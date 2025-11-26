# Rebranding Notes - Pramuka UIN Sultanah Nahrasiyah

## Perubahan Branding
Dari: **PRAMUKADIY / Kwartir Daerah DIY**  
Ke: **Pramuka UIN Sultanah Nahrasiyah / Racana Gerakan Pramuka**

## Informasi Universitas
- **Nama**: UIN Sultanah Nahrasiyah
- **Lokasi**: Lhokseumawe, Aceh
- **Alamat**: Jl. Syech Abdurrauf, Medan Mawang, Samudera, Lhokseumawe, Aceh 24355
- **Telp**: (0645) 44373
- **Email**: pramuka@uinsu.ac.id

## File yang Sudah Diupdate

### 1. Layout Files (✅ SELESAI)
- `resources/views/layouts/main.blade.php`
  - Header: PRAMUKADIY → PRAMUKA UIN
  - Subtitle: Kwartir Daerah DIY → UIN Sunan Kalijaga
  - Footer: Kwartir Daerah → Racana
  - Address: Gedung Dinas Pariwisata DIY → Kampus UIN Sunan Kalijaga
  - Email: kwarda@pramukadiy.or.id → pramuka@uin-suka.ac.id

- `resources/views/layouts/app.blade.php`
  - Page title updated

### 2. View Files (✅ SELESAI)
- `resources/views/home.blade.php`
  - Welcome message updated
  - Newsflash updated
  
- `resources/views/profile.blade.php`
  - Header & description updated
  
- `resources/views/organization.blade.php`
  - Header & description updated
  
- `resources/views/news.blade.php`
  - Header updated
  
- `resources/views/agenda.blade.php`
  - Subtitle updated

### 3. Seeder Files (⚠️ PERLU MANUAL UPDATE)
File-file berikut masih menggunakan referensi lama dan perlu diupdate manual sesuai konteks UIN Sunan Kalijaga:

- `database/seeders/SliderSeeder.php`
  - Title: "Selamat Datang di Pramuka DIY" → "Selamat Datang di Pramuka UIN Sunan Kalijaga"
  - Description: Update references to UIN

- `database/seeders/ProfileMenuSeeder.php`
  - Sejarah: Update dari Kwartir Daerah DIY → Racana UIN Sunan Kalijaga
  - Visi Misi: Sesuaikan dengan visi misi kampus
  - Struktur: Update struktur organisasi Racana
  - Program Kerja: Sesuaikan dengan program kampus

- `database/seeders/OrganizationMenuSeeder.php`
  - Struktur Organisasi: Update ke struktur Racana
  - Majelis Pembimbing: Sesuaikan dengan konteks PT
  - Pengurus: Update nama-nama pengurus

- `database/seeders/AgendaSeeder.php`
  - Update lokasi: "Kantor Kwarda" → "Kampus UIN"
  - Update deskripsi kegiatan sesuai konteks PT

## Catatan Penting

### Yang Sudah Berubah:
1. ✅ Branding utama di navbar dan footer
2. ✅ Alamat sekretariat
3. ✅ Kontak email dan telepon
4. ✅ Copyright footer
5. ✅ Page titles
6. ✅ Headers semua halaman utama

### Yang Masih Perlu Disesuaikan:
1. ⚠️ Konten seeder (opsional, akan muncul saat db:seed)
2. ⚠️ Gambar/foto jika ada yang spesifik DIY
3. ⚠️ Struktur organisasi di database
4. ⚠️ Nama-nama pengurus di database

### Rekomendasi Selanjutnya:
1. Update seeders sesuai data actual UIN Sunan Kalijaga
2. Ganti logo jika ada logo khusus Racana UIN
3. Update visi misi sesuai dengan dokumen resmi
4. Update struktur organisasi dengan data aktual
5. Sesuaikan program kerja dengan rencana Racana

## Build Status
✅ Frontend assets berhasil di-build (npm run build)
- CSS: 95.00 kB
- JS: 36.35 kB
