# SPK dan Monitoring Penerima Rastrada

Aplikasi web untuk membantu menentukan penerima bantuan Rastrada dan memantau penyalurannya. Penerima diurutkan dengan metode TOPSIS berdasarkan kriteria yang dinilai petugas, lalu hasilnya disetujui lurah dan penyalurannya dipantau di aplikasi yang sama.

Proyek ini dikembangkan secara kolaboratif sebagai proyek akademik (Tugas Akhir).

## Fitur

- **Data penduduk:** input dan kelola data calon penerima. RT/RW dapat mengajukan warga untuk dinilai.
- **Kriteria dan subkriteria:** atur bobot, jenis kriteria (benefit atau cost), subkriteria, status aktif, dan apakah suatu kriteria butuh bukti.
- **Periode:** penilaian dan perhitungan dikelompokkan per periode.
- **Penilaian:** petugas menilai tiap calon penerima berdasarkan kriteria.
- **Perhitungan TOPSIS:** menampilkan tiap langkah, yaitu matriks keputusan, normalisasi, normalisasi terbobot, solusi ideal positif dan negatif, jarak, nilai preferensi, dan peringkat.
- **Bantuan lain:** warga yang sudah menerima bantuan lain pada tahun yang sama dikeluarkan dari perhitungan.
- **Hasil dan kuota:** lurah menetapkan kuota penerima berdasarkan peringkat.
- **Monitoring distribusi:** memantau status pengambilan bantuan, termasuk bukti pengambilan.
- **Laporan:** ekspor ke PDF dan Excel.
- **Akun dan hak akses:** empat peran dengan akses berbeda, yaitu Admin, Petugas, Lurah, dan RT/RW.

## Peran pengguna

| Peran | Tugas utama |
|---|---|
| Admin | Akses penuh sistem, kelola akun dan pegawai |
| Petugas | Input data, penilaian, perhitungan, dan monitoring |
| Lurah | Melihat hasil, validasi dan persetujuan, menetapkan kuota |
| RT/RW | Input data penduduk dan mengajukan warga |

## Metode TOPSIS singkat

TOPSIS (Technique for Order Preference by Similarity to Ideal Solution) mengurutkan pilihan berdasarkan kedekatannya dengan solusi ideal. Langkah di aplikasi ini:

1. Susun matriks keputusan dari nilai penilaian tiap calon pada tiap kriteria.
2. Normalisasi matriks, lalu kalikan dengan bobot kriteria.
3. Tentukan solusi ideal positif dan negatif. Kriteria benefit mengambil nilai terbesar sebagai ideal positif, sedangkan kriteria cost mengambil nilai terkecil.
4. Hitung jarak tiap calon ke solusi ideal positif dan negatif.
5. Hitung nilai preferensi, lalu urutkan dari yang tertinggi.

## Teknologi

- Laravel 12 (PHP 8.2 atau lebih baru)
- MySQL
- Bootstrap
- `maatwebsite/excel` untuk ekspor Excel dan `barryvdh/laravel-dompdf` untuk ekspor PDF
- Vite

## Cara menjalankan di komputer sendiri

Yang dibutuhkan: PHP 8.2+, Composer, Node.js dan npm, serta MySQL.

```bash
git clone https://github.com/lailahyt/Sistem-Pendukung-Keputusan-dan-Monitoring-Penerima-Rastrada-Menggunakan-TOPSIS.git
cd Sistem-Pendukung-Keputusan-dan-Monitoring-Penerima-Rastrada-Menggunakan-TOPSIS

composer install
npm install

cp .env.example .env
php artisan key:generate
```

Buat database kosong di MySQL, lalu ubah bagian database di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_kamu
DB_USERNAME=root
DB_PASSWORD=
```

Lanjutkan dengan migrasi, data awal, dan build tampilan:

```bash
php artisan migrate --seed
npm run build
php artisan serve
```

Buka `http://localhost:8000`.

### Akun contoh

Data awal (`php artisan migrate --seed`) berisi peran, data wilayah RT/RW, dan tiga akun percobaan:

| Peran | Email | Password |
|---|---|---|
| Admin | `admin@gmail.com` | `password` |
| Petugas | `petugas@gmail.com` | `password` |
| Lurah | `lurah@gmail.com` | `password` |

Akun RT/RW dibuat oleh Admin lewat menu akun. Akun di atas hanya untuk percobaan di komputer sendiri. Ganti password sebelum aplikasi dipakai sungguhan.

## Struktur singkat

```
app/Services/TopsisService.php   Perhitungan TOPSIS
app/Http/Controllers/            Penduduk, kriteria, penilaian, hasil, monitoring, laporan
app/Exports/LaporanExport.php    Ekspor laporan Excel
database/migrations/             Struktur tabel
database/seeders/                Peran, akun percobaan, data wilayah
resources/views/                 Tampilan Blade
routes/web.php                   Rute dan pembatasan akses per peran
```

## Catatan data

Repo ini tidak berisi data warga asli. Semua data penduduk, penilaian, dan bukti pengambilan dimasukkan lewat aplikasi, dan sebaiknya tidak dipublikasikan.

## Penulis

- Laila Hayati — [GitHub](https://github.com/lailahyt)
- Trindah Agustina — [GitHub](https://github.com/trindah)
