<div class="space-y-6">
    <!-- Heading & Price -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="mb-3">
            <h2 class="text-2xl font-extrabold text-gray-900 leading-tight uppercase">{{ $car->name }}</h2>
        </div>
        <div class="flex items-center gap-3 mb-4">
            <p class="text-2xl font-bold text-red-600">{{ $this->currentPrice }}</p>
            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-orange-500 text-white text-xs font-semibold">
                Harga OTR
            </span>
        </div>
        <div class="border-t border-gray-200 pt-4">
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">Kredit Mulai</p>
                    <p class="font-semibold text-blue-600">Rp {{ number_format(max(1, ($car->min_price ?? 0)/60), 0, ',', '.') }}/bln × 60</p>
                </div>
                <div class="text-right">
                    <p class="text-gray-500">Total Uang Muka</p>
                    <p class="font-semibold text-gray-800">Rp {{ number_format(max(0, ($car->min_price ?? 0)*0.2), 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="mt-2">
                <a href="#SimulasiKredit" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 text-sm font-medium rounded-md px-2 py-1 hover:bg-blue-50 transition-colors" aria-label="Buka Simulasi Kredit">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path d="M7 3.75A2.75 2.75 0 0 0 4.25 6.5v11A2.75 2.75 0 0 0 7 20.25h10A2.75 2.75 0 0 0 19.75 17.5v-11A2.75 2.75 0 0 0 17 3.75H7zm-.25 3.5c0-.414.336-.75.75-.75h9c.414 0 .75.336.75.75v2c0 .414-.336.75-.75.75h-9a.75.75 0 0 1-.75-.75v-2zM7.5 13.25a.75.75 0 0 1 .75-.75h2a.75.75 0 0 1 0 1.5h-2a.75.75 0 0 1-.75-.75zm0 3a.75.75 0 0 1 .75-.75h2a.75.75 0 0 1 0 1.5h-2a.75.75 0 0 1-.75-.75zm5-3a.75.75 0 0 1 .75-.75h2a.75.75 0 0 1 0 1.5h-2a.75.75 0 0 1-.75-.75zm0 3a.75.75 0 0 1 .75-.75h2a.75.75 0 0 1 0 1.5h-2a.75.75 0 0 1-.75-.75z"/>
                    </svg>
                    <span>Simulasi Kredit</span>
                </a>
            </div>
        </div>
    </div>

</div>
