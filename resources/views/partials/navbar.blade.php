<header class="header" aria-hidden="false">
  <nav class="site-navbar">

<div class="site-navbar-inner">
    <div class="navbar-left">
      <a class="navbar-brand fw-bold" href="{{ url('/') }}">
        <img src="{{ asset('images/IMG_7079-removebg-preview.png') }}" height="50" alt="GoTour">
      </a>
      <button class="navbar-toggler" type="button" aria-expanded="false" aria-controls="navbarNav" aria-label="Toggle navigation">☰</button>
    </div>

    {{-- center nav for desktop --}}
    <div class="navbar-center">
      <ul class="nav-links nav-links--desktop">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/') ? 'active text-primary fw-bold' : '' }}" href="{{ url('/') }}">
            Beranda
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ Request::is('paket') ? 'active text-primary fw-bold' : '' }}" href="{{ url('/paket') }}">
            Paket Wisata
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ Request::is('foto') ? 'active text-primary fw-bold' : '' }}" href="{{ url('/foto') }}">
            Rekomendasi Foto
          </a>
        </li>

        <li class="nav-item"><a class="nav-link fw-bold" href="{{ route('layanan.index') }}">Layanan</a></li>
        <li class="nav-item"><a class="nav-link fw-bold" href="{{ route('testimoni.index') }}">Testimoni</a></li>
        <li class="nav-item"><a class="nav-link fw-bold" href="{{ route('blog.index') }}">Blog</a></li>
      </ul>
    </div>

    {{-- right side - auth controls (desktop) --}}
    <div class="navbar-right">
      <div class="auth-buttons auth-buttons--desktop">
        @guest
          <a href="{{ route('login') }}" class="login-btn">Login</a>
          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="signup-btn">Daftar</a>
          @endif
        @else
          <div class="user-controls">
            @if(auth()->user()->is_admin)
              <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost">Admin</a>
            @endif
            <span class="user-name">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
              @csrf
              <button type="submit" class="logout-btn">Logout</button>
            </form>
          </div>
        @endguest
      </div>
    </div>

    {{-- collapsed area for mobile: shows links + auth when toggled --}}
    <div class="navbar-collapse" id="navbarNav">
      <ul class="nav-links nav-links--mobile">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/') ? 'active text-primary fw-bold' : '' }}" href="{{ url('/') }}">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('paket') ? 'active text-primary fw-bold' : '' }}" href="{{ url('/paket') }}">Paket Wisata</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('foto') ? 'active text-primary fw-bold' : '' }}" href="{{ url('/foto') }}">Rekomendasi Foto</a>
        </li>
        <li class="nav-item"><a class="nav-link fw-bold" href="{{ route('layanan.index') }}">Layanan</a></li>
        <li class="nav-item"><a class="nav-link fw-bold" href="{{ route('testimoni.index') }}">Testimoni</a></li>
        <li class="nav-item"><a class="nav-link fw-bold" href="{{ route('blog.index') }}">Blog</a></li>
      </ul>

      <div class="auth-buttons auth-buttons--mobile">
        @guest
          <a href="{{ route('login') }}" class="login-btn">Login</a>
          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="signup-btn">Daftar</a>
          @endif
        @else
          <div class="user-controls">
            @if(auth()->user()->is_admin)
              <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost">Admin</a>
            @endif
            <span class="user-name">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
              @csrf
              <button type="submit" class="logout-btn">Logout</button>
            </form>
          </div>
        @endguest
      </div>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function(){
      const toggler = document.querySelector('.navbar-toggler');
      const collapse = document.querySelector('.navbar-collapse');
      if (toggler && collapse) {
        toggler.addEventListener('click', function(){
          collapse.classList.toggle('open');
          const expanded = this.getAttribute('aria-expanded') === 'true';
          this.setAttribute('aria-expanded', String(!expanded));
        });
      }
    });
  </script>

  </nav>
</header>
