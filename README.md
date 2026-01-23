# Home Putra Interior - Laravel CMS

Project ini adalah hasil migrasi dari PHP Native ke Laravel 12.x dengan arsitektur profesional dan scalable.

## 🏗️ Arsitektur

```
┌─────────────────────────┐        ┌─────────────────────────┐
│   LANDING PAGE          │        │    ADMIN CMS            │
│   homeputra-laravel.test│        │ admin.homeputra-laravel │
│   (READ ONLY)           │        │    (FULL CRUD)          │
└───────────┬─────────────┘        └───────────┬─────────────┘
            │                                  │
            └──────────────┬───────────────────┘
                           ▼
                  ┌────────────────┐
                  │   DATABASE     │
                  │ homeputra_cms  │
                  └────────────────┘
```

## 📁 Struktur Project

```
homeputra-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Frontend/      # Landing Page (READ ONLY)
│   │   │   ├── Admin/         # CMS (CRUD)
│   │   │   └── Api/           # API endpoints
│   │   └── Middleware/
│   │       └── AdminAuthenticate.php
│   └── Models/
│       ├── User.php
│       ├── HeroSection.php
│       ├── Portfolio.php
│       ├── Service.php
│       ├── Testimonial.php
│       ├── ContactSubmission.php
│       ├── Statistic.php
│       └── SiteSetting.php
├── database/
│   ├── migrations/
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/views/
│   ├── frontend/              # Landing Page Views
│   └── admin/                 # Admin Panel Views
├── routes/
│   ├── web.php                # Frontend routes
│   ├── admin.php              # Admin routes (subdomain)
│   └── api.php                # API routes
└── public/
    └── assets/                # CSS, JS, Images
```

## 🚀 Instalasi

### 1. Requirements
- PHP 8.2+
- Composer
- MySQL/MariaDB
- Node.js (optional, untuk Vite)

### 2. Setup Database
Buat database baru:
```sql
CREATE DATABASE homeputra_cms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 3. Konfigurasi Environment
```bash
cp .env.example .env
```

Edit `.env`:
```env
APP_URL=http://homeputra-laravel.test
APP_DOMAIN=homeputra-laravel.test

DB_DATABASE=homeputra_cms
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Install Dependencies
```bash
composer install
```

### 5. Generate Key
```bash
php artisan key:generate
```

### 6. Run Migrations & Seed
```bash
php artisan migrate
php artisan db:seed
```

### 7. Storage Link
```bash
php artisan storage:link
```

### 8. Laragon Setup
Di Laragon, project akan otomatis bisa diakses di:
- Landing Page: `http://homeputra-laravel.test`
- Admin Panel: `http://admin.homeputra-laravel.test`

> ⚠️ Untuk subdomain di Laragon, pastikan "Auto virtual hosts" aktif.

## 🔑 Login Admin

Setelah seeding, gunakan kredensial:
- **Username:** `admin`
- **Password:** `admin123`
- **URL:** `http://admin.homeputra-laravel.test/login`

## 📋 Routes

### Frontend (Public)
| Method | URI | Controller |
|--------|-----|------------|
| GET | `/` | HomeController@index |
| GET | `/portfolio` | PortfolioController@index |
| GET | `/services` | ServiceController@index |
| GET | `/calculator` | CalculatorController@index |

### Admin (Protected)
| Method | URI | Controller |
|--------|-----|------------|
| GET | `/` | DashboardController@index |
| GET/POST/PUT/DELETE | `/portfolio/*` | PortfolioController |
| GET/POST/PUT/DELETE | `/services/*` | ServiceController |
| ... | ... | ... |

### API
| Method | URI | Description |
|--------|-----|-------------|
| POST | `/api/contact` | Submit contact form |
| POST | `/api/calculator/calculate` | Calculate price |

## 🔒 Security

- CSRF Protection aktif
- Rate limiting pada API (10 req/min untuk contact)
- Password hashing dengan bcrypt
- Session isolation antara frontend & admin
- XSS prevention via Blade auto-escaping

## 📝 Development Notes

### Menambah Controller Admin Baru
```bash
php artisan make:controller Admin/NamaController --resource
```

### Menambah Model Baru
```bash
php artisan make:model NamaModel -m
```

### Clear Cache
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

## 🚀 Production

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

## 📄 License

Proprietary - Home Putra Interior
