

https://github.com/user-attachments/assets/573bf214-59df-4997-80b7-826cdc7ead3b


# PANDJI SIMASET - Sistem Informasi Manajemen Aset

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-12.0-red?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-purple?style=flat-square&logo=php)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

Aplikasi web untuk manajemen dan monitoring aset properti, bangunan, ruangan, dan barang inventaris.

</div>

---

## 📋 Daftar Isi

- [Tentang Project](#tentang-project)
- [Fitur Utama](#fitur-utama)
- [Tech Stack](#tech-stack)
- [Instalasi](#instalasi)
- [Konfigurasi](#konfigurasi)
- [Penggunaan](#penggunaan)
- [Struktur Database](#struktur-database)
- [API Routes](#api-routes)
- [Role & Permission](#role--permission)
- [Testing](#testing)
- [Kontribusi](#kontribusi)
- [Lisensi](#lisensi)

---

## 🎯 Tentang Project

**PANDJI SIMASET** adalah Sistem Informasi Manajemen Aset yang dirancang untuk membantu organisasi dalam:
- **Inventarisasi aset** - mencatat semua aset milik organisasi
- **Monitoring kondisi** - melacak status dan kondisi setiap aset
- **Manajemen lokasi** - mengorganisir aset berdasarkan lokasi (tanah, bangunan, ruangan)
- **Kategorisasi barang** - mengelompokkan barang sesuai kategorinya
- **Audit trail** - mencatat aktivitas pengguna untuk keamanan dan akuntabilitas

Project ini dibangun dengan Laravel 12 sebagai framework backend dan Tailwind CSS untuk UI.

---

## ✨ Fitur Utama

### 1. **Dashboard**
   - Ringkasan statistik aset (total, aktif, maintenance, rusak)
   - Visualisasi kondisi aset
   - Activity log terbaru

### 2. **Manajemen Tanah**
   - Tambah, edit, hapus data tanah
   - Track lokasi dan informasi lahan

### 3. **Manajemen Bangunan**
   - Inventarisasi gedung dan struktur bangunan
   - Informasi detail bangunan

### 4. **Manajemen Ruangan**
   - Daftar ruangan di dalam bangunan
   - Informasi lantai dan kapasitas

### 5. **Manajemen Barang**
   - CRUD untuk semua barang inventaris
   - Tracking kondisi barang (aktif, maintenance, rusak)
   - Kategorisasi barang
   - Status monitoring

### 6. **Manajemen Kategori**
   - Organisasi barang berdasarkan tipe/kategori

### 7. **User Management** (Admin only)
   - Manajemen akun pengguna
   - Role-based access control
   - Admin & User roles

### 8. **Activity Log**
   - Pencatatan otomatis setiap aktivitas pengguna
   - Audit trail lengkap

---

## 🛠️ Tech Stack

### Backend
- **Framework**: Laravel 12.0
- **PHP**: 8.2+
- **Database**: SQLite / MySQL / PostgreSQL (configurable)
- **ORM**: Eloquent
- **Testing**: Pest PHP 3.8

### Frontend
- **CSS Framework**: Tailwind CSS 4.0
- **Build Tool**: Vite 7.0
- **HTTP Client**: Axios 1.11
- **Node.js**: 18+

### Development Tools
- **Composer**: Dependency management (PHP)
- **npm**: Package management (Node.js)
- **Laravel Pint**: Code formatting
- **Laravel Sail**: Docker environment
- **Laravel Pail**: Log viewer

---

## 📦 Instalasi

### Prerequisites
- PHP 8.2 atau lebih tinggi
- Composer
- Node.js 18+ dan npm
- Git

### Langkah-langkah

1. **Clone repository**
   ```bash
   git clone https://github.com/jawahirnaufal43/project_pdjism.git
   cd project_pdjism
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Setup environment file**
   ```bash
   cp .env.example .env
   ```

5. **Generate application key**
   ```bash
   php artisan key:generate
   ```

6. **Jalankan migrasi database**
   ```bash
   php artisan migrate
   ```

7. **Seed database (opsional)**
   ```bash
   php artisan db:seed
   ```

8. **Build assets**
   ```bash
   npm run build
   ```

---

## ⚙️ Konfigurasi

### Database Configuration
Edit file `.env` untuk mengatur database:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

# Atau untuk MySQL:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pandji_simaset
DB_USERNAME=root
DB_PASSWORD=
```

### Mail Configuration
Sesuaikan mail driver di `.env`:

```env
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
```

---

## 🚀 Penggunaan

### Development Server

Jalankan development server dengan:

```bash
composer dev
```

Atau gunakan perintah terpisah:

```bash
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: Vite dev server
npm run dev

# Terminal 3: Queue listener (optional)
php artisan queue:listen
```

Server akan berjalan di:
- **Application**: http://localhost:8000
- **Frontend Assets**: http://localhost:5173 (Vite dev server)

### Production Build

```bash
npm run build
php artisan migrate --force
```

---

## 🗄️ Struktur Database

### Models & Tables

| Model | Table | Deskripsi |
|-------|-------|-----------|
| `User` | `users` | Data pengguna aplikasi |
| `Tanah` | `tanahs` | Data lahan/tanah |
| `Bangunan` | `bangunans` | Data gedung/bangunan |
| `Ruangan` | `ruangans` | Data ruangan dalam bangunan |
| `Barang` | `barangs` | Data barang inventaris |
| `Kategori` | `kategoris` | Kategori barang |
| `Activity` | `activities` | Log aktivitas pengguna |

### Relasi Database

```
User
  ├─ has many Activities
  └─ has Role (admin/user)

Bangunan
  ├─ belongs to Tanah
  └─ has many Ruangan

Ruangan
  ├─ belongs to Bangunan
  └─ has many Barang

Barang
  ├─ belongs to Ruangan
  ├─ belongs to Kategori
  └─ has many Activities

Kategori
  └─ has many Barang

Activity
  ├─ belongs to User
  └─ recorded for Models (Barang, Bangunan, Ruangan, Tanah, Kategori)
```

---

## 🔗 API Routes

Semua routes dilindungi dengan middleware `auth` kecuali login/register.

### Authentication
```
GET    /login             - Login form
POST   /login             - Process login
GET    /register          - Register form
POST   /register          - Process registration
POST   /logout            - Logout
```

### Protected Routes (Authenticated Users)
```
GET    /dashboard         - Dashboard dengan statistik
```

### Tanah (Land)
```
GET    /tanah             - List semua tanah
GET    /tanah/create      - Form create (admin only)
POST   /tanah             - Store (admin only)
GET    /tanah/{id}/edit   - Form edit (admin only)
PUT    /tanah/{id}        - Update (admin only)
DELETE /tanah/{id}        - Delete (admin only)
```

### Bangunan (Building)
```
GET    /bangunan          - List semua bangunan
GET    /bangunan/create   - Form create (admin only)
POST   /bangunan          - Store (admin only)
GET    /bangunan/{id}/edit - Form edit (admin only)
PUT    /bangunan/{id}     - Update (admin only)
DELETE /bangunan/{id}     - Delete (admin only)
```

### Ruangan (Room)
```
GET    /ruangan           - List semua ruangan
GET    /ruangan/create    - Form create (admin only)
POST   /ruangan           - Store (admin only)
GET    /ruangan/{id}/edit - Form edit (admin only)
PUT    /ruangan/{id}      - Update (admin only)
DELETE /ruangan/{id}      - Delete (admin only)
```

### Barang (Items)
```
GET    /barang            - List semua barang
GET    /barang/create     - Form create (admin only)
POST   /barang            - Store (admin only)
GET    /barang/{id}/edit  - Form edit (admin only)
PUT    /barang/{id}       - Update (admin only)
DELETE /barang/{id}       - Delete (admin only)
```

### Kategori (Categories)
```
GET    /kategori          - List semua kategori
GET    /kategori/create   - Form create (admin only)
POST   /kategori          - Store (admin only)
GET    /kategori/{id}/edit - Form edit (admin only)
PUT    /kategori/{id}     - Update (admin only)
DELETE /kategori/{id}     - Delete (admin only)
```

### Users (Admin only)
```
GET    /users             - List semua user
GET    /users/create      - Form create user
POST   /users             - Store user
GET    /users/{id}/edit   - Form edit user
PUT    /users/{id}        - Update user
DELETE /users/{id}        - Delete user
```

---

## 👥 Role & Permission

### Admin
- ✅ CRUD semua resource (Tanah, Bangunan, Ruangan, Barang, Kategori)
- ✅ Manajemen user
- ✅ View semua aktivitas
- ✅ Access dashboard lengkap

### User
- ✅ View semua resource (read-only)
- ✅ View dashboard
- ❌ Create, edit, delete resource
- ❌ Manajemen user

**Implementasi**: `App\Http\Middleware\IsAdmin` - middleware yang mengecek role user sebelum akses resource tertentu.

---

## 🧪 Testing

### Menjalankan Tests

```bash
# Run all tests
composer test

# Run specific test file
php artisan test tests/Feature/Auth/LoginTest.php

# Run with coverage
php artisan test --coverage
```

### Testing Tools
- **Pest PHP**: Modern PHP testing framework
- **Mockery**: Mocking library
- **Faker**: Generate fake data untuk testing

### Test Structure
```
tests/
├── Feature/          - Integration tests
├── Unit/             - Unit tests
├── Pest.php          - Pest configuration
└── TestCase.php      - Base test class
```

---

## 📁 Struktur Project

```
.
├── app/
│   ├── Http/
│   │   ├── Controllers/     - Semua controllers
│   │   └── Middleware/      - Custom middleware (IsAdmin, etc)
│   ├── Models/              - Eloquent models
│   └── Providers/           - Service providers
├── bootstrap/               - App bootstrap files
├── config/                  - Configuration files
├── database/
│   ├── factories/           - Model factories untuk testing
│   ├── migrations/          - Database migrations
│   └── seeders/             - Database seeders
├── public/                  - Publicly accessible files
├── resources/
│   ├── css/                 - CSS files
│   ├── js/                  - JavaScript files
│   └── views/               - Blade templates
├── routes/
│   ├── web.php              - Web routes
│   └── console.php          - Console routes
├── storage/                 - Cache, logs, uploads
├── tests/                   - Test files
├── vendor/                  - Composer dependencies
└── composer.json            - PHP dependencies
```

---

## 🔐 Security Features

- **Authentication**: Laravel built-in auth dengan session-based
- **Authorization**: Role-based access control (RBAC)
- **CSRF Protection**: Token validation pada semua forms
- **SQL Injection Prevention**: Eloquent ORM dengan prepared statements
- **Password Hashing**: Bcrypt hashing untuk password
- **Activity Logging**: Audit trail untuk setiap aktivitas

---

## 🐛 Troubleshooting

### Issue: Database file tidak ditemukan
```bash
touch database/database.sqlite
php artisan migrate
```

### Issue: Permission denied pada storage
```bash
chmod -R 775 storage bootstrap/cache
```

### Issue: Assets tidak di-compile
```bash
npm install
npm run dev
```

### Issue: Composer autoload error
```bash
composer dump-autoload
```

---

## 🤝 Kontribusi

Kami menerima kontribusi dari komunitas. Untuk berkontribusi:

1. Fork repository ini
2. Buat branch fitur (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buka Pull Request

### Coding Standards
- Ikuti PSR-12 untuk PHP code style
- Gunakan Laravel naming conventions
- Tambahkan tests untuk fitur baru
- Update dokumentasi jika diperlukan

---

## 📝 Lisensi

Project ini menggunakan lisensi MIT. Lihat file [LICENSE](LICENSE) untuk detail lengkap.

---

## 👨‍💻 Author

**Jawadir Naufal** - [GitHub](https://github.com/jawahirnaufal43)

---

## 📞 Support

Untuk pertanyaan, masalah, atau saran, silakan buat issue di [GitHub Issues](https://github.com/jawahirnaufal43/project_pdjism/issues).

---

<div align="center">

Made with ❤️ for better asset management

</div>
