@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header Section -->
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center justify-center">
            <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            نظام رفع ملفات الطلبة
        </h1>
        <p class="text-gray-600 mt-2">إدارة وتتبع ملفات الطلاب المرفوعة</p>
    </div>

    <!-- Upload Card -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8 max-w-2xl mx-auto">
        <div class="flex items-center mb-4">
            <div class="p-2 rounded-full bg-blue-100 mr-3">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">رفع ملف جديد</h2>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg text-sm flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-50 text-red-700 rounded-lg text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('students.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                <input id="file" name="file" type="file" accept=".xlsx,.csv" class="hidden" required />
                <label for="file" class="cursor-pointer flex flex-col items-center">
                    <svg class="w-10 h-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    <p class="text-gray-500 mb-1">اضغط لاختيار ملف أو اسحبه هنا</p>
                    <p class="text-xs text-gray-400">يجب أن يكون الملف بصيغة XLSX أو CSV</p>
                </label>
            </div>
            <button type="submit" class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center justify-center space-x-2 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
                <span>رفع الملف</span>
            </button>
        </form>
    </div>

    <!-- Upload History -->
    <div class="space-y-4">
        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            سجل الرفع السابق
        </h2>

        @php
            $groupedStudents = $allStudents->groupBy('upload_id');
        @endphp

        @foreach ($groupedStudents as $uploadId => $studentsGroup)
            @php
                $uploadedAt = $studentsGroup->first()->created_at->format('Y-m-d H:i');
            @endphp

            <div x-data="{ open: false, search: '' }" class="border rounded-lg shadow-sm bg-white overflow-hidden">
                <!-- Upload Header -->
                <button @click="open = !open" class="w-full flex justify-between items-center p-4 hover:bg-gray-50 focus:outline-none">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 rounded-full bg-gray-100">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <h3 class="font-medium text-gray-800">رفع بتاريخ {{ $uploadedAt }}</h3>
                            <p class="text-xs text-gray-500">{{ $studentsGroup->count() }} طالب</p>
                        </div>
                    </div>
                    <svg :class="{'transform rotate-180': open}" class="w-5 h-5 text-gray-400 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Student Table -->
                <div x-show="open" x-transition class="border-t">
                    <div class="p-3 bg-gray-50">
                        <div class="relative">
                            <input type="text" placeholder="ابحث عن طالب..." x-model="search"
                                   class="w-full pl-8 pr-4 py-2 border rounded-md text-sm focus:ring-1 focus:ring-blue-300 focus:border-blue-300" />
                            <svg class="absolute left-2.5 top-2.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-100 text-gray-600 text-xs">
                                <tr>
                                    <th class="px-3 py-2 text-left w-8">#</th>
                                    <th class="px-3 py-2 text-left">CNE</th>
                                    <th class="px-3 py-2 text-left">الاسم</th>
                                    <th class="px-3 py-2 text-left">التخصص</th>
                                    <th class="px-3 py-2 text-left">📧 البريد</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($studentsGroup as $index => $student)
                                    <tr class="hover:bg-gray-50"
                                        x-show="search === '' ||
                                               '{{ strtolower($student->numero) }}'.includes(search.toLowerCase()) ||
                                               '{{ strtolower($student->cne) }}'.includes(search.toLowerCase()) ||
                                               '{{ strtolower($student->nom) }}'.includes(search.toLowerCase())">
                                        <td class="px-3 py-2">{{ $index + 1 }}</td>
                                        <td class="px-3 py-2 font-medium">{{ $student->cne }}</td>
                                        <td class="px-3 py-2">{{ $student->nom }} {{ $student->prenom }}</td>
                                        <td class="px-3 py-2">{{ $student->specialite }}</td>
                                        <td class="px-3 py-2 text-blue-600">{{ $student->email }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
