<?php

namespace Database\Seeders;

use App\Models\Promo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PromoSeeder extends Seeder
{
    public function run(): void
    {
        $titles = [
            'Promo Kredit Ringan Daihatsu Hanya Bulan Ini',
            'Cashback Spesial Pembelian Daihatsu Rocky',
            'Gratis Aksesoris Original untuk Sigra Baru',
            'Trade-in Program: Tukar Tambah Mobil Lama ke Daihatsu',
        ];

        $placeholder = 'https://placehold.net/default.png';

        foreach ($titles as $title) {
            $daysAgo = random_int(1, 7);
            $createdAt = Carbon::now()->subDays($daysAgo)->subHours(random_int(0, 23))->subMinutes(random_int(0, 59));

            Promo::updateOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'title' => $title,
                    'thumbnail' => $placeholder,
                    'content' => self::richLorem(),
                    'is_active' => true,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]
            );
        }
    }

    protected static function richLorem(): string
    {
        return <<<HTML
<h1>Promo Daihatsu</h1>
<p><strong>Lorem ipsum</strong> dolor sit amet, <em>consectetur</em> adipiscing elit. Integer non dolor a nibh luctus tempus.</p>
<h2>Keuntungan</h2>
<p>Curabitur vitae ligula nec turpis vulputate cursus. Sed euismod, nunc at aliquet ullamcorper, neque erat facilisis velit.</p>
<h3>Syarat & Ketentuan</h3>
<p>Vivamus <strong>tristique</strong> nisl sit amet <em>metus</em> volutpat, sed aliquet neque pulvinar.</p>
<h4>Highlight</h4>
<p>Donec posuere, dui vitae rutrum pharetra, urna sapien semper mi, id fringilla justo erat sed libero.</p>
<h5>Catatan</h5>
<p>Mauris ultricies nisl at massa consequat fermentum.</p>
<h6>Penutup</h6>
<p>Quisque eget nunc nec odio vehicula blandit.</p>
HTML;
    }
}
