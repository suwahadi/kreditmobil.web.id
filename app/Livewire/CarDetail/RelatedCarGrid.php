<?php

namespace App\Livewire\CarDetail;

use App\Models\CarModel;
use Livewire\Component;

class RelatedCarGrid extends Component
{
    public CarModel $car;

    public function mount(CarModel $car)
    {
        $this->car = $car->loadMissing(['category', 'activeCarTypes', 'carColors']);
    }

    public function getRelatedProperty()
    {
        return CarModel::with(['category', 'activeCarTypes', 'carColors'])
            ->where('is_active', true)
            ->whereHas('activeCarTypes')
            ->where('id', '!=', $this->car->id)
            ->inRandomOrder()
            ->limit(8)
            ->get();
    }

    public function render()
    {
        return view('livewire.car-detail.related-car-grid', [
            'cars' => $this->related,
        ]);
    }
}
