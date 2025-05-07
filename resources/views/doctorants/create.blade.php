@extends('layouts.app')
@section('title', 'Ajouter un Nouveau Doctorant')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Ajouter un Nouveau Doctorant</h1>

        <form action="{{ route('doctorants.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Personal Information -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold border-b pb-2">Informations Personnelles</h2>

                    <div>
                        <label for="cne" class="block text-sm font-medium text-gray-700">CNE</label>
                        <input type="text" name="cne" id="cne" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="cin" class="block text-sm font-medium text-gray-700">CIN</label>
                        <input type="text" name="cin" id="cin" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700">Nom (Français)</label>
                        <input type="text" name="nom" id="nom" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom (Français)</label>
                        <input type="text" name="prenom" id="prenom" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="nom_ar" class="block text-sm font-medium text-gray-700">الاسم (عربي)</label>
                        <input type="text" name="nom_ar" id="nom_ar" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-right" dir="rtl">
                    </div>

                    <div>
                        <label for="prenom_ar" class="block text-sm font-medium text-gray-700">النسب (عربي)</label>
                        <input type="text" name="prenom_ar" id="prenom_ar" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-right" dir="rtl">
                    </div>

                    <div>
                        <label for="date_naissance" class="block text-sm font-medium text-gray-700">Date de Naissance</label>
                        <input type="date" name="date_naissance" id="date_naissance" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="lieu_naissance" class="block text-sm font-medium text-gray-700">Lieu de Naissance</label>
                        <input type="text" name="lieu_naissance" id="lieu_naissance" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="nationalite" class="block text-sm font-medium text-gray-700">Nationalité</label>
                        <input type="text" name="nationalite" id="nationalite" required
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

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Fonctionnaire</label>
                        <div class="mt-1">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="fonctionnaire" value="1"
                                       class="rounded text-blue-600 focus:ring-blue-500">
                                <span class="ml-2">Oui</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Academic Information -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold border-b pb-2">Informations Académiques</h2>

                    <div>
                        <label for="bourse" class="block text-sm font-medium text-gray-700">Bourse</label>
                        <input type="text" name="bourse" id="bourse" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="formation" class="block text-sm font-medium text-gray-700">Formation</label>
                        <input type="text" name="formation" id="formation" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="sujet" class="block text-sm font-medium text-gray-700">Sujet de Thèse</label>
                        <textarea name="sujet" id="sujet" rows="3" required
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    </div>

                    <div>
                        <label for="id_prof" class="block text-sm font-medium text-gray-700">Directeur de Thèse</label>
                        <select name="id_prof" id="id_prof" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Sélectionner un professeur</option>
                            @foreach($profs as $prof)
                                <option value="{{ $prof->id_prof }}">{{ $prof->nom }} {{ $prof->prenom }}</option>
                            @endforeach
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

                    <div>
                        <label for="date_soutenance" class="block text-sm font-medium text-gray-700">Date de Soutenance (Optionnel)</label>
                        <input type="date" name="date_soutenance" id="date_soutenance"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="situation" class="block text-sm font-medium text-gray-700">Situation</label>
                        <input type="text" name="situation" id="situation" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="these" class="block text-sm font-medium text-gray-700">Titre de Thèse</label>
                        <input type="text" name="these" id="these" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="mention" class="block text-sm font-medium text-gray-700">Mention (Optionnel)</label>
                        <input type="text" name="mention" id="mention"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('doctorants.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
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
