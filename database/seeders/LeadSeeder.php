<?php

namespace Database\Seeders;

use App\Models\CarType;
use App\Models\Lead;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LeadSeeder extends Seeder
{
    public function run(): void
    {
        $carTypeIds = CarType::query()->pluck('id')->all();
        if (empty($carTypeIds)) {
            return;
        }

        $salesUserIds = User::query()->where('role', 'sales')->pluck('id')->all();
        $anyUserIds = empty($salesUserIds) ? User::query()->pluck('id')->all() : $salesUserIds;

        $names = [
            'Alya Prameswari',
            'Dimas Aditya Putra',
            'Nayla Azzahra',
            'Raka Pratama Nugraha',
            'Zahra Cahya Kirana',
            'Faiz Ramadhan Akbar',
            'Keyla Naufalia',
            'Rizky Maulana Pradana',
            'Nabila Shafira Putri',
            'Reyhan Alvaro Saputra',
        ];

        $sources = ['Website', 'Instagram', 'Tiktok', 'Facebook', 'Referral'];
        $channels = ['Ads', 'Organic', 'DM', 'Form', 'Landing'];
        $statuses = [
            Lead::STATUS_NEW,
            Lead::STATUS_ASSIGNED,
            Lead::STATUS_FOLLOW_UP,
            Lead::STATUS_NEGOTIATION,
            Lead::STATUS_WON,
            Lead::STATUS_LOST,
        ];

        foreach ($names as $i => $customerName) {
            $date = Carbon::now()->subDays(random_int(0, 30))->subHours(random_int(0, 23))->subMinutes(random_int(0, 59));
            $leadCode = 'LD-' . $date->format('Ymd') . '-' . str_pad((string)($i + 1), 4, '0', STR_PAD_LEFT);

            $phone = '08' . random_int(11, 99) . random_int(1000, 9999) . random_int(1000, 9999);
            $status = $statuses[array_rand($statuses)];
            $carTypeId = $carTypeIds[array_rand($carTypeIds)];
            $salesId = !empty($anyUserIds) ? $anyUserIds[array_rand($anyUserIds)] : null;

            Lead::query()->create([
                'lead_code' => $leadCode,
                'car_type_id' => $carTypeId,
                'customer_name' => $customerName,
                'phone' => $phone,
                'source' => $sources[array_rand($sources)],
                'channel' => $channels[array_rand($channels)],
                'status' => $status,
                'notes' => fake()->optional(0.6)->sentence(10),
                'sales_id' => $salesId,
                'submitted_at' => $date,
                'otp_id' => null,
                'meta' => [
                    'birth_year' => random_int(2005, 2008),
                    'utm' => [
                        'source' => 'seed',
                        'campaign' => 'demo',
                    ],
                ],
            ]);
        }
    }
}
