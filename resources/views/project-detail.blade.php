<x-layouts.app :title="$project->title" :socialMedia="$socialMedia">
    <section class="min-h-screen bg-gradient-to-b from-[#F2E7DD] to-[#F2D6CE] py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-8" data-aos="fade-up">
                <a href="{{ route('projects') }}"
                    class="inline-flex items-center gap-2 text-[#292421]/70 hover:text-[#A75F37] transition group">
                    <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                    <span class="font-medium">Kembali ke Project</span>
                </a>
            </div>

            <div class="grid lg:grid-cols-2 gap-12 items-start">
                <!-- Left - Content -->
                <div class="order-2 lg:order-1" data-aos="fade-up" data-aos-delay="100">
                    <!-- Category Badge -->
                    @if($project->category)
                        <span
                            class="inline-block bg-[#BAE0DA] text-[#7A958F] px-4 py-1 rounded-full text-sm font-medium mb-4">
                            {{ $project->category }}
                        </span>
                    @endif

                    <!-- Title -->
                    <h1 class="text-4xl md:text-5xl font-bold text-[#292421] mb-6">
                        {{ $project->title }}
                    </h1>

                    <!-- Tags -->
                    @if($project->tags && count($project->tags) > 0)
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach($project->tags as $tag)
                                <span
                                    class="bg-white/80 backdrop-blur-sm text-[#292421] px-4 py-2 rounded-full text-sm font-medium shadow-sm border border-[#D9B99F]">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <!-- Description -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg mb-8">
                        <h3 class="text-lg font-semibold text-[#292421] mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#A75F37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Deskripsi
                        </h3>
                        <p class="text-[#292421]/70 leading-relaxed whitespace-pre-line">{{ $project->description }}</p>
                    </div>

                    <!-- Links -->
                    <div class="flex flex-wrap gap-4">
                        @if($project->link)
                            <a href="{{ $project->link }}" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center gap-2 bg-[#A75F37] hover:bg-[#8B4F2E] text-white px-6 py-3 rounded-full font-medium transition shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                    </path>
                                </svg>
                                Live Preview
                            </a>
                        @endif

                        @if($project->github_link)
                            <a href="{{ $project->github_link }}" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center gap-2 bg-[#292421] hover:bg-[#1a1816] text-white px-6 py-3 rounded-full font-medium transition shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                </svg>
                                GitHub
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Right - Image Carousel -->
                <div class="order-1 lg:order-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="sticky top-24">
                        <!-- Main Image Carousel -->
                        <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden" id="carousel-container">
                            @php
                                $allImages = [];
                                if ($project->image) {
                                    $allImages[] = $project->image;
                                }
                                if ($project->gallery && is_array($project->gallery)) {
                                    $allImages = array_merge($allImages, $project->gallery);
                                }
                            @endphp

                            @if(count($allImages) > 0)
                                <div class="relative aspect-[4/3]">
                                    @foreach($allImages as $index => $image)
                                        <div class="carousel-slide absolute inset-0 transition-opacity duration-500 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
                                            data-index="{{ $index }}">
                                            <img src="{{ asset('storage/' . $image) }}"
                                                alt="{{ $project->title }} - Image {{ $index + 1 }}"
                                                class="w-full h-full object-cover" loading="lazy">
                                        </div>
                                    @endforeach

                                    @if(count($allImages) > 1)
                                        <!-- Navigation Arrows -->
                                        <button onclick="prevSlide()"
                                            class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-[#292421] p-2 rounded-full shadow-lg transition">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 19l-7-7 7-7"></path>
                                            </svg>
                                        </button>
                                        <button onclick="nextSlide()"
                                            class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-[#292421] p-2 rounded-full shadow-lg transition">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </button>

                                        <!-- Dots Indicator -->
                                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                                            @foreach($allImages as $index => $image)
                                                <button onclick="goToSlide({{ $index }})"
                                                    class="carousel-dot w-3 h-3 rounded-full transition {{ $index === 0 ? 'bg-[#A75F37]' : 'bg-white/60 hover:bg-white' }}"
                                                    data-index="{{ $index }}">
                                                </button>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div class="aspect-[4/3] bg-[#F2D6CE] flex items-center justify-center">
                                    <svg class="w-20 h-20 text-[#CA8E82]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Thumbnail Preview -->
                        @if(count($allImages) > 1)
                            <div class="flex gap-3 mt-4 justify-center">
                                @foreach($allImages as $index => $image)
                                    <button onclick="goToSlide({{ $index }})"
                                        class="thumbnail-btn w-16 h-16 rounded-lg overflow-hidden border-2 transition {{ $index === 0 ? 'border-[#A75F37]' : 'border-transparent hover:border-[#D9B99F]' }}"
                                        data-index="{{ $index }}">
                                        <img src="{{ asset('storage/' . $image) }}" alt="Thumbnail {{ $index + 1 }}"
                                            class="w-full h-full object-cover" loading="lazy">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            let currentSlide = 0;
            const slides = document.querySelectorAll('.carousel-slide');
            const dots = document.querySelectorAll('.carousel-dot');
            const thumbnails = document.querySelectorAll('.thumbnail-btn');
            const totalSlides = slides.length;

            function updateSlide() {
                slides.forEach((slide, index) => {
                    slide.classList.toggle('opacity-100', index === currentSlide);
                    slide.classList.toggle('opacity-0', index !== currentSlide);
                });

                dots.forEach((dot, index) => {
                    dot.classList.toggle('bg-[#A75F37]', index === currentSlide);
                    dot.classList.toggle('bg-white/60', index !== currentSlide);
                });

                thumbnails.forEach((thumb, index) => {
                    thumb.classList.toggle('border-[#A75F37]', index === currentSlide);
                    thumb.classList.toggle('border-transparent', index !== currentSlide);
                });
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % totalSlides;
                updateSlide();
            }

            function prevSlide() {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                updateSlide();
            }

            function goToSlide(index) {
                currentSlide = index;
                updateSlide();
            }

            // Auto-slide every 5 seconds (optional)
            // setInterval(nextSlide, 5000);
        </script>
    @endpush
</x-layouts.app>