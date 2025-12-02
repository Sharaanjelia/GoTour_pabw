<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class Package extends Model
{
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
    ];

    protected $casts = [
        'featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected $appends = ['cover_image_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // use slug for route model binding
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // return full URL to cover image stored on public disk
    public function getCoverImageUrlAttribute()
    {
        $path = $this->cover_image;
        if (!$path) return null;
        // if already a full URL, return it
        if (preg_match('#^https?://#i', $path)) return $path;
        // remove leading slash if someone stored '/storage/...'
        if (str_starts_with($path, '/storage/')) {
            $path = substr($path, strlen('/storage/'));
        }
        // if someone stored 'storage/...' normalize to 'packages/..'
        if (str_starts_with($path, 'storage/')) {
            $path = substr($path, strlen('storage/'));
        }
        if (Storage::disk('public')->exists($path)) {
            // Return a relative URL for local public disk so it works regardless
            // of APP_URL / hostname / port (useful in dev served via different host)
            return '/storage/' . ltrim($path, '/');
        }
        return null;
    }
}
