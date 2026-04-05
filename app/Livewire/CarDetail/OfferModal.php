<?php

namespace App\Livewire\CarDetail;

use App\Models\CarModel;
use Livewire\Component;
use App\Services\FazpassOtpService;
use Illuminate\Support\Facades\Redirect;
use App\Services\LeadCreator;
use App\Models\Lead;

class OfferModal extends Component
{
    public bool $show = false;
    public string $step = 'form';

    public ?CarModel $car = null;

    public string $name = '';
    public string $phone = '';
    public bool $wa_opt_in = true;
    public array $otp = ['', '', '', ''];
    public int $otpCountdown = 180;
    public bool $canResend = false;
    public ?string $otpId = null;
    public ?int $otpSentAt = null;
    public int $otpAttempts = 0;
    public bool $isRequesting = false;
    public bool $isVerifying = false;
    public ?string $notice = null;

    protected $listeners = [
        'openPenawaran' => 'open',
    ];

    protected $rules = [
        'name' => 'required|min:3',
        'phone' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Nama wajib diisi',
        'name.min' => 'Nama minimal 3 karakter',
        'phone.required' => 'Nomor WhatsApp wajib diisi',
    ];

    public function mount(CarModel $car)
    {
        $this->car = $car;
    }

    public function open($carId = null)
    {
        if ($carId && (!$this->car || $this->car->id !== (int)$carId)) {
            $this->car = CarModel::with(['activeCarTypes'])->find($carId) ?? $this->car;
        }
        $this->resetForm();
        $this->resetValidation();
        $this->show = true;
        $this->step = 'form';
    }

    public function close()
    {
        $this->show = false;
        $this->resetValidation();
    }

    public function submitForm()
    {
        $this->validate();

        if ($this->isRequesting) return;
        $this->isRequesting = true;

        $digits = preg_replace('/\D/', '', $this->phone);
        if (strlen($digits) < 9) {
            $this->addError('phone', 'Nomor WhatsApp tidak valid.');
            $this->isRequesting = false;
            return;
        }

        if ($this->otpSentAt && (time() - $this->otpSentAt) < 180) {
            $remaining = 180 - (time() - $this->otpSentAt);
            $this->notice = 'Tunggu ' . $remaining . ' detik sebelum mengirim ulang kode.';
            $this->isRequesting = false;
            $this->step = 'otp';
            return;
        }

        // Generate 4-digit OTP
        $generatedOtp = (string) random_int(1000, 9999);

        try {
            $service = new FazpassOtpService();
            $sendPhone = '62' . ltrim($digits, '0');
            $resp = $service->sendOtp($sendPhone, $generatedOtp);
            $this->otpId = $resp['data']['id'] ?? null;
            $this->otpSentAt = time();
            $this->otpAttempts = 0;
            $this->otp = ['', '', '', ''];
            $this->step = 'otp';
            $this->startOtpTimer(180);
            $this->notice = 'Kode OTP berhasil dikirim ke +62' . $this->maskedPhone;
        } catch (\Throwable $e) {
            $this->addError('phone', 'Gagal mengirim OTP. Coba beberapa saat lagi.');
        } finally {
            $this->isRequesting = false;
        }
    }

    public function editPhone()
    {
        $this->step = 'form';
    }

    public function getMaskedPhoneProperty()
    {
        if (!$this->phone) return '';
        $digits = preg_replace('/\D/', '', $this->phone);
        if (strlen($digits) <= 8) return $digits;
        return substr($digits, 0, 8) . str_repeat('•', max(0, strlen($digits) - 8));
    }

    protected function resetForm()
    {
        $this->name = '';
        $this->phone = '';
        $this->wa_opt_in = true;
        $this->otp = ['', '', '', ''];
        $this->otpCountdown = 180;
        $this->canResend = false;
    }

    public function startOtpTimer($seconds = 180)
    {
        $this->otpCountdown = $seconds;
        $this->canResend = false;
    }

    public function tick()
    {
        if ($this->step !== 'otp' || !$this->show || $this->canResend) return;
        if ($this->otpCountdown > 0) {
            $this->otpCountdown--;
            if ($this->otpCountdown <= 0) {
                $this->canResend = true;
            }
        }
    }

