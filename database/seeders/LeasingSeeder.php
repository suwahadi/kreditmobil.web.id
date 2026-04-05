<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class LeasingSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        DB::table('leasings')->upsert([
            ['name' => 'Adira Finance', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Astra Credit Companies (ACC)', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'BCA Finance', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Mandiri Tunas Finance (MTF)', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'BFI Finance', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'OTO Finance', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Toyota Astra Financial (TAF)', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Indomobil Finance', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Clipan Finance', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Maybank Finance', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'CIMB Niaga Finance', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Sinar Mas Multifinance', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'SMS Finance', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
        ], ['name'], ['is_active', 'updated_at']);
    }
}
