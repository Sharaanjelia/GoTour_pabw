<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PhotoRecommendation extends Model
{
    use HasFactory;

    protected $fillable = ['title','image','description','category','tips','is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        $path = $this->image;
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
