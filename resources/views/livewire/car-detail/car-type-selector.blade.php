<div class="space-y-4">
    <!-- Transmission Selector (Segmented) -->
    <div class="border-t border-gray-200 pt-4">
        <h3 class="text-base font-semibold text-gray-900 mb-2">Pilih Transmisi</h3>
        <div class="flex w-full md:w-auto gap-2">
            @php($options = collect(['MT' => 'Manual','AT' => 'Otomatis','CVT' => 'CVT'])->filter(function($label, $key){ return in_array($key, $this->availableTransmissions->all()); }))
            @foreach($options as $code => $label)
                <button
                    wire:click="selectTransmission('{{ $code }}')"
                    class="flex-1 md:flex-none px-5 py-2 text-sm font-semibold rounded-lg border transition-colors {{ $selectedTransmission === $code ? 'border-blue-600 bg-blue-50 text-blue-700' : 'border-gray-300 bg-white text-gray-800 hover:bg-gray-50' }}"
                >
                    {{ $label }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Type Selector (Dropdown) -->
    <div class="pt-3">
        <h3 class="text-base font-semibold text-gray-900 mb-2">Pilih Tipe</h3>
        <div class="relative">
            <select 
                class="w-full appearance-none px-4 py-3 pr-10 border border-blue-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm font-medium text-gray-900"
                wire:change="selectType($event.target.value)"
            >
                @foreach($this->filteredTypes as $type)
                    <option value="{{ $type->id }}" {{ $selectedType?->id === $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
            <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-blue-500 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </div>
        @if($selectedType)
            <div class="mt-3 text-sm text-gray-600 flex items-center justify-between">
                <span>{{ $selectedType->transmission_label }}</span>
                <span class="font-semibold text-red-600">{{ $selectedType->formatted_price }}</span>
            </div>
        @endif
    </div>
</div>
