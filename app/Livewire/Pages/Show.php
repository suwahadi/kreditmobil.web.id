<?php

namespace App\Livewire\Pages;

use App\Models\Page;
use Livewire\Component;

class Show extends Component
{
    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $page = Page::query()
            ->where('slug', $this->slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('livewire.pages.show', [
            'page' => $page,
        ])->layout('layouts.app');
    }
}
