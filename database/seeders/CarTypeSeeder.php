<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarType;
use Illuminate\Support\Str;

class CarTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carTypes = [
            // All New Ayla (car_model_id: 1)
            [
                'car_model_id' => 1,
                'name' => 'All New Ayla 1.0 M/T',
                'slug' => 'all-new-ayla-1-0-m-t',
                'transmission' => 'MT',
                'price_otr' => 142000000,
                'specifications' => [
                    'engine' => ['type' => '1.0L DOHC', 'displacement' => '998 cc', 'power' => '67 PS', 'torque' => '91 Nm'],
                    'dimensions' => ['length' => '3660 mm', 'width' => '1600 mm', 'height' => '1520 mm'],
                    'features' => ['airbags' => 2, 'abs' => true, 'ac' => 'Manual'],
                    'capacity' => ['seats' => 5, 'doors' => 4, 'fuel_tank' => '36 L']
                ],
                'is_active' => true,
            ],
            [
                'car_model_id' => 1,
                'name' => 'All New Ayla 1.2 R A/T',
                'slug' => 'all-new-ayla-1-2-r-a-t',
                'transmission' => 'AT',
                'price_otr' => 165000000,
                'specifications' => [
                    'engine' => ['type' => '1.2L DOHC', 'displacement' => '1197 cc', 'power' => '87 PS', 'torque' => '114 Nm'],
                    'dimensions' => ['length' => '3660 mm', 'width' => '1600 mm', 'height' => '1520 mm'],
                    'features' => ['airbags' => 2, 'abs' => true, 'ac' => 'Automatic'],
                    'capacity' => ['seats' => 5, 'doors' => 4, 'fuel_tank' => '36 L']
                ],
                'is_active' => true,
            ],
            
            // All New Sirion (car_model_id: 2)
            [
                'car_model_id' => 2,
                'name' => 'All New Sirion 1.5 M/T',
                'slug' => 'all-new-sirion-1-5-m-t',
                'transmission' => 'MT',
                'price_otr' => 195000000,
                'specifications' => [
                    'engine' => ['type' => '1.5L DOHC', 'displacement' => '1496 cc', 'power' => '103 PS', 'torque' => '136 Nm'],
                    'dimensions' => ['length' => '3950 mm', 'width' => '1695 mm', 'height' => '1515 mm'],
                    'features' => ['airbags' => 2, 'abs' => true, 'ac' => 'Automatic'],
                    'capacity' => ['seats' => 5, 'doors' => 5, 'fuel_tank' => '40 L']
                ],
                'is_active' => true,
            ],
            [
                'car_model_id' => 2,
                'name' => 'All New Sirion 1.5 CVT',
                'slug' => 'all-new-sirion-1-5-cvt',
                'transmission' => 'CVT',
                'price_otr' => 215000000,
                'specifications' => [
                    'engine' => ['type' => '1.5L DOHC', 'displacement' => '1496 cc', 'power' => '103 PS', 'torque' => '136 Nm'],
                    'dimensions' => ['length' => '3950 mm', 'width' => '1695 mm', 'height' => '1515 mm'],
                    'features' => ['airbags' => 4, 'abs' => true, 'ac' => 'Automatic'],
                    'capacity' => ['seats' => 5, 'doors' => 5, 'fuel_tank' => '40 L']
                ],
                'is_active' => true,
            ],
            
            // New Rocky (car_model_id: 3)
            [
                'car_model_id' => 3,
                'name' => 'Rocky 1.2 M/T',
                'slug' => 'rocky-1-2-m-t',
                'transmission' => 'MT',
                'price_otr' => 231700000,
                'specifications' => [
                    'engine' => ['type' => '1.2L DOHC', 'displacement' => '1197 cc', 'power' => '87 PS', 'torque' => '114 Nm'],
                    'dimensions' => ['length' => '4095 mm', 'width' => '1730 mm', 'height' => '1635 mm'],
                    'features' => ['airbags' => 2, 'abs' => true, 'ac' => 'Automatic'],
                    'capacity' => ['seats' => 5, 'doors' => 5, 'fuel_tank' => '45 L']
                ],
                'is_active' => true,
            ],
            [
                'car_model_id' => 3,
                'name' => 'Rocky 1.2 R A/T',
                'slug' => 'rocky-1-2-r-a-t',
                'transmission' => 'AT',
                'price_otr' => 245000000,
                'specifications' => [
                    'engine' => ['type' => '1.2L DOHC', 'displacement' => '1197 cc', 'power' => '87 PS', 'torque' => '114 Nm'],
                    'dimensions' => ['length' => '4095 mm', 'width' => '1730 mm', 'height' => '1635 mm'],
                    'features' => ['airbags' => 4, 'abs' => true, 'ac' => 'Automatic'],
                    'capacity' => ['seats' => 5, 'doors' => 5, 'fuel_tank' => '45 L']
                ],
                'is_active' => true,
            ],
            
            // Rocky Hybrid (car_model_id: 4)
            [
                'car_model_id' => 4,
                'name' => 'Rocky Hybrid 1.2 CVT',
                'slug' => 'rocky-hybrid-1-2-cvt',
                'transmission' => 'CVT',
                'price_otr' => 285000000,
                'specifications' => [
                    'engine' => ['type' => '1.2L DOHC Hybrid', 'displacement' => '1197 cc', 'power' => '92 PS', 'torque' => '120 Nm'],
                    'dimensions' => ['length' => '4095 mm', 'width' => '1730 mm', 'height' => '1635 mm'],
                    'features' => ['airbags' => 4, 'abs' => true, 'ac' => 'Automatic'],
                    'capacity' => ['seats' => 5, 'doors' => 5, 'fuel_tank' => '45 L']
                ],
                'is_active' => true,
            ],
            
            // All New Terios (car_model_id: 5)
            [
                'car_model_id' => 5,
                'name' => 'All New Terios R M/T',
                'slug' => 'all-new-terios-r-m-t',
                'transmission' => 'MT',
                'price_otr' => 268000000,
                'specifications' => [
                    'engine' => ['type' => '1.5L DOHC', 'displacement' => '1496 cc', 'power' => '103 PS', 'torque' => '136 Nm'],
                    'dimensions' => ['length' => '4455 mm', 'width' => '1695 mm', 'height' => '1700 mm'],
                    'features' => ['airbags' => 2, 'abs' => true, 'ac' => 'Dual Blower'],
                    'capacity' => ['seats' => 7, 'doors' => 5, 'fuel_tank' => '45 L']
                ],
                'is_active' => true,
            ],
            [
                'car_model_id' => 5,
                'name' => 'All New Terios R A/T',
                'slug' => 'all-new-terios-r-a-t',
                'transmission' => 'AT',
                'price_otr' => 285000000,
                'specifications' => [
                    'engine' => ['type' => '1.5L DOHC', 'displacement' => '1496 cc', 'power' => '103 PS', 'torque' => '136 Nm'],
                    'dimensions' => ['length' => '4455 mm', 'width' => '1695 mm', 'height' => '1700 mm'],
                    'features' => ['airbags' => 4, 'abs' => true, 'ac' => 'Dual Blower'],
                    'capacity' => ['seats' => 7, 'doors' => 5, 'fuel_tank' => '45 L']
                ],
                'is_active' => true,
            ],
            
            // All New Xenia (car_model_id: 6)
            [
                'car_model_id' => 6,
                'name' => 'All New Xenia 1.3 M/T',
                'slug' => 'all-new-xenia-1-3-m-t',
                'transmission' => 'MT',
                'price_otr' => 245000000,
                'specifications' => [
                    'engine' => ['type' => '1.3L DOHC', 'displacement' => '1329 cc', 'power' => '95 PS', 'torque' => '121 Nm'],
                    'dimensions' => ['length' => '4190 mm', 'width' => '1660 mm', 'height' => '1695 mm'],
                    'features' => ['airbags' => 2, 'abs' => true, 'ac' => 'Dual Blower'],
                    'capacity' => ['seats' => 7, 'doors' => 5, 'fuel_tank' => '45 L']
                ],
                'is_active' => true,
            ],
            
            // New Luxio (car_model_id: 7)
            [
                'car_model_id' => 7,
                'name' => 'New Luxio 1.5 M/T',
                'slug' => 'new-luxio-1-5-m-t',
                'transmission' => 'MT',
                'price_otr' => 235000000,
                'specifications' => [
                    'engine' => ['type' => '1.5L DOHC', 'displacement' => '1496 cc', 'power' => '103 PS', 'torque' => '136 Nm'],
                    'dimensions' => ['length' => '4165 mm', 'width' => '1665 mm', 'height' => '1700 mm'],
                    'features' => ['airbags' => 2, 'abs' => true, 'ac' => 'Dual Blower'],
                    'capacity' => ['seats' => 8, 'doors' => 4, 'fuel_tank' => '45 L']
                ],
                'is_active' => true,
            ],
            [
                'car_model_id' => 7,
                'name' => 'New Luxio 1.5 A/T',
                'slug' => 'new-luxio-1-5-a-t',
                'transmission' => 'AT',
                'price_otr' => 255000000,
                'specifications' => [
                    'engine' => ['type' => '1.5L DOHC', 'displacement' => '1496 cc', 'power' => '103 PS', 'torque' => '136 Nm'],
                    'dimensions' => ['length' => '4165 mm', 'width' => '1665 mm', 'height' => '1700 mm'],
                    'features' => ['airbags' => 2, 'abs' => true, 'ac' => 'Dual Blower'],
                    'capacity' => ['seats' => 8, 'doors' => 4, 'fuel_tank' => '45 L']
                ],
                'is_active' => true,
            ],
            
            // New Sigra (car_model_id: 8)
            [
                'car_model_id' => 8,
                'name' => 'Sigra 1.2 D M/T',
                'slug' => 'sigra-1-2-d-m-t',
                'transmission' => 'MT',
                'price_otr' => 155000000,
                'specifications' => [
                    'engine' => ['type' => '1.2L DOHC', 'displacement' => '1197 cc', 'power' => '87 PS', 'torque' => '114 Nm'],
                    'dimensions' => ['length' => '4050 mm', 'width' => '1655 mm', 'height' => '1685 mm'],
                    'features' => ['airbags' => 1, 'abs' => false, 'ac' => 'Manual'],
                    'capacity' => ['seats' => 7, 'doors' => 5, 'fuel_tank' => '36 L']
                ],
                'is_active' => true,
            ],
            [
                'car_model_id' => 8,
                'name' => 'Sigra 1.5 R A/T',
                'slug' => 'sigra-1-5-r-a-t',
                'transmission' => 'AT',
                'price_otr' => 195000000,
                'specifications' => [
                    'engine' => ['type' => '1.5L DOHC', 'displacement' => '1496 cc', 'power' => '103 PS', 'torque' => '136 Nm'],
                    'dimensions' => ['length' => '4050 mm', 'width' => '1655 mm', 'height' => '1685 mm'],
                    'features' => ['airbags' => 2, 'abs' => true, 'ac' => 'Automatic'],
                    'capacity' => ['seats' => 7, 'doors' => 5, 'fuel_tank' => '36 L']
                ],
                'is_active' => true,
            ],
            
            // Granmax Pick Up (car_model_id: 9)
            [
                'car_model_id' => 9,
                'name' => 'Granmax Pick Up 1.3 M/T',
                'slug' => 'granmax-pick-up-1-3-m-t',
                'transmission' => 'MT',
                'price_otr' => 165000000,
                'specifications' => [
                    'engine' => ['type' => '1.3L DOHC', 'displacement' => '1329 cc', 'power' => '95 PS', 'torque' => '121 Nm'],
                    'dimensions' => ['length' => '4170 mm', 'width' => '1665 mm', 'height' => '1850 mm'],
                    'features' => ['airbags' => 0, 'abs' => false, 'ac' => 'Manual'],
                    'capacity' => ['seats' => 3, 'doors' => 2, 'fuel_tank' => '45 L']
                ],
                'is_active' => true,
            ],
            [
                'car_model_id' => 9,
                'name' => 'Granmax Pick Up 1.5 M/T',
                'slug' => 'granmax-pick-up-1-5-m-t',
                'transmission' => 'MT',
                'price_otr' => 175000000,
                'specifications' => [
                    'engine' => ['type' => '1.5L DOHC', 'displacement' => '1496 cc', 'power' => '103 PS', 'torque' => '136 Nm'],
                    'dimensions' => ['length' => '4170 mm', 'width' => '1665 mm', 'height' => '1850 mm'],
                    'features' => ['airbags' => 0, 'abs' => false, 'ac' => 'Manual'],
                    'capacity' => ['seats' => 3, 'doors' => 2, 'fuel_tank' => '45 L']
                ],
                'is_active' => true,
            ],
            
            // Granmax Minibus (car_model_id: 10)
            [
                'car_model_id' => 10,
                'name' => 'Granmax Minibus 1.3 M/T',
                'slug' => 'granmax-minibus-1-3-m-t',
                'transmission' => 'MT',
                'price_otr' => 185000000,
                'specifications' => [
                    'engine' => ['type' => '1.3L DOHC', 'displacement' => '1329 cc', 'power' => '95 PS', 'torque' => '121 Nm'],
                    'dimensions' => ['length' => '4170 mm', 'width' => '1665 mm', 'height' => '1850 mm'],
                    'features' => ['airbags' => 1, 'abs' => false, 'ac' => 'Manual'],
                    'capacity' => ['seats' => 7, 'doors' => 4, 'fuel_tank' => '45 L']
                ],
                'is_active' => true,
            ],
            
            // Granmax Blindvan (car_model_id: 11)
            [
                'car_model_id' => 11,
                'name' => 'Granmax Blindvan 1.3 M/T',
                'slug' => 'granmax-blindvan-1-3-m-t',
                'transmission' => 'MT',
                'price_otr' => 175000000,
                'specifications' => [
                    'engine' => ['type' => '1.3L DOHC', 'displacement' => '1329 cc', 'power' => '95 PS', 'torque' => '121 Nm'],
                    'dimensions' => ['length' => '4170 mm', 'width' => '1665 mm', 'height' => '1850 mm'],
                    'features' => ['airbags' => 1, 'abs' => false, 'ac' => 'Manual'],
                    'capacity' => ['seats' => 3, 'doors' => 4, 'fuel_tank' => '45 L']
                ],
                'is_active' => true,
            ],
        ];

        foreach ($carTypes as $carType) {
            CarType::firstOrCreate(
                ['slug' => $carType['slug']],
                [
                    'car_model_id' => $carType['car_model_id'],
                    'name' => $carType['name'],
                    'transmission' => $carType['transmission'],
                    'price_otr' => $carType['price_otr'],
                    'specifications' => $carType['specifications'],
                    'is_active' => $carType['is_active'],
                ]
            );
        }
    }
}
