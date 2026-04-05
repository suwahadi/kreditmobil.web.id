<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-4">
    <!-- Filter Header -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-900">Filter</h3>
        <button 
            wire:click="clearAllFilters"
            class="text-sm text-red-600 hover:text-red-700 font-medium"
        >
            Hapus Semua
        </button>
    </div>

    <!-- Categories Filter -->
    <div class="mb-6">
        <h4 class="text-sm font-semibold text-gray-900 mb-3">Kategori</h4>
        <div class="space-y-2">
            @foreach($categories as $category)
                <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded">
                    <input 
                        type="checkbox" 
                        value="{{ $category->id }}"
                        wire:model.live="selectedCategories"
                        class="rounded border-gray-300 text-red-600 focus:ring-red-500"
                    >
                    <span class="ml-3 text-sm text-gray-700">
                        {{ $category->name }}
                        <span class="text-gray-400">({{ $category->car_models_count }})</span>
                    </span>
                </label>
            @endforeach
        </div>
    </div>

    <!-- Transmission Filter -->
    <div class="mb-6">
        <h4 class="text-sm font-semibold text-gray-900 mb-3">Transmisi</h4>
        <div class="space-y-2">
            @foreach($transmissionOptions as $value => $label)
                <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded">
                    <input 
                        type="checkbox" 
                        value="{{ $value }}"
                        wire:model.live="selectedTransmissions"
                        class="rounded border-gray-300 text-red-600 focus:ring-red-500"
                    >
                    <span class="ml-3 text-sm text-gray-700">{{ $label }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <!-- Price Range Filter -->
    <div class="mb-6">
        <h4 class="text-sm font-semibold text-gray-900 mb-3">Rentang Harga</h4>
        
        <!-- Price Display -->
        <div class="mb-4 p-3 bg-gray-50 rounded-lg">
            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-600">Minimum:</span>
                <span class="font-semibold text-gray-900">{{ $formattedPriceMin }}</span>
            </div>
            <div class="flex justify-between items-center text-sm mt-1">
                <span class="text-gray-600">Maksimum:</span>
                <span class="font-semibold text-gray-900">{{ $formattedPriceMax }}</span>
            </div>
        </div>

        <!-- Price Sliders -->
        <div class="space-y-4">
            <!-- Min Price -->
            <div>
                <label class="text-xs text-gray-600">Harga Minimum</label>
                <input 
                    type="range" 
                    min="0" 
                    max="{{ $priceMax }}"
                    step="1000000"
                    wire:model.live="currentPriceMin"
                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-red-600"
                >
            </div>
            
            <!-- Max Price -->
            <div>
                <label class="text-xs text-gray-600">Harga Maksimum</label>
                <input 
                    type="range" 
                    min="0" 
                    max="{{ $priceMax }}"
                    step="1000000"
                    wire:model.live="currentPriceMax"
                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-red-600"
                >
            </div>
        </div>
    </div>

    <!-- Active Filters Summary -->
    @if(count($selectedCategories) > 0 || count($selectedTransmissions) > 0 || $currentPriceMin > 0 || $currentPriceMax < $priceMax)
        <div class="pt-4 border-t border-gray-200">
            <h4 class="text-sm font-semibold text-gray-900 mb-2">Filter Aktif</h4>
            <div class="flex flex-wrap gap-2">
                <!-- Selected Categories -->
                @foreach($selectedCategories as $categoryId)
                    @php
                        $category = $categories->where('id', $categoryId)->first();
                    @endphp
                    @if($category)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            {{ $category->name }}
                            <button 
                                wire:click="selectedCategories = array_diff(selectedCategories, [{{ $categoryId }}])"
                                class="ml-1 text-red-600 hover:text-red-800"
                            >
                                ×
                            </button>
                        </span>
                    @endif
                @endforeach
                
                <!-- Selected Transmissions -->
                @foreach($selectedTransmissions as $transmission)
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        {{ $transmissionOptions[$transmission] }}
                        <button 
                            wire:click="selectedTransmissions = array_diff(selectedTransmissions, ['{{ $transmission }}'])"
                            class="ml-1 text-red-600 hover:text-red-800"
                        >
                            ×
                        </button>
                    </span>
                @endforeach
                
                <!-- Price Range -->
                @if($currentPriceMin > 0 || $currentPriceMax < $priceMax)
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        {{ $formattedPriceMin }} - {{ $formattedPriceMax }}
                        <button 
                            wire:click="currentPriceMin = 0; currentPriceMax = {{ $priceMax }}"
                            class="ml-1 text-red-600 hover:text-red-800"
                        >
                            ×
                        </button>
                    </span>
                @endif
            </div>
        </div>
    @endif
</div>
