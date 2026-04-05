<div class="max-w-6xl mx-auto px-4 py-10" style="font-family: 'Poppins', sans-serif;">
    @php
        $metaTitle = $promo->title;
        $metaDescription = str($promo->content)->stripTags()->limit(150);
        $thumb = $promo->thumbnail ?? null;
        $isUrl = is_string($thumb) && \Illuminate\Support\Str::startsWith($thumb, ['http://', 'https://']);
        $img = $thumb ? ($isUrl ? $thumb : asset('storage/' . ltrim($thumb, '/'))) : 'https://placehold.net/800x500?text=No+Image';
    @endphp
    <div class="w-full">
        <div class="aspect-[16/9] bg-slate-100 rounded-2xl overflow-hidden mb-6">
            <img src="{{ $img }}" alt="{{ $promo->title }}" class="w-full h-full object-cover">
        </div>
        <h1 class="text-3xl font-bold text-slate-900 leading-tight mb-2">{{ $promo->title }}</h1>
        <p class="text-slate-500 text-sm mb-6">
            {{ $promo->created_at->format('d M Y, H:i:s') }}
        </p>
        <article class="prose max-w-none">
            {!! $promo->content !!}
        </article>
    </div>

    <div class="max-w-6xl mx-auto mt-12">
        <h2 class="text-xl font-semibold text-slate-800 mb-4">Promo Lainnya</h2>
        <x-content.grid :items="$more" type="promo" />
    </div>
</div>
