<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Project;
use Illuminate\Support\Facades\Storage;

$project = Project::find(4);

echo "=== DEBUG INFO ===\n";
echo "Image in DB: " . $project->image . "\n";
echo "Gallery type: " . gettype($project->gallery) . "\n";
echo "Gallery is array: " . (is_array($project->gallery) ? "YES" : "NO") . "\n";
echo "Gallery: " . json_encode($project->gallery) . "\n";
echo "Gallery raw: " . $project->getRawOriginal('gallery') . "\n";
echo "\n=== Generated URLs ===\n";
echo "Storage::url(image): " . Storage::url($project->image) . "\n";
if ($project->gallery) {
    foreach ($project->gallery as $img) {
        echo "Storage::url(gallery): " . Storage::url($img) . "\n";
    }
}
echo "\n=== File Exists Check ===\n";
echo "Image exists: " . (Storage::disk('public')->exists($project->image) ? "YES" : "NO") . "\n";
echo "APP_URL: " . config('app.url') . "\n";
echo "Storage public disk root: " . config('filesystems.disks.public.root') . "\n";
echo "Storage public disk url: " . config('filesystems.disks.public.url') . "\n";
