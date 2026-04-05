<?php

namespace App\Livewire;

use App\Models\CarModel;
use Livewire\Component;

class CarCard extends Component
{
    public CarModel $car;

    public function mount(CarModel $car)
    {
        $this->car = $car;
    }

    public function getPrimaryColorProperty()
    {
        return $this->car->carColors->first();
    }

    public function getCheapestTypeProperty()
    {
        return $this->car->activeCarTypes->sortBy('price_otr')->first();
    }

    public function getTransmissionTypesProperty()
    {
        return $this->car->activeCarTypes->pluck('transmission')->unique()->sort()->values();
    }

    public function render()
    {
        return view('livewire.car-card', [
            'primaryColor' => $this->primaryColor,
            'cheapestType' => $this->cheapestType,
            'transmissionTypes' => $this->transmissionTypes,
        ]);
    }
}
