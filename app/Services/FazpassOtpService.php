<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class FazpassOtpService
{
    protected string $baseUrl;
    protected string $merchantKey;
    protected ?string $gatewayKey;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.fazpass.base_url', 'https://api.fazpass.com'), '/');
        $this->merchantKey = (string) config('services.fazpass.merchant_key');
        $this->gatewayKey = config('services.fazpass.gateway_key');
    }

    public function sendOtp(string $phone, string $otp): array
    {
        $payload = [
            'phone' => $phone,
            'otp' => $otp,
            'gateway_key' => $this->gatewayKey,
        ];

        Log::info('[Fazpass] Sending OTP', [
            'endpoint' => '/v1/otp/send',
            'base_url' => $this->baseUrl,
            'payload' => $this->redact($payload),
        ]);

        $response = Http::asJson()
            ->withToken($this->merchantKey)
            ->timeout(10)
            ->retry(2, 200)
            ->post($this->baseUrl . '/v1/otp/send', $payload);

        if (!$response->ok()) {
            Log::warning('[Fazpass] Non-OK HTTP when sending OTP', [
                'status' => $response->status(),
                'body' => $response->body(),
                'headers' => $response->headers(),
            ]);
            throw new RuntimeException('Gagal mengirim OTP (HTTP ' . $response->status() . ')');
        }

        $data = $response->json();
        if (!Arr::get($data, 'status')) {
            Log::warning('[Fazpass] Send OTP failed according to API payload', [
                'response' => $data,
            ]);
            throw new RuntimeException((string) Arr::get($data, 'message', 'Gagal mengirim OTP'));
        }

        Log::info('[Fazpass] OTP sent successfully', [
            'otp_id' => Arr::get($data, 'data.id'),
            'channel' => Arr::get($data, 'data.channel'),
            'provider' => Arr::get($data, 'data.provider'),
        ]);

        return $data;
    }

    public function verifyOtp(string $otpId, string $otp): array
    {
        $payload = [
            'otp_id' => $otpId,
            'otp' => $otp,
        ];

        Log::info('[Fazpass] Verifying OTP', [
            'endpoint' => '/v1/otp/verify',
            'base_url' => $this->baseUrl,
            'payload' => $this->redact($payload),
        ]);

        $response = Http::asJson()
            ->withToken($this->merchantKey)
            ->timeout(10)
            ->retry(2, 200)
            ->post($this->baseUrl . '/v1/otp/verify', $payload);

        if (!$response->ok()) {
            Log::warning('[Fazpass] Non-OK HTTP when verifying OTP', [
                'status' => $response->status(),
                'body' => $response->body(),
                'headers' => $response->headers(),
            ]);
            throw new RuntimeException('Gagal verifikasi OTP (HTTP ' . $response->status() . ')');
        }

        $data = $response->json();
        if (!Arr::get($data, 'status')) {
            Log::warning('[Fazpass] Verify OTP failed according to API payload', [
                'response' => $data,
            ]);
            throw new RuntimeException((string) Arr::get($data, 'message', 'OTP tidak valid'));
        }

        Log::info('[Fazpass] OTP verified successfully', [
            'otp_id' => $otpId,
        ]);

        return $data;
    }

    protected function redact(array $payload): array
    {
        $out = $payload;
        if (isset($out['otp'])) {
            $out['otp'] = '****';
        }
        if (isset($out['phone'])) {
            $p = (string) $out['phone'];
            $out['phone'] = strlen($p) > 4 ? substr($p, 0, 2) . str_repeat('•', max(0, strlen($p) - 4)) . substr($p, -2) : '****';
        }
        if (isset($out['gateway_key'])) {
            $out['gateway_key'] = '**********';
        }
        return $out;
    }
}
