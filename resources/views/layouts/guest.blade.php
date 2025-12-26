<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/auth-custom.css') }}" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Bootstrap 5 JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body class="auth-bg">
        <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100 px-2">
            <div class="card shadow rounded-4 p-4 w-100" style="max-width:370px;min-width:0;">
                <div class="d-flex flex-column align-items-center mb-3">
                    <img src='{{ asset('images/GoTourLogo.png') }}' alt="GoTour" class="mb-2" style="width:48px;height:48px;border-radius:8px;object-fit:cover;" />
                    <h1 class="fw-bold mb-1 text-center" style="color:#1566b1;font-size:1.7rem;">GoTour</h1>
                    <div class="text-secondary small mb-2 text-center">Jelajahi Indonesia Bersamamu</div>
                </div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
