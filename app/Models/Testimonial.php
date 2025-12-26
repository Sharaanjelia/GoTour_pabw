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
        if (!$this->photo) {
            return null;
        }
        
        if (str_starts_with($this->photo, '/storage/')) {
            return $this->photo;
        }
        
        if (str_starts_with($this->photo, 'storage/')) {
            return '/' . $this->photo;
        }
        
        return '/storage/' . $this->photo;
    }
}
