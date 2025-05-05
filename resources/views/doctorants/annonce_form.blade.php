@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- Card Header -->
        <div class="bg-blue-600 rounded-t-lg px-6 py-4 flex items-center space-x-4 space-x-reverse">
            <div class="flex-shrink-0 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div class="text-right">
                <h2 class="text-xl font-bold text-white">إعداد إعلان مناقشة الدكتوراه</h2>
                <p class="text-blue-100 mt-1">الطالب: {{ $doctorant->NOMAR }} {{ $doctorant->PRENOMAR }}</p>
            </div>
        </div>

        <!-- Card Body -->
        <div class="bg-white shadow rounded-b-lg px-6 py-6">
            <form method="POST" action="{{ route('doctorant.annonce.generate') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="doctorant_id" value="{{ $doctorant->id }}">

                <!-- Date Field -->
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 text-right mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        تاريخ المناقشة
                    </label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="date" name="date" id="date" required
                            class="block w-full pr-10 border-gray-300 text-right rounded-md focus:ring-blue-500 focus:border-blue-500"
                            placeholder="YYYY-MM-DD">
                    </div>
                </div>

                <!-- Time Field -->
                <div>
                    <label for="heure" class="block text-sm font-medium text-gray-700 text-right mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        الساعة
                    </label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="time" name="heure" id="heure" required
                            class="block w-full pr-10 border-gray-300 text-right rounded-md focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Location Field -->
                <div>
                    <label for="lieu" class="block text-sm font-medium text-gray-700 text-right mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        مكان المناقشة
                    </label>
                    <div class="mt-1">
                        <input type="text" name="lieu" id="lieu" required
                            class="block w-full pr-10 border-gray-300 text-right rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Language Field -->
                <div>
                    <label for="language" class="block text-sm font-medium text-gray-700 text-right mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                        </svg>
                        لغة البحث عن أسماء الأساتذة
                    </label>
                    <select id="language" name="language" required
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-right border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-md shadow-sm">
                        <option value="fr">فرنسية</option>
                        <option value="ar">عربية</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        تحميل الإعلان
                    </button>
                </div>
            </form>
        </div>

        <!-- Card Footer -->
        <div class="bg-gray-50 rounded-b-lg px-6 py-3 text-right">
            <p class="text-sm text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                سيتم إنشاء الإعلان وفق القالب المحدد مسبقاً
            </p>
        </div>
    </div>
</div>
@endsection
