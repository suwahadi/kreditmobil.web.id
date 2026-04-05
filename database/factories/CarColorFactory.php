<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarColor>
 */
class CarColorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $colors = [
            ['name' => 'Icy White', 'hex' => '#FFFFFF'],
            ['name' => 'Solid Black', 'hex' => '#000000'],
            ['name' => 'Silver Metallic', 'hex' => '#C0C0C0'],
            ['name' => 'Red Mica', 'hex' => '#E60012'],
            ['name' => 'Blue Metallic', 'hex' => '#003F7F'],
            ['name' => 'Gray Metallic', 'hex' => '#808080'],
            ['name' => 'Orange Metallic', 'hex' => '#FF6600'],
            ['name' => 'Beige Metallic', 'hex' => '#F5DEB3'],
            ['name' => 'Dark Green', 'hex' => '#006400'],
            ['name' => 'Burgundy Red', 'hex' => '#800020'],
        ];

        $color = fake()->randomElement($colors);
        
        return [
            'car_model_id' => fake()->numberBetween(1, 11),
            'color_name' => $color['name'],
            'hex_code' => $color['hex'],
            'image_path' => 'colors/' . fake()->slug() . '.jpg',
        ];
    }
}
