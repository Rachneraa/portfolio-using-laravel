<?php

namespace App\Observers;

use App\Models\Experience;
use App\Services\ImageOptimizer;

class ExperienceObserver
{
    public function saving(Experience $experience): void
    {
        // Optimize image if it was changed
        if ($experience->isDirty('image') && $experience->image) {
            $experience->image = ImageOptimizer::optimize(
                $experience->image,
                800,
                600,
                80
            );
        }
    }
}
