<div class="max-w-6xl mx-auto px-4 py-10" style="font-family: 'Poppins', sans-serif;">
    <h1 class="text-2xl font-semibold text-slate-800 mb-6">Promo Daihatsu</h1>

    <x-content.grid :items="$items" type="promo" />

    <div class="mt-8">
        {{ $items->links() }}
    </div>
</div>
