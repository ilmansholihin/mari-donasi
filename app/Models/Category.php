<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'icon',
    ];
    public static function boot()
    {
        parent::boot();

        // Event "creating" untuk membuat slug unik
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = self::generateUniqueSlug($category->name);
            }
        });
    }

    // Fungsi untuk membuat slug unik
    public static function generateUniqueSlug($name)
    {
        $slug = Str::slug($name); // Buat slug awal
        $originalSlug = $slug;
        $count = 1;

        // Cek apakah slug sudah ada di database (termasuk yang soft deleted)
        while (self::withTrashed()->where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }

}
