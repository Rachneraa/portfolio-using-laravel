<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AboutItem extends Model
{
    protected $fillable = [
        'about_id',
        'title',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function about(): BelongsTo
    {
        return $this->belongsTo(About::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
