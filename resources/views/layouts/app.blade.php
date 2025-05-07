<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('FSJES', 'FSJES') }} - @yield('title')</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM8U4j7z5l5c5e5e5e5e5e5e5e5e5e5e5e5e5e5" crossorigin="anonymous">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <link rel="icon" href="{{ asset('images/th.jpeg') }}" type="image/jpeg">

    <style>
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.3s ease;
        }

        .loading-logo {
            width: 150px;
            height: 150px;
            margin-bottom: 20px;
            animation: pulse 1.5s infinite ease-in-out;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
    </style>
</head>

<body class="antialiased" x-data="fullscreen" @dblclick="toggleFullscreen">
    <!-- Loading Overlay -->
    <div id="loading-overlay" class="loading-overlay">
        <img src="{{ asset('images/th.jpeg') }}" alt="Loading Logo" class="loading-logo">
        <div class="loading-spinner"></div>
        <p class="mt-4 text-gray-700 font-semibold">Loading FSJES...</p>
    </div>

    <!-- ✅ غلاف الزر داخل x-data ليعمل Alpine -->
    <div x-data="fullscreen" class="fixed left-0 top-1/4 transform -translate-y-1/2 z-50">
        <button @click="toggleFullscreen"
            class="bg-blue-600 text-white p-3 rounded-r-lg shadow-lg hover:bg-blue-700 transition-colors duration-300"
            title="تبديل وضع الشاشة الكاملة">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
            </svg>
        </button>
    </div>

    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <main class="py-6 px-4 sm:px-6 lg:px-8">
            @yield('content')
        </main>
    </div>

    @stack('scripts')

    @include('components.toast')

    @livewireScripts

    <script>
        // Hide loading overlay when page is fully loaded
        window.addEventListener('load', function() {
            const loadingOverlay = document.getElementById('loading-overlay');
            loadingOverlay.style.opacity = '0';
            setTimeout(() => {
                loadingOverlay.style.display = 'none';
            }, 300); // Match this with the CSS transition duration
        });

        document.addEventListener('alpine:init', () => {
            Alpine.data('fullscreen', () => ({
                isFullscreen: false,

                toggleFullscreen() {
                    if (!document.fullscreenElement) {
                        document.documentElement.requestFullscreen?.().then(() => {
                            localStorage.setItem('fullscreen', 'true'); // تخزين حالة الشاشة الكاملة
                            this.isFullscreen = true;
                        }).catch(err => {
                            console.error(`Error enabling fullscreen: ${err.message}`);
                        });
                    } else {
                        document.exitFullscreen?.().then(() => {
                            localStorage.setItem('fullscreen', 'false'); // تخزين حالة الخروج من الشاشة الكاملة
                            this.isFullscreen = false;
                        });
                    }
                },

                checkFullscreen() {
                    this.isFullscreen = !!(
                        document.fullscreenElement ||
                        document.webkitFullscreenElement ||
                        document.msFullscreenElement
                    );
                },

                init() {
                    this.checkFullscreen();

                    // إذا كانت القيمة مخزنة في localStorage وأنت لست في fullscreen، قم بتفعيله
                    if (localStorage.getItem('fullscreen') === 'true' && !document.fullscreenElement) {
                        document.documentElement.requestFullscreen?.().then(() => {
                            this.isFullscreen = true;
                        });
                    }

                    document.addEventListener('fullscreenchange', () => this.checkFullscreen());
                    document.addEventListener('webkitfullscreenchange', () => this.checkFullscreen());
                    document.addEventListener('msfullscreenchange', () => this.checkFullscreen());
                }
            }));
        });
    </script>

</body>

</html>
