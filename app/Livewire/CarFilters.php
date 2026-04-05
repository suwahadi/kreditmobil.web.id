<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\CarType;
use Livewire\Component;

class CarFilters extends Component
{
    public $selectedCategories = [];
    public $selectedTransmissions = [];
    public $priceMin = 0;
    public $priceMax = 500000000;
    public $currentPriceMin = 0;
    public $currentPriceMax = 500000000;

    protected $listeners = [
        'updateFilters' => 'updateFilters',
        'filtersCleared' => 'clearAllFilters',
    ];

    public function mount()
    {
        $this->priceMax = CarType::max('price_otr') ?? 500000000;
        $this->currentPriceMax = $this->priceMax;
    }

    public function updated($name, $value)
    {
        $this->dispatch('updateFilters', [
            'selectedCategories' => $this->selectedCategories,
            'selectedTransmissions' => $this->selectedTransmissions,
            'priceMin' => $this->currentPriceMin,
            'priceMax' => $this->currentPriceMax,
        ]);
    }

    public function updatedCurrentPriceMin()
    {
        if ($this->currentPriceMin > $this->currentPriceMax) {
            $this->currentPriceMin = $this->currentPriceMax;
        }
        
        $this->priceMin = $this->currentPriceMin;
        $this->dispatch('updateFilters', [
            'selectedCategories' => $this->selectedCategories,
            'selectedTransmissions' => $this->selectedTransmissions,
            'priceMin' => $this->priceMin,
            'priceMax' => $this->priceMax,
        ]);
    }

    public function updatedCurrentPriceMax()
    {
        if ($this->currentPriceMax < $this->currentPriceMin) {
            $this->currentPriceMax = $this->currentPriceMin;
        }
        
        $this->priceMax = $this->currentPriceMax;
        $this->dispatch('updateFilters', [
            'selectedCategories' => $this->selectedCategories,
            'selectedTransmissions' => $this->selectedTransmissions,
            'priceMin' => $this->priceMin,
            'priceMax' => $this->priceMax,
        ]);
    }

    public function clearAllFilters()
    {
        $this->reset([
            'selectedCategories',
            'selectedTransmissions',
            'currentPriceMin',
            'currentPriceMax',
        ]);
        
        $this->priceMax = CarType::max('price_otr') ?? 500000000;
        $this->currentPriceMax = $this->priceMax;
        
        $this->dispatch('updateFilters', [
            'selectedCategories' => $this->selectedCategories,
            'selectedTransmissions' => $this->selectedTransmissions,
            'priceMin' => $this->currentPriceMin,
            'priceMax' => $this->currentPriceMax,
        ]);
    }

    public function render()
    {
        $categories = Category::withCount('carModels')->orderBy('name')->get();
        $transmissionOptions = [
            'MT' => 'Manual',
            'AT' => 'Otomatis',
            'CVT' => 'CVT',
        ];
        
        $formattedPriceMin = 'Rp ' . number_format($this->currentPriceMin, 0, ',', '.');
        $formattedPriceMax = 'Rp ' . number_format($this->currentPriceMax, 0, ',', '.');
        
        return view('livewire.car-filters', [
            'categories' => $categories,
            'transmissionOptions' => $transmissionOptions,
            'formattedPriceMin' => $formattedPriceMin,
            'formattedPriceMax' => $formattedPriceMax,
        ]);
    }
}
