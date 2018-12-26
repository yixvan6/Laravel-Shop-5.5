<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'description', 'image', 'on_sale', 'rating', 'sold_count',
        'review_count', 'price',
    ];

    protected $casts = [
        'on_sale' => 'boolean',
    ];

    public function skus()
    {
        return $this->hasMany(ProductSku::class);
    }

    public function getImageUrlAttribute()
    {
        if (starts_with($this->attributes['image'], 'http')) {
            return $this->attributes['image'];
        }

        return \Storage::disk('admin')->url($this->attributes['image']);
    }
}
