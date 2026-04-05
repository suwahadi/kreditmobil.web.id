<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Spesifikasi Lengkap {{ $car->name }}</h2>

    <div class="space-y-3">
        @foreach($this->specifications as $sectionKey => $items)
            @php
                $humanTitle = ucwords(str_replace(['_', '-'], ' ', $sectionKey));
            @endphp
            <div>
                <livewire:car-detail.specification-section 
                    :title="$humanTitle"
                    :specifications="$items"
                    :is-expanded="in_array($sectionKey, $this->expandedSections)"
                    :key="'spec-' . $sectionKey"
                />
            </div>
        @endforeach
    </div>
    
    <div class="mt-6 p-4 bg-gray-50 rounded-lg">
        <p class="text-sm text-gray-600 text-center">
            <strong>Disclaimer:</strong> Spesifikasi dapat berubah sewaktu-waktu tanpa pemberitahuan terlebih dahulu. 
            Hubungi dealer resmi Daihatsu untuk informasi terkini.
        </p>
    </div>
</div>
