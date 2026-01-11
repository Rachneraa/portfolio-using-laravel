<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'title',
        'company',
        'description',
        'image',
        'start_date',
        'end_date',
        'location',
        'order',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Format for TimelineJS
    public function toTimelineEvent(): array
    {
        return [
            'start_date' => [
                'year' => $this->start_date->format('Y'),
                'month' => $this->start_date->format('n'),
                'day' => $this->start_date->format('j'),
            ],
            'end_date' => $this->end_date ? [
                'year' => $this->end_date->format('Y'),
                'month' => $this->end_date->format('n'),
                'day' => $this->end_date->format('j'),
            ] : null,
            'text' => [
                'headline' => $this->title,
                'text' => '<p>' . $this->description . '</p>' .
                    ($this->company ? '<p><strong>' . $this->company . '</strong></p>' : '') .
                    ($this->location ? '<p><em>' . $this->location . '</em></p>' : ''),
            ],
            'media' => $this->image ? [
                'url' => asset('storage/' . $this->image),
                'caption' => $this->title,
            ] : null,
        ];
    }
}
