
<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf
        <div class="mb-2">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" type="email" required autofocus autocomplete="username" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" />
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-2">
            <label for="password" class="form-label">Password</label>
            <input id="password" name="password" type="password" required autocomplete="current-password" class="form-control @error('password') is-invalid @enderror" />
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="d-flex justify-content-between align-items-center mb-2 w-100">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                <label class="form-check-label small" for="remember_me">Ingat saya</label>
            </div>
            @if (Route::has('password.request'))
                <a class="small text-decoration-none" style="color:#2563eb" href="{{ route('password.request') }}">Lupa password?</a>
            @endif
        </div>
        <button type="submit" class="auth-btn">Masuk</button>
        <a href="{{ route('register') }}" class="auth-link">Belum punya akun? <span style="color:#2563eb">Daftar</span></a>
    </form>
</x-guest-layout>
