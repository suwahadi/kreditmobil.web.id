<div class="max-w-6xl mx-auto px-4 py-10" style="font-family: 'Poppins', sans-serif;">
    @php
        $meta = $page->meta_seo ?? [];
        $metaTitle = $meta['meta_title'] ?? $page->title;
        $metaDescription = $meta['meta_description'] ?? str($page->content)->stripTags()->limit(150);
    @endphp

    @push('meta')
        <title>{{ $page->title }} - {{ config('app.name') }}</title>
        @if(!empty($metaTitle))
            <meta name="title" content="{{ $metaTitle }}">
            <meta property="og:title" content="{{ $metaTitle }}">
            <meta name="twitter:title" content="{{ $metaTitle }}">
        @endif
        @if(!empty($metaDescription))
            <meta name="description" content="{{ $metaDescription }}">
            <meta property="og:description" content="{{ $metaDescription }}">
            <meta name="twitter:description" content="{{ $metaDescription }}">
        @endif
        @foreach($meta as $key => $value)
            @continue(in_array($key, ['meta_title','meta_description']))
            <meta name="{{ $key }}" content="{{ is_array($value) ? json_encode($value) : $value }}">
        @endforeach
    @endpush

    <div class="w-full">
        <h1 class="text-3xl font-bold text-slate-900 leading-tight mb-6">{{ $page->title }}</h1>
        <article class="prose max-w-none leading-relaxed [&>p]:mb-5 [&>h2]:mt-8 [&>h2]:mb-3 [&>h3]:mt-6 [&>h3]:mb-2 [&>ul]:my-5 [&>ul]:list-disc [&>ul]:pl-6 [&>ol]:my-5 [&>ol]:list-decimal [&>ol]:pl-6 [&>img]:my-6 [&>img]:rounded-xl">
            {!! $page->content !!}
        </article>
    </div>
</div>
