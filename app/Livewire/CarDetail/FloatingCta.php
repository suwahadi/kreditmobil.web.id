<?php

namespace App\Livewire\CarDetail;

use Livewire\Component;

class FloatingCta extends Component
{
    public $car;
    public $selectedType;

    protected $listeners = [
        'typeSelected' => 'updateSelectedType',
    ];

    public function mount($car, $selectedType = null)
    {
        $this->car = $car;
        $this->selectedType = $selectedType;
    }

    public function updateSelectedType($typeId)
    {
        $this->selectedType = $this->car->activeCarTypes->find($typeId);
    }

    public function getDisplayPriceProperty()
    {
        if ($this->selectedType && isset($this->selectedType->formatted_price)) {
            return $this->selectedType->formatted_price;
        }
        return number_format($this->car->min_price ?? 0, 0, ',', '.');
    }

    public function openSimulasiKredit()
    {
        $this->dispatch('openSimulasiKredit');
    }

    public function openPenawaran()
    {
        $this->dispatch('openPenawaran', $this->car->id);
    }

    public function render()
    {
        return view('livewire.car-detail.floating-cta');
    }
}
