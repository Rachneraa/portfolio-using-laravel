<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectImage extends Model
{
    protected $fillable = [
        'project_id',
        'image_path',
        'aspect_ratio',
        'width',
        'height',
        'order',
    ];

    protected $casts = [
        'width' => 'integer',
        'height' => 'integer',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get aspect ratio as string (e.g., "16:9", "9:16", "1:1")
     */
    public function getAspectRatioStringAttribute(): string
    {
        if (!$this->aspect_ratio) {
            return 'auto';
        }

        $ratio = explode(':', $this->aspect_ratio);
        return implode(':', $ratio);
    }

    /**
     * Get aspect ratio percentage for CSS padding-bottom trick
     */
    public function getAspectRatioPercentAttribute(): float
    {
        if (!$this->aspect_ratio) {
            return 100;
        }

        [$width, $height] = explode(':', $this->aspect_ratio);
        return (float) $height / (float) $width * 100;
    }
}
