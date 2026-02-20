<?php

namespace App\Observers;

use App\Models\Project;
use App\Models\ProjectImage;
use App\Services\ImageOptimizer;
use Illuminate\Support\Facades\Storage;

class ProjectObserver
{
    public function saving(Project $project): void
    {
        $dimensions = ImageOptimizer::getDimensions('project');

        // Optimize image if it was changed
        if ($project->isDirty('image') && $project->image) {
            $project->image = ImageOptimizer::optimize(
                $project->image,
                $dimensions['width'],
                $dimensions['height'],
                80
            );
        }
    }

    public function deleting(Project $project): void
    {
        // Delete all associated ProjectImages and their files
        foreach ($project->images as $image) {
            if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            $image->delete();
        }
    }
}

