<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CreditSetting;

class CreditSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $creditSettings = [
            [
                'tenor_months' => 12,
                'interest_rate' => 0.0650, // 6.5%
            ],
            [
                'tenor_months' => 24,
                'interest_rate' => 0.0750, // 7.5%
            ],
            [
                'tenor_months' => 36,
                'interest_rate' => 0.0850, // 8.5%
            ],
            [
                'tenor_months' => 48,
                'interest_rate' => 0.0950, // 9.5%
            ],
            [
                'tenor_months' => 60,
                'interest_rate' => 0.1050, // 10.5%
            ],
        ];

        foreach ($creditSettings as $creditSetting) {
            CreditSetting::firstOrCreate(
                ['tenor_months' => $creditSetting['tenor_months']],
                ['interest_rate' => $creditSetting['interest_rate']]
            );
        }
    }
}
