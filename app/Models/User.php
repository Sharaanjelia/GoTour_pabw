<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'phone',
        'city',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];

    /* =====================
       RELATIONSHIPS
    ===================== */

    public function favorites()
    {
        return $this->hasMany(\App\Models\Favorite::class);
    }

    public function payments()
    {
        return $this->hasMany(\App\Models\Payment::class);
    }

    /* =====================
       ACCESSORS (OPSIONAL)
    ===================== */

    public function getPoinAttribute()
    {
        return 2450;
    }

    public function getTripsCountAttribute()
    {
        return 12;
    }
}
