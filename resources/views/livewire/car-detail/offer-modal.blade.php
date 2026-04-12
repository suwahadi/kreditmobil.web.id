<div>
    @if($show)
        <div class="fixed inset-0 z-50 flex items-end sm:items-center justify-center">
            <div class="fixed inset-0 bg-black/40" wire:click="close" aria-hidden="true"></div>

            <div class="relative z-10 w-full sm:max-w-md mx-auto bg-white rounded-2xl shadow-xl border border-gray-200 p-5 sm:p-6" role="dialog" aria-modal="true">
            <button type="button" wire:click="close" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600" aria-label="Tutup">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M6.225 4.811a.75.75 0 011.06 0L12 9.525l4.715-4.714a.75.75 0 111.06 1.06L13.06 10.586l4.715 4.714a.75.75 0 11-1.06 1.06L12 11.646l-4.715 4.714a.75.75 0 11-1.06-1.06l4.714-4.715-4.714-4.714a.75.75 0 010-1.06z" clip-rule="evenodd" />
                </svg>
            </button>

            @if($step === 'form')
                <div>
                    <h3 class="text-xl font-bold text-gray-900 leading-tight">Dapatkan TDP dan Cicilan terendah untuk <span class="text-gray-900">{{ $car->name }}</span></h3>
                    @if($notice)
                        <p class="mt-2 mb-2 text-sm text-blue-600">{{ $notice }}</p>
                    @endif

                    <div class="mt-5 space-y-4">
                        <div>
                            <label class="sr-only" for="offer-name">Nama Anda</label>
                            <input id="offer-name" type="text" wire:model.defer="name" placeholder="Nama Anda" required aria-required="true" @error('name') aria-invalid="true" @enderror class="w-full rounded-xl bg-gray-100 border px-4 py-3 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-200 @enderror" @disabled($isRequesting) />
                            @error('name')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="sr-only" for="offer-wa">Nomor WhatsApp</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500">+62</div>
                                <input id="offer-wa" type="tel" inputmode="numeric" wire:model.defer="phone" placeholder="812345678XXX" required aria-required="true" @error('phone') aria-invalid="true" @enderror class="w-full rounded-xl bg-gray-100 border pl-20 pr-4 py-3 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('phone') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-200 @enderror" @disabled($isRequesting) />
                            </div>
                            @error('phone')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <label class="flex items-start gap-2 select-none">
                            <input type="checkbox" wire:model.defer="wa_opt_in" class="mt-1 h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500" default="true" />
                            <span class="text-sm text-gray-500">Pastikan nomor ini aktif WhatsApp</span>
                        </label>
                        <p class="text-xs text-gray-500">Dengan melanjutkan, Anda telah sepakat menyetujui S&amp;K.</p>
                        <button type="button" wire:click="submitForm" class="w-full rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold py-3 cursor-pointer disabled:opacity-60" wire:loading.attr="disabled" wire:target="submitForm" @disabled($isRequesting)>
                            <span wire:loading wire:target="submitForm" class="inline-flex items-center gap-2">
                                Memproses...
                            </span>
                            <span wire:loading.remove wire:target="submitForm">DAPATKAN PENAWARAN</span>
                        </button>
                    </div>
                </div>
            @elseif($step === 'otp')
                <div>
                    <div class="flex items-start justify-between">
                        <h3 class="text-xl font-bold text-gray-900">Verifikasi OTP</h3>
                    </div>
                    @if($notice)
                        @if(str_contains($notice, 'salah') || str_contains($notice, 'kedaluwarsa') || str_contains($notice, 'Gagal') || str_contains($notice, 'tidak valid'))
                            <div class="mt-2 mb-2 p-3 bg-red-50 border border-red-200 rounded-lg">
                                <p class="text-sm text-red-700 font-medium">{{ $notice }}</p>
                            </div>
                        @else
                            <p class="mt-2 mb-2 text-sm text-gray-600">{{ $notice }}</p>
                        @endif
                    @else
                        <p class="mt-2 mb-2 text-sm text-gray-600">Kode OTP berhasil dikirim ke +62{{ $this->maskedPhone }}.</p>
                    @endif

                    @if($demoOtp)
                        <div class="mb-3 inline-flex items-center gap-2 rounded-lg bg-amber-100 border border-amber-300 px-3 py-1.5 text-sm font-mono font-bold text-amber-800 tracking-widest">
                            <span class="text-xs font-sans font-medium text-amber-600">DEMO OTP:</span>
                            {{ $demoOtp }}
                        </div>
                    @endif

                    <button type="button" wire:click="editPhone" class="mt-1 text-sm text-blue-600 hover:text-blue-700 inline-flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M16.862 3.487a2.25 2.25 0 113.182 3.183L7.284 19.43a5.25 5.25 0 01-2.31 1.337l-2.227.595a.75.75 0 01-.92-.92l.595-2.226a5.25 5.25 0 011.337-2.312L16.862 3.487z"/></svg>
                        Ubah nomor
                    </button>

                    <div class="mt-4 grid grid-cols-4 gap-3">
                        @for($i=0; $i<4; $i++)
                            <input
                                type="text"
                                inputmode="numeric"
                                maxlength="1"
                                class="h-12 rounded-xl bg-gray-100 border border-gray-200 text-center text-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                wire:model="otp.{{ $i }}"
                                placeholder="•"
                                oninput="this.value=this.value.replace(/\D/g,'').slice(0,1); if(this.value && this.nextElementSibling){ this.nextElementSibling.focus(); }"
                                onkeydown="if(event.key==='Backspace' && !this.value && this.previousElementSibling){ this.previousElementSibling.focus(); }"
                            @disabled($isVerifying)
                            />
                        @endfor
                    </div>

                    <button 
                        wire:click="verifyOtp"
                        class="mt-5 flex items-center gap-2 px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition-colors font-medium cursor-pointer disabled:opacity-60"
                        wire:loading.attr="disabled" wire:target="verifyOtp"
                        @disabled($isVerifying)
                    >
                        <span wire:loading wire:target="verifyOtp" class="inline-flex items-center gap-2">
                            Memverifikasi...
                        </span>
                        <span wire:loading.remove wire:target="verifyOtp">Verifikasi OTP</span>
                    </button>

                    <div class="mt-4 flex items-center gap-2 text-sm text-gray-600">
                        @if(!$canResend)
                            <span>Kirim ulang OTP dalam {{ $this->otpCountdownFormatted }}</span>
                            <div wire:poll.1s="tick" class="w-4 h-4 text-blue-500">
                                <svg class="w-4 h-4 text-blue-500 animate-spin" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
                            </div>
                        @else
                            <button type="button" wire:click="resendOtp" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium disabled:opacity-60" wire:loading.attr="disabled" wire:target="resendOtp" @disabled($isRequesting)
                            >
                                Kirim Ulang
                            </button>
                        @endif
                    </div>
                </div>
            @endif
            </div>
        </div>
    @endif
</div>
