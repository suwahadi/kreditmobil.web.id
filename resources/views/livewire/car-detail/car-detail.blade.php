<div>
    <section class="py-6">
        <div class="max-w-6xl mx-auto px-4">
            <nav class="mb-4" aria-label="Breadcrumb">
                <ol class="flex items-center text-sm text-gray-500 gap-2">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-gray-700">Home</a>
                    </li>
                    <li class="text-gray-400">›</li>
                    <li>
                        <a href="#" class="hover:text-gray-700">Mobil</a>
                    </li>
                    <li class="text-gray-400">›</li>
                    <li class="text-[#1359D3] font-bold uppercase">{{ $car->name }}</li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                <div class="lg:col-span-7">
                    <livewire:car-detail.car-image-gallery 
                        :car="$car" 
                        :selected-color="$this->selectedColor"
                        key="image-gallery"
                    />
                </div>

                <div class="lg:col-span-5 space-y-6">
                    <livewire:car-detail.car-price-section 
                        :car="$car"
                        :selected-type="$this->selectedType"
                        key="price-section"
                    />

                    <!-- Transmission & Type selectors moved to right column -->
                    <livewire:car-detail.car-type-selector 
                        :car="$car"
                        :selected-transmission="$this->selectedTransmission"
                        :selected-type="$this->selectedType"
                        key="type-selector"
                    />
                </div>
            </div>

            <!-- Specifications Section -->
            <div class="mt-12">
                <livewire:car-detail.car-specifications 
                    :car="$car"
                    :specifications="$this->specifications"
                    :expanded-sections="$this->expandedSections"
                    key="specifications"
                />
            </div>

            <!-- Credit Simulator Section -->
            <div id="credit-simulator-section" class="mt-12 scroll-mt-24">
                <livewire:car-detail.credit-simulator 
                    :car="$car"
                    :selected-type="$this->selectedType"
                    key="credit-simulator"
                />
            </div>

            <!-- Deskripsi Mobil -->
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi {{ $car->name }}</h2>
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed space-y-4">
                    {!! $car->description !!}
                </div>
            </div>

            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Model Daihatsu Lainnya</h2>
                <livewire:car-detail.related-car-grid :car="$car" key="related-car-grid" />
            </div>
        </div>
    </section>


    <!-- Floating CTA -->
    <livewire:car-detail.floating-cta 
        :car="$car" 
        :selected-type="$this->selectedType"
        key="floating-cta"
    />

    <!-- Offer Modal -->
    <livewire:car-detail.offer-modal 
        :car="$car"
        key="offer-modal"
    />
</div>
