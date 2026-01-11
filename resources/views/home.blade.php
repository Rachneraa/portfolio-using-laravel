<x-layouts.app :title="'Home'" :socialMedia="$socialMedia">
    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex items-center bg-gradient-to-b from-pink-100 to-pink-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="order-2 md:order-1">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-800 mb-4" data-aos="fade-up">
                        Hi I'm <span class="text-pink-500">{{ $hero->name ?? 'Fadilla Tasya Wanda' }}</span>
                    </h1>
                    <p class="text-gray-600 text-lg mb-8" data-aos="fade-up" data-aos-delay="100">
                        {{ $hero->description ?? 'I am a UI designer and also a front-end developer. I am very interested in creating a design & a website that has an attractive appearance' }}
                    </p>
                    <div class="flex gap-4" data-aos="fade-up" data-aos-delay="200">
                        @if($hero && $hero->cv_file)
                            <a href="{{ route('download.cv') }}"
                                class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-full font-medium transition flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Download CV
                            </a>
                        @endif
                        <a href="#contact"
                            class="border-2 border-gray-800 hover:bg-gray-800 hover:text-white text-gray-800 px-6 py-3 rounded-full font-medium transition">
                            Contact
                        </a>
                    </div>

                    <!-- Social Media Links -->
                    @if($socialMedia && $socialMedia->count() > 0)
                        <div class="flex gap-4 mt-6" data-aos="fade-up" data-aos-delay="300">
                            @foreach($socialMedia as $social)
                                <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer"
                                    class="w-10 h-10 rounded-full flex items-center justify-center transition hover:scale-110 shadow-md"
                                    style="background-color: {{ $social->color }}20; color: {{ $social->color }};">
                                    @include('components.social-icons.' . $social->icon)
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Right Content - Photo -->
                <div class="flex justify-center order-1 md:order-2" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative">
                        <div class="w-64 h-64 md:w-80 md:h-80 rounded-2xl bg-pink-300 overflow-hidden shadow-xl">
                            @if($hero && $hero->photo)
                                <img src="{{ asset('storage/' . $hero->photo) }}" alt="{{ $hero->name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-pink-200">
                                    <svg class="w-32 h-32 text-pink-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="absolute -bottom-4 -right-4 bg-white rounded-xl p-4 shadow-lg">
                            <p class="font-semibold text-gray-800">{{ $hero->name ?? 'Fadilla Tasya Wanda' }}</p>
                            <p class="text-sm text-pink-500">{{ $hero->title ?? 'UI Designer' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-pink-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-start">
                <!-- Left - Description -->
                <div class="bg-white rounded-2xl p-8 shadow-lg" data-aos="fade-up">
                    <div class="prose prose-pink max-w-none">
                        {!! $about->description ?? '<p>I\'m a passionate creative professional with a deep love for elegant design and meaningful storytelling. With over 6 years of experience in brand design and strategy, I\'ve helped numerous clients bring their visions to life through thoughtful, beautiful design solutions.</p><p>My approach combines strategic thinking with artistic sensibility, creating designs that are not only visually stunning but also purposeful and effective. I believe that great design should feel effortless while making a lasting impact.</p>' !!}
                    </div>

                    <div class="mt-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">What I Bring</h3>
                        <ul class="space-y-2">
                            @if($about && $about->items->count() > 0)
                                @foreach($about->items->where('is_active', true) as $item)
                                    <li class="flex items-center gap-2 text-gray-600">
                                        <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                        {{ $item->title }}
                                    </li>
                                @endforeach
                            @else
                                <li class="flex items-center gap-2 text-gray-600">
                                    <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    Brand identity design & strategy
                                </li>
                                <li class="flex items-center gap-2 text-gray-600">
                                    <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    Visual storytelling & creative direction
                                </li>
                                <li class="flex items-center gap-2 text-gray-600">
                                    <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    UI/UX design with attention to detail
                                </li>
                                <li class="flex items-center gap-2 text-gray-600">
                                    <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    Typography & color theory expertise
                                </li>
                                <li class="flex items-center gap-2 text-gray-600">
                                    <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    Client collaboration & mentoring
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Right - Image Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-400 rounded-xl h-32 overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                        @if($about && $about->gallery_image_1)
                            <img src="{{ asset('storage/' . $about->gallery_image_1) }}" alt="Gallery 1"
                                class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="bg-gray-400 rounded-xl h-32 overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                        @if($about && $about->gallery_image_2)
                            <img src="{{ asset('storage/' . $about->gallery_image_2) }}" alt="Gallery 2"
                                class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="bg-gray-400 rounded-xl h-32 overflow-hidden" data-aos="fade-up" data-aos-delay="300">
                        @if($about && $about->gallery_image_3)
                            <img src="{{ asset('storage/' . $about->gallery_image_3) }}" alt="Gallery 3"
                                class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="bg-gray-400 rounded-xl h-32 overflow-hidden" data-aos="fade-up" data-aos-delay="400">
                        @if($about && $about->gallery_image_4)
                            <img src="{{ asset('storage/' . $about->gallery_image_4) }}" alt="Gallery 4"
                                class="w-full h-full object-cover">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-20 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-4" data-aos="fade-up">My Skill</h2>
            <p class="text-center text-gray-500 mb-12" data-aos="fade-up" data-aos-delay="100">A blend of technical and creative skills for digital and visual work.</p>

            <!-- Marquee Row 1 - Scroll Right -->
            <div class="marquee-wrapper mb-6 overflow-hidden" data-marquee="right">
                <div class="marquee-track flex whitespace-nowrap">
                    @foreach($skillsRow1 as $skill)
                        @php
                            $hex = ltrim($skill->color ?? '#ec4899', '#');
                            $r = hexdec(substr($hex, 0, 2));
                            $g = hexdec(substr($hex, 2, 2));
                            $b = hexdec(substr($hex, 4, 2));
                            $bgColor = "rgba($r, $g, $b, 0.35)";
                        @endphp
                        <div class="inline-flex items-center gap-3 rounded-full px-6 py-3 mx-3 shadow-sm whitespace-nowrap"
                            style="background-color: {{ $bgColor }}">
                            @if($skill->icon_type === 'emoji' && $skill->emoji)
                                <span class="text-2xl flex-shrink-0">{{ $skill->emoji }}</span>
                            @elseif($skill->icon_type === 'image' && $skill->icon)
                                <img src="{{ asset('storage/' . $skill->icon) }}" alt="{{ $skill->name }}"
                                    class="w-7 h-7 object-contain flex-shrink-0">
                            @else
                                <div class="w-6 h-6 rounded-full flex-shrink-0" style="background-color: {{ $skill->color }}">
                                </div>
                            @endif
                            <span class="font-medium text-gray-700">{{ $skill->name }}</span>
                        </div>
                    @endforeach
                    {{-- Duplicate for seamless loop --}}
                    @foreach($skillsRow1 as $skill)
                        @php
                            $hex = ltrim($skill->color ?? '#ec4899', '#');
                            $r = hexdec(substr($hex, 0, 2));
                            $g = hexdec(substr($hex, 2, 2));
                            $b = hexdec(substr($hex, 4, 2));
                            $bgColor = "rgba($r, $g, $b, 0.35)";
                        @endphp
                        <div class="inline-flex items-center gap-3 rounded-full px-6 py-3 mx-3 shadow-sm whitespace-nowrap"
                            style="background-color: {{ $bgColor }}">
                            @if($skill->icon_type === 'emoji' && $skill->emoji)
                                <span class="text-2xl flex-shrink-0">{{ $skill->emoji }}</span>
                            @elseif($skill->icon_type === 'image' && $skill->icon)
                                <img src="{{ asset('storage/' . $skill->icon) }}" alt="{{ $skill->name }}"
                                    class="w-7 h-7 object-contain flex-shrink-0">
                            @else
                                <div class="w-6 h-6 rounded-full flex-shrink-0" style="background-color: {{ $skill->color }}">
                                </div>
                            @endif
                            <span class="font-medium text-gray-700">{{ $skill->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Marquee Row 2 - Scroll Left -->
            <div class="marquee-wrapper overflow-hidden" data-marquee="left">
                <div class="marquee-track flex whitespace-nowrap">
                    @foreach($skillsRow2 as $skill)
                        @php
                            $hex = ltrim($skill->color ?? '#ec4899', '#');
                            $r = hexdec(substr($hex, 0, 2));
                            $g = hexdec(substr($hex, 2, 2));
                            $b = hexdec(substr($hex, 4, 2));
                            $bgColor = "rgba($r, $g, $b, 0.35)";
                        @endphp
                        <div class="inline-flex items-center gap-3 rounded-full px-6 py-3 mx-3 shadow-sm whitespace-nowrap"
                            style="background-color: {{ $bgColor }}">
                            @if($skill->icon_type === 'emoji' && $skill->emoji)
                                <span class="text-2xl flex-shrink-0">{{ $skill->emoji }}</span>
                            @elseif($skill->icon_type === 'image' && $skill->icon)
                                <img src="{{ asset('storage/' . $skill->icon) }}" alt="{{ $skill->name }}"
                                    class="w-7 h-7 object-contain flex-shrink-0">
                            @else
                                <div class="w-6 h-6 rounded-full flex-shrink-0" style="background-color: {{ $skill->color }}">
                                </div>
                            @endif
                            <span class="font-medium text-gray-700">{{ $skill->name }}</span>
                        </div>
                    @endforeach
                    {{-- Duplicate for seamless loop --}}
                    @foreach($skillsRow2 as $skill)
                        @php
                            $hex = ltrim($skill->color ?? '#ec4899', '#');
                            $r = hexdec(substr($hex, 0, 2));
                            $g = hexdec(substr($hex, 2, 2));
                            $b = hexdec(substr($hex, 4, 2));
                            $bgColor = "rgba($r, $g, $b, 0.35)";
                        @endphp
                        <div class="inline-flex items-center gap-3 rounded-full px-6 py-3 mx-3 shadow-sm whitespace-nowrap"
                            style="background-color: {{ $bgColor }}">
                            @if($skill->icon_type === 'emoji' && $skill->emoji)
                                <span class="text-2xl flex-shrink-0">{{ $skill->emoji }}</span>
                            @elseif($skill->icon_type === 'image' && $skill->icon)
                                <img src="{{ asset('storage/' . $skill->icon) }}" alt="{{ $skill->name }}"
                                    class="w-7 h-7 object-contain flex-shrink-0">
                            @else
                                <div class="w-6 h-6 rounded-full flex-shrink-0" style="background-color: {{ $skill->color }}">
                                </div>
                            @endif
                            <span class="font-medium text-gray-700">{{ $skill->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-20 bg-pink-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-4" data-aos="fade-up">portfolio</h2>
            <p class="text-center text-gray-500 mb-12" data-aos="fade-up" data-aos-delay="100">Browse my portfolio to
                explore a range of software applications
                and projects I've worked on, showcasing my expertise and dedication to creating innovative digital
                solutions.</p>

            <!-- Project Grid - Max 6 on desktop, 2 on mobile -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($projects->take(6) as $index => $project)
                    <div class="project-card bg-white rounded-xl overflow-hidden shadow-lg" data-aos="fade-up"
                        data-aos-delay="{{ ($index % 3) * 100 + 200 }}">
                        <div class="h-48 bg-gray-300 overflow-hidden">
                            @if($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center bg-gradient-to-br from-pink-200 to-pink-300">
                                    <svg class="w-16 h-16 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-pink-500 text-lg mb-2">{{ $project->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $project->description }}</p>
                            <a href="{{ route('projects.show', $project) }}"
                                class="text-pink-500 hover:text-pink-600 text-sm font-medium flex items-center gap-1">
                                Lihat Detail
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    @for($i = 0; $i < 6; $i++)
                        <div class="project-card bg-white rounded-xl overflow-hidden shadow-lg" data-aos="fade-up"
                            data-aos-delay="{{ ($i % 3) * 100 + 200 }}">
                            <div class="h-48 bg-gradient-to-br from-pink-200 to-pink-300 flex items-center justify-center">
                                <svg class="w-16 h-16 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div class="p-6">
                                <h3 class="font-bold text-pink-500 text-lg mb-2">E-Learning App</h3>
                                <p class="text-gray-600 text-sm mb-4">Lorem ipsum dolor sit amet adipiscing elit</p>
                                <a href="#"
                                    class="text-pink-500 hover:text-pink-600 text-sm font-medium flex items-center gap-1">
                                    View Project
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endfor
                @endforelse
            </div>

            <!-- Show more button -->
            <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="400">
                <a href="{{ route('projects') }}"
                    class="inline-flex items-center gap-2 bg-pink-500 hover:bg-pink-600 text-white px-8 py-3 rounded-full font-medium transition">
                    Lihat Lebih Banyak
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Experience Section with TimelineJS -->
    <section id="experience" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12" data-aos="fade-up">experience</h2>

            <div id="timeline-embed" data-aos="fade-up" data-aos-delay="100" style="width: 100%; height: 600px;"></div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-pink-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-4" data-aos="fade-up">Get in Touch</h2>
            <p class="text-center text-gray-500 mb-12" data-aos="fade-up" data-aos-delay="100">Have a project in mind or
                just want to chat? I'd love to hear
                from you.</p>

            <div class="grid md:grid-cols-2 gap-12">
                <!-- Left - Contact Info -->
                <div data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Let's Connect</h3>
                    <p class="text-gray-600 mb-8">I'm always open to discussing new projects, creative ideas, or
                        opportunities to be part of your vision.</p>

                    <div class="space-y-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-pink-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Email</p>
                                <p class="text-gray-600">Fadillatasya5@gmail.com</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-pink-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Phone</p>
                                <p class="text-gray-600">+62 851-5638-8955</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-pink-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Location</p>
                                <p class="text-gray-600">Mampang Prapatan, Jakarta Selatan, DKI Jakarta, Indonesia</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right - Contact Form -->
                <div class="bg-white rounded-2xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="300">
                    <form id="contact-form" class="space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                            <input type="text" id="name" name="name" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                placeholder="Your name">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                placeholder="your.email@example.com">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                            <textarea id="message" name="message" rows="4" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                                placeholder="Tell me about your project..."></textarea>
                            @error('message')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" id="submit-btn"
                            class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-lg font-medium transition flex items-center justify-center gap-2">
                            <span id="btn-text">Send Message</span>
                            <svg id="btn-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            <svg id="btn-loading" class="hidden w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            // Initialize TimelineJS
            document.addEventListener('DOMContentLoaded', function () {
                fetch('{{ route('timeline.data') }}')
                    .then(response => response.json())
                    .then(data => {
                        if (data.events && data.events.length > 0) {
                            new TL.Timeline('timeline-embed', data, {
                                language: 'id',
                                initial_zoom: 2,
                                scale_factor: 2,
                                timenav_height_percentage: 25,
                            });
                        } else {
                            document.getElementById('timeline-embed').innerHTML = `
                                                    <div class="text-center py-20 text-gray-500">
                                                        <p>no experience added yet.</p>
                                                    </div>
                                                `;
                        }
                    })
                    .catch(error => {
                        console.error('Error loading timeline:', error);
                        document.getElementById('timeline-embed').innerHTML = `
                                                <div class="text-center py-20 text-gray-500">
                                                    <p>Gagal memuat timeline.</p>
                                                </div>
                                            `;
                    });
            });
        </script>

        {{-- Draggable Marquee Script --}}
        <script>
            (function () {
                const wrappers = document.querySelectorAll('.marquee-wrapper');
                let activeWrapper = null; // Track which wrapper is being dragged

                wrappers.forEach(wrapper => {
                    const track = wrapper.querySelector('.marquee-track');
                    if (!track) return;

                    const direction = wrapper.dataset.marquee; // 'left' or 'right'
                    const speed = 1; // pixels per frame
                    let position = direction === 'right' ? -track.scrollWidth / 2 : 0;
                    let isPaused = false;
                    let startX = 0;
                    let dragStartPos = 0;
                    let resumeTimeout = null;
                    const RESUME_DELAY = 2000;

                    // Store state on wrapper element
                    wrapper._marqueeState = {
                        getPosition: () => position,
                        setPosition: (p) => { position = p; },
                        track,
                        direction,
                        setPaused: (p) => { isPaused = p; },
                        isPaused: () => isPaused,
                        startX: () => startX,
                        setStartX: (x) => { startX = x; },
                        dragStartPos: () => dragStartPos,
                        setDragStartPos: (p) => { dragStartPos = p; },
                        resumeTimeout: () => resumeTimeout,
                        setResumeTimeout: (t) => { resumeTimeout = t; },
                        clearResumeTimeout: () => { clearTimeout(resumeTimeout); }
                    };

                    // Set initial position
                    track.style.transform = `translateX(${position}px)`;

                    // Animation loop
                    const animate = () => {
                        if (!isPaused) {
                            if (direction === 'right') {
                                position += speed;
                                if (position >= 0) {
                                    position = -track.scrollWidth / 2;
                                }
                            } else {
                                position -= speed;
                                if (position <= -track.scrollWidth / 2) {
                                    position = 0;
                                }
                            }
                            track.style.transform = `translateX(${position}px)`;
                        }
                        requestAnimationFrame(animate);
                    };

                    // Start animation
                    animate();

                    // Mouse down on wrapper
                    wrapper.addEventListener('mousedown', (e) => {
                        activeWrapper = wrapper;
                        isPaused = true;
                        startX = e.clientX;
                        dragStartPos = position;
                        wrapper.style.cursor = 'grabbing';
                        clearTimeout(resumeTimeout);
                        e.preventDefault();
                    });

                    // Touch start
                    wrapper.addEventListener('touchstart', (e) => {
                        activeWrapper = wrapper;
                        isPaused = true;
                        startX = e.touches[0].clientX;
                        dragStartPos = position;
                        clearTimeout(resumeTimeout);
                    }, { passive: true });

                    // Prevent image drag
                    wrapper.querySelectorAll('img').forEach(img => {
                        img.addEventListener('dragstart', (e) => e.preventDefault());
                    });
                });

                // Global mouse move
                document.addEventListener('mousemove', (e) => {
                    if (!activeWrapper) return;
                    const state = activeWrapper._marqueeState;
                    const diff = e.clientX - state.startX();
                    const newPos = state.dragStartPos() + diff;
                    state.setPosition(newPos);
                    state.track.style.transform = `translateX(${newPos}px)`;
                });

                // Global mouse up
                document.addEventListener('mouseup', () => {
                    if (!activeWrapper) return;
                    const state = activeWrapper._marqueeState;
                    activeWrapper.style.cursor = 'grab';

                    // Normalize position
                    let pos = state.getPosition();
                    const halfWidth = state.track.scrollWidth / 2;
                    while (pos > 0) pos -= halfWidth;
                    while (pos < -halfWidth) pos += halfWidth;
                    state.setPosition(pos);

                    // Schedule resume
                    state.clearResumeTimeout();
                    const timeout = setTimeout(() => {
                        state.setPaused(false);
                    }, 2000);
                    state.setResumeTimeout(timeout);

                    activeWrapper = null;
                });

                // Global touch move
                document.addEventListener('touchmove', (e) => {
                    if (!activeWrapper) return;
                    const state = activeWrapper._marqueeState;
                    const diff = e.touches[0].clientX - state.startX();
                    const newPos = state.dragStartPos() + diff;
                    state.setPosition(newPos);
                    state.track.style.transform = `translateX(${newPos}px)`;
                }, { passive: true });

                // Global touch end
                document.addEventListener('touchend', () => {
                    if (!activeWrapper) return;
                    const state = activeWrapper._marqueeState;

                    // Normalize position
                    let pos = state.getPosition();
                    const halfWidth = state.track.scrollWidth / 2;
                    while (pos > 0) pos -= halfWidth;
                    while (pos < -halfWidth) pos += halfWidth;
                    state.setPosition(pos);

                    // Schedule resume
                    state.clearResumeTimeout();
                    const timeout = setTimeout(() => {
                        state.setPaused(false);
                    }, 2000);
                    state.setResumeTimeout(timeout);

                    activeWrapper = null;
                });
            })();

            // Contact Form AJAX with SweetAlert2
            const contactForm = document.getElementById('contact-form');
            if (contactForm) {
                contactForm.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    
                    const submitBtn = document.getElementById('submit-btn');
                    const btnText = document.getElementById('btn-text');
                    const btnIcon = document.getElementById('btn-icon');
                    const btnLoading = document.getElementById('btn-loading');
                    
                    // Show loading state
                    submitBtn.disabled = true;
                    btnText.textContent = 'Sending...';
                    btnIcon.classList.add('hidden');
                    btnLoading.classList.remove('hidden');
                    
                    const formData = new FormData(contactForm);
                    
                    try {
                        const response = await fetch('{{ route("contact.store") }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                            }
                        });
                        
                        const data = await response.json();
                        
                        if (response.ok && data.success) {
                            // Success
                            Swal.fire({
                                icon: 'success',
                                title: 'Pesan Terkirim! 🎉',
                                text: data.message || 'Terima kasih telah menghubungi kami. Kami akan segera membalas pesan Anda.',
                                confirmButtonColor: '#ec4899',
                                confirmButtonText: 'OK'
                            });
                            contactForm.reset();
                        } else {
                            // Validation error or other error
                            let errorMessage = data.message || 'Terjadi kesalahan. Silakan coba lagi.';
                            if (data.errors) {
                                errorMessage = Object.values(data.errors).flat().join('\n');
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops!',
                                text: errorMessage,
                                confirmButtonColor: '#ec4899'
                            });
                        }
                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan koneksi. Silakan coba lagi.',
                            confirmButtonColor: '#ec4899'
                        });
                    } finally {
                        // Reset button state
                        submitBtn.disabled = false;
                        btnText.textContent = 'Send Message';
                        btnIcon.classList.remove('hidden');
                        btnLoading.classList.add('hidden');
                    }
                });
            }
        </script>
    @endpush
</x-layouts.app>