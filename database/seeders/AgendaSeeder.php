<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $agendas = [
            [
                'title' => 'Rapat Koordinasi Kwartir Daerah',
                'description' => 'Rapat koordinasi pengurus Kwartir Daerah DIY membahas program kerja 2025',
                'date' => now()->addDays(3),
                'time' => '09:00 WIB',
                'location' => 'Kantor Kwarda Pramuka DIY',
                'is_active' => true,
            ],
            [
                'title' => 'Pelatihan Pembina Siaga',
                'description' => 'Kursus Mahir Dasar untuk pembina Siaga se-DIY',
                'date' => now()->addDays(7),
                'time' => '08:00 - 16:00 WIB',
                'location' => 'Bumi Perkemahan Prambanan',
                'is_active' => true,
            ],
            [
                'title' => 'Lomba Pionering Tingkat Provinsi',
                'description' => 'Kompetisi pionering untuk tingkat Penggalang dan Penegak',
                'date' => now()->addDays(14),
                'time' => '07:00 WIB',
                'location' => 'Lapangan Denggung, Sleman',
                'is_active' => true,
            ],
            [
                'title' => 'Upacara Hari Pramuka',
                'description' => 'Upacara memperingati Hari Pramuka ke-64',
                'date' => now()->addDays(21),
                'time' => '08:00 WIB',
                'location' => 'Lapangan Kridosono',
                'is_active' => true,
            ],
            [
                'title' => 'Kemah Bakti Pramuka Pandega',
                'description' => 'Kegiatan kemah bakti untuk tingkat Pandega se-DIY',
                'date' => now()->addDays(28),
                'time' => '06:00 WIB',
                'location' => 'Pantai Parangtritis',
                'is_active' => true,
            ],
            [
                'title' => 'Raimuna Cabang DIY 2025',
                'description' => 'Pertemuan besar anggota Pramuka tingkat Penegak dan Pandega',
                'date' => now()->addDays(35),
                'time' => '05:00 WIB',
                'location' => 'Bumi Perkemahan Candi Prambanan',
                'is_active' => true,
            ],
            [
                'title' => 'Pelatihan Saka Wanabakti',
                'description' => 'Pelatihan khusus untuk anggota Saka Wanabakti',
                'date' => now()->addDays(42),
                'time' => '08:00 - 15:00 WIB',
                'location' => 'Hutan Pendidikan Wanagama',
                'is_active' => true,
            ],
        ];

        foreach ($agendas as $agenda) {
            Agenda::create($agenda);
        }
    }
}
