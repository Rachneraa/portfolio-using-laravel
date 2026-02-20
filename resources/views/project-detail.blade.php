@use('Illuminate\Support\Facades\Storage')

<x-layouts.app :title="$project->title" :socialMedia="$socialMedia">
    <section class="min-h-screen bg-gradient-to-b from-[#FBF4EB] to-[#FBD9E5] py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-8" data-aos="fade-up">
                <a href="{{ route('projects') }}"
                    class="inline-flex items-center gap-2 text-[#F283AF]/80 hover:text-[#C43670] transition group">
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
                            class="inline-block bg-[#FBD9E5] text-[#C43670] px-4 py-1 rounded-full text-sm font-medium mb-4">
                            {{ $project->category }}
                        </span>
                    @endif

                    <!-- Title -->
                    <h1 class="text-4xl md:text-5xl font-bold text-[#C43670] mb-6">
                        {{ $project->title }}
                    </h1>

                    <!-- Tags -->
                    @if($project->tags && count($project->tags) > 0)
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach($project->tags as $tag)
                                <span
                                    class="bg-white/80 backdrop-blur-sm text-[#C43670] px-4 py-2 rounded-full text-sm font-medium shadow-sm border border-[#F3CC97]">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <!-- Description -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg mb-8">
                        <h3 class="text-lg font-semibold text-[#C43670] mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#F283AF]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Deskripsi
                        </h3>
                        <p class="text-[#C43670]/70 leading-relaxed whitespace-pre-line">{{ $project->description }}</p>
                    </div>

                    <!-- Links -->
                    <div class="flex flex-wrap gap-4">
                        @if($project->link)
                            <a href="{{ $project->link }}" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center gap-2 bg-[#F283AF] hover:bg-[#C43670] text-white px-6 py-3 rounded-full font-medium transition shadow-lg hover:shadow-xl">
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
                                class="inline-flex items-center gap-2 bg-[#C43670] hover:bg-[#F283AF] text-white px-6 py-3 rounded-full font-medium transition shadow-lg hover:shadow-xl">
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
                        <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden" id="carousel-container"
                            style="width: 100%; margin: 0 auto; display: flex; justify-content: center; align-items: center; transition: height 0.3s ease;">
                            @php
                                $allImages = [];
                                // Use new ProjectImages relasi if available
                                if ($project->images && $project->images->count() > 0) {
                                    $allImages = $project->images->all();
                                } else {
                                    // Fallback to legacy gallery - both json array and single image
                                    if ($project->gallery && is_array($project->gallery) && count($project->gallery) > 0) {
                                        foreach ($project->gallery as $path) {
                                            if ($path) {
                                                $allImages[] = (object) [
                                                    'image_path' => $path,
                                                    'aspect_ratio' => null,
                                                    'width' => null,
                                                    'height' => null,
                                                ];
                                            }
                                        }
                                    }
                                    // If still no images, try main image field
                                    if (count($allImages) === 0 && $project->image) {
                                        $allImages[] = (object) [
                                            'image_path' => $project->image,
                                            'aspect_ratio' => null,
                                            'width' => null,
                                            'height' => null,
                                        ];
                                    }
                                }
                            @endphp

                            @if(count($allImages) > 0)
                                <div class="relative w-full" id="carousel-wrapper">
                                    <!-- Main Carousel -->
                                    <div class="relative mx-auto flex items-center justify-center w-full"
                                        style="position: relative; display: flex; align-items: center; justify-content: center;">
                                        @foreach($allImages as $index => $imageItem)
                                            @php
                                                $imagePath = is_object($imageItem) ? $imageItem->image_path : $imageItem;
                                                $imageUrl = Storage::url($imagePath);
                                                $width = is_object($imageItem) ? $imageItem->width : null;
                                                $height = is_object($imageItem) ? $imageItem->height : null;
                                                $aspectRatio = is_object($imageItem) ? $imageItem->aspect_ratio : null;
                                            @endphp
                                            <div class="carousel-slide transition-opacity duration-500 {{ $index === 0 ? 'opacity-100 static' : 'opacity-0 absolute inset-0' }}"
                                                data-index="{{ $index }}" data-width="{{ $width }}" data-height="{{ $height }}"
                                                data-ratio="{{ $aspectRatio }}"
                                                style="width: 100%; display: flex; align-items: center; justify-content: center; padding: 20px;">
                                                <img src="{{ $imageUrl }}" alt="{{ $project->title }} - Image {{ $index + 1 }}"
                                                    class="carousel-image"
                                                    style="max-width: 100%; height: auto; object-fit: contain;"
                                                    onload="updateCarouselHeight()"
                                                    onerror="console.error('Image failed to load:', '{{ $imagePath }}'); this.style.display='none';"
                                                    {{ $index === 0 ? '' : 'loading="lazy"' }}>
                                            </div>
                                        @endforeach

                                        @if(count($allImages) > 1)
                                            <!-- Navigation Arrows -->
                                            <button onclick="prevSlide()"
                                                class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-[#C43670] p-2 rounded-full shadow-lg transition z-10">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 19l-7-7 7-7"></path>
                                                </svg>
                                            </button>
                                            <button onclick="nextSlide()"
                                                class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-[#C43670] p-2 rounded-full shadow-lg transition z-10">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </button>

                                            <!-- Dots Indicator -->
                                            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                                                @foreach($allImages as $index => $image)
                                                    <button onclick="goToSlide({{ $index }})"
                                                        class="carousel-dot w-3 h-3 rounded-full transition {{ $index === 0 ? 'bg-[#F283AF]' : 'bg-white/60 hover:bg-white' }}"
                                                        data-index="{{ $index }}">
                                                    </button>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="relative w-full flex items-center justify-center" style="min-height: 300px;">
                                    <svg class="w-20 h-20 text-[#C43670]/30" fill="none" stroke="currentColor"
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
                            <div class="flex gap-3 mt-4 justify-center flex-wrap">
                                @foreach($allImages as $index => $imageItem)
                                    @php
                                        $imagePath = is_object($imageItem) ? $imageItem->image_path : $imageItem;
                                    @endphp
                                    <button onclick="goToSlide({{ $index }})"
                                        class="thumbnail-btn w-16 h-16 rounded-lg overflow-hidden border-2 transition {{ $index === 0 ? 'border-[#F283AF]' : 'border-transparent hover:border-[#F3CC97]' }}"
                                        data-index="{{ $index }}">
                                        <img src="{{ Storage::url($imagePath) }}" alt="Thumbnail {{ $index + 1 }}"
                                            class="w-full h-full object-cover">
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
            const carouselContainer = document.getElementById('carousel-container');
            const totalSlides = slides.length;

            // Calculate max container width responsively
            function getContainerWidth() {
                return Math.min(carouselContainer.offsetWidth, window.innerWidth * 0.9);
            }

            // Update carousel height based on current slide
            function updateCarouselHeight() {
                if (totalSlides === 0) return;

                const currentSlideEl = slides[currentSlide];
                if (!currentSlideEl) return;

                const width = parseFloat(currentSlideEl.dataset.width);
                const height = parseFloat(currentSlideEl.dataset.height);

                // If dimensions exist, calculate height
                if (width && height) {
                    const containerWidth = getContainerWidth();
                    const calculatedHeight = (height / width) * containerWidth;
                    carouselContainer.style.height = Math.max(calculatedHeight + 40, 200) + 'px'; // 40px for padding
                } else {
                    // Fallback: use actual image height
                    const img = currentSlideEl.querySelector('.carousel-image');
                    if (img && img.complete && img.naturalHeight) {
                        const containerWidth = getContainerWidth();
                        const calculatedHeight = (img.naturalHeight / img.naturalWidth) * containerWidth;
                        carouselContainer.style.height = Math.max(calculatedHeight + 40, 200) + 'px';
                    }
                }
            }

            function updateSlide() {
                slides.forEach((slide, index) => {
                    slide.classList.toggle('opacity-100', index === currentSlide);
                    slide.classList.toggle('opacity-0', index !== currentSlide);
                });

                dots.forEach((dot, index) => {
                    dot.classList.toggle('bg-[#F283AF]', index === currentSlide);
                    dot.classList.toggle('bg-white/60', index !== currentSlide);
                });

                thumbnails.forEach((thumb, index) => {
                    thumb.classList.toggle('border-[#F283AF]', index === currentSlide);
                    thumb.classList.toggle('border-transparent', index !== currentSlide);
                });

                // Update height when slide changes
                updateCarouselHeight();
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

            // Initialize height on page load
            window.addEventListener('load', updateCarouselHeight);

            // Update height on window resize (truly responsive)
            window.addEventListener('resize', updateCarouselHeight);

            // Auto-slide every 5 seconds (optional)
            // setInterval(nextSlide, 5000);
        </script>
    @endpush
</x-layouts.app>