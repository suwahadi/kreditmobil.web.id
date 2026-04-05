<div class="max-w-6xl mx-auto px-4 py-10" style="font-family: 'Poppins', sans-serif;">
    <h1 class="text-2xl font-semibold text-slate-800 mb-6">Berita Daihatsu</h1>

    @if ($items->count())
        <x-content.grid :items="$items" type="news" />
    @else
        <div class="bg-white rounded-2xl border border-slate-200 p-8 text-center text-slate-500">
            Belum ada artikel untuk saat ini.
        </div>
    @endif

    <div class="mt-8">
        {{ $items->links() }}
    </div>
</div>
