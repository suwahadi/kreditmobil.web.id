<?php

namespace App\Livewire\CarDetail;

use App\Models\CarModel;
use Livewire\Component;
use Illuminate\Support\Str;

class CarImageGallery extends Component
{
    public CarModel $car;
    public $selectedColor;

    public function mount(CarModel $car, $selectedColor = null)
    {
        $this->car = $car;
        $this->selectedColor = $selectedColor;
    }

    public function getMainImageUrlProperty()
    {
        if ($this->selectedColor && !empty($this->selectedColor->image_path)) {
            $url = $this->resolveImageUrl($this->selectedColor->image_path);
            if ($url) return $url;
        }
        
        if (!empty($this->car->main_image)) {
            $url = $this->resolveImageUrl($this->car->main_image);
            if ($url) return $url;
        }

        return 'https://placehold.net/default.png';
    }

    protected function resolveImageUrl(?string $path): ?string
    {
        if (empty($path)) return null;

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        $trimmed = ltrim($path, '/');

        return asset($trimmed);
    }

    public function selectColor($colorId)
    {
        $this->selectedColor = $this->car->carColors->find($colorId);
        $this->dispatch('colorSelected', colorId: $colorId);
    }

    public function render()
    {
        return view('livewire.car-detail.car-image-gallery');
    }
}
