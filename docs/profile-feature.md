# 🔐 Profile Feature Documentation

## Overview
Halaman profile user yang sudah terhubung ke database dengan fitur lengkap: edit profile, ubah password, dan hapus akun.

---

## 🗂️ Struktur File

### Controller
**File:** `app/Http/Controllers/UserProfileController.php`

```php
class UserProfileController extends Controller
{
    // Tampilkan halaman profile + data user
    public function index()
    
    // Update data profile (nama, email, phone)
    public function updateProfile(Request $request)
    
    // Ganti password dengan validasi password lama
    public function updatePassword(Request $request)
    
    // Hapus akun user
    public function destroy(Request $request)
}
```

### Routes
**File:** `routes/web.php`

```php
Route::middleware('auth')->group(function () {
    // Halaman profile
    Route::get('/profil', [UserProfileController::class, 'index'])
        ->name('user.profile');
    
    // Update profile
    Route::post('/profil/update', [UserProfileController::class, 'updateProfile'])
        ->name('user.profile.update');
    
    // Update password
    Route::post('/profil/password', [UserProfileController::class, 'updatePassword'])
        ->name('user.password.update');
    
    // Delete account
    Route::delete('/profil/account', [UserProfileController::class, 'destroy'])
        ->name('user.account.destroy');
});
```

### View
**File:** `resources/views/profile/index.blade.php`

---

## ✨ Fitur yang Sudah Berfungsi

### 1️⃣ Tampilan Profile
- ✅ Data user dari database (`$user->name`, `$user->email`)
- ✅ Protected dengan middleware `auth` (hanya user login)
- ✅ Display error dan success messages

### 2️⃣ Edit Profile
**Form:** Update nama, email, phone

**Validasi:**
```php
'name' => ['required', 'string', 'max:255'],
'email' => ['required', 'email', 'unique:users,email,' . $user->id],
'phone' => ['nullable', 'string', 'max:20'],
```

**Flow:**
1. User isi form edit profile
2. Submit ke `POST /profil/update`
3. Validasi data
4. Update ke database: `$user->update($validated)`
5. Redirect dengan success message

### 3️⃣ Ubah Password
**Form:** Password lama, password baru, konfirmasi password

**Validasi:**
```php
'current_password' => ['required', 'current_password'], // Cek password lama
'password' => ['required', 'confirmed', Password::defaults()], // Min 8 char
```

**Flow:**
1. User masukkan password lama
2. Masukkan password baru + konfirmasi
3. Submit ke `POST /profil/password`
4. Laravel validasi password lama otomatis
5. Hash password baru: `Hash::make($validated['password'])`
6. Update database
7. Success message

### 4️⃣ Hapus Akun
**Validasi:** Password confirmation

**Flow:**
1. User klik tombol "Hapus Akun"
2. Konfirmasi dengan password
3. Submit ke `DELETE /profil/account`
4. Logout user
5. Delete user dari database
6. Invalidate session
7. Redirect ke homepage

---

## 🔄 Query Database yang Digunakan

### Ambil Data User
```php
$user = auth()->user();
// Eloquent otomatis ambil data dari tabel users
```

### Update Profile
```php
$user->update([
    'name' => $request->name,
    'email' => $request->email,
    'phone' => $request->phone,
]);
```

### Update Password
```php
$user->update([
    'password' => Hash::make($request->password),
]);
```

### Delete Account
```php
$user->delete();
```

---

## 🛡️ Validasi

### Email Unique Check
```php
'email' => ['required', 'email', 'unique:users,email,' . $user->id]
```
- Cek email unique KECUALI untuk email user itu sendiri

### Current Password Validation
```php
'current_password' => ['required', 'current_password']
```
- Laravel otomatis cek apakah password lama match dengan hash di database

### Password Confirmation
```php
'password' => ['required', 'confirmed', Password::defaults()]
```
- Field `password_confirmation` harus sama dengan `password`
- Password::defaults() = minimal 8 karakter

---

## 💡 Error Handling

### Display Errors
```blade
@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
</div>
@endif
```

### Display Success
```blade
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
```

### Contoh Error Messages
- "The email has already been taken." (email sudah dipakai)
- "The current password is incorrect." (password lama salah)
- "The password confirmation does not match." (konfirmasi tidak sama)

---

## 🧪 Testing

### Test Edit Profile
```bash
# 1. Login sebagai user
# 2. Akses /profil
# 3. Ubah nama/email
# 4. Submit form
# 5. Cek database: SELECT * FROM users WHERE id = ?
```

### Test Ubah Password
```bash
# 1. Login
# 2. Form ubah password
# 3. Masukkan password lama SALAH → Error
# 4. Masukkan password lama BENAR + password baru → Success
# 5. Logout dan login dengan password baru
```

### Test Delete Account
```bash
# 1. Login
# 2. Klik hapus akun
# 3. Masukkan password
# 4. User terhapus dari database + redirect ke homepage
```

---

## 🔐 Security Features

### ✅ Password Hashing
- Gunakan `Hash::make()` untuk hash password
- Laravel otomatis gunakan bcrypt

### ✅ Auth Middleware
- Hanya user login yang bisa akses `/profil`

### ✅ Current Password Check
- Validasi password lama sebelum ganti password
- Validasi password sebelum hapus akun

### ✅ CSRF Protection
- Semua form punya `@csrf` token

### ✅ Session Management
- Session di-invalidate setelah delete account
- Token regenerasi untuk keamanan

---

## 📝 Model: User

**File:** `app/Models/User.php`

```php
class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
```

---

## 🎯 Summary

**Yang Sudah Berfungsi:**
- ✅ Profile page dengan data dari database
- ✅ Edit profile (nama, email, phone)
- ✅ Ubah password dengan validasi
- ✅ Delete account
- ✅ Auth middleware protection
- ✅ Validasi lengkap
- ✅ Error handling
- ✅ Success messages
- ✅ Password hashing
- ✅ CSRF protection

**Cara Akses:**
1. Login: `/login`
2. Profile: `/profil`
3. Edit profile: Form di tab "Profil Saya"
4. Ubah password: Form di bawah edit profile
5. Hapus akun: Tombol merah di bawah

**Database Terhubung:**
- ✅ Read: `auth()->user()` → Data dari DB
- ✅ Update: `$user->update()` → Simpan ke DB
- ✅ Delete: `$user->delete()` → Hapus dari DB
