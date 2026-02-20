<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Project;
use Illuminate\Support\Facades\Storage;

$project = Project::find(4);

$allImages = [];
if ($project->image) {
    $allImages[] = $project->image;
}
if ($project->gallery && is_array($project->gallery)) {
    $allImages = array_merge($allImages, $project->gallery);
}

echo "=== BLADE RENDERING TEST ===\n";
echo "Total images: " . count($allImages) . "\n\n";

foreach ($allImages as $index => $image) {
    echo "Image " . ($index + 1) . ":\n";
    echo "  Path: " . $image . "\n";
    echo "  URL: " . Storage::url($image) . "\n";
    echo "  Exists: " . (Storage::disk('public')->exists($image) ? "YES" : "NO") . "\n\n";
}
