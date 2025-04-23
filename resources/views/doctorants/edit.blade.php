@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Edit Doctorant</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Update the doctorant information</p>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
            <form action="{{ route('doctorants.update', $doctorant->id) }}" method="POST" class="divide-y divide-gray-200">
                @csrf
                @method('PUT')
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <label for="nom" class="block text-sm font-medium text-gray-700">Last Name (FR)</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <input type="text" name="nom" id="nom" value="{{ old('nom', $doctorant->nom) }}" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @error('nom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50">
                    <label for="prenom" class="block text-sm font-medium text-gray-700">First Name (FR)</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $doctorant->prenom) }}" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @error('prenom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <label for="nom_ar" class="block text-sm font-medium text-gray-700">Last Name (AR)</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <input type="text" name="nom_ar" id="nom_ar" value="{{ old('nom_ar', $doctorant->nom_ar) }}" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @error('nom_ar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50">
                    <label for="prenom_ar" class="block text-sm font-medium text-gray-700">First Name (AR)</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <input type="text" name="prenom_ar" id="prenom_ar" value="{{ old('prenom_ar', $doctorant->prenom_ar) }}" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @error('prenom_ar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <label for="date_naissance" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <input type="date" name="date_naissance" id="date_naissance" value="{{ old('date_naissance', $doctorant->date_naissance->format('Y-m-d')) }}" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @error('date_naissance') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50">
                    <label for="lieu_naissance" class="block text-sm font-medium text-gray-700">Place of Birth</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <input type="text" name="lieu_naissance" id="lieu_naissance" value="{{ old('lieu_naissance', $doctorant->lieu_naissance) }}" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @error('lieu_naissance') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <label for="nationalite" class="block text-sm font-medium text-gray-700">Nationality</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <input type="text" name="nationalite" id="nationalite" value="{{ old('nationalite', $doctorant->nationalite) }}" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @error('nationalite') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50">
                    <label for="fonctionnaire" class="block text-sm font-medium text-gray-700">Civil Servant</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <select name="fonctionnaire" id="fonctionnaire" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                            <option value="1" {{ old('fonctionnaire', $doctorant->fonctionnaire) == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('fonctionnaire', $doctorant->fonctionnaire) == 0 ? 'selected' : '' }}>No</option>
                        </select>
                        @error('fonctionnaire') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <label for="bourse" class="block text-sm font-medium text-gray-700">Scholarship</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <input type="text" name="bourse" id="bourse" value="{{ old('bourse', $doctorant->bourse) }}" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @error('bourse') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50">
                    <label for="formation" class="block text-sm font-medium text-gray-700">Formation</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <input type="text" name="formation" id="formation" value="{{ old('formation', $doctorant->formation) }}" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @error('formation') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <label for="these" class="block text-sm font-medium text-gray-700">Thesis Title</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <input type="text" name="these" id="these" value="{{ old('these', $doctorant->these) }}" class="block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 rounded-md">
                        @error('these') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50">
                    <label for="sujet" class="block text-sm font-medium text-gray-700">Thesis Subject</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <textarea name="sujet" id="sujet" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('sujet', $doctorant->sujet) }}</textarea>
                        @error('sujet') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <label for="id_prof" class="block text-sm font-medium text-gray-700">Supervisor</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <select name="id_prof" id="id_prof" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                            @foreach($profs as $prof)
                                <option value="{{ $prof->id_prof }}" {{ old('id_prof', $doctorant->id_prof) == $prof->id_prof ? 'selected' : '' }}>
                                    {{ $prof->nom }} {{ $prof->prenom }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_prof') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50">
                    <label for="id_laboratoire" class="block text-sm font-medium text-gray-700">Laboratory</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <select name="id_laboratoire" id="id_laboratoire" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                            @foreach($laboratoires as $laboratoire)
                                <option value="{{ $laboratoire->id_laboratoire }}" {{ old('id_laboratoire', $doctorant->id_laboratoire) == $laboratoire->id_laboratoire ? 'selected' : '' }}>
                                    {{ $laboratoire->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_laboratoire') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <label for="date_soutenance" class="block text-sm font-medium text-gray-700">Defense Date</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <input type="date" name="date_soutenance" id="date_soutenance" value="{{ old('date_soutenance', $doctorant->date_soutenance ? $doctorant->date_soutenance->format('Y-m-d') : '') }}" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        @error('date_soutenance') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50">
                    <label for="situation" class="block text-sm font-medium text-gray-700">Status</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <select name="situation" id="situation" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                            <option value="In Progress" {{ old('situation', $doctorant->situation) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Submitted" {{ old('situation', $doctorant->situation) == 'Submitted' ? 'selected' : '' }}>Submitted</option>
                            <option value="Defended" {{ old('situation', $doctorant->situation) == 'Defended' ? 'selected' : '' }}>Defended</option>
                            <option value="Graduated" {{ old('situation', $doctorant->situation) == 'Graduated' ? 'selected' : '' }}>Graduated</option>
                        </select>
                        @error('situation') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <label for="mention" class="block text-sm font-medium text-gray-700">Mention</label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <select name="mention" id="mention" class="max-w-lg block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                            <option value="">Select mention</option>
                            <option value="Honorable" {{ old('mention', $doctorant->mention) == 'Honorable' ? 'selected' : '' }}>Honorable</option>
                            <option value="Very Honorable" {{ old('mention', $doctorant->mention) == 'Very Honorable' ? 'selected' : '' }}>Very Honorable</option>
                            <option value="Très Honorable" {{ old('mention', $doctorant->mention) == 'Très Honorable' ? 'selected' : '' }}>Très Honorable</option>
                        </select>
                        @error('mention') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Doctorant
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
