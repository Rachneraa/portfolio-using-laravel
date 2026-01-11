<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class About extends Model
{
    protected $fillable = [
        'description',
        'image',
        'gallery_image_1',
        'gallery_image_2',
        'gallery_image_3',
        'gallery_image_4',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(AboutItem::class)->orderBy('order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
