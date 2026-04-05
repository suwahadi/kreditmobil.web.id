<?php

namespace App\Livewire\Promo;

use App\Models\Promo;
use Livewire\Component;
use Livewire\WithPagination;

class PromoArchive extends Component
{
    use WithPagination;

    public int $perPage = 8;

    public function render()
    {
        $items = Promo::query()
            ->where('is_active', true)
            ->latest('created_at')
            ->paginate($this->perPage);

        return view('livewire.promo.archive', [
            'items' => $items,
        ])->layout('layouts.app');
    }
}
