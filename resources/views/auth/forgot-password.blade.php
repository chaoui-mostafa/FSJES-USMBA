@extends('layouts.app')
@section('title', 'Forgot Password')

@section('content')
<div class="fixed inset-0 bg-gradient-to-br from-blue-50 to-indigo-100 overflow-y-auto">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-5xl w-full bg-white rounded-xl overflow-hidden flex shadow-2xl">
            <!-- Left side - Form -->
            <div class="w-full md:w-1/2 p-8 md:p-10 space-y-6">
                <div class="text-center">
                    <div class="mx-auto h-16 w-16 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Forgot your password?</h2>
                    <p class="mt-2 text-gray-600">Enter your email and we'll send you a reset link</p>
                </div>

                @if (session('status'))
                    <div class="p-4 bg-green-50 rounded-lg text-green-700 text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="space-y-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                </div>
                                <input id="email" name="email" type="email"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                    placeholder="you@example.com"
                                    value="{{ old('email') }}"
                                    required autocomplete="email" autofocus>
                            </div>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                            Send Password Reset Link
                        </button>
                    </div>
                </form>

                <div class="text-center text-sm text-gray-500">
                    Remember your password?
                    <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500 transition duration-300">Sign in</a>
                </div>
            </div>

            <!-- Right side - Brand image with modern slider -->
            <div class="hidden md:block md:w-1/2 bg-gradient-to-br from-red-500 to-indigo-600 relative overflow-hidden">
                <div id="slider" class="absolute inset-0 flex items-center justify-center p-8 text-white">
                    <!-- Slide 1 -->
                    <div class="slide absolute inset-0 flex flex-col items-center justify-center p-6 md:p-8 transition-all duration-1000 ease-[cubic-bezier(0.83,0,0.17,1)] transform translate-x-0 opacity-100">
                        <h1 class="text-3xl md:text-4xl font-bold mb-2 text-center">FSJES Management</h1>
                        <p class="text-base md:text-lg text-center mb-4 md:mb-6">Simplifiez vos tâches académiques et administratives avec facilité.</p>
                        <img src="{{ asset('images/th.jpeg') }}" alt="Logo de la marque" class="w-48 h-48 md:w-64 md:h-64 object-contain rounded-lg shadow-lg">
                        <p class="mt-3 md:mt-4 text-sm md:text-base text-center">Faculté des Sciences Juridiques, Économiques et Sociales – Fès</p>
                    </div>

                    <!-- Slide 2 -->
                    <div class="slide absolute inset-0 flex flex-col items-center justify-center p-6 md:p-8 transition-all duration-1000 ease-[cubic-bezier(0.83,0,0.17,1)] transform translate-x-full opacity-0">
                        <h1 class="text-3xl md:text-4xl font-bold mb-2 text-center">Gestion Simplifiée</h1>
                        <h2 class="text-xl md:text-2xl font-semibold text-center mb-4 md:mb-6">With eTwin technology</h2>
                        <img src="{{ asset('images/slide2.jpg') }}" alt="Image 2" class="w-48 h-48 md:w-64 md:h-64 object-contain rounded-lg shadow-lg">

                        <div class="mt-3 md:mt-4 flex justify-center space-x-4 md:space-x-6">
                            <a href="https://www.facebook.com" target="_blank" class="text-white hover:text-blue-300 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 md:h-8 md:w-8" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.675 0h-21.35C.6 0 0 .6 0 1.325v21.351C0 23.4.6 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.894-4.788 4.659-4.788 1.325 0 2.463.099 2.794.143v3.24h-1.917c-1.504 0-1.796.715-1.796 1.763v2.31h3.587l-.467 3.622h-3.12V24h6.116C23.4 24 24 23.4 24 22.675V1.325C24 .6 23.4 0 22.675 0z"/>
                                </svg>
                            </a>
                            <a href="https://www.instagram.com" target="_blank" class="text-white hover:text-pink-400 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 md:h-8 md:w-8" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.334 3.608 1.31.975.975 1.247 2.242 1.31 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.062 1.366-.334 2.633-1.31 3.608-.975.975-2.242 1.247-3.608 1.31-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.062-2.633-.334-3.608-1.31-.975-.975-1.247-2.242-1.31-3.608-.058-1.266-.07-1.646-.07-4.85s.012-3.584.07-4.85c.062-1.366.334-2.633 1.31-3.608.975-.975 2.242-1.247 3.608-1.31 1.266-.058 1.646-.07 4.85-.07zm0-2.163C8.756 0 8.332.014 7.052.072 5.773.13 4.548.392 3.5 1.44 2.452 2.488 2.19 3.713 2.132 4.992.014 8.332 0 8.756 0 12s.014 3.668.072 4.948c.058 1.279.32 2.504 1.368 3.552 1.048 1.048 2.273 1.31 3.552 1.368 1.279.058 1.703.072 4.948.072s3.668-.014 4.948-.072c1.279-.058 2.504-.32 3.552-1.368 1.048-1.048 1.31-2.273 1.368-3.552.058-1.279.072-1.703.072-4.948s-.014-3.668-.072-4.948c-.058-1.279-.32-2.504-1.368-3.552-1.048-1.048-2.273-1.31-3.552-1.368C15.668.014 15.244 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.162a3.999 3.999 0 110-7.998 3.999 3.999 0 010 7.998zm6.406-11.845a1.44 1.44 0 11-2.88 0 1.44 1.44 0 012.88 0z"/>
                                </svg>
                            </a>
                            <a href="https://wa.me" target="_blank" class="text-white hover:text-green-400 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 md:h-8 md:w-8" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.52 3.48A11.93 11.93 0 0012 0C5.373 0 0 5.373 0 12c0 2.11.55 4.15 1.6 5.95L0 24l6.26-1.6A11.93 11.93 0 0012 24c6.627 0 12-5.373 12-12 0-3.2-1.25-6.21-3.48-8.52zM12 22c-1.85 0-3.63-.5-5.2-1.45l-.37-.22-3.7.95.95-3.7-.22-.37C2.5 15.63 2 13.85 2 12 2 6.48 6.48 2 12 2c2.85 0 5.52 1.1 7.55 3.15C21.9 7.48 22 10.15 22 12c0 5.52-4.48 10-10 10zm5.2-6.8c-.25-.12-1.48-.73-1.7-.82-.23-.08-.4-.12-.57.12-.17.25-.65.82-.8.98-.15.17-.3.2-.55.08-.25-.12-1.05-.39-2-1.25-.74-.66-1.23-1.48-1.38-1.73-.15-.25-.02-.38.1-.5.1-.1.25-.27.37-.4.12-.12.15-.2.23-.33.08-.12.04-.25-.02-.37-.06-.12-.57-1.37-.78-1.88-.2-.5-.4-.43-.57-.43-.15 0-.3-.02-.46-.02-.15 0-.4.06-.6.25-.2.2-.8.78-.8 1.9s.82 2.2.93 2.35c.12.15 1.6 2.45 3.88 3.43.54.23.96.37 1.28.48.54.17 1.03.15 1.42.1.43-.06 1.48-.6 1.7-1.18.2-.57.2-1.05.15-1.18-.06-.12-.2-.18-.43-.3z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Slider indicators -->
                <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2 z-10">
                    <button class="slider-indicator w-2.5 h-2.5 rounded-full bg-white bg-opacity-50 focus:outline-none transition-all duration-300" data-index="0" aria-label="Slide 1"></button>
                    <button class="slider-indicator w-2.5 h-2.5 rounded-full bg-white bg-opacity-50 focus:outline-none transition-all duration-300" data-index="1" aria-label="Slide 2"></button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .slide {
        will-change: transform, opacity;
    }

    .slider-indicator.active {
        background-color: white;
        transform: scale(1.3);
        opacity: 1;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const slides = document.querySelectorAll('#slider .slide');
        const indicators = document.querySelectorAll('.slider-indicator');
        let currentIndex = 0;
        let intervalId;

        // Initialize first slide and indicator
        slides[0].classList.remove('translate-x-full', 'opacity-0');
        indicators[0].classList.add('active');

        function showSlide(index) {
            // Hide all slides
            slides.forEach((slide, i) => {
                slide.classList.remove('translate-x-0', 'opacity-100');
                slide.classList.add(i > index ? 'translate-x-full' : '-translate-x-full', 'opacity-0');
                indicators[i].classList.remove('active');
            });

            // Show current slide
            slides[index].classList.remove('translate-x-full', '-translate-x-full', 'opacity-0');
            slides[index].classList.add('translate-x-0', 'opacity-100');
            indicators[index].classList.add('active');

            currentIndex = index;
        }

        function nextSlide() {
            const nextIndex = (currentIndex + 1) % slides.length;
            showSlide(nextIndex);
        }

        // Auto-rotate slides
        function startSlider() {
            intervalId = setInterval(nextSlide, 5000);
        }

        // Pause on hover
        document.querySelector('#slider').addEventListener('mouseenter', () => {
            clearInterval(intervalId);
        });

        document.querySelector('#slider').addEventListener('mouseleave', startSlider);

        // Click indicators
        indicators.forEach(indicator => {
            indicator.addEventListener('click', () => {
                const index = parseInt(indicator.dataset.index);
                if (index !== currentIndex) {
                    clearInterval(intervalId);
                    showSlide(index);
                    startSlider();
                }
            });
        });

        startSlider();
    });
</script>
@endsection
