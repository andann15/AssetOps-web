<div align="center">

# ΛssetOps

**Integrated Asset & Maintenance Management System**

> Sistem manajemen aset dan tiket keluhan berbasis web untuk lingkungan korporat — dikembangkan untuk **PT Pupuk Kaltim - Departemen Administrasi Korporat (AdKor)**.

[![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?logo=laravel&logoColor=white)](https://laravel.com/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-06B6D4?logo=tailwindcss&logoColor=white)](https://tailwindcss.com/)
[![Vite](https://img.shields.io/badge/Vite-7.x-646CFF?logo=vite&logoColor=white)](https://vitejs.dev/)
[![Docker](https://img.shields.io/badge/Docker-MinIO-2496ED?logo=docker&logoColor=white)](https://www.docker.com/)
[![MinIO](https://img.shields.io/badge/MinIO-Object_Storage-C72C48?logo=minio&logoColor=white)](https://min.io/)

</div>

---

## 📋 Deskripsi Proyek

**AssetOps** adalah aplikasi web manajemen aset dan pemeliharaan internal yang dirancang untuk mempermudah proses pelaporan, pengelolaan, dan pemantauan kerusakan aset kantor. Sistem ini memungkinkan:

- **Karyawan** memilih aset yang sedang mereka gunakan dan melaporkan kerusakan secara langsung.
- **Admin** mengelola data aset, pengguna, dan menyetujui/menolak tiket keluhan.
- **Operator/Teknisi** melihat dan mengerjakan tiket yang telah disetujui.

---

## ✨ Fitur Utama

| Fitur | Keterangan |
|---|---|
| 🔐 Autentikasi & Role | Login dengan 3 peran: Admin, Operator, Karyawan |
| 🗃️ Manajemen Aset | Admin dapat menambah, mengedit, dan menetapkan aset ke karyawan |
| 📋 Aset Saya | Karyawan dapat mengklaim dan melihat daftar aset yang digunakan |
| 🎫 Sistem Tiket | Karyawan dapat melaporkan kerusakan dengan foto (upload atau kamera langsung) |
| 📸 Kamera Real-time | Form laporan mendukung pengambilan foto langsung dari kamera HP/webcam |
| ✅ Alur Persetujuan | Admin menyetujui → Operator ditugaskan → Selesai → Ditutup Karyawan |
| 🚫 Filter Operator | Tiket yang dibatalkan/ditolak tidak tampil di layar Operator |
| 📊 Dashboard | Ringkasan status tiket per peran masing-masing |

---

## 🏗️ Arsitektur Sistem

Proyek ini menggunakan arsitektur **Laravel Monolitik** (Full-Stack Framework):

```
Browser / HP
    │
    ▼
Routes (routes/web.php)
    │
    ▼
Controllers (app/Http/Controllers/)
    │
    ▼
Models (app/Models/) ←——→ Database MySQL
    │
    ▼
Views / Blade Templates (resources/views/)
    │
    ▼
Browser menampilkan halaman
```

**Stack Teknologi:**
- **Backend:** PHP 8.2 + Laravel 12
- **Frontend:** Blade Templates + TailwindCSS + Alpine.js
- **Database:** MySQL 8.0 (via XAMPP)
- **Penyimpanan Foto:** MinIO (S3-compatible Object Storage via Docker)
- **Build Tool:** Vite 7
- **Auth & Permission:** Laravel Breeze + Spatie Laravel-Permission

---

## 📁 Struktur Folder Penting

```
assetops/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Logika bisnis tiap fitur
│   │   └── Middleware/         # Middleware (autentikasi, role)
│   ├── Models/                 # Model Eloquent (Asset, Ticket, User, dll.)
│   ├── Policies/               # Otorisasi berbasis kebijakan
│   └── Services/               # Service class (TicketStateMachine)
├── database/
│   ├── migrations/             # Skema tabel database
│   └── seeders/                # Data awal (roles, permissions, user admin)
├── resources/
│   ├── views/
│   │   ├── admin/              # Halaman Admin
│   │   ├── tickets/            # Halaman Tiket (buat, lihat, daftar)
│   │   ├── user/               # Dashboard Karyawan
│   │   ├── layouts/            # Template dasar (app.blade.php, guest.blade.php)
│   │   └── components/         # Komponen reusable (sidebar, navbar, dll.)
│   └── css/                    # File CSS utama
├── routes/
│   ├── web.php                 # Definisi semua rute web
│   └── auth.php                # Rute autentikasi
├── docker-compose.yml          # Konfigurasi Docker untuk MinIO
├── jalankan.bat                # Skrip untuk menjalankan aplikasi (Windows)
├── hentikan.bat                # Skrip untuk menghentikan semua server (Windows)
└── .env                        # Konfigurasi lingkungan (tidak di-commit ke Git)
```

---

## 🚀 Cara Menjalankan (Development — Windows + XAMPP)

### Prasyarat

Pastikan sudah terinstall:
- [XAMPP](https://www.apachefriends.org/) (dengan MySQL aktif)
- [PHP 8.2+](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/)
- [Node.js 18+](https://nodejs.org/) & NPM
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) (untuk MinIO — penyimpanan foto)

---

### 🐳 Menjalankan MinIO (Penyimpanan Foto) via Docker

Aplikasi ini menggunakan **MinIO** sebagai object storage kompatibel S3 untuk menyimpan semua foto laporan dan bukti penyelesaian tiket. MinIO dijalankan menggunakan **Docker**.

**1. Pastikan Docker Desktop sudah aktif/berjalan.**

**2. Jalankan MinIO container:**
```bash
docker-compose up -d
```

Perintah ini akan otomatis:
- Menjalankan MinIO server di port `9000` (API) dan `9001` (Web Console)
- Membuat bucket `assetops-bucket` secara otomatis
- Mengatur bucket agar bisa diakses publik

**3. Verifikasi MinIO berjalan:**

Buka browser dan akses MinIO Web Console:
```
http://localhost:9001
```
| Field | Value |
|---|---|
| Username | `minioadmin` |
| Password | `minioadmin123` |

**4. Konfigurasi `.env` untuk MinIO** (sudah terkonfigurasi secara default):
```env
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=minioadmin
AWS_SECRET_ACCESS_KEY=minioadmin123
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=assetops-bucket
AWS_USE_PATH_STYLE_ENDPOINT=true
AWS_ENDPOINT=http://127.0.0.1:9000
```

> ⚠️ **Penting:** MinIO **harus aktif** sebelum menjalankan aplikasi, jika tidak foto tiket tidak akan dapat diunggah maupun ditampilkan.

**Untuk menghentikan MinIO:**
```bash
docker-compose down
```

---

---

### Langkah Instalasi

**1. Clone repository**
```bash
git clone https://github.com/username/assetops.git
cd assetops
```

**2. Install dependensi PHP**
```bash
composer install
```

**3. Install dependensi JavaScript**
```bash
npm install
```

**4. Salin file konfigurasi**
```bash
copy .env.example .env
```

**5. Generate application key**
```bash
php artisan key:generate
```

**6. Konfigurasi database**

Edit file `.env`, sesuaikan bagian berikut:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=assetops
DB_USERNAME=root
DB_PASSWORD=
```

**7. Buat database di phpMyAdmin**

Buka `http://localhost/phpmyadmin` dan buat database baru bernama `assetops`.

**8. Jalankan migrasi & seeder**
```bash
php artisan migrate --seed
```

**9. Buat symbolic link untuk storage foto**
```bash
php artisan storage:link
```

**10. Build aset CSS/JS**
```bash
npm run build
```

---

### Menjalankan Aplikasi

**Cara cepat (disarankan):** Klik dua kali file `jalankan.bat` atau jalankan di terminal sebagai Administrator:
```bash
.\jalankan.bat
```

Aplikasi akan otomatis terbuka di `http://localhost:8000`

**Cara manual:**
```bash
# Terminal 1 - Server Laravel
php artisan serve

# Terminal 2 - Vite (Development)
npm run dev
```

**Untuk menghentikan:**
```bash
.\hentikan.bat
```

---

## 👤 Akun Default (Setelah Seeding)

| Role | Email | Password |
|---|---|---|
| Admin | admin@assetops.com | password |
| Operator | operator@assetops.com | password |
| Karyawan | user@assetops.com | password |

> ⚠️ **Penting:** Segera ganti password setelah pertama kali login di lingkungan produksi!

---

## 🔄 Alur Sistem Tiket

```
Karyawan Buat Tiket
        │
        ▼
[waiting_approval] ──── Admin Tolak ────► [rejected]
        │
  Admin Setujui + Tugaskan Operator
        │
        ▼
    [assigned]
        │
  Operator Mulai Kerjakan
        │
        ▼
   [checking] ◄── Operator upload foto bukti
        │
  Operator Tandai Selesai
        │
        ▼
   [completed]
        │
  Karyawan Konfirmasi Selesai
        │
        ▼
    [closed] ✅
```

Karyawan juga dapat **membatalkan** tiket selama masih dalam status `waiting_approval`.

---

## 🛡️ Peran & Hak Akses

| Aksi | Admin | Operator | Karyawan |
|---|:---:|:---:|:---:|
| Kelola Master Data (Aset, Divisi, dll.) | ✅ | ❌ | ❌ |
| Lihat semua tiket | ✅ | ✅* | ❌ |
| Setujui / Tolak tiket | ✅ | ❌ | ❌ |
| Kerjakan tiket | ❌ | ✅ | ❌ |
| Buat tiket keluhan | ❌ | ❌ | ✅ |
| Klaim & lihat Aset Saya | ❌ | ❌ | ✅ |
| Tutup tiket (konfirmasi selesai) | ❌ | ❌ | ✅ |
| Manajemen Pengguna | ✅ | ❌ | ❌ |

> *Operator tidak melihat tiket yang berstatus `rejected` atau `cancelled`.

---

## 📄 Lisensi

Proyek ini dikembangkan secara internal untuk keperluan **PT Pupuk Kaltim - Departemen AdKor**. Seluruh hak cipta dilindungi.

---

<div align="center">
  <sub>Dibangun dengan ❤️ menggunakan Laravel 12 & TailwindCSS</sub>
</div>
