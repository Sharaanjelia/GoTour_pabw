<footer class="footer header">
  <div class="footer-grid">
    <div class="footer-col">
      <h3>GoTour</h3>
      <p>Explore. Book. Enjoy. Layanan paket wisata terbaik untuk liburan Anda.</p>
    </div>

    <div class="footer-col">
      <h3>Company</h3>
      <ul>
        <li><a href="{{ url('/') }}">Beranda</a></li>
        <li><a href="{{ url('/paket') }}">Paket Wisata</a></li>
        <li><a href="{{ route('blog.index') }}">Blog</a></li>
        <li><a href="#">Bantuan</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h3>Kontak</h3>
      <ul>
        <li>support@gotour.example</li>
        <li>+62 21 555 0123</li>
        <li>Jakarta, Indonesia</li>
      </ul>
    </div>

    <div class="footer-col">
      <h3>Follow</h3>
      <ul>
        <li><a href="#">Instagram</a></li>
        <li><a href="#">Facebook</a></li>
        <li><a href="#">Twitter</a></li>
      </ul>
    </div>
  </div>

  <div class="footer-bottom">
    <p>© {{ date('Y') }} GoTour. All rights reserved.</p>
  </div>
</footer>
