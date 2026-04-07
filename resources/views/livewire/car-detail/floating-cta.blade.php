<div class="fixed inset-x-0 bottom-0 z-40">
    <div class="mx-auto max-w-7xl px-4 pb-4">
        <div class="bg-white shadow-xl border border-gray-200 rounded-2xl p-3 md:p-4 flex flex-col md:flex-row md:items-center gap-3 md:gap-4">
            <div class="flex-1">
                <div class="flex items-center gap-2">
                    <span class="text-xs md:text-sm font-extrabold text-gray-900 uppercase">{{ $car->name }}</span>
                    @if($this->selectedType?->name)
                        <span class="hidden md:inline text-xs text-gray-400">|</span>
                        <span class="hidden md:inline text-xs text-gray-500 uppercase">{{ $car->name }} {{ $this->selectedType->name }}</span>
                    @endif
                </div>
                <div class="mt-1 flex items-center gap-2">
                    <p class="text-xl md:text-2xl font-bold text-[#1359D3]">{{ $this->displayPrice }}</p>
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-orange-500 text-white text-xs font-semibold">
                        Harga OTR
                    </span>
                </div>
            </div>
            <div class="flex gap-2 md:gap-3">
                <a href="#SimulasiKredit"
                   class="flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-colors font-medium cursor-pointer">
                    Simulasi Kredit
                </a>
                <button 
                    wire:click="openPenawaran"
                    wire:loading.attr="disabled"
                    wire:target="openPenawaran"
                    class="flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition-colors font-medium cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed">
                    <span wire:loading wire:target="openPenawaran" class="inline-flex items-center gap-2">
                        Mohon Tunggu...
                    </span>
                    <span wire:loading.remove wire:target="openPenawaran">Minta Penawaran</span>
                </button>
            </div>
        </div>
    </div>
</div>
