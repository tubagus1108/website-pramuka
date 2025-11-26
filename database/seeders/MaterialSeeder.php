<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        $materials = [
            [
                'title' => 'Pengenalan Tali Temali untuk Siaga',
                'slug' => 'pengenalan-tali-temali-siaga',
                'description' => 'Materi dasar tentang tali temali yang disesuaikan untuk tingkat Siaga',
                'content' => '<h2>Pengenalan Tali Temali</h2><p>Tali temali adalah salah satu keterampilan dasar yang harus dikuasai oleh setiap anggota Pramuka, termasuk Siaga.</p><h3>Jenis-jenis Simpul Dasar:</h3><ul><li><strong>Simpul Mati</strong> - Untuk menyambung dua tali yang sama besar</li><li><strong>Simpul Hidup</strong> - Untuk membuat jerat yang dapat dikencangkan dan dilonggarkan</li><li><strong>Simpul Pangkal</strong> - Untuk mengikat tali pada tiang</li></ul><h3>Manfaat Belajar Tali Temali:</h3><ul><li>Melatih keterampilan motorik halus</li><li>Mengembangkan kesabaran dan ketelitian</li><li>Berguna dalam kegiatan berkemah</li><li>Meningkatkan kepercayaan diri</li></ul>',
                'category' => 'Siaga',
                'level' => 'Dasar',
                'tags' => 'tali-temali,simpul,keterampilan',
                'author' => 'Kakak Pembina Siaga',
                'is_active' => true,
            ],
            [
                'title' => 'Morse dan Semaphore untuk Penggalang',
                'slug' => 'morse-semaphore-penggalang',
                'description' => 'Belajar kode morse dan semaphore sebagai alat komunikasi Pramuka',
                'content' => '<h2>Komunikasi Pramuka: Morse dan Semaphore</h2><p>Morse dan Semaphore adalah sistem komunikasi jarak jauh yang telah lama digunakan dalam kepramukaan.</p><h3>Kode Morse</h3><p>Kode Morse menggunakan kombinasi titik (.) dan garis (-) untuk mewakili huruf dan angka.</p><p>Contoh:<br>A = .- (titik garis)<br>B = -... (garis titik titik titik)<br>SOS = ... --- ... (sinyal bahaya internasional)</p><h3>Semaphore</h3><p>Semaphore menggunakan bendera untuk komunikasi visual jarak jauh. Setiap posisi bendera mewakili huruf tertentu.</p><h3>Tips Belajar:</h3><ul><li>Latihan rutin setiap hari minimal 15 menit</li><li>Mulai dari huruf-huruf yang sering digunakan</li><li>Praktik dengan teman untuk komunikasi dua arah</li><li>Gunakan aplikasi mobile untuk latihan</li></ul>',
                'category' => 'Penggalang',
                'level' => 'Dasar',
                'tags' => 'morse,semaphore,komunikasi,sandi',
                'author' => 'Kakak Pembina Penggalang',
                'is_active' => true,
            ],
            [
                'title' => 'Teknik Mendirikan Tenda untuk Penegak',
                'slug' => 'teknik-mendirikan-tenda-penegak',
                'description' => 'Panduan lengkap mendirikan berbagai jenis tenda untuk kegiatan perkemahan',
                'content' => '<h2>Teknik Mendirikan Tenda</h2><p>Mendirikan tenda adalah keterampilan penting dalam kegiatan perkemahan. Berikut panduan lengkapnya.</p><h3>Jenis-jenis Tenda:</h3><ol><li><strong>Tenda Dome</strong> - Tenda berbentuk kubah, cocok untuk 2-4 orang</li><li><strong>Tenda Tunnel</strong> - Tenda memanjang seperti terowongan</li><li><strong>Tenda Regu</strong> - Tenda besar untuk 8-12 orang</li><li><strong>Tenda Pleton</strong> - Tenda sangat besar untuk kegiatan bersama</li></ol><h3>Langkah-langkah Mendirikan Tenda:</h3><ol><li>Pilih lokasi yang rata dan tidak ada genangan air</li><li>Bersihkan area dari batu dan ranting</li><li>Bentangkan terpal dasar (groundsheet)</li><li>Susun kerangka tenda sesuai instruksi</li><li>Pasang fly sheet (penutup luar)</li><li>Kencangkan tali penguat ke pasak</li><li>Pastikan tenda kokoh dan rapi</li></ol><h3>Tips Penting:</h3><ul><li>Hindari mendirikan tenda di bawah pohon besar</li><li>Pastikan pintu tenda menghadap arah yang aman</li><li>Buat parit drainase di sekitar tenda jika diperlukan</li><li>Simpan sepatu di luar tenda</li></ul>',
                'category' => 'Penegak',
                'level' => 'Menengah',
                'tags' => 'tenda,camping,perkemahan,outdoor',
                'author' => 'Kakak Pembina Penegak',
                'is_active' => true,
            ],
            [
                'title' => 'Leadership dan Manajemen Kegiatan Pramuka',
                'slug' => 'leadership-manajemen-kegiatan',
                'description' => 'Materi kepemimpinan dan manajemen untuk Pandega dan Pembina',
                'content' => '<h2>Kepemimpinan dalam Pramuka</h2><p>Kepemimpinan adalah inti dari pendidikan kepramukaan. Setiap anggota Pramuka diharapkan dapat menjadi pemimpin yang baik.</p><h3>Prinsip Kepemimpinan Pramuka:</h3><ol><li><strong>Ing Ngarso Sung Tulodo</strong> - Di depan memberi teladan</li><li><strong>Ing Madyo Mangun Karso</strong> - Di tengah memberi semangat</li><li><strong>Tut Wuri Handayani</strong> - Di belakang memberi dorongan</li></ol><h3>Keterampilan yang Harus Dikuasai Pemimpin:</h3><ul><li>Komunikasi efektif</li><li>Pengambilan keputusan</li><li>Manajemen waktu</li><li>Delegasi tugas</li><li>Resolusi konflik</li><li>Motivasi tim</li></ul><h3>Manajemen Kegiatan:</h3><ol><li><strong>Perencanaan</strong> - Tentukan tujuan, waktu, tempat, peserta</li><li><strong>Organizing</strong> - Susun kepanitiaan dan pembagian tugas</li><li><strong>Actuating</strong> - Laksanakan kegiatan sesuai rencana</li><li><strong>Controlling</strong> - Awasi dan evaluasi pelaksanaan</li></ol><h3>Studi Kasus:</h3><p>Dalam mengelola kegiatan Jambore, seorang pemimpin harus bisa mengkoordinasi ratusan peserta, mengelola logistik, mengatur jadwal, dan memastikan keamanan. Semua ini membutuhkan keterampilan kepemimpinan yang matang.</p>',
                'category' => 'Pandega',
                'level' => 'Lanjutan',
                'tags' => 'leadership,kepemimpinan,manajemen,organisasi',
                'author' => 'Kakak Pembimbing Pandega',
                'is_active' => true,
            ],
            [
                'title' => 'Pertolongan Pertama pada Kecelakaan (P3K)',
                'slug' => 'pertolongan-pertama-p3k',
                'description' => 'Panduan lengkap P3K untuk semua tingkatan Pramuka',
                'content' => '<h2>Pertolongan Pertama pada Kecelakaan (P3K)</h2><p>P3K adalah keterampilan wajib yang harus dikuasai setiap anggota Pramuka untuk memberikan bantuan darurat sebelum pertolongan medis tiba.</p><h3>Prinsip Dasar P3K:</h3><ul><li><strong>Safety First</strong> - Pastikan keselamatan penolong dan korban</li><li><strong>Stay Calm</strong> - Tetap tenang dalam situasi darurat</li><li><strong>Call for Help</strong> - Segera hubungi bantuan medis</li></ul><h3>Isi Kotak P3K Standar:</h3><ul><li>Perban elastis dan kasa steril</li><li>Plester luka berbagai ukuran</li><li>Gunting dan pinset</li><li>Antiseptik (betadine, alkohol 70%)</li><li>Obat-obatan dasar (parasetamol, oralit)</li><li>Sarung tangan latex</li><li>Thermometer</li></ul><h3>Penanganan Cedera Umum:</h3><h4>1. Luka Lecet/Gores</h4><ol><li>Bersihkan luka dengan air mengalir</li><li>Oleskan antiseptik</li><li>Tutup dengan plester atau perban jika diperlukan</li></ol><h4>2. Luka Bakar Ringan</h4><ol><li>Dinginkan dengan air mengalir selama 10-15 menit</li><li>Jangan pecahkan gelembung yang terbentuk</li><li>Tutup dengan kasa steril</li><li>Berikan obat pereda nyeri jika perlu</li></ol><h4>3. Keseleo/Terkilir</h4><ol><li>RICE Method: Rest, Ice, Compression, Elevation</li><li>Istirahatkan bagian yang cedera</li><li>Kompres dengan es</li><li>Balut dengan perban elastis</li><li>Tinggikan posisi bagian yang cedera</li></ol><h3>Nomor Darurat:</h3><ul><li>Ambulans: 118/119</li><li>Polisi: 110</li><li>Pemadam Kebakaran: 113</li><li>SAR: 115</li></ul>',
                'category' => 'Umum',
                'level' => 'Dasar',
                'tags' => 'p3k,pertolongan-pertama,kesehatan,keselamatan',
                'author' => 'Tim Medis Kwarda',
                'is_active' => true,
            ],
            [
                'title' => 'Metode Kepramukaan untuk Pembina',
                'slug' => 'metode-kepramukaan-pembina',
                'description' => 'Panduan penerapan metode kepramukaan dalam pembinaan anggota',
                'content' => '<h2>Metode Kepramukaan</h2><p>Metode Kepramukaan adalah cara pembinaan yang khas dalam Gerakan Pramuka untuk mencapai tujuan pendidikan kepramukaan.</p><h3>10 Metode Kepramukaan:</h3><ol><li><strong>Pengamalan Kode Kehormatan Pramuka</strong><br>Dasatama dan Trisatya menjadi pedoman tingkah laku</li><li><strong>Belajar Sambil Melakukan</strong><br>Learning by doing - praktek langsung di lapangan</li><li><strong>Sistem Beregu</strong><br>Kegiatan dalam kelompok kecil untuk kerjasama</li><li><strong>Kegiatan Menantang dan Menarik</strong><br>Program yang progresif dan menyenangkan</li><li><strong>Kegiatan di Alam Terbuka</strong><br>Memanfaatkan alam sebagai laboratorium</li><li><strong>Sistem Tanda Kecakapan</strong><br>Pengakuan atas prestasi dan keterampilan</li><li><strong>Sistem Among</strong><br>Ing ngarso sung tulodo, ing madyo mangun karso, tut wuri handayani</li><li><strong>Satuan Terpisah</strong><br>Pembinaan putra dan putri terpisah</li><li><strong>Kiasan Dasar</strong><br>Penggunaan tema yang sesuai dengan golongan usia</li><li><strong>Sistem Kaderisasi</strong><br>Pembinaan berkelanjutan untuk regenerasi</li></ol><h3>Penerapan dalam Kegiatan:</h3><p>Sebagai pembina, penting untuk memahami karakteristik setiap golongan usia:</p><ul><li><strong>Siaga (7-10 tahun)</strong> - Dunia bermain dan keluarga</li><li><strong>Penggalang (11-15 tahun)</strong> - Petualangan dan kompetisi</li><li><strong>Penegak (16-20 tahun)</strong> - Tantangan dan pengabdian</li><li><strong>Pandega (21-25 tahun)</strong> - Kepemimpinan dan tanggung jawab</li></ul><h3>Tips untuk Pembina:</h3><ul><li>Persiapkan materi dengan matang</li><li>Gunakan metode yang variatif</li><li>Berikan contoh yang baik</li><li>Evaluasi setiap kegiatan</li><li>Terus belajar dan berkembang</li></ul>',
                'category' => 'Pembina',
                'level' => 'Lanjutan',
                'tags' => 'metode,pembinaan,pendidikan,pembina',
                'author' => 'Tim Pusdiklatda',
                'is_active' => true,
            ],
        ];

        foreach ($materials as $material) {
            Material::create($material);
        }
    }
}
