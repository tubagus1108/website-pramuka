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
        ProfileMenu::create([
            'title' => 'Sejarah Pramuka Uinsuna',
            'content' => 'Sejarah Pramuka Uinsuna dimulai sejak tahun ... (isi panjang seperti blog, tambahkan detail sejarah, tokoh, peristiwa, dan perkembangan Pramuka di Uinsuna). Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque euismod, nisi eu consectetur consectetur, nisl nisi consectetur nisi, eu consectetur nisl nisi euismod nisi.'
        ]);
        ProfileMenu::create([
            'title' => 'Visi - Misi',
            'content' => '<h2>Visi Misi</h2>
<p>Visi Gerakan Pramuka Daerah Istimewa Yogyakarta 2020-2025 disusun dalam rangka mewujudkan Pramuka Daerah tujuan Gerakan Pramuka. Visi tersebut disusun dengan memperhatikan hal-hal sebagai berikut:</p>
<ul>
<li>Visi, misi, dan sasaran pembangunan nasional.</li>
<li>Visi, misi, dan sasaran pembangunan Daerah Istimewa Yogyakarta.</li>
<li>Arah kebijakan, visi, misi, dan sasaran Gerakan Pramuka.</li>
<li>Kondisi internal dan kondisi eksternal.</li>
</ul>
<p>Visi Gerakan Pramuka Daerah Istimewa Yogyakarta 2020-2025 adalah: <strong>"Terwujudnya Pramuka Istimewa sebagai Generasi Unggul"</strong></p>
<p>Makna visi ini adalah pada tahun 2025 terwujud kondisi di mana anggota muda Gerakan Pramuka DIY memiliki karakter/kualitas sebagai pramuka istimewa yaitu generasi muda unggul yang mampu membangun dirinya sendiri secara mandiri, serta bersama-sama bertanggungjawab atas pembangunan bangsa dan negara, dengan kualitas utama sebagai berikut:</p>
<ul>
<li>Memenuhi syarat-syarat kecakapan umum sebagaimana ditetapkan oleh Gerakan Pramuka.</li>
<li>Memenuhi syarat-syarat kecakapan khusus sesuai potensi, minat, bakat, dan kondisi lingkungannya.</li>
<li>Memiliki karakter sesuai dengan nilai-nilai budaya Daerah Istimewa Yogyakarta.</li>
<li>Memiliki semangat untuk berperanserta dalam pembangunan nasional dan internasional.</li>
<li>Memiliki jiwa kepemimpinan (Leadership) yang kuat untuk menjadi pemimpin dimasa yang akan datang.</li>
</ul>
<p>Untuk mewujudkan visi tersebut, ditetapkan <strong>3 (tiga) misi Gerakan Pramuka Daerah Istimewa Yogyakarta 2020-2025</strong> yaitu:</p>
<ol>
<li>Mewujudkan Anggota Gerakan Pramuka Daerah Istimewa Yogyakarta yang berkarakter, berbudaya, dan mampu menjadi aktor perubahan dalam pembangunan nasional/internasional.</li>
<li>Mewujudkan organisasi yang modern dan dinamis.</li>
<li>Meningkatkan peran Gerakan Pramuka Daerah Istimewa Yogyakarta dalam pengabdian pada masyarakat melalui pengembangan kehumasan yang memanfaatkan teknologi informasi sehingga menjangkau pengakuan masyarakat global.</li>
</ol>
<p>Misi ini diterjemahkan ke dalam agenda-agenda pokok atau program prioritas sebagai instrumen pelaksanaan misi dan pencapaian sebuah visi.</p>'
        ]);
        ProfileMenu::create([
            'title' => 'Sejarah Pramuka',
            'content' => 'Sejarah Pramuka secara umum bermula dari gagasan Lord Baden-Powell di Inggris pada awal abad ke-20. Gerakan Pramuka berkembang pesat di berbagai negara, termasuk Indonesia. Di Indonesia, Pramuka resmi berdiri pada tahun 1961 dengan tujuan membentuk generasi muda yang tangguh, mandiri, dan berjiwa sosial. Pramuka telah berkontribusi besar dalam pembangunan karakter bangsa.'
        ]);
    }
}
