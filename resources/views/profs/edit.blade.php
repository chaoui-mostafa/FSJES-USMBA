@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Edit Professor</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Update professor information</p>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
            <form action="{{ route('profs.update', $prof->id_prof) }}" method="POST" class="divide-y divide-gray-200">
                @csrf
                @method('PUT')
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <label for="nom" class="block text-sm font-medium text-gray-700">Name (FR)</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <input type="text" name="nom" id="nom" value="{{ old('nom', $prof->nom) }}" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @error('nom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50">
                    <label for="nom_ar" class="block text-sm font-medium text-gray-700">Name (AR)</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <input type="text" name="nom_ar" id="nom_ar" value="{{ old('nom_ar', $prof->nom_ar) }}" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @error('nom_ar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <label for="grade" class="block text-sm font-medium text-gray-700">Grade</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <input type="text" name="grade" id="grade" value="{{ old('grade', $prof->grade) }}" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @error('grade') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50">
                    <label for="etablissement" class="block text-sm font-medium text-gray-700">Institution</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <input type="text" name="etablissement" id="etablissement" value="{{ old('etablissement', $prof->etablissement) }}" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @error('etablissement') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <label for="departement" class="block text-sm font-medium text-gray-700">Department</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <input type="text" name="departement" id="departement" value="{{ old('departement', $prof->departement) }}" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @error('departement') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50">
                    <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <select name="type" id="type" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                            <option value="Permanent" {{ old('type', $prof->type) == 'Permanent' ? 'selected' : '' }}>Permanent</option>
                            <option value="Visiting" {{ old('type', $prof->type) == 'Visiting' ? 'selected' : '' }}>Visiting</option>
                            <option value="Associate" {{ old('type', $prof->type) == 'Associate' ? 'selected' : '' }}>Associate</option>
                        </select>
                        @error('type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <label for="id_laboratoire" class="block text-sm font-medium text-gray-700">Laboratory</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <select name="id_laboratoire" id="id_laboratoire" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                            @foreach($laboratoires as $laboratoire)
                                <option value="{{ $laboratoire->id_laboratoire }}" {{ old('id_laboratoire', $prof->id_laboratoire) == $laboratoire->id_laboratoire ? 'selected' : '' }}>
                                    {{ $laboratoire->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_laboratoire') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Professor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
