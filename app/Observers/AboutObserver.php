<?php

namespace App\Observers;

use App\Models\About;
use App\Services\ImageOptimizer;

class AboutObserver
{
    public function saving(About $about): void
    {
        $dimensions = ImageOptimizer::getDimensions('gallery');

        // Optimize gallery images if they were changed
        $galleryFields = ['gallery_image_1', 'gallery_image_2', 'gallery_image_3', 'gallery_image_4', 'image'];

        foreach ($galleryFields as $field) {
            if ($about->isDirty($field) && $about->$field) {
                $about->$field = ImageOptimizer::optimize(
                    $about->$field,
                    $dimensions['width'],
                    $dimensions['height'],
                    80
                );
            }
        }
    }
}
