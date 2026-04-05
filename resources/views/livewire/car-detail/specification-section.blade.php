<div class="rounded-xl overflow-hidden shadow-sm">
    @php($sectionId = \Illuminate\Support\Str::slug($title))
    <!-- Section Header -->
    <button 
        wire:click="toggle"
        class="w-full px-5 py-3 transition-colors duration-200 flex items-center justify-between text-left rounded-xl border cursor-pointer {{ $isExpanded ? 'bg-blue-50 border-blue-100' : 'bg-blue-50/60 hover:bg-blue-50 border-blue-100' }}"
        aria-controls="panel-{{ $sectionId }}"
        aria-expanded="{{ $isExpanded ? 'true' : 'false' }}"
    >
        <h3 class="text-sm md:text-base font-semibold {{ $isExpanded ? 'text-blue-700' : 'text-blue-700' }}">{{ $title }}</h3>
        <div class="flex items-center">
            <svg 
                class="w-4 h-4 text-blue-600 transition-transform duration-300 {{ $isExpanded ? 'rotate-180' : '' }}" 
                fill="none" 
                stroke="currentColor" 
                viewBox="0 0 24 24"
                aria-hidden="true"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    </button>

    <!-- Section Content -->
    <div 
        id="panel-{{ $sectionId }}"
        class="transition-all duration-300 ease-in-out {{ $isExpanded ? 'max-h-[36rem] opacity-100' : 'max-h-0 opacity-0' }} overflow-hidden"
    >
        <div class="p-5 bg-blue-50 rounded-b-xl border border-t-0 border-blue-100">
            @if(count($specifications) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-3">
                    @foreach($specifications as $label => $value)
                        <div class="text-sm flex items-start gap-4">
                            <span class="text-gray-700 font-medium flex-1 pr-2">{{ $label }}</span>
                            <span class="text-gray-900 text-right flex-1">{{ $value }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-6 text-gray-500">
                    <svg class="w-8 h-8 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-sm">Spesifikasi tidak tersedia</p>
                </div>
            @endif
        </div>
    </div>
</div>
