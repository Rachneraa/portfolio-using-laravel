<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Fix Hero photo paths
        DB::table('heroes')->whereNotNull('photo')->orderBy('id')->chunk(100, function ($heroes) {
            foreach ($heroes as $hero) {
                $newPath = $this->fixPath($hero->photo);
                DB::table('heroes')->where('id', $hero->id)->update(['photo' => $newPath]);
            }
        });

        // Fix Hero CV paths
        DB::table('heroes')->whereNotNull('cv_file')->orderBy('id')->chunk(100, function ($heroes) {
            foreach ($heroes as $hero) {
                $newPath = $this->fixPath($hero->cv_file);
                DB::table('heroes')->where('id', $hero->id)->update(['cv_file' => $newPath]);
            }
        });

        // Fix About image paths
        DB::table('abouts')->whereNotNull('image')->orderBy('id')->chunk(100, function ($abouts) {
            foreach ($abouts as $about) {
                $newPath = $this->fixPath($about->image);
                DB::table('abouts')->where('id', $about->id)->update(['image' => $newPath]);
            }
        });

        // Fix About gallery paths
        foreach (['gallery_image_1', 'gallery_image_2', 'gallery_image_3', 'gallery_image_4'] as $column) {
            DB::table('abouts')->whereNotNull($column)->orderBy('id')->chunk(100, function ($abouts) use ($column) {
                foreach ($abouts as $about) {
                    $newPath = $this->fixPath($about->$column);
                    DB::table('abouts')->where('id', $about->id)->update([$column => $newPath]);
                }
            });
        }

        // Fix Experience image paths
        DB::table('experiences')->whereNotNull('image')->orderBy('id')->chunk(100, function ($experiences) {
            foreach ($experiences as $exp) {
                $newPath = $this->fixPath($exp->image);
                DB::table('experiences')->where('id', $exp->id)->update(['image' => $newPath]);
            }
        });

        // Fix Skill icon paths
        DB::table('skills')->whereNotNull('icon')->orderBy('id')->chunk(100, function ($skills) {
            foreach ($skills as $skill) {
                $newPath = $this->fixPath($skill->icon);
                DB::table('skills')->where('id', $skill->id)->update(['icon' => $newPath]);
            }
        });

        // Fix Project image paths
        DB::table('projects')->whereNotNull('image')->orderBy('id')->chunk(100, function ($projects) {
            foreach ($projects as $project) {
                $newPath = $this->fixPath($project->image);
                DB::table('projects')->where('id', $project->id)->update(['image' => $newPath]);
            }
        });

        // Fix Project gallery paths
        DB::table('projects')->whereNotNull('gallery')->orderBy('id')->chunk(100, function ($projects) {
            foreach ($projects as $project) {
                $newPath = $this->fixPath($project->gallery);
                DB::table('projects')->where('id', $project->id)->update(['gallery' => $newPath]);
            }
        });
    }

    private function fixPath($path)
    {
        if (empty($path)) {
            return $path;
        }

        // Jika path sudah tidak absolute (tidak dimulai dengan heroes/, cv/, etc)
        // dan sebelumnya mengandung full URL, extract path-nya saja
        if (strpos($path, 'http') === 0) {
            // Full URL - extract path saja
            $urlParts = parse_url($path);
            $path = ltrim($urlParts['path'], '/public/');
        }

        // Pastikan path relatif terhadap storage/app/public
        // Contoh: heroes/001KF... atau cv/001KF...
        if (strpos($path, '/') === 0) {
            $path = ltrim($path, '/');
        }

        return $path;
    }

    public function down(): void
    {
        // Rollback tidak melakukan apa-apa
    }
};
