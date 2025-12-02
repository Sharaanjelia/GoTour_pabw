# Local dev setup script for Windows PowerShell
# Create .env if missing, use sqlite for local DB, run migrations, seed, and build assets.
# Usage: in project root run: powershell -ExecutionPolicy Bypass -File scripts\setup-local.ps1

$ProjectRoot = Split-Path -Path $MyInvocation.MyCommand.Path -Parent | Split-Path -Parent
Set-Location $ProjectRoot

Write-Host "Starting local setup in: $ProjectRoot" -ForegroundColor Cyan

Write-Host "1) Ensure .env exists (copying from .env.example if missing)" -ForegroundColor Yellow
if (-not (Test-Path -Path "$ProjectRoot\.env")) {
    Copy-Item -Path "$ProjectRoot\.env.example" -Destination "$ProjectRoot\.env"
    Write-Host ".env created from .env.example" -ForegroundColor Green
} else {
    Write-Host ".env already exists (not modified)" -ForegroundColor Yellow
}

Write-Host "2) Ensure sqlite database file exists" -ForegroundColor Yellow
if (-not (Test-Path -Path "$ProjectRoot\database\database.sqlite")) {
    New-Item -Path "$ProjectRoot\database\database.sqlite" -ItemType File | Out-Null
    Write-Host "Created database\database.sqlite" -ForegroundColor Green
} else {
    Write-Host "database\database.sqlite already exists" -ForegroundColor Yellow
}

Write-Host "3) Installing PHP dependencies (composer install)" -ForegroundColor Yellow
composer install --no-interaction

Write-Host "4) Generate application key" -ForegroundColor Yellow
php artisan key:generate

Write-Host "5) Run migrations (using sqlite override)" -ForegroundColor Yellow
# Temporarily set env var for this PowerShell session
$env:DB_CONNECTION = 'sqlite'
php artisan migrate --force

Write-Host "6) Link storage (create public/storage symlink)" -ForegroundColor Yellow
# Use custom approach for Windows: prefer artisan storage:link but fallback to mklink if needed
try {
    php artisan storage:link
} catch {
    Write-Host "storage:link failed, trying junction (mklink /J)" -ForegroundColor Yellow
    $linkTarget = Join-Path $ProjectRoot 'storage\app\public'
    $linkPath = Join-Path $ProjectRoot 'public\storage'
    cmd /c mklink /J "$linkPath" "$linkTarget" | Out-Null
}

Write-Host "7) Build front-end assets" -ForegroundColor Yellow
npm install
npm run build

Write-Host "8) Clear caches and compile views" -ForegroundColor Yellow
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan view:cache

Write-Host "Done! Run: php artisan serve" -ForegroundColor Green

# Reset env override for the current process
Remove-Item Env:\DB_CONNECTION -ErrorAction SilentlyContinue
