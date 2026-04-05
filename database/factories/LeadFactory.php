<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $indonesianNames = [
            'Anton Sany', 'Siti Nurhaliza', 'Ahmad Fauzi', 'Dewi Lestari', 'Eko Prasetyo',
            'Rina Wijaya', 'Hendra Gunawan', 'Maya Sari', 'Joko Widodo', 'Fitri Handayani',
            'Rizky Ahmad', 'Nina Permata', 'Bayu Setiawan', 'Citra Dewi', 'Fajar Nugroho',
            'Laila Karim', 'Rizki Maulana', 'Anggraini Sari', 'Bambang Susilo', 'Putri Amelia',
            'Muhammad Rizki', 'Sarah Wijayanti', 'Dimas Pratama', 'Intan Permata', 'Yoga Saputra',
            'Ayu Lestari', 'Andi Wijaya', 'Fajar Hidayat', 'Ratna Sari', 'Toni Nugroho'
        ];

        $phonePrefixes = ['0812', '0813', '0821', '0822', '0823', '0852', '0853', '0856', '0857', '0858', '0895', '0896', '0897', '0898', '0899'];
        
        return [
            'car_type_id' => fake()->numberBetween(1, 19),
            'name' => fake()->randomElement($indonesianNames),
            'phone' => fake()->randomElement($phonePrefixes) . fake()->numberBetween(10000000, 99999999),
            'email' => fake()->optional(0.7)->safeEmail(), // 70% chance of having email
            'down_payment_amount' => fake()->numberBetween(20000000, 100000000),
            'tenor_months' => fake()->randomElement([12, 24, 36, 48, 60]),
            'status' => fake()->randomElement(['New', 'Contacted', 'Junk', 'Closed']),
        ];
    }
}
