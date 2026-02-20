<?php

namespace App\Observers;

use App\Models\ProjectImage;
use App\Services\ImageOptimizer;
use Illuminate\Support\Facades\Storage;

class ProjectImageObserver
{
    public function saving(ProjectImage $projectImage): void
    {
        // Optimize image jika diubah
        if ($projectImage->isDirty('image_path') && $projectImage->image_path) {
            $imagePath = $projectImage->image_path;

            // Optimize to WebP
            $optimized = ImageOptimizer::optimize($imagePath, null, null, 80, 'public');

            // Delete original jika berbeda
            if ($optimized !== $imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $projectImage->image_path = $optimized;
        }

        // Get dimensions jika belum ada
        if ($projectImage->isDirty('image_path') || !$projectImage->aspect_ratio) {
            $dimensions = ImageOptimizer::getImageDimensions($projectImage->image_path, 'public');
            if ($dimensions) {
                $projectImage->width = $dimensions['width'];
                $projectImage->height = $dimensions['height'];
                $projectImage->aspect_ratio = $dimensions['aspect_ratio'];
            }
        }
    }
}
