<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrator',
                'phone' => null,
                'role' => User::ROLE_ADMIN,
                'is_active' => true,
                'password' => 'admin@admin.com',
            ]
        );
    }
}
