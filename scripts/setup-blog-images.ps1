# Script untuk membantu rename gambar blog
# Jalankan script ini di folder tempat Anda menyimpan gambar-gambar blog

Write-Host "==================================" -ForegroundColor Cyan
Write-Host "  Script Rename Gambar Blog" -ForegroundColor Cyan
Write-Host "==================================" -ForegroundColor Cyan
Write-Host ""

# Cek apakah folder blog images sudah ada
$blogFolder = "public\images\blog"
if (-not (Test-Path $blogFolder)) {
    New-Item -ItemType Directory -Path $blogFolder -Force | Out-Null
    Write-Host "✓ Folder $blogFolder berhasil dibuat" -ForegroundColor Green
} else {
    Write-Host "✓ Folder $blogFolder sudah ada" -ForegroundColor Green
}

Write-Host ""
Write-Host "Mapping gambar ke artikel blog:" -ForegroundColor Yellow
Write-Host "================================" -ForegroundColor Yellow
Write-Host ""
Write-Host "1. Gambar GLAMPING (dome putih)" -ForegroundColor White
Write-Host "   → Rename menjadi: glamping-bandung.jpg" -ForegroundColor Green
Write-Host ""
Write-Host "2. Gambar KEBUN TEH (jembatan kayu)" -ForegroundColor White
Write-Host "   → Rename menjadi: kebun-teh-rancabali.jpg" -ForegroundColor Green
Write-Host ""
Write-Host "3. Gambar MAKANAN SUNDA (spread makanan)" -ForegroundColor White
Write-Host "   → Rename menjadi: kuliner-sunda-lembang.jpg" -ForegroundColor Green
Write-Host ""
Write-Host "4. Gambar GEDUNG SATE (dengan tulisan)" -ForegroundColor White
Write-Host "   → Rename menjadi: gedung-sate-bandung.jpg" -ForegroundColor Green
Write-Host ""
Write-Host "5. Gambar COFFEE SHOP (bangunan putih modern)" -ForegroundColor White
Write-Host "   → Rename menjadi: coffee-shop-bandung.jpg" -ForegroundColor Green
Write-Host ""
Write-Host "6. Gambar KAWAH PUTIH (danau biru)" -ForegroundColor White
Write-Host "   → Rename menjadi: kawah-putih-ciwidey.jpg" -ForegroundColor Green
Write-Host ""
Write-Host "7. Gambar CAFE OUTDOOR (view kota malam)" -ForegroundColor White
Write-Host "   → Rename menjadi: cafe-view-kota-bandung.jpg" -ForegroundColor Green
Write-Host ""
Write-Host "8. Gambar HERITAGE OUTLET (toko)" -ForegroundColor White
Write-Host "   → Rename menjadi: heritage-factory-outlet.jpg" -ForegroundColor Green
Write-Host ""
Write-Host "9. Gambar WISATA MALAM (outdoor dengan lampu)" -ForegroundColor White
Write-Host "   → Rename menjadi: wisata-malam-bandung.jpg" -ForegroundColor Green
Write-Host ""
Write-Host "================================" -ForegroundColor Yellow
Write-Host ""
Write-Host "Setelah rename semua gambar, copy ke folder: $blogFolder" -ForegroundColor Cyan
Write-Host "Lalu jalankan command:" -ForegroundColor Cyan
Write-Host "  php artisan db:seed --class=UpdateBlogImagesSeeder" -ForegroundColor Green
Write-Host ""

# Cek apakah ada file image di folder blog
$imageFiles = Get-ChildItem -Path $blogFolder -File -ErrorAction SilentlyContinue
if ($imageFiles.Count -gt 0) {
    Write-Host "File gambar yang sudah ada di folder blog:" -ForegroundColor Yellow
    foreach ($file in $imageFiles) {
        Write-Host "  ✓ $($file.Name)" -ForegroundColor Green
    }
} else {
    Write-Host "⚠ Belum ada file gambar di folder blog" -ForegroundColor Yellow
}

Write-Host ""
Write-Host "Press any key to continue..."
$null = $Host.UI.RawUI.ReadKey("NoEcho,IncludeKeyDown")
