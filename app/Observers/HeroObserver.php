<?php

namespace App\Observers;

use App\Models\Hero;
use App\Services\ImageOptimizer;

class HeroObserver
{
    public function saving(Hero $hero): void
    {
        $dimensions = ImageOptimizer::getDimensions('hero');

        // Optimize photo if it was changed
        if ($hero->isDirty('photo') && $hero->photo) {
            $hero->photo = ImageOptimizer::optimize(
                $hero->photo,
                $dimensions['width'],
                $dimensions['height'],
                80
            );
        }
    }
}
