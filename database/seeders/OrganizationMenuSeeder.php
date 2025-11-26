<?php

namespace Database\Seeders;

use App\Models\OrganizationMenu;
use Illuminate\Database\Seeder;

class OrganizationMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'title' => 'Lambang',
                'slug' => 'lambang',
                'content' => 'LAMBANG GERAKAN PRAMUKA\n\nLambang Gerakan Pramuka berbentuk Tunas Kelapa yang memiliki filosofi mendalam sebagai identitas organisasi kepramukaan di Indonesia.\n\nMAKNA FILOSOFIS:\n- Buah kelapa dapat tumbuh dimana saja, melambangkan kemampuan beradaptasi\n- Tunas kelapa (cikal bakal) mencerminkan generasi muda calon pemimpin\n- Akar yang kuat melambangkan dasar kepramukaan yang kokoh\n- Daun yang menjulang menggambarkan cita-cita yang tinggi\n\nATRIBUT LAMBANG:\n- Warna cokelat pada tunas melambangkan kesederhanaan dan kealamian\n- Bentuk segi lima mewakili Pancasila sebagai dasar negara\n- Lingkaran merah putih menunjukkan semangat nasionalisme\n\nPENGGUNAAN LAMBANG:\nLambang Gerakan Pramuka digunakan pada:\n1. Bendera Gerakan Pramuka\n2. Tanda pengenal anggota\n3. Atribut seragam\n4. Dokumen resmi organisasi\n5. Papan nama kantor kwartir',
                'is_active' => true,
            ],
            [
                'title' => 'Struktur Organisasi',
                'slug' => 'struktur-organisasi',
                'content' => 'STRUKTUR ORGANISASI KWARTIR DAERAH PRAMUKA DIY\n\nSTRUKTUR KEPEMIMPINAN\nKetua: GKR Hayu\nWakil Ketua: [Nama Wakil Ketua]\nSekretaris: [Nama Sekretaris]\nBendahara: [Nama Bendahara]\n\nANDALAN KWARTIR DAERAH\nKetua Andalan: [Nama]\nWakil Ketua Andalan: [Nama]\n\nBIDANG-BIDANG KWARTIR DAERAH:\n\n1. BIDANG PENDIDIKAN DAN PELATIHAN\n   - Menyelenggarakan pendidikan dan pelatihan pembina\n   - Mengembangkan kurikulum kepramukaan\n   - Sertifikasi pembina dan pelatih\n\n2. BIDANG ORGANISASI DAN TATA LAKSANA\n   - Pengelolaan administrasi kwartir\n   - Pengembangan sistem organisasi\n   - Koordinasi dengan kwartir cabang\n\n3. BIDANG HUBUNGAN MASYARAKAT DAN KERJASAMA\n   - Menjalin kerjasama dengan instansi terkait\n   - Publikasi dan promosi kepramukaan\n   - Kemitraan dengan stakeholder\n\n4. BIDANG PEMBINAAN SUMBER DAYA KWARTIR\n   - Pengembangan SDM pembina dan pengurus\n   - Pengelolaan aset dan fasilitas\n   - Pembinaan gugus depan\n\n5. BIDANG PEMBINAAN SATUAN KARYA PRAMUKA\n   - Koordinasi seluruh Saka di DIY\n   - Pengembangan program Saka\n   - Peningkatan kualitas anggota Saka',
                'is_active' => true,
            ],
            [
                'title' => 'Majelis Pembimbing',
                'slug' => 'majelis-pembimbing',
                'content' => 'MAJELIS PEMBIMBING KWARTIR DAERAH PRAMUKA DIY\n\nDEFINISI DAN FUNGSI\nMajelis Pembimbing adalah badan yang memberikan bimbingan kepada Kwartir untuk kelancaran tugas-tugas penyelenggaraan kepramukaan dalam wilayah kerjanya.\n\nKOMPOSISI MAJELIS PEMBIMBING:\n1. Ketua Majelis Pembimbing\n2. Wakil Ketua\n3. Sekretaris\n4. Anggota dari berbagai unsur masyarakat\n\nTUGAS DAN WEWENANG:\n- Memberikan bimbingan kepada Kwartir Daerah\n- Membantu mengusahakan dana dan sarana prasarana\n- Menjalin hubungan dengan pemerintah dan masyarakat\n- Mendukung program-program Gerakan Pramuka\n- Memberikan masukan strategis untuk pengembangan organisasi\n\nKEANGGOTAAN:\nAnggota Majelis Pembimbing terdiri dari tokoh masyarakat, akademisi, praktisi, dan pemerhati kepramukaan yang memiliki dedikasi tinggi terhadap pembinaan generasi muda.\n\nPERIODE KEPENGURUSAN:\nMajelis Pembimbing bertugas selama satu periode (5 tahun) dan dapat dipilih kembali untuk periode berikutnya.',
                'is_active' => true,
            ],
            [
                'title' => 'Pengurus',
                'slug' => 'pengurus',
                'content' => 'PENGURUS KWARTIR DAERAH PRAMUKA DIY\nPERIODE 2025-2030\n\nPENGURUS HARIAN:\n\nKetua: GKR Hayu\nWakil Ketua: [Nama]\nSekretaris: [Nama]\nWakil Sekretaris: [Nama]\nBendahara: [Nama]\nWakil Bendahara: [Nama]\n\nANDALAN KWARTIR DAERAH:\n\nKetua Andalan: [Nama]\nWakil Ketua Andalan: [Nama]\n\nANGGOTA ANDALAN:\n1. Andalan Bidang Pendidikan dan Pelatihan\n2. Andalan Bidang Organisasi dan Tata Laksana\n3. Andalan Bidang Hubungan Masyarakat dan Kerjasama\n4. Andalan Bidang Pembinaan Sumber Daya Kwartir\n5. Andalan Bidang Pembinaan Satuan Karya\n\nSTAF KWARTIR:\n- Staf Administrasi\n- Staf Keuangan\n- Staf Kesekretariatan\n- Staf Program\n- Staf IT dan Multimedia\n\nTUGAS DAN TANGGUNG JAWAB:\nPengurus Kwartir Daerah bertanggung jawab atas:\n- Pengelolaan organisasi sehari-hari\n- Pelaksanaan program kerja\n- Koordinasi dengan kwartir cabang\n- Pembinaan gugus depan dan satuan karya\n- Pelaporan kepada Kwartir Nasional',
                'is_active' => true,
            ],
            [
                'title' => 'Pusdiklatda',
                'slug' => 'pusdiklatda',
                'content' => 'PUSAT PENDIDIKAN DAN PELATIHAN DAERAH (PUSDIKLATDA)\nGERAKAN PRAMUKA DIY\n\nPROFIL\nPusdiklatda adalah lembaga yang menyelenggarakan pendidikan dan pelatihan kepramukaan di tingkat daerah untuk meningkatkan kualitas pembina, pelatih, dan pengurus.\n\nFUNGSI PUSDIKLATDA:\n1. Menyelenggarakan kursus-kursus kepramukaan\n2. Mengembangkan kurikulum dan silabus pelatihan\n3. Menyediakan pelatih berkualitas\n4. Mengelola sarana dan prasarana pelatihan\n5. Melakukan evaluasi dan sertifikasi peserta\n\nJENIS PELATIHAN YANG DISELENGGARAKAN:\n\n1. KURSUS PEMBINA PRAMUKA MAHIR DASAR (KMD)\n   - Durasi: 72 jam\n   - Target: Calon pembina baru\n\n2. KURSUS PEMBINA PRAMUKA MAHIR LANJUTAN (KML)\n   - Durasi: 96 jam\n   - Target: Pembina yang telah lulus KMD\n\n3. KURSUS PELATIH PEMBINA (KPP)\n   - Durasi: 120 jam\n   - Target: Pembina untuk menjadi pelatih\n\n4. ORIENTASI PENGURUS\n   - Durasi: 24 jam\n   - Target: Pengurus kwartir dan gugus depan\n\n5. PELATIHAN KHUSUS\n   - Pelatihan outdoor\n   - Pelatihan rescue\n   - Pelatihan kepemimpinan\n   - Pelatihan manajemen gugus depan\n\nFASILITAS:\n- Aula pelatihan\n- Ruang kelas\n- Area outdoor training\n- Lapangan upacara\n- Mess peserta',
                'is_active' => true,
            ],
            [
                'title' => 'Puslitbang Kwarda',
                'slug' => 'puslitbang-kwarda',
                'content' => 'PUSAT PENELITIAN DAN PENGEMBANGAN KWARTIR DAERAH\nGERAKAN PRAMUKA DIY\n\nVISI\nMenjadi pusat unggulan penelitian dan pengembangan kepramukaan di Indonesia\n\nMISI\n1. Melakukan penelitian untuk pengembangan metode kepramukaan\n2. Mengembangkan inovasi program pembinaan generasi muda\n3. Menyediakan data dan informasi kepramukaan yang akurat\n4. Mendukung pengambilan keputusan berbasis riset\n\nBIDANG PENELITIAN:\n\n1. PENELITIAN PENDIDIKAN KEPRAMUKAAN\n   - Metode pembinaan siaga, penggalang, penegak, pandega\n   - Efektivitas kurikulum kepramukaan\n   - Perkembangan karakter anggota\n\n2. PENELITIAN ORGANISASI\n   - Struktur dan tata kelola kwartir\n   - Kinerja gugus depan\n   - Sistem administrasi dan manajemen\n\n3. PENELITIAN SOSIAL KEMASYARAKATAN\n   - Peran pramuka dalam pembangunan masyarakat\n   - Kontribusi pramuka terhadap pendidikan karakter\n   - Dampak kegiatan pramuka terhadap lingkungan\n\nPROGRAM PENGEMBANGAN:\n- Pengembangan materi pelatihan\n- Penyusunan buku panduan kepramukaan\n- Inovasi kegiatan kepramukaan modern\n- Digitalisasi sistem informasi pramuka\n- Pengembangan aplikasi kepramukaan\n\nOUTPUT PUSLITBANG:\n1. Jurnal Kepramukaan DIY (terbit 2x setahun)\n2. Buku panduan dan modul pelatihan\n3. Policy brief untuk pengambil kebijakan\n4. Rekomendasi program berbasis riset',
                'is_active' => true,
            ],
            [
                'title' => 'Pusinfo Kwarda',
                'slug' => 'pusinfo-kwarda',
                'content' => 'PUSAT INFORMASI DAN KOMUNIKASI KWARTIR DAERAH\nGERAKAN PRAMUKA DIY\n\nTUGAS POKOK\nMengelola sistem informasi dan komunikasi Gerakan Pramuka DIY untuk mendukung transparansi, akuntabilitas, dan publikasi kegiatan kepramukaan.\n\nFUNGSI PUSINFO:\n1. Pengelolaan website resmi Pramuka DIY\n2. Pengelolaan media sosial (Instagram, Facebook, Twitter, YouTube)\n3. Produksi konten multimedia (foto, video, infografis)\n4. Publikasi berita dan informasi kepramukaan\n5. Dokumentasi kegiatan\n6. Pelayanan informasi publik\n\nLAYANAN PUSINFO:\n\n1. SISTEM INFORMASI DIGITAL\n   - Database anggota Pramuka DIY\n   - Sistem pendaftaran kegiatan online\n   - E-learning kepramukaan\n   - Portal berita pramuka\n\n2. MEDIA SOSIAL\n   - Instagram: @pramukadiy\n   - Facebook: Pramuka DIY Official\n   - Twitter: @PramukaDIY\n   - YouTube: Pramuka DIY Channel\n\n3. PUBLIKASI\n   - Buletin Pramuka DIY (bulanan)\n   - Newsletter digital\n   - Press release kegiatan\n   - Annual report\n\n4. DOKUMENTASI\n   - Foto dokumentasi HD\n   - Video dokumenter kegiatan\n   - Live streaming event besar\n   - Arsip digital\n\n5. CONTACT CENTER\n   - Hotline: (0274) xxx-xxxx\n   - Email: info@pramukadiy.or.id\n   - WhatsApp Center: 08xx-xxxx-xxxx\n\nPROGRAM UNGGULAN:\n- Pramuka DIY Mobile App\n- E-Sertifikat Pelatihan\n- Virtual Museum Pramuka DIY\n- Podcast Kepramukaan',
                'is_active' => true,
            ],
            [
                'title' => 'Dewan Kerja',
                'slug' => 'dewan-kerja',
                'content' => 'DEWAN KERJA PRAMUKA PENEGAK DAN PANDEGA\nKWARTIR DAERAH DIY\n\nPROFIL\nDewan Kerja adalah organisasi bagi anggota Pramuka Penegak dan Pandega untuk mengembangkan kepemimpinan, berorganisasi, dan berkontribusi dalam kegiatan kepramukaan.\n\nSTRUKTUR DEWAN KERJA:\n\nKetua Dewan Kerja: [Nama]\nWakil Ketua: [Nama]\nSekretaris: [Nama]\nBendahara: [Nama]\n\nBIDANG-BIDANG:\n1. Bidang Organisasi dan Administrasi\n2. Bidang Program dan Kegiatan\n3. Bidang Hubungan Masyarakat\n4. Bidang Dana dan Usaha\n\nTUGAS DAN FUNGSI:\n- Mengkoordinasikan kegiatan Penegak dan Pandega di DIY\n- Menyelenggarakan Raimuna Daerah\n- Melaksanakan program bakti masyarakat\n- Mengembangkan kreativitas dan inovasi anggota\n- Menjadi wadah kaderisasi pemimpin muda\n\nKEGIATAN RUTIN:\n1. Rapat Koordinasi Dewan Kerja (bulanan)\n2. Pelatihan kepemimpinan Penegak-Pandega\n3. Bakti sosial dan lingkungan\n4. Penggalangan dana untuk kegiatan\n5. Pertukaran pelajar dengan daerah lain\n\nKEGIATAN TAHUNAN:\n- Raimuna Daerah (Raida)\n- Perkemahan Wirakarya\n- Lomba Tingkat Penegak-Pandega\n- Seminar dan workshop\n- Kegiatan adventure dan outdoor\n\nPRESTASI:\n- Juara Umum Raida Nasional\n- Delegasi Indonesia di Asia-Pacific Scout Jamboree\n- Penghargaan Dewan Kerja Terbaik Nasional',
                'is_active' => true,
            ],
            [
                'title' => 'Satuan Karya',
                'slug' => 'satuan-karya',
                'content' => 'SATUAN KARYA PRAMUKA (SAKA)\nKWARTIR DAERAH DIY\n\nPENGERTIAN\nSatuan Karya Pramuka adalah wadah pendidikan dan pembinaan guna menyalurkan minat, mengembangkan bakat dan pengalaman para Pramuka dalam berbagai bidang ilmu pengetahuan dan teknologi.\n\nJENIS SATUAN KARYA DI DIY:\n\n1. SAKA BHAYANGKARA\n   - Bidang: Keamanan dan Ketertiban\n   - Kegiatan: Pelatihan kamtibmas, traffic safety, cybercrime awareness\n\n2. SAKA DIRGANTARA\n   - Bidang: Kedirgantaraan dan Teknologi Penerbangan\n   - Kegiatan: Aeromodeling, meteorologi, navigasi udara\n\n3. SAKA BAHARI\n   - Bidang: Kelautan dan Kebaharian\n   - Kegiatan: Pelayaran, selam, navigasi laut, konservasi laut\n\n4. SAKA WANABAKTI\n   - Bidang: Kehutanan dan Lingkungan\n   - Kegiatan: Konservasi hutan, reboisasi, ekowisata\n\n5. SAKA TARUNA BUMI\n   - Bidang: Pertanian dan Ketahanan Pangan\n   - Kegiatan: Urban farming, hidroponik, peternakan\n\n6. SAKA KENCANA\n   - Bidang: Kesehatan dan Keluarga Berencana\n   - Kegiatan: PMR, donor darah, penyuluhan kesehatan\n\n7. SAKA PARIWISATA\n   - Bidang: Kepariwisataan\n   - Kegiatan: Pemandu wisata, pelestarian budaya, hospitality\n\n8. SAKA WIDYA BUDAYA BAKTI\n   - Bidang: Seni, Budaya, dan Olahraga\n   - Kegiatan: Seni tari, musik, teater, olahraga tradisional\n\n9. SAKA KALPATARU\n   - Bidang: Lingkungan Hidup\n   - Kegiatan: Pengelolaan sampah, daur ulang, go green\n\n10. SAKA INFORMATIKA\n    - Bidang: Teknologi Informasi\n    - Kegiatan: Pemrograman, desain grafis, multimedia\n\nSYARAT KEANGGOTAAN:\n- Pramuka Penegak atau Pandega\n- Memiliki minat di bidang Saka tertentu\n- Mengikuti pelantikan Saka\n\nTINGKATAN KECAKAPAN:\n1. SKK (Syarat Kecakapan Khusus) Purwa\n2. SKK Madya\n3. SKK Utama',
                'is_active' => true,
            ],
            [
                'title' => 'Satuan Komunitas',
                'slug' => 'satuan-komunitas',
                'content' => 'SATUAN KOMUNITAS PRAMUKA (SAKO)\nKWARTIR DAERAH DIY\n\nDEFINISI\nSatuan Komunitas Pramuka adalah wadah bagi anggota Pramuka yang memiliki kesamaan profesi, hobi, atau kepentingan tertentu untuk berkumpul, berbagi, dan mengembangkan potensi.\n\nTUJUAN SAKO:\n1. Memberikan wadah bagi Pramuka alumni untuk tetap aktif\n2. Mengembangkan networking sesama Pramuka\n3. Berbagi pengalaman dan keahlian\n4. Mendukung kegiatan Gerakan Pramuka\n5. Menjadi role model bagi anggota muda\n\nJENIS SATUAN KOMUNITAS DI DIY:\n\n1. SAKO GURU\n   - Anggota: Guru-guru alumni Pramuka\n   - Kegiatan: Workshop pendidikan, pembinaan gugus depan sekolah\n\n2. SAKO WARTAWAN\n   - Anggota: Wartawan dan jurnalis alumni Pramuka\n   - Kegiatan: Pelatihan jurnalistik, publikasi kegiatan pramuka\n\n3. SAKO MAHASISWA\n   - Anggota: Mahasiswa alumni Pramuka\n   - Kegiatan: Bakti sosial kampus, kajian kepramukaan\n\n4. SAKO MEDIS\n   - Anggota: Tenaga kesehatan alumni Pramuka\n   - Kegiatan: Bakti kesehatan, pelatihan P3K\n\n5. SAKO PROFESIONAL\n   - Anggota: Profesional di berbagai bidang\n   - Kegiatan: Mentoring, career talk, networking\n\n6. SAKO CREATIVE\n   - Anggota: Seniman dan kreator alumni Pramuka\n   - Kegiatan: Workshop seni, pentas budaya\n\n7. SAKO BISNIS\n   - Anggota: Pengusaha alumni Pramuka\n   - Kegiatan: Business networking, kewirausahaan\n\nMANFAAT BERGABUNG SAKO:\n- Networking dengan sesama profesional\n- Update kegiatan kepramukaan\n- Berkontribusi untuk generasi muda\n- Mengembangkan skill dan kompetensi\n- Mendapat dukungan komunitas\n\nCARA BERGABUNG:\n1. Mengisi formulir pendaftaran\n2. Melampirkan bukti alumni Pramuka (sertifikat/foto)\n3. Memilih Sako sesuai profesi/minat\n4. Mengikuti orientasi Sako\n5. Aktif dalam kegiatan komunitas',
                'is_active' => true,
            ],
        ];

        foreach ($menus as $menu) {
            OrganizationMenu::create($menu);
        }
    }
}
