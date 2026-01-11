<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $table = 'social_media';

    protected $fillable = [
        'name',
        'icon',
        'url',
        'color',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Available social media icons
    public static function getAvailableIcons(): array
    {
        return [
            'instagram' => 'Instagram',
            'facebook' => 'Facebook',
            'twitter' => 'Twitter/X',
            'linkedin' => 'LinkedIn',
            'github' => 'GitHub',
            'youtube' => 'YouTube',
            'tiktok' => 'TikTok',
            'whatsapp' => 'WhatsApp',
            'telegram' => 'Telegram',
            'discord' => 'Discord',
            'dribbble' => 'Dribbble',
            'behance' => 'Behance',
        ];
    }
}
