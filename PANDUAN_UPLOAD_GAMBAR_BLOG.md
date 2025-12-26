# Panduan Upload Gambar Blog

Silakan simpan gambar-gambar yang Anda kirimkan ke folder `public/images/blog/` dengan nama sebagai berikut:

## Mapping Gambar ke Artikel:

1. **Gambar Glamping (Dome putih)** 
   - Simpan sebagai: `glamping-bandung.jpg`
   - Untuk artikel: "Glamping Seru di Bandung: Rekomendasi untuk Liburan Keluarga"

2. **Gambar Kebun Teh (Jembatan kayu di kebun teh hijau)**
   - Simpan sebagai: `kebun-teh-rancabali.jpg`
   - Untuk artikel: "Menjelajahi Kesejukan Kebun Teh Rancabali di Ciwidey"

3. **Gambar Makanan Sunda (Berbagai masakan tradisional)**
   - Simpan sebagai: `kuliner-sunda-lembang.jpg`
   - Untuk artikel: "5 Rekomendasi Tempat Makan Sunda Autentik di Lembang"

4. **Gambar Gedung Sate (dengan tulisan GEDUNG SATE)**
   - Simpan sebagai: `gedung-sate-bandung.jpg`
   - Untuk artikel: "Wisata Sejarah: Menelusuri Gedung Bersejarah di Bandung"

5. **Gambar Coffee Shop (Bangunan putih modern minimalis)**
   - Simpan sebagai: `coffee-shop-bandung.jpg`
   - Untuk artikel: "Kopi Bandung: 7 Coffee Shop dengan View Terbaik"

6. **Gambar Kawah Putih (Danau biru kehijauan dengan gunung)**
   - Simpan sebagai: `kawah-putih-ciwidey.jpg`
   - Untuk artikel: "Panduan Lengkap Berkunjung ke Kawah Putih Ciwidey"

7. **Gambar Cafe Outdoor View Kota (Lampu-lampu malam dengan pemandangan kota)**
   - Simpan sebagai: `cafe-view-kota-bandung.jpg`
   - Untuk artikel: "Tempat Nongkrong Hits di Bandung untuk Anak Muda"

8. **Gambar Heritage Outlet (Toko dengan tulisan HERITAGE)**
   - Simpan sebagai: `heritage-factory-outlet.jpg`
   - Untuk artikel: "Belanja di Bandung: Factory Outlet dan Distro Terbaik"

9. **Gambar Wisata Malam (Tempat duduk outdoor dengan lampu string)**
   - Simpan sebagai: `wisata-malam-bandung.jpg`
   - Untuk artikel: "Jalan-Jalan Malam di Bandung: Tempat Wisata Malam Terbaik"

---

## Cara Upload:

1. Buka folder `public/images/blog/` di project Anda
2. Copy semua gambar yang Anda kirimkan ke folder tersebut
3. Rename setiap gambar sesuai dengan nama di atas
4. Jalankan command berikut untuk update database:
   ```
   php artisan db:seed --class=UpdateBlogImagesSeeder
   ```

Setelah itu, refresh halaman `/blog` dan semua artikel akan memiliki gambar cover yang sesuai! 🎉
