<div class="mt-12" id="SimulasiKredit">
    <section class="rounded-xl p-6 md:p-8" style="background-color:#E6F1FF;">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl font-semibold text-[#2E6ADB] mb-6">Simulasi Kredit {{ $car->name }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left controls -->
                <div>
                    <!-- Type selector -->
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Mobil</label>
                    <select
                        class="w-full rounded-xl bg-white border-2 border-[#D2E6FF] focus:border-[#2E6ADB] focus:ring-[#2E6ADB] text-sm px-3 py-3"
                        wire:input="setTypeId($event.target.value)"
                    >
                        @foreach($this->types as $type)
                            <option value="{{ $type->id }}">
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- DP amount and percent -->
                    <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-4 items-end">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Uang Muka</label>
                            <div class="relative">
                                <input type="hidden" id="dp-hidden-{{ $car->id }}" wire:model="dpAmount" wire:key="dp-hidden-{{ $dpAmount }}">
                                <input type="text"
                                       id="dp-input-{{ $car->id }}"
                                       class="w-full rounded-xl bg-white border-2 border-[#D2E6FF] focus:border-[#2E6ADB] focus:ring-[#2E6ADB] px-3 py-3"
                                       value="{{ 'Rp ' . number_format($dpAmount,0,',','.') }}"
                                       wire:key="dp-input-{{ $dpAmount }}"
                                       oninput="(function(el){
                                           const raw=(el.value||'').toString().replace(/\D/g,'');
                                           const hidden=document.getElementById('dp-hidden-{{ $car->id }}');
                                           if(hidden){ hidden.value = raw; hidden.dispatchEvent(new Event('input',{bubbles:true})); }
                                           el.value = raw ? ('Rp ' + raw.replace(/\B(?=(\d{3})+(?!\d))/g,'.')) : 'Rp 0';
                                       })(this)"
                                />
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="text-sm font-medium text-gray-700">% dari Harga OTR</label>
                                <span class="text-xs font-medium text-[#2E6ADB]" id="dp-percent-label-{{ $car->id }}">{{ $dpPercentSlider }}%</span>
                            </div>
                            <input type="range" min="20" max="70" step="1" class="w-full accent-[#2E6ADB]" id="dp-slider-{{ $car->id }}"
                                   value="{{ $dpPercentSlider }}" autocomplete="off"
                                   wire:input="setDpPercentSlider($event.target.value)">

                            <div class="flex justify-between text-xs text-gray-500 mt-2">
                                <span>20%</span><span>30%</span><span>40%</span><span>50%</span><span>60%</span><span>70%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tenor -->
                    <div class="mt-5">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jangka Waktu</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach([12,24,36,48,60] as $t)
                                <button type="button"
                                    wire:click="$set('tenor', {{ $t }})"
                                    class="px-3 py-1.5 rounded-full text-sm border transition-colors {{ $tenor === $t ? 'bg-[#2E6ADB] text-white border-[#2E6ADB]' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                                    {{ $t }} Bulan
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Calculate button -->
                    <div class="mt-6">
                        <button type="button" class="px-5 py-2 rounded-full border-2 border-[#2E6ADB] text-[#2E6ADB] hover:bg-[#2E6ADB] hover:text-white transition-colors text-sm font-medium"
                                wire:click="$refresh">
                            Hitung Simulasi
                        </button>
                    </div>
                </div>

                <!-- Right summary card -->
                <div>
                    <div class="rounded-2xl p-6 md:p-8 text-white shadow-md" style="background-color:#1359D3;">
                        <p class="text-sm text-white/80">Harga OTR Mulai</p>
                        <div class="mt-1">
                            <p class="text-2xl md:text-3xl font-semibold">Rp {{ number_format($otr,0,',','.') }}</p>
                        </div>

                        <p class="mt-6 text-sm text-white/80">Pembayaran Bulanan</p>
                        <div class="mt-1">
                            <p class="text-2xl md:text-3xl font-semibold">Rp {{ number_format($monthly,0,',','.') }}</p>
                        </div>

                        <hr class="my-6 border-white/20">
                        <ul class="space-y-2 text-xs text-white/80 leading-relaxed">
                            <li>* Harga OTR yang tertera merupakan harga OTR di Jakarta.</li>
                            <li>* Uang muka belum meliputi biaya admin dan biaya lain.</li>
                            <li>* Simulasi dibuat berdasarkan asumsi tingkat suku bunga yang disesuaikan dengan tenor.</li>
                        </ul>

                        <div class="mt-6">
                            <button 
                                type="button" 
                                wire:click="openPenawaran"
                                class="flex items-center gap-2 px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition-colors font-medium cursor-pointer w-full md:w-auto">
                                Minta Penawaran
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="otr-{{ $car->id }}" value="{{ $otr }}">
    </section>
</div>
<script>
document.addEventListener('livewire:load', function () {
  const carId = '{{ $car->id }}';
  const hidden = document.getElementById('dp-hidden-' + carId);
  const visible = document.getElementById('dp-input-' + carId);
  const slider = document.getElementById('dp-slider-' + carId);
  const label = document.getElementById('dp-percent-label-' + carId);
  const otrEl = document.getElementById('otr-' + carId);
  if (!hidden || !visible || !slider || !label || !otrEl) return;
  function format(v){
    v = (v||'').toString().replace(/\D/g,'');
    return v ? ('Rp ' + v.replace(/\B(?=(\d{3})+(?!\d))/g,'.')) : 'Rp 0';
  }
  function syncFromServer(){
    var txt = (label.textContent||'').replace(/[^0-9]/g,'');
    if (txt) slider.value = txt;
    visible.value = format(hidden.value);
  }
  function updateFromSlider(){
    const percent = parseInt(slider.value || '0', 10);
    label.textContent = percent + '%';
    const otr = parseInt(otrEl.value || '0', 10);
    const amount = Math.round(otr * (percent/100));
    hidden.value = String(amount);
    hidden.dispatchEvent(new Event('input', { bubbles: true }));
    visible.value = format(amount);
  }
  slider.addEventListener('input', updateFromSlider);
  syncFromServer();
  hidden.addEventListener('input', () => {
    const otr = parseInt(otrEl.value || '0', 10);
    const amt = parseInt(hidden.value || '0', 10);
    const pct = Math.max(20, Math.min(70, Math.round(otr > 0 ? (amt/otr)*100 : 0)));
    label.textContent = pct + '%';
    slider.value = String(pct);
    visible.value = format(amt);
  });
  window.Livewire.hook('message.processed', () => {
    syncFromServer();
  });
});
</script>
