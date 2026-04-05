<?php

namespace App\Livewire;

use App\Models\CarModel;
use App\Models\CarType;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CarShowcase extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategories = [];
    public $selectedTransmissions = [];
    public $priceMin = 0;
    public $priceMax = 500000000;
    public $sortBy = 'name-asc';
    public $loading = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategories' => ['except' => []],
        'selectedTransmissions' => ['except' => []],
        'priceMin' => ['except' => 0],
        'priceMax' => ['except' => 500000000],
        'sortBy' => ['except' => 'name-asc'],
    ];

    protected $listeners = [
        'updateFilters' => 'updateFilters',
        'clearAllFilters' => 'clearFilters',
    ];

    public function mount()
    {
        // Set a default price max without database query to avoid mount errors
        $this->priceMax = 500000000;
    }

    public function updating($name, $value)
    {
        $this->loading = true;
        $this->resetPage();
    }

    public function updated($name, $value)
    {
        $this->loading = false;
    }

    public function updateFilters($filters)
    {
        $this->selectedCategories = $filters['selectedCategories'] ?? [];
        $this->selectedTransmissions = $filters['selectedTransmissions'] ?? [];
        $this->priceMin = $filters['priceMin'] ?? 0;
        $this->priceMax = $filters['priceMax'] ?? 500000000;
        $this->resetPage();
    }

    public function getCarsQuery()
    {
        try {
            $query = CarModel::with(['category', 'activeCarTypes', 'carColors'])
                ->where('is_active', true);

            $query->whereHas('activeCarTypes');

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
            if ($this->priceMin > 0 || $this->priceMax < 500000000) {
                $query->whereHas('activeCarTypes', function ($q) {
                    $q->where('price_otr', '>=', $this->priceMin)
                      ->where('price_otr', '<=', $this->priceMax);
                });
            }

            return $query;
        } catch (\Exception $e) {
            return CarModel::where('id', 0);
        }
    }

    public function clearFilters()
    {
        $this->reset([
            'search',
            'selectedCategories',
            'selectedTransmissions',
            'priceMin',
            'priceMax',
        ]);
        $this->priceMax = CarType::max('price_otr') ?? 500000000;
        $this->resetPage();
        
        $this->dispatch('filtersCleared');
    }

    public function render()
    {
        try {
            $cars = $this->getCarsQuery();
            
            switch ($this->sortBy) {
                case 'name-asc':
                    $cars->orderBy('name', 'asc');
                    break;
                case 'name-desc':
                    $cars->orderBy('name', 'desc');
                    break;
                case 'price-asc':
                    $cars->orderByRaw('(SELECT MIN(price_otr) FROM car_types WHERE car_model_id = car_models.id AND is_active = 1) asc');
                    break;
                case 'price-desc':
                    $cars->orderByRaw('(SELECT MIN(price_otr) FROM car_types WHERE car_model_id = car_models.id AND is_active = 1) desc');
                    break;
                default:
                    $cars->orderBy('name', 'asc');
            }
            
            $paginatedCars = $cars->paginate(12);
            $totalCars = $this->getCarsQuery()->count();
            
            return view('livewire.car-showcase', [
                'cars' => $paginatedCars,
                'totalCars' => $totalCars,
            ]);
        } catch (\Exception $e) {
            $emptyCollection = new \Illuminate\Pagination\LengthAwarePaginator(
                collect([]),
                0,
                12,
                1
            );
            
            return view('livewire.car-showcase', [
                'cars' => $emptyCollection,
                'totalCars' => 0,
            ]);
        }
    }
}
