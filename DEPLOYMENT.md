# DOKUMENTASI LENGKAP DEPLOYMENT BENGKELIN (RENDER & SUPABASE)

Dokumen ini berisi panduan teknis arsitektur, konfigurasi environment, langkah-langkah deployment, serta troubleshooting untuk mendeploy aplikasi **Bengkelin (Laravel 12)** ke **Render** menggunakan **Supabase PostgreSQL** dan **Supabase Storage (S3 API)**.

---

## 1. ARSITEKTUR APLIKASI & FLOW REQUEST

```
                             +-------------------+
                             |   End User / Web  |
                             +---------+---------+
                                       |
                                       v
                             +---------+---------+
                             |   Render Web App  |
                             | (Laravel 12 App)  |
                             +----+---------+----+
                                  |         |
                  SQL Queries     |         |    S3 File Uploads
              (PostgreSQL Driver) |         |  (Flysystem S3 API)
                                  v         v
                     +------------+--+   +--+------------+
                     |    Supabase   |   |    Supabase   |
                     |  PostgreSQL   |   |    Storage    |
                     +---------------+   +---------------+
```

---

## 2. CHECKLIST SELURUH PERUBAHAN

- [x] **Audit Dependensi**: Menambahkan package `league/flysystem-aws-s3-v3` (`^3.35`) untuk dukungan Supabase Storage S3 API.
- [x] **Refactoring Migration (PostgreSQL)**: Mengubah raw SQL MySQL `MODIFY COLUMN` pada `2026_06_08_144636_update_service_bookings_status_enum.php` menjadi query `CHECK` constraint PostgreSQL yang valid dan aman.
- [x] **Refactoring Database Seeder**: Memastikan `RoleUserSeeder` dipanggil secara otomatis di semua environment (`production` maupun `local`) sehingga akun Admin, Mekanik, dan Pengguna otomatis tersedia saat deployment.
- [x] **Integrasi Storage Dinamis**: Mengubah seluruh controller (`ServiceController`, `TireController`, `OilController`, `SparepartController`, `ProductController`) dari hardcoded disk `public` menjadi disk dinamis `config('filesystems.default', 'public')`.
- [x] **Refactoring Model Accessors**: Mengubah accessor `$model->gambar_url` & `$model->image_url` pada `Service`, `Product`, `Tire`, `Oil`, dan `Sparepart` agar secara otomatis mendukung URL Supabase Storage S3, file seeded lokal, maupun URL eksternal.
- [x] **Script Build Automasi**: Membuat file executable `build.sh` untuk otomasi `composer install`, `npm run build`, `php artisan config:cache`, `route:cache`, `view:cache`, dan `php artisan migrate --force --seed` di Render.
- [x] **Render Blueprint (Infrastructure-as-Code)**: Membuat `render.yaml` untuk otomasi setup environment variabel dan service di Render.

---

## 3. DAFTAR FILE YANG DIUBAH & DIBUAT

