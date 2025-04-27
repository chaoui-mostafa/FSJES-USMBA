{{-- resources/views/laboratoires/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Flash Messages -->
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded-r">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">There were {{ $errors->count() }} errors with your submission</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 rounded-r">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center bg-gradient-to-r from-blue-50 to-gray-50">
            <div>
                <h3 class="text-lg font-medium leading-6 text-gray-900">Laboratory Details</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-600">{{ $laboratoire->nom }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('laboratoires.edit', $laboratoire->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M17.414 2.586a2 2 0 00-2.828 0L9 8.172V11h2.828l5.586-5.586a2 2 0 000-2.828zM7 12v2h2l6.586-6.586-2-2L7 12zM4 16v-2H3a1 1 0 00-1 1v2a1 1 0 001 1h2a1 1 0 001-1v-1H4z" />
                    </svg>
                    Edit
                </a>

                <x-delete-button :action="route('laboratoires.destroy', $laboratoire->id)" />

                <a href="{{ route('laboratoires.members', $laboratoire->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13 7a3 3 0 11-6 0 3 3 0 016 0zM5 13a4 4 0 00-4 4v1a1 1 0 001 1h16a1 1 0 001-1v-1a4 4 0 00-4-4H5z" />
                    </svg>
                    Members
                </a>
            </div>
        </div>
        <div class="border-t border-gray-200 divide-y divide-gray-200">
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 hover:bg-gray-100 transition-colors duration-150">
                <dt class="text-sm font-medium text-gray-500 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 3a1 1 0 00-.894.553L7.382 7H4a1 1 0 000 2h3a1 1 0 00.894-.553L10 5.618l2.106 3.829A1 1 0 0013 10h3a1 1 0 100-2h-3.382l-1.724-3.447A1 1 0 0010 3z" />
                    </svg>
                    French Name
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-medium">{{ $laboratoire->nom }}</dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 hover:bg-gray-50 transition-colors duration-150">
                <dt class="text-sm font-medium text-gray-500 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 3a1 1 0 00-.894.553L7.382 7H4a1 1 0 000 2h3a1 1 0 00.894-.553L10 5.618l2.106 3.829A1 1 0 0013 10h3a1 1 0 100-2h-3.382l-1.724-3.447A1 1 0 0010 3z" />
                    </svg>
                    Arabic Name
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-medium">{{ $laboratoire->nom_ar }}</dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 hover:bg-gray-100 transition-colors duration-150">
                <dt class="text-sm font-medium text-gray-500 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 3a1 1 0 00-.894.553L7.382 7H4a1 1 0 000 2h3a1 1 0 00.894-.553L10 5.618l2.106 3.829A1 1 0 0013 10h3a1 1 0 100-2h-3.382l-1.724-3.447A1 1 0 0010 3z" />
                    </svg>
                    Location
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-medium">{{ $laboratoire->localisation }}</dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 hover:bg-gray-50 transition-colors duration-150">
                <dt class="text-sm font-medium text-gray-500 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 3a1 1 0 00-.894.553L7.382 7H4a1 1 0 000 2h3a1 1 0 00.894-.553L10 5.618l2.106 3.829A1 1 0 0013 10h3a1 1 0 100-2h-3.382l-1.724-3.447A1 1 0 0010 3z" />
                    </svg>
                    Created
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-medium">{{ $laboratoire->created_at->format('M d, Y H:i') }}</dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 hover:bg-gray-100 transition-colors duration-150">
                <dt class="text-sm font-medium text-gray-500 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 3a1 1 0 00-.894.553L7.382 7H4a1 1 0 000 2h3a1 1 0 00.894-.553L10 5.618l2.106 3.829A1 1 0 0013 10h3a1 1 0 100-2h-3.382l-1.724-3.447A1 1 0 0010 3z" />
                    </svg>
                    Last Updated
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-medium">{{ $laboratoire->updated_at->format('M d, Y H:i') }}</dd>
            </div>
        </div>
    </div>
</div>
@endsection
