<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{
          darkMode: localStorage.getItem('darkMode') === 'true' ||
          (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
      }"
      :class="{ 'dark': darkMode }"
      class="{{ Auth::check() && Auth::user()->dark_mode ? 'dark' : '' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('FSJES', 'FSJES') }} - @yield('title')</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <link rel="icon" href="{{ asset('images/th.jpeg') }}" type="image/jpeg" style="border-radius:60%;">

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
            transition: opacity 0.5s ease;
        }

        .dark .loading-overlay {
            background-color: rgba(17, 24, 39, 0.9);
        }

        .loading-logo {
            width: 150px;
            height: 150px;
            margin-bottom: 20px;
            animation: pulse 1.5s infinite ease-in-out;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(209, 213, 219, 0.3);
            border-top: 5px solid #f59e0b;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .dark .loading-spinner {
            border: 5px solid rgba(55, 65, 81, 0.3);
            border-top: 5px solid #f59e0b;
        }

        .loading-text {
            margin-top: 1rem;
            font-size: 1.125rem;
            font-weight: 600;
            color: #1e40af;
        }

        .dark .loading-text {
            color: greenyellow;
        }

        .progress-bar {
            width: 200px;
            height: 4px;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 2px;
            margin-top: 20px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            background: chartreuse;
            width: 0%;
            transition: width 0.3s ease;
        }

        .dark .progress-bar-fill {
            background: chartreuse;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.05);
                opacity: 0.8;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .fullscreen-btn {
            background-color: #f59e0b;
            color: white;
            padding: 0.75rem;
            border-radius: 0 0.375rem 0.375rem 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .fullscreen-btn:hover {
            background-color: #3b82f6;
        }

        .dark .fullscreen-btn {
            background-color: #d97706;
        }

        .dark .fullscreen-btn:hover {
            background-color: #2563eb;
        }
    </style>
</head>

<body class="antialiased bg-white dark:bg-gray-800" x-data="fullscreen">
    <!-- Loading Overlay -->
    <div id="loading-overlay" class="loading-overlay">
        <img src="{{ asset('images/th.jpeg') }}" alt="Loading Logo" class="loading-logo">
        <div class="loading-spinner"></div>
        <p class="loading-text">Loading FSJES...</p>
        <div class="progress-bar">
            <div id="progress-bar-fill" class="progress-bar-fill"></div>
        </div>
    </div>

    <!-- Fullscreen toggle button -->
    <div x-data="fullscreen" class="fixed left-0 top-1/4 transform -translate-y-1/2 z-50">
        <button @click="toggleFullscreen"
            class="fullscreen-btn"
            title="Toggle Fullscreen Mode">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
            </svg>
        </button>
    </div>

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 transition-colors duration-200">
        @include('layouts.navigation')

        <main class="py-6 px-4 sm:px-6 lg:px-8">
            @yield('content')
        </main>
    </div>

    @stack('scripts')

    @include('components.toast')

    @livewireScripts

    <script>
        // Minimum loading time (3 seconds)
        const MIN_LOADING_TIME = 3000;
        let loadingStartTime = Date.now();
        let resourcesLoaded = false;
        let domLoaded = false;

        // Update progress bar
        function updateProgress(percentage) {
            const progressBar = document.getElementById('progress-bar-fill');
            if (progressBar) {
                progressBar.style.width = `${percentage}%`;
            }
        }

        // Hide loading overlay when conditions are met
        function hideLoadingOverlay() {
            const currentTime = Date.now();
            const elapsed = currentTime - loadingStartTime;
            const remainingTime = Math.max(0, MIN_LOADING_TIME - elapsed);

            setTimeout(() => {
                const loadingOverlay = document.getElementById('loading-overlay');
                if (loadingOverlay) {
                    loadingOverlay.style.opacity = '0';
                    setTimeout(() => {
                        loadingOverlay.style.display = 'none';
                    }, 500);
                }
            }, remainingTime);
        }

        // Simulate progress (optional - can be removed if not needed)
        let progress = 0;
        const progressInterval = setInterval(() => {
            progress += 5;
            if (progress <= 95) {
                updateProgress(progress);
            }
        }, 150);

        // DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            domLoaded = true;
            updateProgress(70);
            if (resourcesLoaded) {
                clearInterval(progressInterval);
                updateProgress(100);
                hideLoadingOverlay();
            }
        });

        // All resources are loaded
        window.addEventListener('load', function() {
            resourcesLoaded = true;
            updateProgress(90);
            if (domLoaded) {
                clearInterval(progressInterval);
                updateProgress(100);
                hideLoadingOverlay();
            }
        });

        // Fallback in case load events don't fire
        setTimeout(() => {
            clearInterval(progressInterval);
            updateProgress(100);
            hideLoadingOverlay();
        }, MIN_LOADING_TIME + 1000);

        // Dark mode toggle functionality
        document.addEventListener('alpine:init', () => {
            // Fullscreen functionality
            Alpine.data('fullscreen', () => ({
                isFullscreen: false,
                clickCount: 0,
                clickTimeout: null,

                toggleFullscreen() {
                    if (!document.fullscreenElement) {
                        document.documentElement.requestFullscreen?.().then(() => {
                            localStorage.setItem('fullscreen', 'true');
                            this.isFullscreen = true;
                        }).catch(err => {
                            console.error(`Error enabling fullscreen: ${err.message}`);
                        });
                    } else {
                        document.exitFullscreen?.().then(() => {
                            localStorage.setItem('fullscreen', 'false');
                            this.isFullscreen = false;
                        });
                    }
                },

                handleClick() {
                    this.clickCount++;
                    if (this.clickTimeout) {
                        clearTimeout(this.clickTimeout);
                    }
                    this.clickTimeout = setTimeout(() => {
                        if (this.clickCount === 3) {
                            this.toggleFullscreen();
                        }
                        this.clickCount = 0;
                    }, 600);
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

                    if (localStorage.getItem('fullscreen') === 'true' && !document.fullscreenElement) {
                        document.documentElement.requestFullscreen?.().then(() => {
                            this.isFullscreen = true;
                        });
                    }

                    document.addEventListener('fullscreenchange', () => this.checkFullscreen());
                    document.addEventListener('webkitfullscreenchange', () => this.checkFullscreen());
                    document.addEventListener('msfullscreenchange', () => this.checkFullscreen());
                    document.body.addEventListener('click', () => this.handleClick());
                }
            }));

            // Dark mode persistence
            Alpine.store('darkMode', {
                on: localStorage.getItem('darkMode') === 'true' ||
                    (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),

                toggle() {
                    this.on = !this.on;
                    localStorage.setItem('darkMode', this.on);
                    document.documentElement.classList.toggle('dark', this.on);
                }
            });
        });

        // Initialize dark mode from localStorage or preference
        if (localStorage.getItem('darkMode') === 'true' ||
            (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</body>
</html>
