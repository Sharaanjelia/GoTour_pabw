# Backup Laravel project (kode, storage, database)
# Jalankan script ini di PowerShell dari root folder project

$backupName = "backup_gotour.zip"

# List folder/file penting
$items = @(
    "app",
    "public",
    "resources",
    "routes",
    "storage/app/public",
    "database/seeders",
    "database/migrations",
    "database/factories",
    "composer.json",
    "package.json",
    "phpunit.xml",
    "tailwind.config.js",
    "vite.config.js",
    "postcss.config.js",
    "config",
    "bootstrap",
    "artisan",
    "README.md"
)

# Tambahkan file SQLite jika ada
if (Test-Path "database/database.sqlite") {
    $items += "database/database.sqlite"
}

# Hapus backup lama jika ada
if (Test-Path $backupName) {
    Remove-Item $backupName
}

Compress-Archive -Path $items -DestinationPath $backupName
Write-Host "Backup selesai! Kirim file $backupName ke temanmu."
