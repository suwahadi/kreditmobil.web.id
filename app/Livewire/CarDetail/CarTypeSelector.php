<?php

namespace App\Livewire\CarDetail;

use App\Models\CarModel;
use Livewire\Component;

class CarTypeSelector extends Component
{
    public CarModel $car;
    public $selectedTransmission = 'all';
    public $selectedType = null;

    protected $listeners = [
        'colorSelected' => '$refresh',
    ];

    public function mount(CarModel $car, $selectedTransmission = 'all', $selectedType = null)
    {
        $this->car = $car;
        $this->selectedTransmission = $selectedTransmission;
        $this->selectedType = $selectedType;
    }

    public function getFilteredTypesProperty()
    {
        $types = $this->car->activeCarTypes;

        if ($this->selectedTransmission !== 'all') {
            $types = $types->where('transmission', $this->selectedTransmission);
        }

        return $types->values();
    }

    public function getAvailableTransmissionsProperty()
    {
        return $this->car->activeCarTypes
            ->pluck('transmission')
            ->unique()
            ->sort()
            ->values();
    }

    public function selectTransmission($transmission)
    {
        $this->selectedTransmission = $transmission;
        
        // Auto-select first available type for this transmission
        $firstType = $this->filteredTypes->first();
        if ($firstType) {
            $this->selectType($firstType->id);
        }
    }

    public function selectType($typeId)
    {
        $this->selectedType = $this->car->activeCarTypes->find($typeId);
        $this->selectedTransmission = $this->selectedType->transmission ?? 'all';
        
        $this->dispatch('typeSelected', typeId: $typeId, transmission: $this->selectedTransmission);
    }

    public function render()
    {
        return view('livewire.car-detail.car-type-selector');
    }
}
