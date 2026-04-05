<?php

namespace App\Services;

use App\Models\Lead;
use App\Models\Customer;
use Illuminate\Support\Str;

class LeadToCustomer
{
    public function createCustomerFromLead(Lead $lead, array $overrides = []): Customer
    {
        $data = [
            'lead_id' => $lead->id,
            'nik' => $overrides['nik'] ?? strtoupper(Str::random(16)),
            'name' => $overrides['name'] ?? $lead->customer_name,
            'gender' => $overrides['gender'] ?? 'L',
            'phone' => $overrides['phone'] ?? $lead->phone,
            'email' => $overrides['email'] ?? null,
            'address' => $overrides['address'] ?? null,
            'city' => $overrides['city'] ?? 'Jakarta',
        ];

        if (empty($data['nik']) || strlen($data['nik']) < 16) {
            $data['nik'] = strtoupper(Str::random(16));
        }

        return Customer::create($data);
    }
}
