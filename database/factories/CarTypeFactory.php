<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarType>
 */
class CarTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $transmissions = ['MT', 'AT', 'CVT'];
        $basePrice = fake()->numberBetween(140000000, 350000000);
        
        return [
            'car_model_id' => fake()->numberBetween(1, 11),
            'name' => fake()->words(3, true),
            'slug' => fake()->slug(),
            'transmission' => fake()->randomElement($transmissions),
            'price_otr' => $basePrice,
            'specifications' => json_encode([
                'engine' => [
                    'type' => fake()->randomElement(['1.0L', '1.2L', '1.3L', '1.5L']) . ' ' . fake()->randomElement(['DOHC', 'VVT-i']),
                    'displacement' => fake()->numberBetween(998, 1498) . ' cc',
                    'power' => fake()->numberBetween(65, 120) . ' PS',
                    'torque' => fake()->numberBetween(90, 150) . ' Nm',
                    'fuel_system' => fake()->randomElement(['EFI', 'MPI']),
                ],
                'dimensions' => [
                    'length' => fake()->numberBetween(3600, 4400) . ' mm',
                    'width' => fake()->numberBetween(1600, 1800) . ' mm',
                    'height' => fake()->numberBetween(1500, 1800) . ' mm',
                    'wheelbase' => fake()->numberBetween(2400, 2750) . ' mm',
                    'ground_clearance' => fake()->numberBetween(180, 220) . ' mm',
                ],
                'features' => [
                    'airbags' => fake()->numberBetween(1, 4),
                    'abs' => fake()->boolean(80),
                    'ac' => fake()->randomElement(['Manual', 'Automatic', 'Dual Blower']),
                    'audio' => fake()->randomElement(['CD/MP3', 'Touch Screen', 'Advanced Audio']),
                    'parking_sensor' => fake()->boolean(60),
                    'camera' => fake()->boolean(40),
                ],
                'capacity' => [
                    'seats' => fake()->numberBetween(5, 7),
                    'doors' => fake()->numberBetween(4, 5),
                    'fuel_tank' => fake()->numberBetween(35, 55) . ' L',
                ]
            ]),
            'is_active' => fake()->boolean(85),
        ];
    }
}
