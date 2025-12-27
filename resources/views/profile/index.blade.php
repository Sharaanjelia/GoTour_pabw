<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Profil Saya | GoTour</title>
    <link rel="stylesheet" href="/css/navbar.css">
    <link rel="stylesheet" href="/css/footer.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f1f5f9;
            color: #0f172a;
        }

        .profile-container {
            display: flex;
            min-height: 100vh;
            padding-top: 70px;
        }

        /* Sidebar - Warna lebih gelap */
        .profile-sidebar {
            width: 340px;
            background: white;
            padding: 2.5rem;
            border-right: 1px solid #e2e8f0;
            position: sticky;
            top: 70px;
            height: calc(100vh - 70px);
            overflow-y: auto;
        }

        .profile-avatar {
            position: relative;
            width: 160px;
            height: 160px;
            margin: 0 auto 1.75rem;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #0c1e3d;
            box-shadow: 0 4px 12px rgba(12, 30, 61, 0.15);
        }

        .profile-avatar-badge {
            position: absolute;
            bottom: 8px;
            right: 8px;
            background: #0c1e3d;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 4px solid white;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }

        .profile-avatar-badge svg {
            width: 22px;
            height: 22px;
            color: white;
        }

        .profile-info {
            text-align: center;
            margin-bottom: 2.25rem;
        }

        .profile-name {
            font-size: 1.625rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 0.625rem;
        }

        .profile-badge {
            display: inline-block;
            background: linear-gradient(135deg, #1a365d 0%, #0c1e3d 100%);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 25px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .profile-stats {
            display: flex;
            gap: 1.25rem;
            margin-bottom: 2.25rem;
            padding: 1.75rem;
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            border-radius: 14px;
        }

        .profile-stat {
            flex: 1;
            text-align: center;
        }

        .profile-stat-value {
            font-size: 1.875rem;
            font-weight: 800;
            color: #0c1e3d;
            display: block;
            line-height: 1.2;
        }

        .profile-stat-label {
            font-size: 0.75rem;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.75px;
            font-weight: 700;
            margin-top: 0.375rem;
        }

        .profile-menu {
            list-style: none;
        }

        .profile-menu-item {
            margin-bottom: 0.625rem;
        }

        .profile-menu-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.25rem;
            border-radius: 12px;
            color: #64748b;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.25s;
            font-size: 0.9375rem;
        }

        .profile-menu-link svg {
            width: 22px;
            height: 22px;
            flex-shrink: 0;
        }

        .profile-menu-link:hover {
            background: #f1f5f9;
            color: #0c1e3d;
            transform: translateX(3px);
        }

        .profile-menu-link.active {
            background: #0c1e3d;
            color: white;
            box-shadow: 0 3px 10px rgba(12, 30, 61, 0.25);
        }

        .profile-menu-link.logout {
            color: #dc2626;
        }

        .profile-menu-link.logout:hover {
            background: #fef2f2;
        }

        /* Main Content */
        .profile-main {
            flex: 1;
            padding: 3.5rem 4rem;
            max-width: 1300px;
        }

        .profile-header {
            margin-bottom: 2.75rem;
        }

        .profile-title {
            font-size: 2.25rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 0.625rem;
        }

        .profile-subtitle {
            color: #64748b;
            font-size: 1.0625rem;
            line-height: 1.6;
        }

        /* Tabs */
        .profile-tabs {
            display: flex;
            gap: 1.25rem;
            margin-bottom: 2.5rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .profile-tab {
            padding: 1.125rem 1.75rem;
            background: none;
            border: none;
            color: #64748b;
            font-weight: 700;
            cursor: pointer;
            position: relative;
            transition: all 0.25s;
            display: flex;
            align-items: center;
            gap: 0.625rem;
            font-size: 0.9375rem;
        }

        .profile-tab svg {
            width: 19px;
            height: 19px;
        }

        .profile-tab:hover {
            color: #0c1e3d;
        }

        .profile-tab.active {
            color: #0c1e3d;
        }

        .profile-tab.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 3px;
            background: #0c1e3d;
            border-radius: 3px 3px 0 0;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Card */
        .profile-card {
            background: white;
            border-radius: 18px;
            padding: 2.25rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            border: 1px solid #e2e8f0;
            margin-bottom: 1.75rem;
        }

        .profile-card-header {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            margin-bottom: 1.75rem;
            padding-bottom: 1.125rem;
            border-bottom: 2px solid #f1f5f9;
        }

        .profile-card-icon {
            width: 26px;
            height: 26px;
            color: #0c1e3d;
        }

        .profile-card-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #0f172a;
        }

        /* Form */
        .form-group {
            margin-bottom: 1.75rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 700;
            color: #475569;
            margin-bottom: 0.625rem;
            text-transform: uppercase;
            letter-spacing: 0.75px;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1.125rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1.0625rem;
            transition: all 0.25s;
            font-weight: 500;
        }

        .form-input:focus {
            outline: none;
            border-color: #0c1e3d;
            box-shadow: 0 0 0 4px rgba(12, 30, 61, 0.08);
        }

        .form-input:disabled {
            background: #f8fafc;
            color: #94a3b8;
            cursor: not-allowed;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.75rem;
        }

        .btn {
            padding: 1rem 2.25rem;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s;
            border: none;
            font-size: 1.0625rem;
            display: inline-flex;
            align-items: center;
            gap: 0.625rem;
        }

        .btn-primary {
            background: #0c1e3d;
            color: white;
        }

        .btn-primary:hover {
            background: #1a365d;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(12, 30, 61, 0.25);
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #475569;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        .form-actions {
            display: flex;
            gap: 1.25rem;
            margin-top: 2.25rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4.5rem 2.5rem;
        }

        .empty-state-icon {
            width: 90px;
            height: 90px;
            color: #cbd5e1;
            margin: 0 auto 1.75rem;
        }

        .empty-state-title {
            font-size: 1.375rem;
            font-weight: 800;
            color: #475569;
            margin-bottom: 0.625rem;
        }

        .empty-state-text {
            color: #94a3b8;
            font-size: 1.0625rem;
        }

        /* Alert */
        .alert {
            padding: 1.125rem 1.75rem;
            border-radius: 12px;
            margin-bottom: 1.75rem;
            display: flex;
            align-items: center;
            gap: 0.875rem;
            font-weight: 600;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 2px solid #bbf7d0;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border: 2px solid #fecaca;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.375rem 0.875rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-success {
            background: #dcfce7;
            color: #166534;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 1.125rem 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #64748b;
            font-weight: 600;
            font-size: 0.9375rem;
        }

        .info-value {
            color: #0f172a;
            font-weight: 700;
            font-size: 0.9375rem;
        }

        .preferences-tags {
            display: flex;
            gap: 0.875rem;
            flex-wrap: wrap;
        }

        .preference-tag {
            padding: 0.625rem 1.125rem;
            background: #0c1e3d;
            color: white;
            border-radius: 999px;
            font-size: 0.875rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        @media (max-width: 1024px) {
            .profile-sidebar {
                display: none;
            }
            
            .profile-main {
                padding: 2.5rem 2rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <div class="profile-container">
        <!-- Sidebar -->
        <aside class="profile-sidebar">
            <div class="profile-avatar">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=200&background=0c1e3d&color=fff&bold=true" alt="{{ $user->name }}">
                <div class="profile-avatar-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>

            <div class="profile-info">
                <h2 class="profile-name">{{ $user->name }}</h2>
                <span class="profile-badge">Elite Traveler</span>
            </div>

            <div class="profile-stats">
                <div class="profile-stat">
                    <span class="profile-stat-value">{{ number_format($user->poin) }}</span>
                    <span class="profile-stat-label">Poin</span>
                </div>
                <div class="profile-stat">
                    <span class="profile-stat-value">{{ $user->trips_count }}</span>
                    <span class="profile-stat-label">Trip</span>
                </div>
            </div>

            <ul class="profile-menu">
                <li class="profile-menu-item">
                    <a href="#" class="profile-menu-link active" data-tab="profil">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profil Saya
                    </a>
                </li>
                <li class="profile-menu-item">
                    <a href="#" class="profile-menu-link" data-tab="riwayat">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Riwayat Trip
                    </a>
                </li>
                <li class="profile-menu-item">
                    <a href="#" class="profile-menu-link" data-tab="favorit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        Favorit Wisata
                    </a>
                </li>
                <li class="profile-menu-item">
                    <a href="#" class="profile-menu-link" data-tab="pengaturan">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Pengaturan
                    </a>
                </li>
                <li class="profile-menu-item" style="margin-top: 1.25rem; padding-top: 1.25rem; border-top: 2px solid #e2e8f0;">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="profile-menu-link logout" style="width: 100%; background: none; border: none; text-align: left; cursor: pointer;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="profile-main">
            @if(session('success'))
            <div class="alert alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 22px; height: 22px;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 22px; height: 22px;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Tab: Profil Saya -->
            <div class="tab-content active" id="tab-profil">
                <div class="profile-header">
                    <h1 class="profile-title">Informasi Akun</h1>
                    <p class="profile-subtitle">Kelola data diri dan preferensi liburanmu.</p>
                </div>

                <div class="profile-card">
                    <div class="profile-card-header">
                        <svg class="profile-card-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <h3 class="profile-card-title">Nama Lengkap</h3>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Nama Lengkap</span>
                        <span class="info-value">{{ $user->name }}</span>
                    </div>
                </div>

                <div class="profile-card">
                    <div class="profile-card-header">
                        <svg class="profile-card-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <h3 class="profile-card-title">Email</h3>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $user->email }}</span>
                    </div>
                </div>

                <div class="profile-card">
                    <div class="profile-card-header">
                        <svg class="profile-card-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <h3 class="profile-card-title">Kota Asal</h3>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Kota Asal</span>
                        <span class="info-value">{{ $user->city ?? 'Bandung' }}</span>
                    </div>
                </div>

                <div class="profile-card">
                    <div class="profile-card-header">
                        <svg class="profile-card-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <h3 class="profile-card-title">Preferensi</h3>
                    </div>

                    <div class="preferences-tags">
                        <span class="preference-tag">WISATA ALAM</span>
                        <span class="preference-tag">KULINER</span>
                    </div>
                </div>

                <button class="btn btn-primary" onclick="document.querySelector('[data-tab=pengaturan]').click(); setTimeout(() => { window.scrollTo({top: 300, behavior: 'smooth'}); }, 100);">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 22px; height: 22px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Profil
                </button>
            </div>

            <!-- Tab: Riwayat Trip -->
            <div class="tab-content" id="tab-riwayat">
                <div class="profile-header">
                    <h1 class="profile-title">Riwayat Trip</h1>
                    <p class="profile-subtitle">Fitur ini sedang dalam sinkronisasi data cloud. Coba lagi dalam beberapa saat.</p>
                </div>

                <div class="profile-card">
                    <div class="empty-state">
                        <svg class="empty-state-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="empty-state-title">Riwayat Trip</h3>
                        <p class="empty-state-text">Fitur ini sedang dalam sinkronisasi data cloud. Coba lagi dalam beberapa saat.</p>
                    </div>
                </div>
            </div>

            <!-- Tab: Favorit Wisata -->
            <div class="tab-content" id="tab-favorit">
                <div class="profile-header">
                    <h1 class="profile-title">Wisata Favorit</h1>
                    <p class="profile-subtitle">Fitur ini sedang dalam sinkronisasi data cloud. Coba lagi dalam beberapa saat.</p>
                </div>

                <div class="profile-card">
                    <div class="empty-state">
                        <svg class="empty-state-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="empty-state-title">Wisata Favorit</h3>
                        <p class="empty-state-text">Fitur ini sedang dalam sinkronisasi data cloud. Coba lagi dalam beberapa saat.</p>
                    </div>
                </div>
            </div>

            <!-- Tab: Pengaturan -->
            <div class="tab-content" id="tab-pengaturan">
                <div class="profile-header">
                    <h1 class="profile-title">Pengaturan Akun</h1>
                    <p class="profile-subtitle">Kelola keamanan dan preferensi akun GoTour kamu</p>
                </div>

                <!-- Sub Tabs -->
                <div class="profile-tabs">
                    <button class="profile-tab active" data-subtab="akun">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Akun & Keamanan
                    </button>
                    <button class="profile-tab" data-subtab="preferensi">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        Preferensi Wisata
                    </button>
                    <button class="profile-tab" data-subtab="notifikasi">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        Notifikasi
                    </button>
                </div>

                <!-- Subtab: Akun & Keamanan -->
                <div class="tab-content active" id="subtab-akun">
                    <!-- Edit Profile Form -->
                    <div class="profile-card">
                        <div class="profile-card-header">
                            <svg class="profile-card-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <h3 class="profile-card-title">Informasi Akun</h3>
                        </div>

                        <form method="POST" action="{{ route('user.profile.update') }}">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Email Terdaftar</label>
                                <input type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Nomor Handphone</label>
                                <div style="display: flex; gap: 1.25rem; align-items: center;">
                                    <input type="tel" name="phone" class="form-input" value="{{ old('phone', $user->phone) }}" placeholder="+62 812 3456 7890">
                                    @if($user->phone)
                                    <span class="badge badge-success">TERVERIFIKASI ✓</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row">
                                <button type="submit" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px; height: 20px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                    </svg>
                                    Simpan
                                </button>
                                <button type="button" class="btn btn-secondary">Batal</button>
                            </div>
                        </form>
                    </div>

                    <!-- Change Password -->
                    <div class="profile-card">
                        <div class="profile-card-header">
                            <svg class="profile-card-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <h3 class="profile-card-title">Ubah Kata Sandi</h3>
                        </div>

                        <form method="POST" action="{{ route('user.password.update') }}">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Password Lama</label>
                                <input type="password" name="current_password" class="form-input" placeholder="••••••••" required>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Password Baru</label>
                                    <input type="password" name="password" class="form-input" placeholder="Minimal 8 karakter" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="form-input" placeholder="••••••••" required>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Perbarui Password</button>
                            </div>
                        </form>
                    </div>

                    <!-- Delete Account -->
                    <div class="profile-card" style="border-color: #fecaca;">
                        <div class="profile-card-header">
                            <svg class="profile-card-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #dc2626;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <h3 class="profile-card-title" style="color: #dc2626;">Hapus Akun</h3>
                        </div>

                        <p style="color: #64748b; margin-bottom: 1.75rem; line-height: 1.6;">
                            Menghapus akun akan menghilangkan semua data riwayat trip, poin reward, dan wishlist kamu secara permanen.
                        </p>

                        <button type="button" class="btn btn-danger" onclick="if(confirm('Apakah Anda yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan!')) document.getElementById('delete-account-form').submit()">
                            Hapus Akun
                        </button>

                        <form id="delete-account-form" method="POST" action="{{ route('user.account.destroy') }}" style="display: none;">
                            @csrf
                            @method('DELETE')
                            <input type="password" name="password" value="dummy" required>
                        </form>
                    </div>
                </div>

                <!-- Subtab: Preferensi Wisata -->
                <div class="tab-content" id="subtab-preferensi">
                    <div class="profile-card">
                        <div class="empty-state">
                            <svg class="empty-state-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                            <h3 class="empty-state-title">Modul Preferensi Wisata</h3>
                            <p class="empty-state-text">Akan segera hadir untuk optimasi AI Rekomendasi.</p>
                        </div>
                    </div>
                </div>

                <!-- Subtab: Notifikasi -->
                <div class="tab-content" id="subtab-notifikasi">
                    <div class="profile-card">
                        <div class="empty-state">
                            <svg class="empty-state-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <h3 class="empty-state-title">Pengaturan Notifikasi</h3>
                            <p class="empty-state-text">Fitur pengaturan notifikasi akan segera hadir.</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('partials.footer')

    <script>
        // Tab Navigation
        document.querySelectorAll('[data-tab]').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const tab = link.dataset.tab;
                
                // Update active link
                document.querySelectorAll('[data-tab]').forEach(l => l.classList.remove('active'));
                link.classList.add('active');
                
                // Show corresponding content
                document.querySelectorAll('.profile-main > .tab-content').forEach(content => {
                    if (content.id === `tab-${tab}`) {
                        content.classList.add('active');
                    } else {
                        content.classList.remove('active');
                    }
                });
            });
        });

        // Subtab Navigation (Pengaturan)
        document.querySelectorAll('[data-subtab]').forEach(tab => {
            tab.addEventListener('click', () => {
                const subtab = tab.dataset.subtab;
                
                // Update active tab
                document.querySelectorAll('[data-subtab]').forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                
                // Show corresponding content
                document.querySelectorAll('#tab-pengaturan .tab-content').forEach(content => {
                    if (content.id === `subtab-${subtab}`) {
                        content.classList.add('active');
                    } else {
                        content.classList.remove('active');
                    }
                });
            });
        });
    </script>
</body>
</html>
