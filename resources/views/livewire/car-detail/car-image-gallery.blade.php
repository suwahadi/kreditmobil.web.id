<div>
    <!-- Main Image -->
    <div class="relative h-[420px] bg-white rounded-lg overflow-hidden mb-4 flex items-center justify-center">
        <img 
            src="{{ $this->mainImageUrl }}" 
            alt="{{ $car->name }}"
            class="max-h-full w-auto object-contain"
            onerror="this.src='https://placehold.net/default.png'"
            loading="lazy"
        >
    </div>

    <!-- Color Selection -->
    @if($car->carColors->count() > 0)
        <div class="pt-2">
            @if($selectedColor)
                <div class="text-center text-xs md:text-sm font-semibold tracking-wide text-gray-800 uppercase mb-2">
                    {{ $selectedColor->color_name }}
                </div>
            @else
                <h3 class="text-center text-xs md:text-sm font-semibold text-gray-700 mb-2">Pilih Warna</h3>
            @endif
            <div class="flex flex-wrap justify-center gap-3">
                @foreach($car->carColors as $color)
                    <button 
                        wire:click="selectColor({{ $color->id }})"
                        class="relative group"
                        title="{{ $color->color_name }}"
                    >
                        <div 
                            class="w-7 h-7 md:w-8 md:h-8 rounded-full transition-all duration-200 border {{ $selectedColor?->id == $color->id ? 'border-white ring-2 ring-blue-600 ring-offset-2 ring-offset-white' : 'border-gray-300 hover:border-gray-400' }}"
                            style="background-color: {{ $color->hex_code }};"
                        ></div>
                        <span class="absolute -bottom-5 left-1/2 transform -translate-x-1/2 text-[10px] md:text-xs text-gray-600 whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity">
                            {{ $color->color_name }}
                        </span>
                    </button>
                @endforeach
            </div>
        </div>
    @endif
</div>
