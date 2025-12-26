
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf
        <div class="mb-2">
            <label for="name" class="form-label">Nama</label>
            <input id="name" name="name" type="text" required autofocus autocomplete="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" />
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-2">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" type="email" required autocomplete="username" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" />
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-2">
            <label for="password" class="form-label">Password</label>
            <input id="password" name="password" type="password" required autocomplete="new-password" class="form-control @error('password') is-invalid @enderror" />
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-2">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" class="form-control @error('password_confirmation') is-invalid @enderror" />
            @error('password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="auth-btn">Daftar</button>
        <a href="{{ route('login') }}" class="auth-link">Sudah punya akun? <span style="color:#2563eb">Masuk</span></a>
    </form>
</x-guest-layout>
