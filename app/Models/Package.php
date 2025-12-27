<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class Package extends Model
{
    use HasFactory;

    /**
     * Relasi ke tabel favorites
     */
    public function favorites()
    {
        return $this->hasMany(\App\Models\Favorite::class);
    }
    use HasFactory;


    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'excerpt',
        'description',
        'duration',
        'price',
        'cover_image',
        'featured',
        'is_active',
        'itinerary',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'is_active' => 'boolean',
        'itinerary' => 'array',
    ];

    protected $appends = ['cover_image_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    
    public function getCoverImageUrlAttribute()
    {
        $path = $this->cover_image;
        if (!$path) return null;

        if (preg_match('#^https?://#i', $path)) return $path;
    
        if (str_starts_with($path, '/storage/')) {
            $path = substr($path, strlen('/storage/'));
        }
        
        if (str_starts_with($path, 'storage/')) {
            $path = substr($path, strlen('storage/'));
        }
        if (Storage::disk('public')->exists($path)) {
            return '/storage/' . ltrim($path, '/');
        }
        return null;
    }
}
