<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            CarModelSeeder::class,
            CarTypeSeeder::class,
            CarColorSeeder::class,
            CreditSettingSeeder::class,
            LeasingSeeder::class,
            AdminUserSeeder::class,
            LeadSeeder::class,
            NewsSeeder::class,
            PromoSeeder::class,
        ]);
    }
}
