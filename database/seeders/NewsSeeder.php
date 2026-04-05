<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $titles = [
            'Peluncuran Daihatsu Sigra Facelift 2026',
            'Tips Perawatan Mesin Daihatsu Terios untuk Harian',
            'Promo Servis Berkala Daihatsu Resmi Bulan Ini',
            'Komparasi Daihatsu Rocky vs Raize: Mana Pilihanmu?',
            'Teknologi ASA pada Daihatsu: Fitur Keselamatan Terkini',
            'Daftar Warna Favorit Konsumen Daihatsu 2026',
            'Panduan Kredit Mobil Daihatsu: DP Ringan, Cicilan Aman',
            'Roadshow Test Drive Daihatsu: Jadwal dan Lokasi',
        ];

        $placeholder = 'https://placehold.net/default.png';

        foreach ($titles as $i => $title) {
            $daysAgo = random_int(1, 30);
            $createdAt = Carbon::now()->subDays($daysAgo)->subHours(random_int(0, 23))->subMinutes(random_int(0, 59));

            News::updateOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'author_id' => 1,
                    'title' => $title,
                    'thumbnail' => $placeholder,
                    'content' => self::richLorem(),
                    'is_active' => true,
                    'meta_seo' => [
                        'meta_title' => $title,
                        'meta_description' => 'Berita terbaru seputar mobil Daihatsu.',
                        'meta_keywords' => 'daihatsu, mobil, promo, berita',
                    ],
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]
            );
        }
    }

    protected static function richLorem(): string
    {
        return <<<HTML
<h1>Daihatsu Headline</h1>
<p><strong>Lorem ipsum</strong> dolor sit amet, <em>consectetur</em> adipiscing elit. Integer non dolor a nibh luctus tempus.</p>
<h2>Sub Heading</h2>
<p>Curabitur vitae ligula nec turpis vulputate cursus. Sed euismod, nunc at aliquet ullamcorper, neque erat facilisis velit.</p>
<h3>Detail Section</h3>
<p>Vivamus <strong>tristique</strong> nisl sit amet <em>metus</em> volutpat, sed aliquet neque pulvinar.</p>
<h4>Highlight</h4>
<p>Donec posuere, dui vitae rutrum pharetra, urna sapien semper mi, id fringilla justo erat sed libero.</p>
<h5>Notes</h5>
<p>Mauris ultricies nisl at massa consequat fermentum.</p>
<h6>Footer</h6>
<p>Quisque eget nunc nec odio vehicula blandit.</p>
HTML;
    }
}
