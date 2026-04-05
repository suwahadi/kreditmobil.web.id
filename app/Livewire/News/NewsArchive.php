<?php

namespace App\Livewire\News;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;

class NewsArchive extends Component
{
    use WithPagination;

    public int $perPage = 8;

    public function render()
    {
        $items = News::query()
            ->with('author')
            ->where('is_active', true)
            ->latest('created_at')
            ->paginate($this->perPage);

        return view('livewire.news.archive', [
            'items' => $items,
        ])->layout('layouts.app');
    }
}
