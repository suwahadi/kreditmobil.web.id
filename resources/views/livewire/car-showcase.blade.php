<div>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-red-600 to-red-700 text-white py-16 flex items-center justify-center">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-3xl md:text-5xl font-bold mb-4">
                    Daftar Harga Mobil Daihatsu
                </h1>
                <p class="text-xxl md:text-xl text-red-100 mb-8">
                    Temukan kendaraan Daihatsu terbaik yang sesuai kebutuhan Anda
                </p>
                
                <!-- Quick Search -->
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 max-w-md mx-auto">
                    <input 
                        type="text" 
                        placeholder="Cari mobil Daihatsu..."
                        class="w-full px-4 py-3 rounded-lg bg-white/90 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white/50"
                        wire:model.live="search"
                    >
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                
                <!-- Mobile Filter Toggle (Checkbox + Label) -->
                <div class="lg:hidden relative">
                    <input id="toggleFilters" type="checkbox" class="peer sr-only" />
                    <label for="toggleFilters" class="relative z-50 w-full inline-flex items-center justify-center gap-2 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition cursor-pointer select-none bg-white" onclick="event.preventDefault(); var cb=document.getElementById('toggleFilters'); cb.checked=!cb.checked;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M7 12h10"/><path d="M10 18h4"/></svg>
                        <span class="peer-checked:hidden">Filter</span>
                        <span class="hidden peer-checked:inline">Tutup Filter</span>
                    </label>
                    <div id="filtersPanel" class="mt-4 hidden peer-checked:block">
                        <livewire:car-filters />
                    </div>
                </div>

                <!-- Filters Sidebar (Desktop) -->
                <aside class="lg:w-1/4 hidden lg:block">
                    <livewire:car-filters />
                </aside>

                <!-- Car Grid -->
                <main class="lg:w-3/4">
                    <!-- Results Header -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">
                                Mobil Daihatsu
                            </h2>
                            <p class="text-gray-600 mt-1 text-sm">
                                Menampilkan {{ $cars->count() }} dari {{ $totalCars }} mobil
                            </p>
                        </div>
                        
                        <!-- Sort Options -->
                        <div class="flex items-center gap-2">
                            <label class="text-sm text-gray-600">Urutkan:</label>
                            <select 
                                class="text-sm px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                                wire:model.live="sortBy"
                            >
                                <option value="name-asc">Nama: A-Z</option>
                                <option value="name-desc">Nama: Z-A</option>
                                <option value="price-asc">Harga: Rendah ke Tinggi</option>
                                <option value="price-desc">Harga: Tinggi ke Rendah</option>
                            </select>
                        </div>
                    </div>

                    <!-- Loading State -->
                    @if($loading)
                        <div class="flex justify-center items-center py-12">
                            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-red-600"></div>
                        </div>
                    @else
                        <!-- Car Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($cars as $car)
                                <livewire:car-card :car="$car" :key="$car->id" />
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($cars->hasPages())
                            <div class="mt-8 flex justify-center">
                                {{ $cars->links() }}
                            </div>
                        @endif

                        <!-- Empty State -->
                        @if($cars->count() === 0)
                            <div class="text-center py-12">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                    Tidak ada mobil ditemukan
                                </h3>
                                <p class="text-gray-600 mb-6">
                                    Coba ubah filter atau kata kunci pencarian Anda.
                                </p>
                                <button 
                                    wire:click="clearFilters"
                                    class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors"
                                >
                                    Hapus Filter
                                </button>
                            </div>
                        @endif
                    @endif
                </main>
            </div>
        </div>
    </section>
</div>
