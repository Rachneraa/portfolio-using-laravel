<?php

namespace App\Providers;

use App\Models\About;
use App\Models\Experience;
use App\Models\Hero;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Skill;
use App\Observers\AboutObserver;
use App\Observers\ExperienceObserver;
use App\Observers\HeroObserver;
use App\Observers\ProjectObserver;
use App\Observers\ProjectImageObserver;
use App\Observers\SkillObserver;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register image optimization observers
        Hero::observe(HeroObserver::class);
        About::observe(AboutObserver::class);
        Skill::observe(SkillObserver::class);
        Project::observe(ProjectObserver::class);
        ProjectImage::observe(ProjectImageObserver::class);
        Experience::observe(ExperienceObserver::class);

        // Force HTTPS when using ngrok or production
        if (
            request()->server('HTTP_X_FORWARDED_PROTO') === 'https' ||
            str_contains(request()->getHost(), 'ngrok')
        ) {
            URL::forceScheme('https');
        }
    }
}
