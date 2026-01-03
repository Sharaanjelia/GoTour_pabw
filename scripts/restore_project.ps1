# Restore Laravel project dari backup
# Jalankan script ini di PowerShell dari root folder project

$backupName = "backup_gotour.zip"

if (-Not (Test-Path $backupName)) {
    Write-Host "File $backupName tidak ditemukan! Letakkan file backup di folder ini."
    exit 1
}

Expand-Archive -Path $backupName -DestinationPath . -Force

# Install dependency
composer install
npm install

# Link storage
php artisan storage:link

# Jalankan migrate dan seed jika perlu
php artisan migrate --seed

Write-Host "Restore selesai! Proyek siap dijalankan."
