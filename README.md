# SiPinjam - Sistem Informasi Peminjaman Alat Lab

SiPinjam adalah aplikasi berbasis web dan RESTful API yang dirancang untuk mengelola peminjaman alat laboratorium secara terintegrasi. Aplikasi ini memudahkan mahasiswa dalam melakukan pengajuan peminjaman alat serta membantu admin dalam memantau stok, kategori, dan riwayat transaksi peminjaman. Sistem ini dilengkapi dengan autentikasi berbasis token (Laravel Sanctum) dan kontrol akses berbasis peran (*Role-Based Access Control*).

---

## Pembuat Aplikasi

* **Nama:** Fatih Ahsan
* **NIM:** 225443033

---

## Langkah Instalasi Proyek

Ikuti langkah-langkah berikut untuk menjalankan proyek SiPinjam di komputer lokal:

1. **Clone Repositori**
   ```bash
   git clone https://github.com/Fasan6767/SiPinjam.git
   cd sipinjam
   ```

2. **Install Dependensi Composer**
   ```bash
   composer install
   ```

3. **Salin File Konfigurasi `.env`**
   ```bash
   copy .env.example .env
   ```
   *Catatan: Sesuaikan nama database di dalam file `.env` jika diperlukan (`DB_DATABASE=peminjaman225443033fatihahsan`).*

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Buat Database**
   Buat database baru di MySQL/phpMyAdmin dengan nama **`peminjaman225443033fatihahsan`** (atau sesuai dengan yang diatur di `.env`).

6. **Jalankan Migration & Seeder**
   ```bash
   php artisan migrate --seed
   ```

7. **Jalankan Server Lokal**
   ```bash
   php artisan serve
   ```
   Aplikasi dapat diakses melalui browser di `http://127.0.0.1:8000`.

---

## Akun Uji Coba (Test Accounts)

Aplikasi telah dilengkapi dengan data awal (*seeder*) untuk pengujian:

| Role | Email | Password | Hak Akses |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin@sipinjam.test` | `password` | Kelola alat, kategori, dan riwayat peminjaman penuh |
| **Mahasiswa** | `mhs@sipinjam.test` | `password` | Melihat daftar alat dan mengajukan peminjaman |

---

## Daftar Endpoint REST API

Semua *endpoint* API diawali dengan `/api`. *Endpoint* yang membutuhkan token wajib menyertakan *header*:
`Authorization: Bearer <token>`

| Method | Endpoint | Fungsi | Akses |
| :--- | :--- | :--- | :--- |
| **GET** | `/api/halo` | Tes koneksi API pertama | Publik |
| **GET** | `/api/kategori` | Menampilkan daftar kategori dan jumlah alat | Publik |
| **GET** | `/api/alat` | Menampilkan daftar alat (support filter `?cari=` & `?kategori=`) | Publik |
| **GET** | `/api/alat/{id}` | Menampilkan detail satu alat | Publik |
| **POST** | `/api/login` | Authentikasi/Login untuk mendapatkan token Sanctum | Publik |
| **GET** | `/api/me` | Menampilkan data profil pengguna pemilik token | Token |
| **POST** | `/api/logout` | Mencabut/mematikan token aktif | Token |
| **GET** | `/api/peminjaman` | Menampilkan riwayat peminjaman milik sendiri | Token |
| **POST** | `/api/peminjaman` | Mengajukan peminjaman alat baru | Token |
| **POST** | `/api/alat` | Menambah data alat baru | Admin Token |
| **PUT** | `/api/alat/{id}` | Mengubah/update data alat | Admin Token |
| **DELETE** | `/api/alat/{id}` | Menghapus data alat | Admin Token |