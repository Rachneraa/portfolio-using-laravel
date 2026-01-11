<?php

namespace App\Observers;

use App\Models\Project;
use App\Services\ImageOptimizer;

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
}
