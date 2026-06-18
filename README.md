# ♻️ ReGoods — Marketplace Barang Bekas Layak Pakai

ReGoods adalah aplikasi marketplace berbasis web yang dirancang untuk memfasilitasi jual beli barang bekas layak pakai secara aman, mudah, dan efisien. Sistem ini memungkinkan pengguna untuk menjual barang yang sudah tidak digunakan serta membantu pembeli mendapatkan barang berkualitas dengan harga yang lebih terjangkau.

Aplikasi dibangun menggunakan Laravel Framework, MySQL, Bootstrap/Tailwind CSS, dan JavaScript untuk memberikan pengalaman pengguna yang modern dan responsif.

---

## ✨ Fitur Utama

| Fitur | Deskripsi |
|---------|---------|
| 🔐 Multi-Role Authentication | Login dan registrasi untuk Admin, Penjual, dan Pembeli |
| 👤 Manajemen Profil | Pengguna dapat mengelola informasi profil akun |
| 📦 Manajemen Produk | Penjual dapat menambah, mengedit, dan menghapus produk |
| 🛒 Keranjang Belanja | Pembeli dapat menyimpan produk sebelum checkout |
| 💳 Checkout & Pembayaran | Mendukung proses transaksi pembelian produk |
| ⭐ Rating & Review | Pembeli dapat memberikan ulasan dan penilaian produk |
| 📊 Dashboard Admin | Monitoring pengguna, produk, dan transaksi |
| 📁 Manajemen Kategori | Pengelolaan kategori produk oleh admin |
| 📋 Manajemen Pesanan | Monitoring dan pengelolaan pesanan |
| 📈 Laporan Penjualan | Menampilkan laporan transaksi dan aktivitas sistem |
| 🔍 Pencarian Produk | Memudahkan pengguna menemukan produk yang diinginkan |

---

## 🛠️ Teknologi yang Digunakan

### Backend
- Laravel 12
- PHP 8.x
- Eloquent ORM

### Frontend
- Blade Template Engine
- HTML5
- CSS3
- JavaScript
- Bootstrap / Tailwind CSS

### Database
- MySQL / MariaDB

### Authentication
- Laravel Authentication
- Session Management

### Development Tools
- Composer
- NPM
- Vite

---

## 📁 Struktur Direktori

```bash
ReGoods/
│
├── app/
│   ├── Models/
│   ├── Http/
│   └── Providers/
│
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
│
├── resources/
│   └── views/
│       ├── admin/
│       │   ├── admins/
│       │   ├── categories/
│       │   ├── orders/
│       │   ├── products/
│       │   ├── reports/
│       │   ├── users/
│       │   └── layouts/
│       │
│       ├── pembeli/
│       │   ├── cart/
│       │   ├── checkout/
│       │   ├── orders/
│       │   ├── products/
│       │   ├── sellers/
│       │   ├── dashboard.blade.php
│       │   ├── product-detail.blade.php
│       │   ├── profile.blade.php
│       │   └── profile-edit.blade.php
│       │
│       ├── penjual/
│       │
│       ├── partials/
│       │
│       ├── login.blade.php
│       ├── register.blade.php
│       ├── forgot-password.blade.php
│       └── welcome.blade.php
│
├── routes/
│   ├── web.php
│   ├── console.php
│   └── channels.php
│
├── public/
├── storage/
├── bootstrap/
├── vendor/
├── composer.json
├── package.json
└── README.md
```

---

## 👥 Role Pengguna

### 👨‍💼 Admin
Admin memiliki hak akses penuh terhadap sistem.

Fitur:
- Dashboard Admin
- Kelola Pengguna
- Kelola Produk
- Kelola Kategori
- Kelola Pesanan
- Monitoring Transaksi
- Laporan Penjualan

---

### 🛍️ Penjual
Penjual dapat menjual barang bekas melalui platform.

Fitur:
- Kelola Produk
- Upload Produk
- Edit Produk
- Hapus Produk
- Kelola Pesanan
- Lihat Riwayat Penjualan
- Kelola Profil

---

### 🛒 Pembeli
Pembeli dapat mencari dan membeli produk.

Fitur:
- Melihat Produk
- Pencarian Produk
- Detail Produk
- Keranjang Belanja
- Checkout
- Riwayat Pesanan
- Rating dan Review
- Kelola Profil

---

## ⚙️ Cara Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/regoods.git
cd regoods
```

---

### 2. Install Dependency PHP

```bash
composer install
```

---

### 3. Install Dependency Frontend

```bash
npm install
```

---

### 4. Copy Environment

```bash
cp .env.example .env
```

Atau pada Windows:

```bash
copy .env.example .env
```

---

### 5. Konfigurasi Database

Edit file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=regoods
DB_USERNAME=root
DB_PASSWORD=
```

---

### 6. Generate Application Key

```bash
php artisan key:generate
```

---

### 7. Jalankan Migration

```bash
php artisan migrate
```

Jika tersedia seeder:

```bash
php artisan migrate --seed
```

---

### 8. Buat Symbolic Link Storage

```bash
php artisan storage:link
```

---

### 9. Jalankan Vite

```bash
npm run dev
```

---

### 10. Jalankan Server Laravel

```bash
php artisan serve
```

Akses aplikasi melalui:

```bash
http://127.0.0.1:8000
```

---

## 🗄️ Struktur Database Utama

### users
Menyimpan data pengguna.

- id
- name
- email
- password
- role
- profile_photo

### products
Menyimpan data produk.

- id
- seller_id
- category_id
- product_name
- description
- price
- image
- condition

### categories
Kategori produk.

- id
- category_name

### orders
Data transaksi.

- id
- buyer_id
- total_price
- payment_method
- status

### order_details
Detail produk yang dibeli.

- id
- order_id
- product_id
- quantity
- subtotal

### reviews
Data rating dan review produk.

- id
- user_id
- product_id
- rating
- review

---

## 📸 Alur Sistem

```text
Registrasi / Login
        │
        ▼
Dashboard
        │
 ┌──────┼──────┐
 ▼             ▼
Penjual      Pembeli
 │             │
 ▼             ▼
Kelola      Cari Produk
Produk          │
 │              ▼
 ▼          Keranjang
Pesanan         │
 │              ▼
 ▼          Checkout
Laporan         │
                ▼
            Pembayaran
                │
                ▼
          Rating & Review
```

---

## 🔒 Keamanan

- Laravel Authentication
- CSRF Protection
- Validation Request
- Password Hashing (Bcrypt)
- Middleware Authorization
- Session Management

---

## 🚀 Pengembangan Selanjutnya

Beberapa fitur yang dapat dikembangkan:

- 📍 Integrasi Google Maps
- 💳 Payment Gateway (Midtrans)
- 🔔 Notifikasi Real-Time
- 📱 Mobile App Android & iOS
- 🤖 Sistem Rekomendasi Produk
- 🔐 Two Factor Authentication (2FA)
- ❤️ Wishlist Produk
- 📦 Tracking Pengiriman

---

## 🤝 Kontributor

Kelompok ASD-A

- Annisa Dina Maharani (2315061041)
- Saskiya Dwi Septiani (2315061033)
- Najlaa' Nafisha Aulia (2355061001)

Program Studi Teknik Informatika  
Fakultas Teknik  
Universitas Lampung

---

## 📄 Lisensi

Proyek ini dibuat untuk keperluan pembelajaran mata kuliah Agile Software Development dan dapat digunakan sebagai referensi pengembangan sistem marketplace berbasis Laravel.