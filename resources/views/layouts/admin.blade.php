<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - GoTour</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}"> <!-- reuse styles where helpful -->
    @stack('styles')
  </head>

  <body>
    <div class="admin-shell">
      <aside class="admin-sidebar">
        <div class="logo">
          <img src="{{ asset('images/logo.png') }}" alt="GoTour Logo" onerror="this.style.display='none'" />
          <h2 style="margin:0;">GOTOUR</h2>
        </div>
        <nav class="admin-nav">
          <a href="{{ route('admin.dashboard') }}" class="{{ Request::is('admin') ? 'active' : '' }}">Dashboard</a>
          <a href="{{ route('admin.packages.index') }}" class="{{ Request::is('admin/packages*') ? 'active' : '' }}">Wisata</a>
          <a href="{{ route('admin.bookings.index') }}" class="{{ Request::is('admin/bookings*') ? 'active' : '' }}">Booking & Pembayaran</a>
          <a href="{{ route('admin.users.index') }}" class="{{ Request::is('admin/users*') ? 'active' : '' }}">Users</a>
          <a href="{{ route('admin.photos.index') ?? '#' }}" class="{{ Request::is('admin/photos*') ? 'active' : '' }}">Rekomendasi Foto</a>
          <a href="{{ route('admin.services.index') }}" class="{{ Request::is('admin/services*') ? 'active' : '' }}">Layanan</a>
          <a href="{{ route('admin.blog.index') }}" class="{{ Request::is('admin/blog*') ? 'active' : '' }}">Blog</a>
          <a href="{{ route('admin.discounts.index') }}" class="{{ Request::is('admin/discounts*') ? 'active' : '' }}">Diskon</a>
          <a href="{{ route('admin.testimonials.index') }}" class="{{ Request::is('admin/testimonials*') ? 'active' : '' }}">Testimoni</a>
        </nav>
      </aside>

      <main class="admin-main">
        <div class="admin-header">
          <div class="admin-search">
            <form method="GET">
              <input type="search" placeholder="Cari" name="q" value="{{ request('q') ?? '' }}" class="form-input" />
            </form>
          </div>

          <div class="admin-actions">
            <button class="admin-toggle btn btn-ghost" onclick="document.querySelector('.admin-sidebar').classList.toggle('open')">☰</button>
            <div class="text-sm text-gray-700">Halo, {{ auth()->user()?->name ?? 'Tamu' }}</div>
            @if(auth()->check())
                <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-ghost">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            @endif
          </div>
        </div>

        <div class="content">
          @if(session('success'))
            <div class="card" style="margin-bottom:1rem; border-left:4px solid #0ea5a2">{{ session('success') }}</div>
          @endif

          @yield('content')
        </div>
      </main>
    </div>

    @stack('scripts')
  </body>
</html>
