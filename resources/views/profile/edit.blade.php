@extends('layouts.app')
@section('title', 'Edit Profile')

@section('content')
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <!-- Windows-style Card with Book Design -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <!-- Windows-style Title Bar -->
                <div class="bg-blue-600 dark:bg-blue-800 px-6 py-3 border-b border-blue-700 dark:border-blue-900 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <h2 class="text-xl font-semibold text-white">Edit Profile</h2>
                    </div>
                    <div class="flex space-x-2">
                        <div class="h-4 w-4 bg-white bg-opacity-30 rounded-full"></div>
                        <div class="h-4 w-4 bg-white bg-opacity-30 rounded-full"></div>
                        <div class="h-4 w-4 bg-white bg-opacity-30 rounded-full"></div>
                    </div>
                </div>

                <!-- Book-like Content Area -->
                <div class="flex flex-col md:flex-row">
                    <!-- Left "Page" - Cover Design -->
                    <div class="w-full md:w-1/3 bg-gradient-to-b from-blue-50 to-blue-100 dark:from-blue-900 dark:to-blue-800 p-6 flex flex-col items-center justify-center border-r border-gray-200 dark:border-gray-700">
                        <div class="relative mb-6">
                            <div class="h-32 w-32 rounded-full bg-white dark:bg-gray-700 shadow-lg border-4 border-white dark:border-gray-600 overflow-hidden">
                                <!-- Profile Image Placeholder -->
                                <svg class="h-full w-full text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <button class="absolute bottom-0 right-0 bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full shadow-md">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </button>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">{{ auth()->user()->name }}</h3>
                        <p class="text-blue-600 dark:text-blue-300">{{ auth()->user()->email }}</p>

                        <!-- Windows-style Stats -->
                        <div class="mt-6 w-full bg-white dark:bg-gray-700 p-4 rounded-lg shadow-inner border border-gray-200 dark:border-gray-600">
                            <div class="grid grid-cols-3 gap-4 text-center">
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">JOINED</p>
                                    <p class="font-medium text-gray-700 dark:text-gray-300">{{ auth()->user()->created_at->format(' d M Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">LAST LOGIN</p>
                                    <p class="font-medium text-gray-700 dark:text-gray-300">
                                        {{ optional(auth()->user()->last_login)->format(' H:i') ?? 'N/A' }}

                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">ROLE</p>
                                    <p class="font-medium text-gray-700 dark:text-gray-300">
                                        {{ ucfirst(auth()->user()->role ?? 'Member') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right "Page" - Form Content -->
                    <div class="w-full md:w-2/3 p-6">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Personal Information Section -->
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center">
                                    <svg class="h-5 w-5 text-blue-600 dark:text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Personal Information
                                </h3>

                                <div class="space-y-4">
                                    <!-- Name Field -->
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                                        <div class="relative">
                                            <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}"
                                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                                   placeholder="Your full name"
                                                   required
                                                   minlength="2"
                                                   maxlength="50">
                                            @error('name')
                                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Email Field -->
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address</label>
                                        <div class="relative">
                                            <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}"
                                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                                   placeholder="your.email@example.com"
                                                   required
                                                   maxlength="255">
                                            @error('email')
                                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Telephone Field -->
                                    <div>
                                        <label for="telephone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone Number</label>
                                        <div class="relative">
                                            <input type="tel" name="telephone" id="telephone" value="{{ old('telephone', auth()->user()->telephone) }}"
                                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                                   placeholder="+212 600-000000"
                                                   pattern="^\+?[\d\s\-]+$"
                                                   maxlength="20">
                                            @error('telephone')
                                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Password Section -->
                            <div class="mb-8">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center">
                                    <svg class="h-5 w-5 text-blue-600 dark:text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    Password Settings
                                </h3>

                                <div class="space-y-4">
                                    <!-- Current Password -->
                                    <div>
                                        <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Current Password</label>
                                        <div class="relative">
                                            <input type="password" name="current_password" id="current_password"
                                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                                   placeholder="Enter current password"
                                                   minlength="8"
                                                   maxlength="50">
                                            @error('current_password')
                                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- New Password -->
                                    <div>
                                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">New Password</label>
                                        <div class="relative">
                                            <input type="password" name="password" id="password"
                                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                                   placeholder="At least 8 characters"
                                                   minlength="8"
                                                   maxlength="50">
                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Must be at least 8 characters</p>
                                            @error('password')
                                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div>
                                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Confirm New Password</label>
                                        <div class="relative">
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                                   placeholder="Confirm your new password"
                                                   minlength="8"
                                                   maxlength="50">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <button type="button" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Cancel
                                </button>
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                    </svg>
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
