<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarModel;
use Illuminate\Support\Str;

class CarModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carModels = [
            // Penumpang
            [
                'category_id' => 1,
                'name' => 'All New Ayla',
                'slug' => 'all-new-ayla',
                'description' => 'Mobil city car hemat bahan bakar dengan desain modern dan fitur lengkap untuk perkotaan.',
                'main_image' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=300,q=85/assets/93deb2b5-6c34-4ad6-9cac-8f942a676677',
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'All New Sirion',
                'slug' => 'all-new-sirion',
                'description' => 'City car sporty dengan performa tinggi dan teknologi canggih.',
                'main_image' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=300,q=85/assets/1654146639626.png',
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'New Rocky',
                'slug' => 'new-rocky',
                'description' => 'SUV compact dengan desain tangguh dan fitur keselamatan lengkap.',
                'main_image' => 'https://medias.astra-daihatsu.id/sys-master-media/h2a/h98/8852617756702/360_Rocky_X_020_F.png',
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Rocky Hybrid',
                'slug' => 'rocky-hybrid',
                'description' => 'SUV hybrid dengan teknologi ramah lingkungan dan efisiensi bahan bakar superior.',
                'main_image' => 'https://medias.astra-daihatsu.id/sys-master-media/hcf/h28/8849270931486',
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'New Terios',
                'slug' => 'new-terios',
                'description' => 'SUV 7-seater dengan ground clearance tinggi dan desain modern.',
                'main_image' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=300,q=85/assets/88517da4-fa48-4427-8013-7dabfde62ca0',
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'All New Xenia',
                'slug' => 'all-new-xenia',
                'description' => 'MPV modern dengan desain elegan dan fitur keselamatan lengkap.',
                'main_image' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=300,q=85/assets/1636640842341.png',
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'New Luxio',
                'slug' => 'new-luxio',
                'description' => 'MPV mewah dengan kapasitas 7 penumpang dan fitur premium.',
                'main_image' => 'https://medias.astra-daihatsu.id/sys-master-media/h43/h3a/8802025439262',
                'is_active' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'New Sigra',
                'slug' => 'new-sigra',
                'description' => 'MPV 7-seater hemat dengan harga terjangkau.',
                'main_image' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=300,q=85/assets/1657170149302.png',
                'is_active' => true,
            ],
            
            // Komersial
            [
                'category_id' => 2,
                'name' => 'GranMax Pick Up',
                'slug' => 'granmax-pick-up',
                'description' => 'Pick up tangguh untuk berbagai kebutuhan bisnis.',
                'main_image' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=300,q=85/assets/1662907391533.png',
                'is_active' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'GranMax Mini Bus',
                'slug' => 'granmax-mini-bus',
                'description' => 'Mini bus dengan kapasitas penumpang fleksibel.',
                'main_image' => 'https://medias.astra-daihatsu.id/sys-master-media/h41/h3d/8802025373726',
                'is_active' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'GranMax Blindvan',
                'slug' => 'granmax-blindvan',
                'description' => 'Blindvan untuk kebutuhan pengiriman barang.',
                'main_image' => 'https://medias.astra-daihatsu.id/sys-master-media/h08/h71/8821605761054/2.png',
                'is_active' => true,
            ],
        ];

        foreach ($carModels as $carModel) {
            CarModel::firstOrCreate(
                ['slug' => $carModel['slug']],
                [
                    'category_id' => $carModel['category_id'],
                    'name' => $carModel['name'],
                    'description' => $carModel['description'],
                    'main_image' => $carModel['main_image'],
                    'is_active' => $carModel['is_active'],
                ]
            );
        }
    }
}
