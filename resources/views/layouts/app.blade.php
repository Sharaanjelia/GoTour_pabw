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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- global public navbar styles (keeps public header looking correct) --}}
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        {{-- footer styles for public pages (keeps footer consistent) --}}
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

        {{-- allow pages to push extra styles (home.css, packages.css etc.) --}}
        @stack('styles')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            {{-- use the public navbar partial so the site header matches the design (keeps admin layout untouched) --}}
            @include('partials.navbar')

            <!-- Page Heading -->
            @if(isset($header) || View::hasSection('header'))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{-- Support component-style header (Breeze) or traditional section('header') --}}
                        @isset($header)
                            {{ $header }}
                        @else
                            @yield('header')
                        @endisset
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{-- Support component-style slot (Breeze) or traditional yield('content') --}}
                @isset($slot)
                    {{ $slot }}
                @else
                    @yield('content')
                @endisset
            </main>

            {{-- public footer --}}
            @include('partials.footer')
        </div>
        {{-- allow pages to push inline scripts when needed --}}
        @stack('scripts')
    </body>
</html>
