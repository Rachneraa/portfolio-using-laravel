<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Portfolio Fadilla Tasya Wanda">
    <meta name="theme-color" content="#F283AF">
    <title>{{ $title ?? 'Portfolio' }} - Fadilla Tasya Wanda</title>

    <!-- Polyfill for legacy/edge browsers -->
    <script
        src="https://polyfill.io/v3/polyfill.min.js?features=default,fetch,Promise,Array.prototype.includes,Object.entries"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">


    <!-- TimelineJS CSS (needed) -->
    <link title="timeline-styles" rel="stylesheet"
        href="https://cdn.knightlab.com/libs/timeline3/latest/css/timeline.css">
    <!-- AOS CSS (needed) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- SweetAlert2 CSS (needed) -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Main App CSS/JS (pastikan hanya import yang dipakai) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html {
            scroll-behavior: smooth;
        }

        body,
        nav,
        footer,
        section,
        div:not(.tl-slidenav-icon):not(.tl-icon),
        p,
        span:not(.tl-icon),
        a,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        button,
        input,
        textarea {
            font-family: 'Poppins', sans-serif;
        }

        .tl-slidenav-icon,
        .tl-icon,
        .tl-menubar-button,
        [class*="tl-icon"] {
            font-family: 'tl-icons' !important;
        }

        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #FBF4EB 0%, #FBD9E5 50%, #F283AF 100%);
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
            border: 4px solid rgba(242, 131, 175, 0.2);
            border-top-color: #F283AF;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .page-content {
            opacity: 1;
            transition: opacity 0.3s ease-in-out;
        }

        .page-content.fade-out {
            opacity: 0;
        }
    </style>
</head>

<body class="bg-[#FBF4EB] min-h-screen">
    <!-- Loading Screen -->
    <div id="loading-screen" class="loading-screen">
        <div class="spinner"></div>
    </div>

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-[#FBF4EB]/80 backdrop-blur-md shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-2">
                    <!-- hi Logo SVG -->
                    <svg class="w-10 h-10" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Letter h -->
                        <rect x="5" y="5" width="18" height="18" rx="2" fill="#F283AF" />
                        <rect x="5" y="25" width="18" height="55" rx="2" fill="#F283AF" />
                        <path d="M23 45 Q40 45 40 60 L40 80 L58 80 L58 55 Q58 35 23 35 L23 45Z" fill="#F283AF" />
                        <!-- Letter i -->
                        <circle cx="75" cy="14" r="12" fill="#F283AF" />
                        <rect x="63" y="35" width="24" height="45" rx="2" fill="#F283AF" />
                    </svg>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/#home" class="font-semibold text-[#292421] hover:text-[#A75F37] transition">Home</a>
                    <a href="/#about" class="font-semibold text-[#292421] hover:text-[#A75F37] transition">About</a>
                    <a href="/#projects"
                        class="font-semibold text-[#292421] hover:text-[#A75F37] transition">Portfolio</a>
                    <a href="/#contact" class="font-semibold text-[#292421] hover:text-[#A75F37] transition">Contact</a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg hover:bg-[#F2D6CE] transition">
                    <svg class="w-6 h-6 text-[#292421]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-[#FBF4EB] border-t border-[#F283AF]">
            <div class="px-4 py-3 space-y-2">
                <a href="/#home"
                    class="block py-2 font-semibold text-[#292421] hover:text-[#A75F37] transition">Home</a>
                <a href="/#about"
                    class="block py-2 font-semibold text-[#292421] hover:text-[#A75F37] transition">About</a>
                <a href="/#projects"
                    class="block py-2 font-semibold text-[#292421] hover:text-[#A75F37] transition">Portfolio</a>
                <a href="/#contact"
                    class="block py-2 font-semibold text-[#292421] hover:text-[#A75F37] transition">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main id="page-content" class="pt-16 page-content">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-[#C43670] py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-xl font-bold text-[#F3CC97] mb-4">Fadilla Tasya Wanda</h3>

            <!-- Footer Navigation -->
            <div class="flex justify-center gap-6 mb-6">
                <a href="/#about" class="text-[#FBF4EB] hover:text-[#F3CC97] transition">About</a>
                <a href="/#skills" class="text-[#FBF4EB] hover:text-[#F3CC97] transition">Skills</a>
                <a href="/#experience" class="text-[#FBF4EB] hover:text-[#F3CC97] transition">Experience</a>
                <a href="/#contact" class="text-[#FBF4EB] hover:text-[#F3CC97] transition">Contact</a>
            </div>

            <!-- Social Media Icons -->
            @if(isset($socialMedia) && $socialMedia->count() > 0)
                <div class="flex justify-center gap-4 mb-6">
                    @foreach($socialMedia as $social)
                        <a href="{{ $social->url }}" target="_blank" rel="noopener noreferrer"
                            class="w-10 h-10 rounded-full flex items-center justify-center transition hover:scale-110"
                            style="background-color: #F283AF20; color: #F3CC97;">
                            @include('components.social-icons.' . $social->icon)
                        </a>
                    @endforeach
                </div>
            @endif

            <p class="text-[#C43670]/70 text-sm">&copy; {{ date('Y') }} Fadilla Tasya Wanda. All rights reserved.</p>
        </div>
    </footer>


    <!-- TimelineJS Script (needed) -->
    <script src="https://cdn.knightlab.com/libs/timeline3/latest/js/timeline.js"></script>
    <!-- AOS Script (needed) -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 600, easing: 'ease-out', once: true });
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function () {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
        // Loading Screen Handler
        const loadingScreen = document.getElementById('loading-screen');
        const pageContent = document.getElementById('page-content');
        window.addEventListener('load', function () { loadingScreen.classList.add('hidden'); });
        document.addEventListener('click', function (e) {
            const link = e.target.closest('a');
            if (link && link.href && !link.href.startsWith('#') && !link.href.includes('#') && link.hostname === window.location.hostname && !link.hasAttribute('download') && link.target !== '_blank') {
                e.preventDefault();
                pageContent.classList.add('fade-out');
                loadingScreen.classList.remove('hidden');
                setTimeout(function () { window.location.href = link.href; }, 300);
            }
        });
        window.addEventListener('pageshow', function (event) {
            if (event.persisted) {
                loadingScreen.classList.add('hidden');
                pageContent.classList.remove('fade-out');
            }
        });
    </script>
    <!-- SweetAlert2 JS (needed) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')
</body>

</html>