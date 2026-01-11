<?php

namespace App\Observers;

use App\Models\Skill;
use App\Services\ImageOptimizer;

class SkillObserver
{
    public function saving(Skill $skill): void
    {
        $dimensions = ImageOptimizer::getDimensions('skill');

        // Optimize icon if it was changed (skip SVG)
        if ($skill->isDirty('icon') && $skill->icon) {
            $extension = strtolower(pathinfo($skill->icon, PATHINFO_EXTENSION));

            // Only optimize non-SVG files
            if ($extension !== 'svg') {
                $skill->icon = ImageOptimizer::optimize(
                    $skill->icon,
                    $dimensions['width'],
                    $dimensions['height'],
                    80
                );
            }
        }
    }
}
