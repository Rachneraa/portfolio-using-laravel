<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portfolio Fadilla Tasya Wanda">
    <title>{{ $title ?? 'Portfolio' }} - Fadilla Tasya Wanda</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- TimelineJS CSS -->
    <link title="timeline-styles" rel="stylesheet"
        href="https://cdn.knightlab.com/libs/timeline3/latest/css/timeline.css">

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Apply Poppins but exclude TimelineJS icons */
        body,
        nav,
        footer,
        section,
        div:not(.tl-slidenav-icon):not(.tl-icon),
        p,
        span:not(.tl-icon),
        a,
        h1, h2, h3, h4, h5, h6,
        button,
        input,
        textarea {
            font-family: 'Poppins', sans-serif;
        }

        /* Ensure TimelineJS icons use their own font */
        .tl-slidenav-icon,
        .tl-icon,
        .tl-menubar-button,
        [class*="tl-icon"] {
            font-family: 'tl-icons' !important;
        }

        /* Loading Screen */
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 50%, #f9a8d4 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
        }

        .loading-screen.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(236, 72, 153, 0.2);
            border-top-color: #ec4899;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Page Transition */
        .page-content {
            opacity: 1;
            transition: opacity 0.3s ease-in-out;
        }

        .page-content.fade-out {
            opacity: 0;
        }
    </style>
</head>

<body class="bg-gradient-pink min-h-screen">
    <!-- Loading Screen -->
    <div id="loading-screen" class="loading-screen">
        <div class="spinner"></div>
    </div>

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-2">
                    <span class="text-xl font-bold text-pink-500">🌸 FTW</span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/#home" class="font-semibold text-gray-700 hover:text-pink-500 transition">Home</a>
                    <a href="/#about" class="font-semibold text-gray-700 hover:text-pink-500 transition">About</a>
                    <a href="/#projects" class="font-semibold text-gray-700 hover:text-pink-500 transition">Portfolio</a>
                    <a href="/#contact" class="font-semibold text-gray-700 hover:text-pink-500 transition">Contact</a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg hover:bg-pink-100 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
            <div class="px-4 py-3 space-y-2">
                <a href="/#home" class="block py-2 font-semibold text-gray-700 hover:text-pink-500 transition">Home</a>
                <a href="/#about"
                    class="block py-2 font-semibold text-gray-700 hover:text-pink-500 transition">About</a>
                <a href="/#projects"
                    class="block py-2 font-semibold text-gray-700 hover:text-pink-500 transition">Portfolio</a>
                <a href="/#contact"
                    class="block py-2 font-semibold text-gray-700 hover:text-pink-500 transition">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main id="page-content" class="pt-16 page-content">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-pink-200 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-xl font-bold text-pink-600 mb-4">Fadilla Tasya Wanda</h3>

            <!-- Footer Navigation -->
            <div class="flex justify-center gap-6 mb-6">
                <a href="/#about" class="text-gray-700 hover:text-pink-600 transition">About</a>
                <a href="/#skills" class="text-gray-700 hover:text-pink-600 transition">Skills</a>
                <a href="/#experience" class="text-gray-700 hover:text-pink-600 transition">Experience</a>
                <a href="/#contact" class="text-gray-700 hover:text-pink-600 transition">Contact</a>
            </div>

            <!-- Social Media Icons -->
            @if(isset($socialMedia) && $socialMedia->count() > 0)
                <div class="flex justify-center gap-4 mb-6">
                    @foreach($socialMedia as $social)
                        <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer"
                            class="w-10 h-10 rounded-full flex items-center justify-center transition hover:scale-110"
                            style="background-color: {{ $social->color }}20; color: {{ $social->color }};">
                            @include('components.social-icons.' . $social->icon)
                        </a>
                    @endforeach
                </div>
            @endif

            <p class="text-gray-600 text-sm">&copy; {{ date('Y') }} Fadilla Tasya Wanda. All rights reserved.</p>
        </div>
    </footer>

    <!-- TimelineJS Script -->
    <script src="https://cdn.knightlab.com/libs/timeline3/latest/js/timeline.js"></script>

    <!-- AOS Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 600,
            easing: 'ease-out',
            once: true
        });
    </script>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function () {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Loading Screen Handler
        const loadingScreen = document.getElementById('loading-screen');
        const pageContent = document.getElementById('page-content');

        // Hide loading screen when page is fully loaded
        window.addEventListener('load', function () {
            loadingScreen.classList.add('hidden');
        });

        // Page transition for internal links
        document.addEventListener('click', function (e) {
            const link = e.target.closest('a');

            if (link && link.href && !link.href.startsWith('#') && !link.href.includes('#') &&
                link.hostname === window.location.hostname &&
                !link.hasAttribute('download') &&
                link.target !== '_blank') {

                e.preventDefault();

                // Fade out content
                pageContent.classList.add('fade-out');

                // Show loading screen
                loadingScreen.classList.remove('hidden');

                // Navigate after animation
                setTimeout(function () {
                    window.location.href = link.href;
                }, 300);
            }
        });

        // Handle browser back/forward buttons
        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                loadingScreen.classList.add('hidden');
                pageContent.classList.remove('fade-out');
            }
        });
    </script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')
</body>

</html>