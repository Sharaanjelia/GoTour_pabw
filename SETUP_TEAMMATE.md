# Setup GoTour di Laptop Teman

## Langkah 1: Clone Repository
```powershell
git clone https://github.com/Sharaanjelia/GoTour_pabw.git
cd GoTour_pabw
```

## Langkah 2: Install Dependencies
```powershell
composer install
npm install
```

## Langkah 3: Setup Environment
```powershell
# Copy file .env
copy .env.example .env

# Generate app key
php artisan key:generate
```

## Langkah 4: Setup Database
```powershell
# Buat database SQLite
type nul > database\database.sqlite

# Jalankan migrations dan seeding
php artisan migrate:fresh --seed

# Link storage untuk upload gambar
php artisan storage:link
```

## Langkah 5: Buat Admin User
```powershell
php artisan tinker --execute="User::create(['name' => 'Admin', 'email' => 'admin@gotour.com', 'password' => bcrypt('password'), 'is_admin' => true]); echo 'Admin created!';"
```

## Langkah 6: Jalankan Development Server
```powershell
# Cara 1: Jalankan semua sekaligus (Recommended)
composer dev

# Cara 2: Manual (buka 2 terminal terpisah)
# Terminal 1:
php artisan serve

# Terminal 2:
npm run dev
```

## Akses Aplikasi
- **Website**: http://localhost:8000
- **Admin Panel**: http://localhost:8000/admin
- **Login Admin**:
  - Email: `admin@gotour.com`
  - Password: `password`

## Troubleshooting

### Error: SQLite database locked
```powershell
php artisan cache:clear
php artisan config:clear
```

### Error: Storage link already exists
```powershell
# Hapus link lama dulu
del public\storage
php artisan storage:link
```

### Error: Permission denied (Windows)
- Aktifkan Developer Mode di Windows Settings → Update & Security → For Developers
- Atau jalankan PowerShell sebagai Administrator

## Requirements
- PHP 8.2+
- Composer
- Node.js & npm
- Git
