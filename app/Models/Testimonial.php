<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','message','photo','approved','user_id','payment_id','rating'];
    public function payment()
    {
        return $this->belongsTo(\App\Models\Payment::class, 'payment_id');
    }

    protected $casts = [
        'approved' => 'boolean',
    ];

    public function getPhotoUrlAttribute()
    {
        $default = '/images/default-user.png'; // pastikan file ini ada di public/images

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

        // Jika file tidak ada, pakai default
        if (!file_exists($fullPath)) {
            return $default;
        }

        return $path;
    }
}
