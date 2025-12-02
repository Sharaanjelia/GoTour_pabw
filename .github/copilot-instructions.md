# Gotour Project - AI Agent Instructions

## Project Overview
Laravel 12 tourism/travel package booking application with admin panel. Migrated from legacy PHP to modern Laravel with Breeze authentication, Tailwind CSS, and Alpine.js.

## Architecture

### Dual Layout System
- **Public**: `layouts/app.blade.php` - Customer-facing pages (packages, blog, destinations, services, discounts, photos, testimonials)
- **Admin**: `layouts/admin.blade.php` - Admin CRUD interfaces at `/admin/*`
- **Auth**: `layouts/guest.blade.php` - Login/registration flows (Laravel Breeze)

### Route Model Binding
- Packages use **slug-based** routing: `Route::get('/paket/{package:slug}', ...)` 
- Models override `getRouteKeyName()` to return `'slug'` (see `app/Models/Package.php`)
- Other resources use default ID binding with custom parameter names: `->parameters(['packages' => 'package'])`

### Authorization Pattern
- Custom `IsAdmin` middleware checks `User->is_admin` boolean flag
- Admin routes: `Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->prefix('admin')`
- Unauthenticated users → redirect to login; authenticated non-admins → 403 with error message
- No role-based permissions system (simple admin flag only)

### Image Storage Convention
- Use `Storage::disk('public')` for uploads (e.g., package covers, photos)
- Store paths relative to public disk: `packages/filename.jpg` (NOT `/storage/packages/...`)
- Models append `_url` accessor for full URLs: `getCoverImageUrlAttribute()` normalizes paths to `/storage/...`
- Run `php artisan storage:link` during setup (handled by setup scripts)

## Development Workflow

### Environment Setup
**Windows (PowerShell)**:
```powershell
powershell -ExecutionPolicy Bypass -File scripts\setup-local.ps1
```
**Linux/macOS**:
```bash
bash scripts/setup-local.sh
```
Creates SQLite database, runs migrations, installs dependencies, builds assets.

### Development Server (Recommended)
```powershell
composer dev
```
Runs concurrently: Laravel server (port 8000), queue worker, Pail logs, Vite dev server. Uses `npx concurrently` to orchestrate.

### Alternative Commands
- **Build assets**: `npm run build` (production) or `npm run dev` (watch mode)
- **Server only**: `php artisan serve`
- **Tests**: `composer test` or `php artisan test` (uses in-memory SQLite)
- **Linting**: `php artisan pint` (Laravel Pint - PHP CS Fixer)

## Database & Seeding

### Core Models
- **User** (`is_admin` boolean) - Auth via Breeze
- **Package** (slug, title, description, price, duration, cover_image, featured, is_active)
- **Payment** (user_id, package_id, amount, status, payment_method, transaction_id)
- **BlogPost**, **Destination**, **Service**, **Discount**, **PhotoRecommendation**, **Testimonial**

### Seeding Data
```php
php artisan db:seed
```
Creates test users + `AdminUserSeeder` for admin accounts. See `docs/admin-setup.md` for Tinker commands to create/promote admins.

### Migration Conventions
- Prefix dates: `2025_11_27_000001_...` for custom migrations
- Use `constrained()->cascadeOnDelete()` for required FKs
- Use `constrained()->nullOnDelete()` for optional FKs (e.g., Package->user_id)

## Key Patterns

### Resource Controllers
Admin CRUD follows Laravel resource pattern with custom parameter names:
```php
Route::resource('packages', AdminPackageController::class)
    ->names('packages')
    ->parameters(['packages' => 'package']);
```

### Public Payment Flow
1. Guest/user creates payment: `POST /payments` (public route)
2. Choose method: `GET /payments/{payment}/methods`
3. Process payment: `POST /payments/{payment}/pay`
4. Edit/delete: requires `auth` middleware

### Frontend Stack
- **Tailwind CSS 3** - Utility-first styling, config in `tailwind.config.js`
- **Alpine.js 3** - Minimal JS reactivity (global `window.Alpine`)
- **Vite** - Asset bundling (`resources/css/app.css`, `resources/js/app.js`)
- **Blade Components** - Use `@extends('layouts.app')` for public pages

## Common Tasks

### Adding New Admin Resource
1. Create migration: `php artisan make:migration create_items_table`
2. Create model with factory: `php artisan make:model Item -mf`
3. Create admin controller: `php artisan make:controller Admin/ItemController --resource`
4. Add route in `routes/web.php` admin group:
   ```php
   Route::resource('items', \App\Http\Controllers\Admin\ItemController::class)
       ->names('items')->parameters(['items' => 'item']);
   ```
5. Create views: `resources/views/admin/items/{index,create,edit}.blade.php` extending `layouts.admin`

### File Upload Pattern
```php
$path = $request->file('image')->store('items', 'public');
$model->update(['image' => $path]); // Store relative path
// Access in Blade: {{ $model->image_url }} (via accessor)
```

### Admin User Management
- URL: `/admin/users` (protected route)
- Toggle admin: `POST /admin/users/{user}/toggle-admin`
- Or use Tinker: `User::find(1)->update(['is_admin' => true]);`

## Testing Notes
- PHPUnit config uses in-memory SQLite (`DB_DATABASE=:memory:`)
- Tests in `tests/Feature/` and `tests/Unit/`
- Run with: `php artisan test` or `composer test`

## Troubleshooting
- **Missing storage link**: Run `php artisan storage:link` or re-run setup script
- **Permission errors (Windows)**: Enable Developer Mode or run PowerShell as Administrator
- **Migration errors**: Check `storage/logs/laravel.log`
- **Vite connection refused**: Ensure `npm run dev` is running alongside `php artisan serve`
