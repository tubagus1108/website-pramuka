<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfileMenu;

class ProfileMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'title' => 'Sejarah Pramuka DIY',
                'slug' => 'sejarah-pramuka-diy',
                'content' => 'Gerakan Pramuka di Daerah Istimewa Yogyakarta memiliki sejarah panjang yang dimulai sejak masa perjuangan kemerdekaan. Pramuka DIY resmi dibentuk untuk membina generasi muda dengan nilai-nilai kepramukaan yang luhur.

Pada tahun 1961, bersama dengan berdirinya Gerakan Pramuka secara nasional, Kwartir Daerah Pramuka DIY juga didirikan untuk mengkoordinasikan kegiatan kepramukaan di wilayah Yogyakarta.

Sejak awal berdirinya, Pramuka DIY telah aktif dalam berbagai kegiatan pembinaan karakter generasi muda, mulai dari tingkat Siaga, Penggalang, Penegak, hingga Pandega. 

Berbagai prestasi telah diraih oleh anggota Pramuka DIY baik di tingkat nasional maupun internasional, membuktikan komitmen dalam membentuk generasi yang tangguh dan berkarakter.',
                'is_active' => true,
            ],
            [
                'title' => 'Visi & Misi',
                'slug' => 'visi-misi',
                'content' => 'VISI
Terwujudnya Pramuka Istimewa sebagai Generasi Unggul

Makna visi ini adalah pada tahun 2030 terwujud kondisi di mana anggota muda Gerakan Pramuka DIY memiliki karakter/kualitas sebagai pramuka istimewa yaitu generasi muda unggul yang mampu membangun dirinya sendiri secara mandiri, serta bersama-sama bertanggungjawab atas pembangunan bangsa dan negara, dengan kualitas utama sebagai berikut:
- Memenuhi syarat-syarat kecakapan umum sebagaimana ditetapkan oleh Gerakan Pramuka
- Memenuhi syarat-syarat kecakapan khusus sesuai potensi, minat, bakat, dan kondisi lingkungannya
- Memiliki karakter sesuai dengan nilai-nilai budaya Daerah Istimewa Yogyakarta
- Memiliki semangat untuk berperanserta dalam pembangunan nasional dan internasional
- Memiliki jiwa kepemimpinan (Leadership) yang kuat untuk menjadi pemimpin dimasa yang akan datang

MISI
1. Mewujudkan Anggota Gerakan Pramuka Daerah Istimewa Yogyakarta yang berkarakter, berbudaya, dan mampu menjadi aktor perubahan dalam pembangunan nasional/internasional
2. Mewujudkan organisasi yang modern dan dinamis
3. Meningkatkan peran Gerakan Pramuka Daerah Istimewa Yogyakarta dalam pengabdian pada masyarakat melalui pengembangan kehumasan yang memanfaatkan teknologi informasi sehingga menjangkau pengakuan masyarakat global',
                'is_active' => true,
            ],
            [
                'title' => 'Struktur Organisasi',
                'slug' => 'struktur-organisasi',
                'content' => 'SUSUNAN PENGURUS KWARTIR DAERAH GERAKAN PRAMUKA DIY
PERIODE 2025-2030

Ketua: GKR Hayu
Wakil Ketua: [Nama Wakil Ketua]

ANDALAN
- Ketua Andalan: [Nama]
- Wakil Ketua Andalan: [Nama]

BIDANG-BIDANG:
1. Bidang Pendidikan dan Pelatihan
2. Bidang Organisasi dan Tata Laksana
3. Bidang Hubungan Masyarakat dan Kerjasama
4. Bidang Pembinaan Sumber Daya Kwartir
5. Bidang Pembinaan Satuan Karya Pramuka

Struktur organisasi Kwartir Daerah Pramuka DIY disusun untuk mengoptimalkan pembinaan dan pengembangan kepramukaan di seluruh wilayah Daerah Istimewa Yogyakarta.',
                'is_active' => true,
            ],
            [
                'title' => 'Lambang & Atribut',
                'slug' => 'lambang-atribut',
                'content' => 'LAMBANG GERAKAN PRAMUKA

Lambang Gerakan Pramuka berbentuk Tunas Kelapa yang memiliki makna filosofis mendalam:
- Buah kelapa merupakan buah yang dapat hidup dimana saja
- Nyiur dalam keadaan tumbuh dinamakan cikal dan bakal
- Cikal-bakal ini merupakan makna dari Praja Muda Karana

ATRIBUT PRAMUKA DIY
Anggota Pramuka DIY menggunakan atribut standar nasional dengan tambahan tanda khusus:
- Tanda Kwartir Daerah DIY
- Papan nama YOGYAKARTA
- Tanda pelantikan sesuai golongan

SERAGAM
Pramuka DIY menggunakan seragam standar yang terdiri dari:
1. Seragam Harian (cokelat muda dan cokelat tua)
2. Seragam Kegiatan (PDH dan PDL)
3. Seragam Upacara

Setiap tingkatan memiliki warna dan model seragam yang berbeda sesuai dengan ketentuan dari Kwartir Nasional Gerakan Pramuka.',
                'is_active' => true,
            ],
            [
                'title' => 'Program Kerja',
                'slug' => 'program-kerja',
                'content' => 'PROGRAM KERJA KWARTIR DAERAH PRAMUKA DIY

A. PROGRAM PEMBINAAN ANGGOTA
1. Pelatihan Kursus Pembina Pramuka Mahir Tingkat Dasar (KMD)
2. Pelatihan Kursus Pembina Pramuka Mahir Tingkat Lanjutan (KML)
3. Pelatihan Kursus Pelatih Pembina Pramuka (KPP)
4. Pelatihan Pelatih Pembina Pramuka Mahir (PPPM)

B. PROGRAM KEGIATAN
1. Jambore Daerah (Jamda)
2. Raimuna Daerah (Raida)
3. Perkemahan Wirakarya
4. Lomba Tingkat (LT) berbagai kategori
5. Bakti Masyarakat

C. PROGRAM PENGEMBANGAN
1. Pengembangan Satuan Karya Pramuka (SAKA)
2. Pengembangan Gudep dan Gugus Depan
3. Kerjasama dengan instansi terkait
4. Pengembangan sistem informasi

D. PROGRAM PEMBERDAYAAN
1. Pemberdayaan Majelis Pembimbing
2. Pemberdayaan Staf Kwartir
3. Pemberdayaan Gugus Depan

Semua program kerja dilaksanakan dengan prinsip berkelanjutan dan terukur untuk mencapai visi dan misi Pramuka DIY.',
                'is_active' => true,
            ],
            [
                'title' => 'Prestasi & Penghargaan',
                'slug' => 'prestasi-penghargaan',
                'content' => 'PRESTASI PRAMUKA DIY

Pramuka DIY telah menorehkan berbagai prestasi membanggakan di tingkat nasional dan internasional:

TINGKAT NASIONAL:
- Juara Umum Jambore Nasional (beberapa periode)
- Juara berbagai lomba tingkat nasional
- Penghargaan Gugus Depan Terbaik
- Penghargaan Pembina Berprestasi

TINGKAT INTERNASIONAL:
- Peserta Asia-Pacific Regional Scout Jamboree
- Peserta World Scout Jamboree
- Pertukaran pelajar kepramukaan internasional

PENGHARGAAN:
- Penghargaan Kwarnas untuk kategori pembinaan terbaik
- Penghargaan dari Pemerintah Daerah DIY
- Sertifikat apresiasi dari berbagai lembaga

Prestasi ini merupakan bukti dedikasi dan kerja keras seluruh anggota, pembina, dan pengurus Pramuka DIY dalam membina generasi muda yang berkualitas.',
                'is_active' => true,
            ],
        ];

        foreach ($menus as $menu) {
            ProfileMenu::create($menu);
        }
    }
}
