@extends('layouts.app')
@section('Title','Ajouter un Professeur')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow-xl rounded-xl overflow-hidden">
        <!-- Form Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4">
            <h1 class="text-2xl font-bold text-white">Ajouter un Nouveau Professeur</h1>
            <p class="text-blue-100">Remplissez le formulaire pour enregistrer un nouveau professeur</p>
        </div>

        <form action="{{ route('profs.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Personal Information -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-2 border-b border-blue-100 pb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <h2 class="text-lg font-semibold text-gray-800">Informations Personnelles</h2>
                    </div>

                    <div class="form-group">
                        <label for="nom_prenom" class="form-label">Nom Complet (Français)</label>
                        <div class="relative">
                            <input type="text" name="nom_prenom" id="nom_prenom" required value="{{ old('nom_prenom') }}"
                                   class="form-input pl-10">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </div>
                        @error('nom_prenom') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="nom_prenom_arabe" class="form-label">الاسم الكامل (عربي)</label>
                        <div class="relative">
                            <input type="text" name="nom_prenom_arabe" id="nom_prenom_arabe" required value="{{ old('nom_prenom_arabe') }}"
                                   class="form-input pr-10 text-right" dir="rtl">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </div>
                        @error('nom_prenom_arabe') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="email_professionnel" class="form-label">Email Professionnel</label>
                        <div class="relative">
                            <input type="email" name="email_professionnel" id="email_professionnel" required value="{{ old('email_professionnel') }}"
                                   class="form-input pl-10">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        @error('email_professionnel') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="numero_telephone" class="form-label">Téléphone</label>
                        <div class="relative">
                            <input type="tel" name="numero_telephone" id="numero_telephone" required value="{{ old('numero_telephone') }}"
                                   class="form-input pl-10">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                        </div>
                        @error('numero_telephone') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Sexe</label>
                        <div class="flex flex-wrap gap-4 mt-1">
                            <label class="inline-flex items-center">
                                <input type="radio" name="sexe" value="M" required {{ old('sexe') == 'M' ? 'checked' : '' }}
                                       class="form-radio text-blue-600 h-4 w-4">
                                <span class="ml-2 text-gray-700">Masculin</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="sexe" value="F" {{ old('sexe') == 'F' ? 'checked' : '' }}
                                       class="form-radio text-blue-600 h-4 w-4">
                                <span class="ml-2 text-gray-700">Féminin</span>
                            </label>
                        </div>
                        @error('sexe') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Professional Information -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-2 border-b border-blue-100 pb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <h2 class="text-lg font-semibold text-gray-800">Informations Professionnelles</h2>
                    </div>

                    <div class="form-group">
                        <label for="grade" class="form-label">Grade (FR)</label>
                        <input type="text" name="grade" id="grade" required value="{{ old('grade') }}"
                               class="form-input">
                        @error('grade') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="grade_ar" class="form-label">الرتبة (AR)</label>
                        <input type="text" name="grade_ar" id="grade_ar" required value="{{ old('grade_ar') }}"
                               class="form-input text-right" dir="rtl">
                        @error('grade_ar') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="departement" class="form-label">Département (FR)</label>
                        <input type="text" name="departement" id="departement" required value="{{ old('departement') }}"
                               class="form-input">
                        @error('departement') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="departement_ar" class="form-label">القسم (AR)</label>
                        <input type="text" name="departement_ar" id="departement_ar" required value="{{ old('departement_ar') }}"
                               class="form-input text-right" dir="rtl">
                        @error('departement_ar') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="etablissement_fr" class="form-label">Établissement (FR)</label>
                        <input type="text" name="etablissement_fr" id="etablissement_fr" required value="{{ old('etablissement_fr') }}"
                               class="form-input">
                        @error('etablissement_fr') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="etablissement_ar" class="form-label">المؤسسة (AR)</label>
                        <input type="text" name="etablissement_ar" id="etablissement_ar" required value="{{ old('etablissement_ar') }}"
                               class="form-input text-right" dir="rtl">
                        @error('etablissement_ar') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="type" class="form-label">Type</label>
                        <select name="type" id="type" required class="form-select">
                            <option value="">Sélectionner un type</option>
                            <option value="Permanent" {{ old('type') == 'Permanent' ? 'selected' : '' }}>Permanent</option>
                            <option value="Visiting" {{ old('type') == 'Visiting' ? 'selected' : '' }}>Visiting</option>
                            <option value="Associate" {{ old('type') == 'Associate' ? 'selected' : '' }}>Associate</option>
                        </select>
                        @error('type') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="status_ar" class="form-label">الحالة (AR)</label>
                        <input type="text" name="status_ar" id="status_ar" value="{{ old('status_ar') }}"
                               class="form-input text-right" dir="rtl">
                        @error('status_ar') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="id_laboratoire" class="form-label">Laboratoire</label>
                        <select name="id_laboratoire" id="id_laboratoire" class="form-select">
                            <option value="">Sélectionner un laboratoire</option>
                            @foreach($laboratoires as $laboratoire)
                                <option value="{{ $laboratoire->id }}" {{ old('id_laboratoire') == $laboratoire->id ? 'selected' : '' }}>
                                    {{ $laboratoire->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_laboratoire') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="doc" class="form-label">Doc</label>
                        <input type="text" name="doc" id="doc" value="{{ old('doc') }}" class="form-input">
                        @error('doc') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="mt-8 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
                <a href="{{ route('profs.index') }}" class="btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Annuler
                </a>
                <button type="submit" class="btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .form-label {
        @apply block text-sm font-medium text-gray-700 mb-1;
    }
    .form-input {
        @apply mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm py-2 px-3 border;
    }
    .form-select {
        @apply mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm;
    }
    .form-radio {
        @apply focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300;
    }
    .form-error {
        @apply text-red-500 text-xs mt-1;
    }
    .btn-primary {
        @apply inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500;
    }
    .btn-secondary {
        @apply inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500;
    }
    .form-group {
        @apply mb-4;
    }
</style>

<script>
    function updateFileName(input) {
        const fileName = input.files[0]?.name || 'Choisir un fichier';
        document.getElementById('file-name').textContent = fileName;
    }
</script>
@endsection
