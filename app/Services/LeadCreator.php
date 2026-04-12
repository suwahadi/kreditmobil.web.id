<?php

namespace App\Services;

use App\Models\Lead;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class LeadCreator
{
    public function normalizePhone(string $raw): string
    {
        $digits = preg_replace('/\D/', '', $raw);
        $digits = ltrim($digits, '0');
        if (!Str::startsWith($digits, '62')) {
            $digits = '62' . $digits;
        }
        return $digits;
    }

    public function phoneExists(string $rawPhone): bool
    {
        $normalized = $this->normalizePhone($rawPhone);

        return Lead::where('phone', $normalized)->exists();
    }

    public function create(array $data): Lead
    {
        $lead = new Lead();
        $lead->lead_code = strtoupper(Str::random(5)) . now()->format('His') . strtoupper(Str::random(4));
        $lead->car_type_id = $data['car_type_id'] ?? null;
        $lead->customer_name = $data['customer_name'];
        $lead->phone = $this->normalizePhone($data['phone']);
        $lead->source = $data['source'] ?? 'Website';
        $lead->channel = $data['channel'] ?? 'WhatsApp';
        $lead->status = $data['status'] ?? Lead::STATUS_NEW;
        $lead->notes = $data['notes'] ?? null;
        $lead->sales_id = $data['sales_id'] ?? null;
        $lead->submitted_at = now();
        $lead->otp_id = $data['otp_id'] ?? null;
        $lead->meta = $data['meta'] ?? null;
        $lead->save();

        // Log::info('[Lead] Created', [
        //     'lead_code' => $lead->lead_code,
        //     'phone_masked' => $lead->masked_phone,
        //     'status' => $lead->status,
        // ]);

        return $lead;
    }
}
