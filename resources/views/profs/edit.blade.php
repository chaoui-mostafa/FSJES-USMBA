@extends('layouts.app')

@section('title', 'Modifier du Professeur')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">Modifier le Professeur</h1>

        <form action="{{ route('profs.update', $prof->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Personal Information -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold border-b pb-2 text-gray-800 dark:text-gray-200">Informations Personnelles</h2>

                    <div>
                        <label for="nom_prenom" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom Complet (Français)</label>
                        <input type="text" name="nom_prenom" id="nom_prenom" required
                            value="{{ old('nom_prenom', $prof->nom_prenom) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        @error('nom_prenom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="nom_prenom_arabe" class="block text-sm font-medium text-gray-700 dark:text-gray-300">الاسم الكامل (عربي)</label>
                        <input type="text" name="nom_prenom_arabe" id="nom_prenom_arabe" required
                            value="{{ old('nom_prenom_arabe', $prof->nom_prenom_arabe) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-right" dir="rtl">
                        @error('nom_prenom_arabe') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="email_professionnel" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Professionnel</label>
                        <input type="email" name="email_professionnel" id="email_professionnel" required
                            value="{{ old('email_professionnel', $prof->email_professionnel) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        @error('email_professionnel') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="numero_telephone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Téléphone</label>
                        <input type="tel" name="numero_telephone" id="numero_telephone" required
                            value="{{ old('numero_telephone', $prof->numero_telephone) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        @error('numero_telephone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sexe</label>
                        <div class="mt-1 space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="sexe" value="M" required
                                    {{ old('sexe', $prof->sexe) == 'M' ? 'checked' : '' }}
                                    class="text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                                <span class="ml-2 text-gray-700 dark:text-gray-300">Masculin</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="sexe" value="F"
                                    {{ old('sexe', $prof->sexe) == 'F' ? 'checked' : '' }}
                                    class="text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                                <span class="ml-2 text-gray-700 dark:text-gray-300">Féminin</span>
                            </label>
                        </div>
                        @error('sexe') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="genre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Genre</label>
                        <input type="text" name="genre" id="genre" required
                            value="{{ old('genre', $prof->genre) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        @error('genre') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Professional Information -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold border-b pb-2 text-gray-800 dark:text-gray-200">Informations Professionnelles</h2>

                    <div>
                        <label for="grade" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Grade (FR)</label>
                        <input type="text" name="grade" id="grade" required
                            value="{{ old('grade', $prof->grade) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        @error('grade') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="grade_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">الرتبة (AR)</label>
                        <input type="text" name="grade_ar" id="grade_ar" required
                            value="{{ old('grade_ar', $prof->grade_ar) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-right" dir="rtl">
                        @error('grade_ar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="departement" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Département (FR)</label>
                        <input type="text" name="departement" id="departement" required
                            value="{{ old('departement', $prof->departement) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        @error('departement') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="departement_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">القسم (AR)</label>
                        <input type="text" name="departement_ar" id="departement_ar" required
                            value="{{ old('departement_ar', $prof->departement_ar) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-right" dir="rtl">
                        @error('departement_ar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="etablissement_fr" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Établissement (FR)</label>
                        <input type="text" name="etablissement_fr" id="etablissement_fr" required
                            value="{{ old('etablissement_fr', $prof->etablissement_fr) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        @error('etablissement_fr') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="etablissement_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">المؤسسة (AR)</label>
                        <input type="text" name="etablissement_ar" id="etablissement_ar" required
                            value="{{ old('etablissement_ar', $prof->etablissement_ar) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-right" dir="rtl">
                        @error('etablissement_ar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                        <select name="type" id="type" required
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            <option value="">Sélectionner un type</option>
                            <option value="Permanent" {{ old('type', $prof->type) == 'Permanent' ? 'selected' : '' }}>Permanent</option>
                            <option value="Visiting" {{ old('type', $prof->type) == 'Visiting' ? 'selected' : '' }}>Visiting</option>
                            <option value="Associate" {{ old('type', $prof->type) == 'Associate' ? 'selected' : '' }}>Associate</option>
                        </select>
                        @error('type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="status_ar" class="block text-sm font-medium text-gray-700 dark:text-gray-300">الحالة (AR)</label>
                        <input type="text" name="status_ar" id="status_ar"
                            value="{{ old('status_ar', $prof->status_ar) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-right" dir="rtl">
                        @error('status_ar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="id_laboratoire" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Laboratoire</label>
                        <select name="id_laboratoire" id="id_laboratoire"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                            <option value="">Sélectionner un laboratoire</option>
                            @foreach($laboratoires as $laboratoire)
                            <option value="{{ $laboratoire->id }}" {{ old('id_laboratoire', $prof->id_laboratoire) == $laboratoire->id ? 'selected' : '' }}>
                                {{ $laboratoire->nom }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_laboratoire') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="doc" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Doc</label>
                        <input type="text" name="doc" id="doc" required
                            value="{{ old('doc', $prof->doc) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        @error('doc') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('profs.index') }}" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    Annuler
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