### File Baru (NEW)
1. [build.sh](file:///c:/xampp/htdocs/bengkelin/build.sh) — Script build deployment otomatis Render.
2. [render.yaml](file:///c:/xampp/htdocs/bengkelin/render.yaml) — Render Infrastructure-as-Code manifest.
3. [deploy-optimize.bat](file:///c:/xampp/htdocs/bengkelin/deploy-optimize.bat) — Script optimasi lokal Windows.
4. [.env.production.example](file:///c:/xampp/htdocs/bengkelin/.env.production.example) — Template variabel lingkungan produksi.

### File Diubah (MODIFY)
1. [composer.json](file:///c:/xampp/htdocs/bengkelin/composer.json) — Penambahan `league/flysystem-aws-s3-v3`.
2. [config/filesystems.php](file:///c:/xampp/htdocs/bengkelin/config/filesystems.php) — Konfigurasi disk `s3` untuk Supabase Storage.
3. [database/migrations/2026_06_08_144636_update_service_bookings_status_enum.php](file:///c:/xampp/htdocs/bengkelin/database/migrations/2026_06_08_144636_update_service_bookings_status_enum.php) — Refactor query ENUM PostgreSQL.
4. [database/seeders/DatabaseSeeder.php](file:///c:/xampp/htdocs/bengkelin/database/seeders/DatabaseSeeder.php) — Eksekusi unconditional `RoleUserSeeder`.
5. [app/Http/Controllers/Admin/ServiceController.php](file:///c:/xampp/htdocs/bengkelin/app/Http/Controllers/Admin/ServiceController.php) — Storage disk dinamis.
6. [app/Http/Controllers/Admin/TireController.php](file:///c:/xampp/htdocs/bengkelin/app/Http/Controllers/Admin/TireController.php) — Storage disk dinamis.
7. [app/Http/Controllers/Admin/OilController.php](file:///c:/xampp/htdocs/bengkelin/app/Http/Controllers/Admin/OilController.php) — Storage disk dinamis.
8. [app/Http/Controllers/Admin/SparepartController.php](file:///c:/xampp/htdocs/bengkelin/app/Http/Controllers/Admin/SparepartController.php) — Storage disk dinamis.
9. [app/Http/Controllers/ProductController.php](file:///c:/xampp/htdocs/bengkelin/app/Http/Controllers/ProductController.php) — Storage disk dinamis.
10. [app/Models/Service.php](file:///c:/xampp/htdocs/bengkelin/app/Models/Service.php) — Accessor gambar dinamis.
11. [app/Models/Product.php](file:///c:/xampp/htdocs/bengkelin/app/Models/Product.php) — Accessor gambar dinamis.
12. [app/Models/Tire.php](file:///c:/xampp/htdocs/bengkelin/app/Models/Tire.php) — Accessor gambar dinamis.
13. [app/Models/Oil.php](file:///c:/xampp/htdocs/bengkelin/app/Models/Oil.php) — Accessor gambar dinamis.
14. [app/Models/Sparepart.php](file:///c:/xampp/htdocs/bengkelin/app/Models/Sparepart.php) — Accessor gambar dinamis.

---

## 4. DAFTAR PACKAGE COMPOSER / NPM YANG DITAMBAHKAN

* **Composer**:
  - `league/flysystem-aws-s3-v3` (`^3.35`)
  - `aws/aws-sdk-php` (`3.389.1`)

---

## 5. DAFTAR ENVIRONMENT VARIABLES (RENDER SETUP)

Masukkan variabel berikut pada dashboard **Render** -> **Environment Variables**:

| Variable Key | Value Contoh / Penjelasan |
| :--- | :--- |
| `APP_NAME` | `Bengkelin` |
| `APP_ENV` | `production` |
| `APP_DEBUG` | `false` |
| `APP_KEY` | *(Biarkan Render me-generate atau buat via `php artisan key:generate --show`)* |
| `APP_URL` | `https://nama-app-kamu.onrender.com` |
| `LOG_CHANNEL` | `stderr` |
| `LOG_LEVEL` | `error` |
| `DB_CONNECTION` | `pgsql` |
| `DB_HOST` | `aws-0-ap-southeast-1.pooler.supabase.com` *(Host Supabase kamu)* |
| `DB_PORT` | `5432` |
| `DB_DATABASE` | `postgres` |
| `DB_USERNAME` | `postgres.xxxxxxxxxxxxxx` *(Username Supabase kamu)* |
| `DB_PASSWORD` | `YOUR_SUPABASE_DB_PASSWORD` |
| `DB_SSLMODE` | `require` |
| `FILESYSTEM_DISK` | `s3` |
| `AWS_ACCESS_KEY_ID` | `YOUR_SUPABASE_S3_ACCESS_KEY_ID` |
| `AWS_SECRET_ACCESS_KEY` | `YOUR_SUPABASE_S3_SECRET_ACCESS_KEY` |
| `AWS_DEFAULT_REGION` | `ap-southeast-1` |
| `AWS_BUCKET` | `bengkelin-storage` |
| `AWS_ENDPOINT` | `https://xxxxxxxxxxxxxx.supabase.co/storage/v1/s3` |
| `AWS_URL` | `https://xxxxxxxxxxxxxx.supabase.co/storage/v1/object/public/bengkelin-storage` |
| `AWS_USE_PATH_STYLE_ENDPOINT` | `true` |
| `SESSION_DRIVER` | `database` |
| `CACHE_STORE` | `database` |
| `QUEUE_CONNECTION` | `sync` |

---

## 6. LANGKAH DEPLOYMENT DARI AWAL SAMPAI SELESAI

### Langkah 1: Persiapan Supabase Storage (Public Bucket)
1. Login ke [Supabase Dashboard](https://supabase.com/dashboard).
2. Buka menu **Storage** -> Klik **New Bucket**.
3. Nama Bucket: `bengkelin-storage`.
4. Pastikan sakelar **Public Bucket** diaktifkan (**ON**).
5. Buka **Project Settings** -> **Storage** -> buat / catat **S3 Access Keys** (`Access Key ID` & `Secret Access Key`).

### Langkah 2: Deploy ke Render via Blueprint / Web Service
1. Login ke [Render Dashboard](https://dashboard.render.com).
2. Klik tombol **New +** -> pilih **Web Service**.
3. Hubungkan ke repository GitHub: `https://github.com/bintanghawley/bengkelin`.
4. Isi data service:
   - **Name**: `bengkelin`
   - **Environment**: `PHP`
   - **Region**: `Singapore`
   - **Branch**: `main`
   - **Build Command**: `./build.sh` (atau `chmod +x build.sh && ./build.sh`)
   - **Start Command**: `vendor/bin/heroku-php-apache2 public/`
5. Masukkan seluruh **Environment Variables** dari tabel di atas.
6. Klik **Create Web Service** dan tunggu Render menyelesaikan proses deployment.

---

## 7. CHECKLIST VERIFIKASI SETELAH DEPLOYMENT

- [ ] **Akses URL**: Buka URL Render (misal `https://bengkelin.onrender.com`), pastikan landing page terbuka tanpa 500 Server Error.
- [ ] **Login Admin**: Login menggunakan `081234567890` / `123456`.
- [ ] **Login Mekanik**: Login menggunakan `081234567891` / `123456`.
- [ ] **Login Pengguna**: Login menggunakan `081234567892` / `123456`.
- [ ] **Upload Gambar**: Tambah produk/ban/oli/sparepart baru dengan gambar. Pastikan gambar tersimpan di Supabase Storage dan muncul di halaman.
- [ ] **Booking & Transaksi**: Uji coba buat booking servis atau checkout toko.

---

## 8. MATRIX TROUBLESHOOTING & ERROR RESOLUTION

| Gejala / Error | Penyebab | Solusi |
| :--- | :--- | :--- |
| `SQLSTATE[08006] [7] connection failed` | IP / Host / Port Supabase salah atau SSL mode tidak diatur | Pastikan `DB_SSLMODE=require` dan host Supabase benar. Gunakan Port `5432` atau `6543`. |
| `SQLSTATE[42601] Syntax error: MODIFY COLUMN` | Query migration khusus MySQL | Dipastikan sudah diperbaiki di commit `0611b27`. |
| `Class "League\Flysystem\AwsS3V3\AwsS3V3Adapter" not found` | Dependensi S3 belum terpasang | Dipastikan sudah terpasang di `composer.json` (`league/flysystem-aws-s3-v3`). |
| Gambar yang diunggah tidak muncul / 404 | Bucket Supabase ber-status *Private* atau `AWS_URL` salah | Ubah bucket Supabase `bengkelin-storage` menjadi **Public**, dan isi `AWS_URL` dengan format: `https://<ref>.supabase.co/storage/v1/object/public/<bucket>`. |
| `permission denied: ./build.sh` | File build.sh belum memiliki izin eksekusi | Di Render Build Command, gunakan: `chmod +x build.sh && ./build.sh`. |
