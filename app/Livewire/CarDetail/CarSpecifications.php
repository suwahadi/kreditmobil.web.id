<?php

namespace App\Livewire\CarDetail;

use App\Models\CarModel;
use Livewire\Component;

class CarSpecifications extends Component
{
    public CarModel $car;
    public $specifications = [];
    public $expandedSections = [];

    protected $listeners = [
        'typeSelected' => '$refresh',
        'colorSelected' => '$refresh',
    ];

    public function mount(CarModel $car, $specifications = [], $expandedSections = [])
    {
        $this->car = $car;
        $this->specifications = $specifications;
        $this->expandedSections = $expandedSections;
    }

    public function toggleSection($section)
    {
        if (in_array($section, $this->expandedSections)) {
            $this->expandedSections = array_diff($this->expandedSections, [$section]);
        } else {
            $this->expandedSections[] = $section;
        }
    }

    public function isSectionExpanded($section)
    {
        return in_array($section, $this->expandedSections);
    }

    public function getSectionTitleProperty()
    {
        return [
            'dimensions' => 'Dimensi',
            'chassis' => 'Chassis & Suspensi',
            'engine' => 'Mesin',
            'safety' => 'Fitur Keamanan',
            'comfort' => 'Fitur Kenyamanan',
            'additional' => 'Informasi Lainnya',
        ];
    }

    public function render()
    {
        return view('livewire.car-detail.car-specifications');
    }
}
