<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $newsData = [
            [
                'title' => 'Pelantikan Pengurus Kwartir Daerah Pramuka DIY Periode 2025-2030',
                'slug' => 'pelantikan-pengurus-kwarda-pramuka-diy-2025-2030',
                'excerpt' => 'GKR Hayu dilantik sebagai Ketua Kwartir Daerah Gerakan Pramuka DIY untuk periode 2025-2030',
                'content' => 'Yogyakarta - Gusti Kanjeng Ratu (GKR) Hayu resmi dilantik sebagai Ketua Kwartir Daerah Gerakan Pramuka Daerah Istimewa Yogyakarta periode 2025-2030. Pelantikan dilakukan di Gedung Agung Yogyakarta dengan dihadiri oleh seluruh pengurus dan anggota Pramuka DIY.\n\nDalam sambutannya, GKR Hayu menyampaikan komitmen untuk terus mengembangkan kepramukaan di Yogyakarta dan membentuk generasi muda yang berkarakter. "Pramuka harus menjadi wadah pembentukan karakter pemuda yang tangguh dan berintegritas," ujarnya.\n\nPelantikan ini juga dihadiri oleh Gubernur DIY, para pejabat daerah, dan tokoh-tokoh kepramukaan dari berbagai daerah.',
                'image' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=800',
                'category' => 'BERITA',
                'tags' => 'pelantikan, kwarda, GKR Hayu',
                'author' => 'Admin Pramuka DIY',
                'published_at' => now()->subDays(5),
                'is_active' => true,
            ],
            [
                'title' => 'Kegiatan Jambore Ranting Penggalang DIY 2025',
                'slug' => 'jambore-ranting-penggalang-diy-2025',
                'excerpt' => 'Ratusan penggalang dari seluruh DIY berkumpul dalam acara Jambore Ranting yang berlangsung selama 3 hari',
                'content' => 'Sleman - Kegiatan Jambore Ranting tingkat Penggalang DIY 2025 diikuti oleh lebih dari 500 peserta dari berbagai gugus depan di Yogyakarta. Acara berlangsung di Bumi Perkemahan Prambanan selama 3 hari.\n\nBerbagai lomba dan kegiatan kepramukaan dilaksanakan, mulai dari pioneering, wide game, hingga pentas seni. Kegiatan ini bertujuan untuk meningkatkan keterampilan dan mempererat persaudaraan antar anggota Pramuka.\n\n"Jambore ini adalah ajang pembuktian kemampuan adik-adik Penggalang dalam menerapkan ilmu kepramukaan," ungkap Ketua Panitia.',
                'image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800',
                'category' => 'KEGIATAN',
                'tags' => 'jambore, penggalang, kegiatan',
                'author' => 'Admin Pramuka DIY',
                'published_at' => now()->subDays(3),
                'is_active' => true,
            ],
            [
                'title' => 'Pelatihan Pembina Pramuka Tingkat Dasar',
                'slug' => 'pelatihan-pembina-pramuka-tingkat-dasar',
                'excerpt' => 'Kwarda DIY menggelar pelatihan untuk calon pembina pramuka dengan materi kursus mahir dasar',
                'content' => 'Yogyakarta - Kwartir Daerah Pramuka DIY menggelar Kursus Mahir Dasar (KMD) untuk para calon pembina pramuka. Sebanyak 80 peserta mengikuti pelatihan ini yang berlangsung selama 5 hari.\n\nMateri yang diajarkan meliputi sejarah kepramukaan, metodologi kepramukaan, teknik pembinaan, hingga praktik di lapangan. Para peserta juga akan mendapatkan sertifikat setelah menyelesaikan seluruh rangkaian pelatihan.\n\n"Pembina yang berkualitas adalah kunci keberhasilan pembinaan anggota Pramuka," kata Kepala Bidang Pendidikan dan Pelatihan Kwarda DIY.',
                'image' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=800',
                'category' => 'ARTIKEL',
                'tags' => 'pelatihan, pembina, KMD',
                'author' => 'Admin Pramuka DIY',
                'published_at' => now()->subDays(7),
                'is_active' => true,
            ],
            [
                'title' => 'Lomba Tali Temali Tingkat Kabupaten',
                'slug' => 'lomba-tali-temali-tingkat-kabupaten',
                'excerpt' => 'Kompetisi keterampilan tali temali diikuti puluhan regu dari berbagai gugus depan',
                'content' => 'Bantul - Lomba tali temali tingkat kabupaten berlangsung meriah di lapangan Sabrang, Bantul. Puluhan regu dari berbagai gugus depan menunjukkan kemampuan mereka dalam membuat berbagai macam simpul dan ikatan.\n\nLomba ini meliputi kategori simpul dasar, pioneering, hingga konstruksi tali. Para peserta antusias menunjukkan kemampuan terbaik mereka untuk meraih juara.\n\nPemenang lomba akan mewakili kabupaten dalam kompetisi tingkat provinsi yang akan diselenggarakan bulan depan.',
                'image' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=800',
                'category' => 'KEGIATAN',
                'tags' => 'lomba, tali temali, kabupaten',
                'author' => 'Admin Pramuka DIY',
                'published_at' => now()->subDays(10),
                'is_active' => true,
            ],
            [
                'title' => 'Bakti Sosial Pramuka Peduli Bencana',
                'slug' => 'bakti-sosial-pramuka-peduli-bencana',
                'excerpt' => 'Anggota Pramuka DIY turun langsung membantu korban bencana alam di Gunungkidul',
                'content' => 'Gunungkidul - Ratusan anggota Pramuka DIY turun ke lapangan untuk membantu korban bencana tanah longsor di Gunungkidul. Mereka membawa bantuan berupa makanan, pakaian, dan perlengkapan dapur.\n\nSelain menyalurkan bantuan, para anggota Pramuka juga membantu membersihkan puing-puing dan mendirikan tenda darurat untuk pengungsi. Kegiatan ini merupakan wujud nyata dari satya dan darma Pramuka.\n\n"Ini adalah wujud kepedulian kami terhadap sesama yang tertimpa musibah," ungkap salah satu peserta.',
                'image' => 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=800',
                'category' => 'BERITA',
                'tags' => 'bakti sosial, bencana, peduli',
                'author' => 'Admin Pramuka DIY',
                'published_at' => now()->subDays(12),
                'is_active' => true,
            ],
            [
                'title' => 'Pengumuman Seleksi Anggota Saka Bhayangkara',
                'slug' => 'pengumuman-seleksi-anggota-saka-bhayangkara',
                'excerpt' => 'Pendaftaran dibuka untuk anggota Pramuka yang ingin bergabung dengan Saka Bhayangkara',
                'content' => 'Yogyakarta - Kwartir Daerah Pramuka DIY membuka pendaftaran seleksi anggota Satuan Karya (Saka) Bhayangkara. Pendaftaran dibuka mulai tanggal 1 hingga 15 Desember 2025.\n\nSyarat pendaftaran meliputi: anggota Pramuka aktif tingkat Penegak atau Pandega, usia maksimal 25 tahun, dan memiliki minat di bidang kepolisian.\n\nInformasi lengkap dan formulir pendaftaran dapat diakses melalui website resmi Kwarda Pramuka DIY.',
                'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800',
                'category' => 'PENGUMUMAN',
                'tags' => 'pengumuman, saka, bhayangkara',
                'author' => 'Admin Pramuka DIY',
                'published_at' => now()->subDays(1),
                'is_active' => true,
            ],
        ];

        foreach ($newsData as $news) {
            News::create($news);
        }
    }
}
