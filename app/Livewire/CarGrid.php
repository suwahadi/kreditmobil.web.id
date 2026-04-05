<?php

namespace App\Livewire;

use App\Models\CarModel;
use Livewire\Component;
use Livewire\WithPagination;

class CarGrid extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategories = [];
    public $selectedTransmissions = [];
    public $priceMin = 0;
    public $priceMax = 500000000;
    public $sortBy = 'name-asc';

    protected $listeners = [
        'updateFilters' => 'updateFilters',
        'updateSort' => 'updateSort',
    ];

    public function updateFilters($filters)
    {
        $this->selectedCategories = $filters['selectedCategories'] ?? [];
        $this->selectedTransmissions = $filters['selectedTransmissions'] ?? [];
        $this->priceMin = $filters['priceMin'] ?? 0;
        $this->priceMax = $filters['priceMax'] ?? 500000000;
        $this->resetPage();
    }

    public function updateSort($sort)
    {
        $this->sortBy = $sort;
        $this->resetPage();
    }

    public function getCarsQuery()
    {
        $query = CarModel::with(['category', 'activeCarTypes', 'carColors'])
            ->whereHas('activeCarTypes')
            ->where('is_active', true);

        // Add min_price and max_price to query for sorting
        $query->selectRaw('*, (
            SELECT MIN(price_otr) 
            FROM car_types 
            WHERE car_model_id = car_models.id 
            AND is_active = 1
        ) as min_price, (
            SELECT MAX(price_otr) 
            FROM car_types 
            WHERE car_model_id = car_models.id 
            AND is_active = 1
        ) as max_price');

        // Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Category filter
        if (!empty($this->selectedCategories)) {
            $query->whereIn('category_id', $this->selectedCategories);
        }

        // Transmission filter
        if (!empty($this->selectedTransmissions)) {
            $query->whereHas('activeCarTypes', function ($q) {
                $q->whereIn('transmission', $this->selectedTransmissions);
            });
        }

        // Price filter
        $query->whereHas('activeCarTypes', function ($q) {
            $q->where('price_otr', '>=', $this->priceMin)
              ->where('price_otr', '<=', $this->priceMax);
        });

        return $query;
    }

    public function getCarsProperty()
    {
        return $this->getCarsQuery()
            ->orderBy($this->getSortColumn(), $this->getSortDirection())
            ->paginate(12);
    }

    protected function getSortColumn()
    {
        return match (explode('-', $this->sortBy)[0]) {
            'name' => 'name',
            'price' => 'min_price',
            default => 'name',
        };
    }

    protected function getSortDirection()
    {
        return match (explode('-', $this->sortBy)[1]) {
            'asc' => 'asc',
            'desc' => 'desc',
            default => 'asc',
        };
    }

    public function render()
    {
        return view('livewire.car-grid', [
            'cars' => $this->cars,
        ]);
    }
}
