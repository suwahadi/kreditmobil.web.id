<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200 flex flex-col min-h-[400px]">
    <!-- Car Image -->
    <a href="{{ route('car.detail', $car->slug) }}" class="block relative h-48 bg-gray-100 hover:bg-gray-200 transition-colors">
        @if($cheapestType)
            <img 
                src="{{ !empty($car->main_image) ? $car->main_image : 'https://placehold.net/default.png' }}" 
                alt="{{ $car->name }}"
                class="w-full h-full object-cover"
                onerror="this.src='https://placehold.net/default.png'"
                loading="lazy"
            >
        @else
            <div class="w-full h-full flex items-center justify-center">
                <img 
                    src="https://placehold.net/default.png"
                    alt="{{ $car->name }}"
                    class="w-full h-full object-cover"
                    loading="lazy"
                >
            </div>
        @endif
        
        <!-- Category Badge -->
        <div class="absolute top-2 left-2">
            <span class="px-2 py-1 bg-red-600 text-white text-xs font-medium rounded-full">
                {{ $car->category->name }}
            </span>
        </div>
    </a>

    <!-- Car Details -->
    <div class="p-3 flex-grow flex flex-col">
        <!-- Car Name -->
        <h3 class="text-lg font-semibold text-gray-900 mb-2">
            <a href="{{ route('car.detail', $car->slug) }}" class="hover:text-red-600 transition-colors">
                {{ $car->name }}
            </a>
        </h3>

        <!-- Transmission Types -->
        @if($transmissionTypes->count() > 0)
            <div class="flex flex-wrap gap-1 mb-1">
                @foreach($transmissionTypes as $transmission)
                    <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs rounded-full">{{ $transmission }}</span>
                @endforeach
            </div>
        @endif

        <!-- Price -->
        @if($cheapestType)
            <div class="mt-2 mb-2">
                <p class="text-xs text-gray-500 mb-1">Mulai dari</p>
                <p class="text-xl font-bold text-red-600">
                    {{ $cheapestType->formatted_price }}
                </p>
            </div>
        @endif

        <div class="flex-grow"></div>
        <!-- Action Buttons -->
        <a 
            href="{{ route('car.detail', $car->slug) }}"
            class="w-full px-4 py-2 bg-red-600 text-white text-center rounded-lg hover:bg-red-700 transition-colors text-sm font-medium"
        >
            Lihat Detail
        </a>
    </div>
</div>
