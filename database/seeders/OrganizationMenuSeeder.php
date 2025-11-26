<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrganizationMenu;

class OrganizationMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            'Lambang',
            'Struktur Organisasi',
            'Majelis Pembimbing',
            'Pengurus',
            'Pusdiklatda',
            'Puslitbang Kwarda',
            'Pusinfo Kwarda',
            'Dewan Kerja',
            'Satuan Karya',
            'Satuan Komunitas',
        ];

        foreach ($menus as $menu) {
            OrganizationMenu::create([
                'title' => $menu,
                'content' => '<h2>' . $menu . '</h2><p>Konten untuk ' . $menu . ' organisasi. Silakan edit dan tambahkan detail sesuai kebutuhan, seperti penjelasan, struktur, tugas, atau informasi lain yang relevan. Anda dapat menggunakan editor untuk menambah gambar, tabel, atau format lain seperti pada konten Visi Misi.</p>',
                'is_active' => true,
            ]);
        }
    }
}
