<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $sliders = [
            [
                'title' => 'Selamat Datang di Pramuka DIY',
                'description' => 'Kwartir Daerah Gerakan Pramuka Daerah Istimewa Yogyakarta - Membentuk Generasi Berkarakter dan Berintegritas',
                'image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&h=600&fit=crop',
                'link' => '/profile',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Selamat Bertugas Kak GKR Hayu',
                'description' => 'Ketua Kwartir Daerah Gerakan Pramuka DIY Periode 2025-2030',
                'image' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=1200&h=600&fit=crop',
                'link' => null,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Kegiatan Pramuka Penggalang DIY',
                'description' => 'Membentuk karakter pemimpin muda melalui berbagai kegiatan kepramukaan',
                'image' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=1200&h=600&fit=crop',
                'link' => '/news',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::create($slider);
        }
    }
}
