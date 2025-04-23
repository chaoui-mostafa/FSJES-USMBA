@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Ajouter un Nouveau Professeur</h1>

        <form action="{{ route('profs.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Personal Information -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold border-b pb-2">Informations Personnelles</h2>

                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700">Nom (Français)</label>
                        <input type="text" name="nom" id="nom" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="nom_ar" class="block text-sm font-medium text-gray-700">الاسم (عربي)</label>
                        <input type="text" name="nom_ar" id="nom_ar" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-right" dir="rtl">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                        <input type="tel" name="telephone" id="telephone" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sexe</label>
                        <div class="mt-1 space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="sexe" value="M" required
                                       class="text-blue-600 focus:ring-blue-500">
                                <span class="ml-2">Masculin</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="sexe" value="F"
                                       class="text-blue-600 focus:ring-blue-500">
                                <span class="ml-2">Féminin</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Professional Information -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold border-b pb-2">Informations Professionnelles</h2>

                    <div>
                        <label for="grade" class="block text-sm font-medium text-gray-700">Grade</label>
                        <select name="grade" id="grade" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Sélectionner un grade</option>
                            <option value="Professeur">Professeur</option>
                            <option value="Maître de conférences">Maître de conférences</option>
                            <option value="Docteur">Docteur</option>
                            <option value="Chercheur">Chercheur</option>
                        </select>
                    </div>

                    <div>
                        <label for="etablissement" class="block text-sm font-medium text-gray-700">Établissement</label>
                        <input type="text" name="etablissement" id="etablissement" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="departement" class="block text-sm font-medium text-gray-700">Département</label>
                        <input type="text" name="departement" id="departement" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                        <select name="type" id="type" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Sélectionner un type</option>
                            <option value="Permanent">Permanent</option>
                            <option value="Vacataire">Vacataire</option>
                            <option value="Associé">Associé</option>
                        </select>
                    </div>

                    <div>
                        <label for="id_laboratoire" class="block text-sm font-medium text-gray-700">Laboratoire</label>
                        <select name="id_laboratoire" id="id_laboratoire" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Sélectionner un laboratoire</option>
                            @foreach($laboratoires as $laboratoire)
                                <option value="{{ $laboratoire->id_laboratoire }}">{{ $laboratoire->nom }}</option>
                            @endforeach
                        </select>
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
