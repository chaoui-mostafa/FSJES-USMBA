@extends('layouts.app')
@section('Title','Ajouter un Professeur')




@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Ajouter un Nouveau Professeur</h1>

        <form action="{{ route('profs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Personal Information -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold border-b pb-2">Informations Personnelles</h2>

                    <div>
                        <label for="nom_prenom" class="block text-sm font-medium text-gray-700">Nom Complet (Français)</label>
                        <input type="text" name="nom_prenom" id="nom_prenom" required value="{{ old('nom_prenom') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('nom_prenom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="nom_prenom_arabe" class="block text-sm font-medium text-gray-700">الاسم الكامل (عربي)</label>
                        <input type="text" name="nom_prenom_arabe" id="nom_prenom_arabe" required value="{{ old('nom_prenom_arabe') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-right" dir="rtl">
                        @error('nom_prenom_arabe') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="email_professionnel" class="block text-sm font-medium text-gray-700">Email Professionnel</label>
                        <input type="email" name="email_professionnel" id="email_professionnel" required value="{{ old('email_professionnel') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('email_professionnel') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="numero_telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                        <input type="tel" name="numero_telephone" id="numero_telephone" required value="{{ old('numero_telephone') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('numero_telephone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sexe</label>
                        <div class="mt-1 space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="sexe" value="M" required {{ old('sexe') == 'M' ? 'checked' : '' }}
                                       class="text-blue-600 focus:ring-blue-500">
                                <span class="ml-2">Masculin</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="sexe" value="F" {{ old('sexe') == 'F' ? 'checked' : '' }}
                                       class="text-blue-600 focus:ring-blue-500">
                                <span class="ml-2">Féminin</span>
                            </label>
                        </div>
                        @error('sexe') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Professional Information -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold border-b pb-2">Informations Professionnelles</h2>

                    <div>
                        <label for="grade" class="block text-sm font-medium text-gray-700">Grade (FR)</label>
                        <input type="text" name="grade" id="grade" required value="{{ old('grade') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('grade') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="grade_ar" class="block text-sm font-medium text-gray-700">الرتبة (AR)</label>
                        <input type="text" name="grade_ar" id="grade_ar" required value="{{ old('grade_ar') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-right" dir="rtl">
                        @error('grade_ar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="departement" class="block text-sm font-medium text-gray-700">Département (FR)</label>
                        <input type="text" name="departement" id="departement" required value="{{ old('departement') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('departement') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="departement_ar" class="block text-sm font-medium text-gray-700">القسم (AR)</label>
                        <input type="text" name="departement_ar" id="departement_ar" required value="{{ old('departement_ar') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-right" dir="rtl">
                        @error('departement_ar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="etablissement_fr" class="block text-sm font-medium text-gray-700">Établissement (FR)</label>
                        <input type="text" name="etablissement_fr" id="etablissement_fr" required value="{{ old('etablissement_fr') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('etablissement_fr') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="etablissement_ar" class="block text-sm font-medium text-gray-700">المؤسسة (AR)</label>
                        <input type="text" name="etablissement_ar" id="etablissement_ar" required value="{{ old('etablissement_ar') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-right" dir="rtl">
                        @error('etablissement_ar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                        <select name="type" id="type" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Sélectionner un type</option>
                            <option value="Permanent" {{ old('type') == 'Permanent' ? 'selected' : '' }}>Permanent</option>
                            <option value="Visiting" {{ old('type') == 'Visiting' ? 'selected' : '' }}>Visiting</option>
                            <option value="Associate" {{ old('type') == 'Associate' ? 'selected' : '' }}>Associate</option>
                        </select>
                        @error('type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="status_ar" class="block text-sm font-medium text-gray-700">الحالة (AR)</label>
                        <input type="text" name="status_ar" id="status_ar" value="{{ old('status_ar') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-right" dir="rtl">
                        @error('status_ar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="id_laboratoire" class="block text-sm font-medium text-gray-700">Laboratoire</label>
                        <select name="id_laboratoire" id="id_laboratoire"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Sélectionner un laboratoire</option>
                            @foreach($laboratoires as $laboratoire)
                                <option value="{{ $laboratoire->id }}" {{ old('id_laboratoire') == $laboratoire->id ? 'selected' : '' }}>
                                    {{ $laboratoire->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_laboratoire') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="doc" class="block text-sm font-medium text-gray-700">Document</label>
                        <input type="file" name="doc" id="doc"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('doc') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('profs.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Annuler
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