    public function getOtpCountdownFormattedProperty(): string
    {
        $total = max(0, (int) $this->otpCountdown);
        $minutes = intdiv($total, 60);
        $seconds = $total % 60;
        return str_pad((string)$minutes, 2, '0', STR_PAD_LEFT) . ':' . str_pad((string)$seconds, 2, '0', STR_PAD_LEFT);
    }

    public function resendOtp()
    {
        if ($this->isRequesting) return;
        if ($this->otpSentAt && (time() - $this->otpSentAt) < 180) {
            $remaining = 180 - (time() - $this->otpSentAt);
            $this->notice = 'Tunggu ' . $remaining . ' detik sebelum mengirim ulang kode.';
            return;
        }

        $this->isRequesting = true;
        $digits = preg_replace('/\D/', '', $this->phone);
        if (strlen($digits) < 9) {
            $this->addError('phone', 'Nomor WhatsApp tidak valid.');
            $this->isRequesting = false;
            return;
        }

        $generatedOtp = (string) random_int(1000, 9999);
        try {
            $service = new FazpassOtpService();
            $sendPhone = '62' . ltrim($digits, '0');
            $resp = $service->sendOtp($sendPhone, $generatedOtp);
            $this->otpId = $resp['data']['id'] ?? null;
            $this->otpSentAt = time();
            $this->otpAttempts = 0;
            $this->otp = ['', '', '', ''];
            $this->startOtpTimer(180);
            $this->notice = 'Kode OTP berhasil dikirim ulang.';
        } catch (\Throwable $e) {
            $this->addError('phone', 'Gagal mengirim ulang OTP. Coba beberapa saat lagi.');
        } finally {
            $this->isRequesting = false;
        }
    }

    public function verifyOtp()
    {
        if ($this->isVerifying) return;
        $this->isVerifying = true;

        if (!$this->otpId) {
            $this->notice = 'Silakan minta kode OTP terlebih dahulu.';
            $this->isVerifying = false;
            return;
        }

        if ($this->otpAttempts >= 3) {
            $this->notice = 'Melebihi batas percobaan. Silakan kirim ulang kode OTP.';
            $this->isVerifying = false;
            return;
        }

        // Pastikan nilai OTP terbaru (jika ada binding defer) sudah terbaca
        $otpArray = is_array($this->otp) ? $this->otp : [];
        $code = implode('', array_map(fn($c) => preg_replace('/\D/', '', (string)$c) ?: '', $otpArray));
        if (strlen($code) !== 4) {
            $this->notice = 'Masukkan 4 digit kode OTP.';
            $this->isVerifying = false;
            return;
        }

        try {
            $service = new FazpassOtpService();
            $service->verifyOtp($this->otpId, $code);
            // success → create lead then reset and redirect
            $creator = new LeadCreator();
            $creator->create([
                'customer_name' => $this->name,
                'phone' => $this->phone,
                'car_type_id' => $this->car?->activeCarTypes->first()->id ?? null,
                'otp_id' => $this->otpId,
                'status' => Lead::STATUS_NEW,
                'source' => 'offer_modal',
                'meta' => [
                    'car_model_id' => $this->car?->id,
                    'car_model_name' => $this->car?->name,
                    'url' => request()->path(),
                ],
            ]);
            $this->resetOtpState();
            $this->show = false;
            return redirect()->to('/thank-you');
        } catch (\Throwable $e) {
            $this->otpAttempts++;
            $this->notice = 'Kode OTP salah atau sudah kedaluwarsa.';
        } finally {
            $this->isVerifying = false;
        }
    }

    protected function resetOtpState()
    {
        $this->otpId = null;
        $this->otpSentAt = null;
        $this->otpAttempts = 0;
        $this->otp = ['', '', '', ''];
        $this->otpCountdown = 180;
        $this->canResend = false;
        $this->notice = null;
    }

    public function render()
    {
        return view('livewire.car-detail.offer-modal');
    }
}
