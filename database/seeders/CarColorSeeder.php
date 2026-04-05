<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarColor;

class CarColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carColors = [
            // All New Ayla (car_model_id: 1)
            ['car_model_id' => 1, 'color_name' => 'Icy White', 'hex_code' => '#FFFFFF', 'image_path' => 'https://medias.astra-daihatsu.id/sys-master-media/360degview/exterior360/AYLA01/Ayla_Icy_White/360_Daihatsu_Ayla_IcyWhite_01.png'],
            ['car_model_id' => 1, 'color_name' => 'Solid Black', 'hex_code' => '#000000', 'image_path' => 'https://medias.astra-daihatsu.id/sys-master-media/360degview/exterior360/AYLA01/Ayla_Solid_Black/360_Daihatsu_Ayla_SolidBlack_01.png'],
            ['car_model_id' => 1, 'color_name' => 'Silver Metallic', 'hex_code' => '#C0C0C0', 'image_path' => 'https://medias.astra-daihatsu.id/sys-master-media/360degview/exterior360/AYLA01/Ayla_Silver/360_Daihatsu_Ayla_Silver_01.png'],
            
            // All New Sirion (car_model_id: 2)
            ['car_model_id' => 2, 'color_name' => 'Mica Red', 'hex_code' => '#E60012', 'image_path' => 'https://medias.astra-daihatsu.id/sys-master-media/360degview/exterior360/SIRION01/Sirion_LavaRed/360_Sirion_01e_LavaRed.png'],
            ['car_model_id' => 2, 'color_name' => 'Icy White', 'hex_code' => '#FFFFFF', 'image_path' => 'https://medias.astra-daihatsu.id/sys-master-media/360degview/exterior360/SIRION01/Sirion_IcyWhite/360_Sirion_01e_IcyWhite.png'],
            ['car_model_id' => 2, 'color_name' => 'Electric Blue', 'hex_code' => '#0066af', 'image_path' => 'https://medias.astra-daihatsu.id/sys-master-media/360degview/exterior360/SIRION01/Sirion_ElectricBlue/360_Sirion_01e_ElectricBlue.png'],
            ['car_model_id' => 2, 'color_name' => 'Glittering Silver', 'hex_code' => '#C0C0C0', 'image_path' => 'https://medias.astra-daihatsu.id/sys-master-media/360degview/exterior360/SIRION01/Sirion_Silver/360_Sirion_01e_Silver.png'],
            ['car_model_id' => 2, 'color_name' => 'Granite Gray', 'hex_code' => '#808080', 'image_path' => 'https://medias.astra-daihatsu.id/sys-master-media/360degview/exterior360/SIRION01/Sirion_Grey/360_Sirion_01e_Grey.png'],
            
            // New Rocky (car_model_id: 3)
            ['car_model_id' => 3, 'color_name' => 'Dark Gray Metallic', 'hex_code' => 'rgb(58, 58, 58)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/c27be12f-4820-435a-aa4b-f1ca84cf4f5b'],
            ['car_model_id' => 3, 'color_name' => 'Icy White', 'hex_code' => '#FFFFFF', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/8b010898-6c6b-4dad-974b-7f3561855749'],
            ['car_model_id' => 3, 'color_name' => 'Classic Silver Metallic', 'hex_code' => 'rgb(116 116 116)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/7e91f8f6-59b8-493e-a05d-267b2cb1b33c'],
            ['car_model_id' => 3, 'color_name' => 'Ultra Black Solid', 'hex_code' => '#111111', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/8353f4fc-951d-4b50-bdd7-b05fedece0ec'],
            ['car_model_id' => 3, 'color_name' => 'Yellow Metallic', 'hex_code' => 'rgb(254 229 2)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/13473dfa-285b-46cd-8b5d-74495cb5a0cd'],
            ['car_model_id' => 3, 'color_name' => 'Compagno Red', 'hex_code' => 'rgb(185 1 10)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/4ec597d3-5883-46ae-ad6e-71797a8c5139'],
            
            // Rocky Hybrid (car_model_id: 4)
            ['car_model_id' => 4, 'color_name' => 'Laser Blue Crystal Shine', 'hex_code' => 'rgb(35 70 117)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/890f55cf-02c4-477c-b60a-bfea782b6f53'],
            ['car_model_id' => 4, 'color_name' => 'Shining Pearl White', 'hex_code' => 'rgb(255 255 255)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/ff612ad9-391a-4c92-8221-a768423c7b42'],
            ['car_model_id' => 4, 'color_name' => 'Black Mica Metallic', 'hex_code' => 'rgb(13 13 13)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/a7e0ee24-b1c7-4df8-85bf-89b0b6234058'],
            
            // All New Terios (car_model_id: 5)
            ['car_model_id' => 5, 'color_name' => 'Glittering Silver', 'hex_code' => 'rgb(209, 210, 212)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/ac977e38-8ac2-4730-9f4f-b1b04f336b09'],
            ['car_model_id' => 5, 'color_name' => 'Scarlet Red Metallic', 'hex_code' => 'rgb(159 28 38)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/5e97adf8-ca89-4972-ac6a-7d5031ead44b'],
            ['car_model_id' => 5, 'color_name' => 'Greenish Gun Metallic', 'hex_code' => 'rgb(81 96 70)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/89d4581b-94da-41c9-8091-452fa6ba94b4'],
            ['car_model_id' => 5, 'color_name' => 'Black Metallic', 'hex_code' => 'rgb(51 51 51)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/3f7e6e81-e9fe-458f-8149-13da80791d3c'],
            ['car_model_id' => 5, 'color_name' => 'Icy White', 'hex_code' => '#FFFFFF', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/a54f4d75-9aa7-480e-92ec-2b5336c51268'],
            ['car_model_id' => 5, 'color_name' => 'Bronze Metallic', 'hex_code' => 'rgb(138 93 59)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/475e8a03-7e4a-4e42-87f2-4186a9ae1bf1'],
            
            // All New Xenia (car_model_id: 6)
            ['car_model_id' => 6, 'color_name' => 'White Solid', 'hex_code' => '#ffffff', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1636623309071.png'],
            ['car_model_id' => 6, 'color_name' => 'Black Metallic', 'hex_code' => '#000000', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1636623273341.png'],
            ['car_model_id' => 6, 'color_name' => 'Silver Metallic', 'hex_code' => 'rgb(210, 208, 212)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1636623391058.png'],
            ['car_model_id' => 6, 'color_name' => 'Greenish Gun Metal', 'hex_code' => 'rgb(83, 88, 74)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1636623681952.png'],
            ['car_model_id' => 6, 'color_name' => 'Purplish Silver', 'hex_code' => 'rgb(181, 172, 184)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1636623632364.png'],
            ['car_model_id' => 6, 'color_name' => 'Dark Grey Metallic', 'hex_code' => 'rgb(95, 95, 95)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1636623524072.png'],
            
            // New Luxio (car_model_id: 7)
            ['car_model_id' => 7, 'color_name' => 'Rock Grey Metallic', 'hex_code' => '#1e1e1e', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1592551411218.png'],
            ['car_model_id' => 7, 'color_name' => 'Icy White', 'hex_code' => '#FFFFFF', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1592551507479.png'],
            ['car_model_id' => 7, 'color_name' => 'Black Metallic', 'hex_code' => '#000000', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1592551432095.png'],
            ['car_model_id' => 7, 'color_name' => 'Classic Silver', 'hex_code' => '#bcbcbc', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1592551439923.png'],
            
            // New Sigra (car_model_id: 8)
            ['car_model_id' => 8, 'color_name' => 'Orange Metallic', 'hex_code' => 'rgb(255, 128, 0)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1657170445751.png'],
            ['car_model_id' => 8, 'color_name' => 'Scarlet Red Metallic', 'hex_code' => 'rgb(128 0 0)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1657170430777.png'],
            ['car_model_id' => 8, 'color_name' => 'Bronze', 'hex_code' => 'rgb(92, 82, 77)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1657170402535.png'],
            ['car_model_id' => 8, 'color_name' => 'Glittering Silver', 'hex_code' => 'rgb(192 192 192)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1657170315131.png'],
            ['car_model_id' => 8, 'color_name' => 'Ultra Black Solid', 'hex_code' => '#000000', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1657170322817.png'],
            ['car_model_id' => 8, 'color_name' => 'Icy White', 'hex_code' => '#FFFFFF', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1657170330610.png'],
            ['car_model_id' => 8, 'color_name' => 'Rock Grey Metallic', 'hex_code' => 'rgb(128 128 128)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1657170335710.png'],
            
            // Granmax Pick Up (car_model_id: 9)
            ['car_model_id' => 9, 'color_name' => 'Classic Silver', 'hex_code' => 'rgb(192, 192, 192)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1662907729222.png'],
            ['car_model_id' => 9, 'color_name' => 'Icy White', 'hex_code' => '#FFFFFF', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1662907734877.png'],
            ['car_model_id' => 9, 'color_name' => 'Ultra Black', 'hex_code' => '#000000', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1662907742266.png'],
            ['car_model_id' => 9, 'color_name' => 'Rock Grey Metallic', 'hex_code' => 'rgb(82 82 82)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1662907771245.png'],
            
            // Granmax Minibus (car_model_id: 10)
            ['car_model_id' => 10, 'color_name' => 'Ultra Black', 'hex_code' => '#000000', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1662995704138.png'],
            ['car_model_id' => 10, 'color_name' => 'Rock Grey Metallic', 'hex_code' => 'rgb(82, 82, 82)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1662995706203.png'],
            ['car_model_id' => 10, 'color_name' => 'Classic Silver', 'hex_code' => 'rgb(192 192 192)', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1662995572124.png'],
            ['car_model_id' => 10, 'color_name' => 'Icy White', 'hex_code' => '#FFFFFF', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/1662995534030.png'],
            
            // Granmax Blindvan (car_model_id: 11)
            ['car_model_id' => 11, 'color_name' => 'Icy White', 'hex_code' => '#FFFFFF', 'image_path' => 'https://cms-2023.daihatsu.co.id/cdn-cgi/image/w=700,q=85/assets/b0af5101-5871-4f27-b21b-b6fb832bd631'],
        ];

        foreach ($carColors as $carColor) {
            CarColor::firstOrCreate(
                [
                    'car_model_id' => $carColor['car_model_id'],
                    'color_name' => $carColor['color_name'],
                ],
                [
                    'hex_code' => $carColor['hex_code'],
                    'image_path' => $carColor['image_path'],
                ]
            );
        }
    }
}
