<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'phone',
        'city',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];

    public function favorites()
    {
        return $this->hasMany(\App\Models\Favorite::class);
    }

    public function payments()
    {
        return $this->hasMany(\App\Models\Payment::class);
    }

    public function getPoinAttribute()
    {
        return 2450;
    }

    public function getTripsCountAttribute()
    {
        return 12;
    }

    public function getPhotoUrlAttribute()
    {
        $default = '/storage/dummy.jpg'; // pastikan file ini ada di public/storage

        if (!$this->photo) {
            return $default;
        }

        $path = $this->photo;
        if (str_starts_with($path, '/storage/')) {
            $fullPath = public_path($path);
        } elseif (str_starts_with($path, 'storage/')) {
            $fullPath = public_path('/' . $path);
            $path = '/' . $path;
        } else {
            $fullPath = public_path('/storage/' . $path);
            $path = '/storage/' . $path;
        }

        if (!file_exists($fullPath)) {
            return $default;
        }

        return $path;
    }
}
