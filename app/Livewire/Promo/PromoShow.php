<?php

namespace App\Livewire\Promo;

use App\Models\Promo;
use Livewire\Component;

class PromoShow extends Component
{
    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $promo = Promo::query()->where('slug', $this->slug)->where('is_active', true)->firstOrFail();
        $more = Promo::query()
            ->where('id', '!=', $promo->id)
            ->where('is_active', true)
            ->latest('created_at')
            ->limit(4)
            ->get();

        return view('livewire.promo.show', [
            'promo' => $promo,
            'more' => $more,
        ]);
    }
}
