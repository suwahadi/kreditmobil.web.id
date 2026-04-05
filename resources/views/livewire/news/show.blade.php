<div class="max-w-6xl mx-auto px-4 py-10" style="font-family: 'Poppins', sans-serif;">
    @php
        $meta = $news->meta_seo ?? [];
        $metaTitle = $meta['meta_title'] ?? $news->title;
        $metaDescription = $meta['meta_description'] ?? str($news->content)->stripTags()->limit(150);
        $thumb = $news->thumbnail ?? null;
        $isUrl = is_string($thumb) && \Illuminate\Support\Str::startsWith($thumb, ['http://', 'https://']);
        $img = $thumb ? ($isUrl ? $thumb : asset('storage/' . ltrim($thumb, '/'))) : 'https://placehold.net/800x500?text=No+Image';
    @endphp
    <div class="w-full">
        <div class="aspect-[16/9] bg-slate-100 rounded-2xl overflow-hidden mb-6">
            <img src="{{ $img }}" alt="{{ $news->title }}" class="w-full h-full object-cover">
        </div>
        <h1 class="text-3xl font-bold text-slate-900 leading-tight mb-2">{{ $news->title }}</h1>
        <p class="text-slate-500 text-sm mb-6">
            {{ $news->created_at->format('d M Y, H:i:s') }} | {{ $news->author?->name ?? 'Admin' }}
        </p>
        <article class="prose max-w-none leading-relaxed [&>p]:mb-5 [&>h2]:mt-8 [&>h2]:mb-3 [&>h3]:mt-6 [&>h3]:mb-2 [&>ul]:my-5 [&>ul]:list-disc [&>ul]:pl-6 [&>ol]:my-5 [&>ol]:list-decimal [&>ol]:pl-6 [&>img]:my-6 [&>img]:rounded-xl">
            {!! $news->content !!}
        </article>
    </div>

    <div class="max-w-6xl mx-auto mt-12">
        <h2 class="text-xl font-semibold text-slate-800 mb-4">Berita Lainnya</h2>
        <x-content.grid :items="$more" type="news" />
    </div>
</div>
