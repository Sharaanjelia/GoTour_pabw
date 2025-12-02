<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','description','icon','image','is_active'];

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }
        
        // If path already starts with /storage/, return as is
        if (str_starts_with($this->image, '/storage/')) {
            return $this->image;
        }
        
        // If path starts with storage/, add leading slash
        if (str_starts_with($this->image, 'storage/')) {
            return '/' . $this->image;
        }
        
        // Otherwise, prepend /storage/
        return '/storage/' . $this->image;
    }
}
