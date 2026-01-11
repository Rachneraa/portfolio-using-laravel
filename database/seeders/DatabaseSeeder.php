<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\AboutItem;
use App\Models\Experience;
use App\Models\Hero;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SocialMedia;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);

        // Create Hero
        Hero::create([
            'name' => 'Fadilla Tasya Wanda',
            'title' => 'UI Designer',
            'description' => 'I am a UI designer and also a front-end developer. I am very interested in creating a design & a website that has an attractive appearance',
            'is_active' => true,
        ]);

        // Create About
        $about = About::create([
            'description' => '<p>I\'m a passionate creative professional with a deep love for elegant design and meaningful storytelling. With over 6 years of experience in brand design and strategy, I\'ve helped numerous clients bring their visions to life through thoughtful, beautiful design solutions.</p><p>My approach combines strategic thinking with artistic sensibility, creating designs that are not only visually stunning but also purposeful and effective. I believe that great design should feel effortless while making a lasting impact.</p>',
            'is_active' => true,
        ]);

        // Create About Items
        $aboutItems = [
            'Brand identity design & strategy',
            'Visual storytelling & creative direction',
            'UI/UX design with attention to detail',
            'Typography & color theory expertise',
            'Client collaboration & mentoring',
        ];

        foreach ($aboutItems as $index => $item) {
            AboutItem::create([
                'about_id' => $about->id,
                'title' => $item,
                'order' => $index,
                'is_active' => true,
            ]);
        }

        // Create Skills - Row 1 (Scroll Right)
        $skillsRow1 = [
            ['name' => 'JavaScript', 'color' => '#F7DF1E'],
            ['name' => 'React JS', 'color' => '#61DAFB'],
            ['name' => 'Material UI', 'color' => '#0081CB'],
            ['name' => 'Laravel PHP', 'color' => '#FF2D20'],
            ['name' => 'Node JS', 'color' => '#339933'],
            ['name' => 'Framer', 'color' => '#0055FF'],
            ['name' => 'Adobe Illustrator', 'color' => '#FF9A00'],
            ['name' => 'Wordpress Elementor', 'color' => '#21759B'],
        ];

        foreach ($skillsRow1 as $index => $skill) {
            Skill::create([
                'name' => $skill['name'],
                'color' => $skill['color'],
                'row' => 1,
                'order' => $index,
                'is_active' => true,
            ]);
        }

        // Create Skills - Row 2 (Scroll Left)
        $skillsRow2 = [
            ['name' => 'Figma', 'color' => '#F24E1E'],
            ['name' => 'React', 'color' => '#61DAFB'],
            ['name' => 'Flutter', 'color' => '#02569B'],
            ['name' => 'HTML', 'color' => '#E34F26'],
            ['name' => 'Vue', 'color' => '#4FC08D'],
            ['name' => 'Kotlin Android Studio', 'color' => '#7F52FF'],
            ['name' => 'C++', 'color' => '#00599C'],
            ['name' => 'Typescript', 'color' => '#3178C6'],
        ];

        foreach ($skillsRow2 as $index => $skill) {
            Skill::create([
                'name' => $skill['name'],
                'color' => $skill['color'],
                'row' => 2,
                'order' => $index,
                'is_active' => true,
            ]);
        }

        // Create Projects
        for ($i = 1; $i <= 6; $i++) {
            Project::create([
                'title' => 'E-Learning App',
                'description' => 'Lorem ipsum dolor sit amet adipiscing elit',
                'category' => 'Web App',
                'is_featured' => true,
                'order' => $i,
                'is_active' => true,
            ]);
        }

        // Create Experiences
        Experience::create([
            'title' => 'Pengalaman PKL blalala',
            'company' => 'PKL di PT wleee',
            'description' => 'Saya pkl di wleee selama wleee, saya disana wleeee',
            'start_date' => '2022-01-01',
            'end_date' => '2022-06-30',
            'location' => 'Indonesia',
            'order' => 1,
            'is_active' => true,
        ]);

        // Create Social Media
        $socialMedias = [
            ['name' => 'Instagram', 'icon' => 'instagram', 'url' => 'https://instagram.com', 'color' => '#E4405F'],
            ['name' => 'LinkedIn', 'icon' => 'linkedin', 'url' => 'https://linkedin.com', 'color' => '#0A66C2'],
            ['name' => 'GitHub', 'icon' => 'github', 'url' => 'https://github.com', 'color' => '#181717'],
            ['name' => 'Twitter', 'icon' => 'twitter', 'url' => 'https://twitter.com', 'color' => '#1DA1F2'],
        ];

        foreach ($socialMedias as $index => $social) {
            SocialMedia::create([
                'name' => $social['name'],
                'icon' => $social['icon'],
                'url' => $social['url'],
                'color' => $social['color'],
                'order' => $index,
                'is_active' => true,
            ]);
        }
    }
}

