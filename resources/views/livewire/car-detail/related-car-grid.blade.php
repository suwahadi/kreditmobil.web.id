<div>
    @if($cars->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($cars as $car)
                <livewire:car-card :car="$car" :key="$car->id" />
            @endforeach
        </div>
    @else
        <p class="text-gray-600">Tidak ada model lain untuk ditampilkan saat ini.</p>
    @endif
</div>
