@props(['items' => collect(), 'type' => 'news'])

<div class="w-full" style="font-family: 'Poppins', sans-serif;">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @foreach ($items as $item)
            @php
                $title = $item->title ?? '';
                $thumb = $item->thumbnail ?? null;
                $isUrl = is_string($thumb) && \Illuminate\Support\Str::startsWith($thumb, ['http://', 'https://']);
                $img = $thumb ? ($isUrl ? $thumb : asset('storage/' . ltrim($thumb, '/'))) : 'https://placehold.net/480x320?text=No+Image';
                $excerpt = \Illuminate\Support\Str::limit(strip_tags($item->content ?? ''), 120);
                $routeName = $type === 'promo' ? 'promo.show' : 'news.show';
            @endphp
            <a href="{{ route($routeName, $item->slug) }}" class="block">
                <article class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="aspect-[4/3] bg-slate-100">
                        <img src="{{ $img }}" alt="{{ $title }}" class="w-full h-full object-cover" loading="lazy">
                    </div>
                    <div class="p-4">
                        <h3 class="text-slate-800 font-semibold leading-tight truncate mb-2">{{ $title }}</h3>
                        <p class="text-slate-600 text-sm line-clamp-3">{{ $excerpt }}</p>
                        <div class="mt-3 text-primary-600 font-semibold text-sm inline-flex items-center gap-1">
                            More
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path fill-rule="evenodd" d="M4.5 12a.75.75 0 0 1 .75-.75h12.19l-3.72-3.72a.75.75 0 1 1 1.06-1.06l5 5a.75.75 0 0 1 0 1.06l-5 5a.75.75 0 1 1-1.06-1.06l3.72-3.72H5.25A.75.75 0 0 1 4.5 12z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </article>
            </a>
        @endforeach
    </div>
</div>
