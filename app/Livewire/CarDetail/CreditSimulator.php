<?php

namespace App\Livewire\CarDetail;

use App\Models\CarModel;
use Livewire\Component;

class CreditSimulator extends Component
{
    public CarModel $car;
    public $selectedType = null; // CarType model instance
    public ?int $selectedTypeId = null; // for dropdown binding

    public int $tenor = 60; // months
    public float $annualRate = 0.065; // 6.5% per year assumption

    public float $dpPercent = 0.30; // 0.20 - 0.70
    public int $dpPercentSlider = 30; // 20 - 70 (UI binding)
    public int $dpAmount = 0; // computed from percent and OTR

    protected $listeners = [
        'typeSelected' => 'onTypeSelected',
    ];

    public function mount(CarModel $car, $selectedType = null)
    {
        $this->car = $car->loadMissing('activeCarTypes');
        $this->selectedTypeId = $selectedType ? ($selectedType->id ?? (int)$selectedType) : null;
        $this->setSelectedTypeById($this->selectedTypeId);
        $this->dpPercentSlider = (int) round($this->dpPercent * 100);
        $this->resetInputs();
    }

    public function getTypesProperty()
    {
        return $this->car->activeCarTypes->values();
    }

    public function getOtrProperty(): int
    {
        $typeId = $this->selectedType ? (is_object($this->selectedType) ? $this->selectedType->id : $this->selectedType) : null;
        $type = $typeId ? $this->car->activeCarTypes->find($typeId) : null;
        $price = $this->effectiveTypePrice($type);
        if ($price > 0) {
            return $price;
        }
        $cheapest = $this->cheapestType();
        return $this->effectiveTypePrice($cheapest);
    }

    public function updatedDpPercentSlider()
    {
        $this->dpPercentSlider = max(20, min(70, (int)$this->dpPercentSlider));
        $this->dpPercent = $this->dpPercentSlider / 100.0;
        $this->recalculateDpFromPercent();
    }

    public function updatedDpAmount()
    {
        $otr = $this->otr;
        $raw = (int)preg_replace('/[^0-9]/', '', (string)$this->dpAmount);
        $min = (int) round($otr * 0.20);
        $max = (int) round($otr * 0.70);
        $amount = max($min, min($max, $raw));
        $this->dpAmount = $amount;
        $this->dpPercent = $otr > 0 ? round($amount / $otr, 4) : 0;
        $this->dpPercentSlider = (int) round(max(0.20, min(0.70, $this->dpPercent)) * 100);
    }

    public function updateType($typeId)
    {
        $this->selectedTypeId = (int) $typeId;
        $this->updatedSelectedTypeId();
    }

    public function setDpPercentSlider($value)
    {
        $this->dpPercentSlider = max(20, min(70, (int)$value));
        $this->dpPercent = $this->dpPercentSlider / 100.0;
        $this->recalculateDpFromPercent();
    }

    public function setTypeId($id)
    {
        $this->selectedTypeId = (int) $id;
        $this->updatedSelectedTypeId();
    }

    public function onTypeSelected($typeId)
    {
        $this->selectedTypeId = (int) $typeId;
        $this->setSelectedTypeById($this->selectedTypeId);
        $this->resetInputs();
    }

    public function updatedSelectedTypeId()
    {
        $typeId = $this->selectedTypeId ?: 0;
        $this->setSelectedTypeById($typeId);
        if ($typeId) {
            $this->dispatch('typeSelected', typeId: $typeId, transmission: optional($this->car->activeCarTypes->find($typeId))->transmission);
        }
        $this->resetInputs();
    }

    protected function setSelectedTypeById($typeId = null)
    {
        if ($typeId) {
            $this->selectedType = $this->car->activeCarTypes->find($typeId);
        }
        if (!$this->selectedType) {
            $this->selectedType = $this->cheapestType();
        }
        $this->selectedTypeId = $this->selectedType?->id ?? null;
    }

    protected function cheapestType()
    {
        return $this->car->activeCarTypes
            ->filter(function ($t) { return $this->effectiveTypePrice($t) > 0; })
            ->sortBy(function ($t) { return $this->effectiveTypePrice($t); })
            ->first();
    }

    protected function effectiveTypePrice($type): int
    {
        if (!$type) return 0;
        foreach (['price_otr','price','otr_price','otr'] as $field) {
            if (isset($type->{$field}) && (int)$type->{$field} > 0) {
                return (int)$type->{$field};
            }
        }
        return 0;
    }

    protected function resetInputs()
    {
        $this->tenor = 60;
        $this->dpPercent = 0.30;
        $this->dpPercentSlider = 30;
        $this->recalculateDpFromPercent();
    }

    protected function recalculateDpFromPercent()
    {
        $otr = $this->otr;
        $this->dpAmount = (int) round($otr * $this->dpPercent);
    }

    public function calculateMonthlyPayment(): int
    {
        $otr = $this->otr;
        $principal = max(0, $otr - $this->dpAmount);
        if ($principal <= 0 || $this->tenor <= 0) {
            return 0;
        }
        $monthlyRate = $this->annualRate / 12.0; // annuity
        if ($monthlyRate <= 0) {
            return (int) ceil($principal / $this->tenor);
        }
        $factor = ($monthlyRate * pow(1 + $monthlyRate, $this->tenor)) / (pow(1 + $monthlyRate, $this->tenor) - 1);
        return (int) round($principal * $factor);
    }

    public function openPenawaran()
    {
        $this->dispatch('openPenawaran', $this->car->id);
    }

    public function render()
    {
        $monthly = $this->calculateMonthlyPayment();
        return view('livewire.car-detail.credit-simulator', [
            'car' => $this->car,
            'otr' => $this->otr,
            'monthly' => $monthly,
        ]);
    }
}
