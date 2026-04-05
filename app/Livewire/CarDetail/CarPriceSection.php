<?php

namespace App\Livewire\CarDetail;

use Livewire\Component;

class CarPriceSection extends Component
{
    public $car;
    public $selectedType;

    protected $listeners = [
        'typeSelected' => 'updateSelectedType',
        'colorSelected' => '$refresh',
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

    public function getCurrentPriceProperty()
    {
        if ($this->selectedType) {
            return $this->selectedType->formatted_price;
        }
        
        return number_format($this->car->min_price, 0, ',', '.');
    }

    public function render()
    {
        return view('livewire.car-detail.car-price-section');
    }
}
