<?php

namespace App\Livewire\News;

use App\Models\News;
use Livewire\Component;

class NewsShow extends Component
{
    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $news = News::with('author')->where('slug', $this->slug)->where('is_active', true)->firstOrFail();
        $more = News::query()
            ->where('id', '!=', $news->id)
            ->where('is_active', true)
            ->latest('created_at')
            ->limit(4)
            ->get();

        return view('livewire.news.show', [
            'news' => $news,
            'more' => $more,
        ])->layout('layouts.app');
    }
}
