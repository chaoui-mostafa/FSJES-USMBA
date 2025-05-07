@extends('layouts.app')
@section('title', 'Forgot Password')
@section('description', 'Reset your password by entering your email address. We will send you a link to reset your password.')
@section('keywords', 'password reset, forgot password, email reset link')

@section('content')
<div class="fixed inset-0 bg-gradient-to-br from-blue-50 to-indigo-100 overflow-y-auto">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="max-w-5xl w-full bg-white rounded-xl overflow-hidden flex">
            <!-- Left side - Form -->
            <div class="w-full md:w-1/2 p-10 space-y-6">
                <div class="text-center">
                    <div class="mx-auto h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Reset Password</h2>
                    <p class="mt-2 text-sm text-gray-600">Create a new password for your account</p>
                </div>

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                                    value="{{ old('email', $request->email) }}"
                                    required autocomplete="email" readonly>
                            </div>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input id="password" name="password" type="password"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                    placeholder="••••••••"
                                    required autocomplete="new-password">
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input id="password_confirmation" name="password_confirmation" type="password"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                    placeholder="••••••••"
                                    required autocomplete="new-password">
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right side - Brand image -->
            <div class="hidden md:block md:w-1/2 bg-blue-600 relative">
                <div class="absolute inset-0 flex items-center justify-center p-10">
                    <img src="{{ asset('images/your-brand-logo.png') }}" alt="Brand Logo" class="max-w-full max-h-full object-contain">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
