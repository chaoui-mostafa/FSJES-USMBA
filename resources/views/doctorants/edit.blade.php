@extends('layouts.app')
@section('title', 'Modifier le Doctorant')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl rounded-xl overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-4">
            <h2 class="text-xl font-bold text-white">Modifier le Doctorant</h2>
        </div>

        <form action="{{ route('doctorants.update', $doctorant->id) }}" method="POST" enctype="multipart/form-data" class="px-6 py-5">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Photo Upload -->
                <div class="flex items-center space-x-6">
                    <div class="shrink-0">
                        @if($doctorant->photo)
                            <img id='preview_img' class="h-24 w-24 object-cover rounded-full border-2 border-gray-300" src="{{ asset('storage/' . $doctorant->photo) }}" alt="Photo actuelle" />
                        @else
                            <div class="h-24 w-24 rounded-full bg-gray-200 flex items-center justify-center border-2 border-gray-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <label class="block">
                        <span class="sr-only">Choisir une photo</span>
                        <input type="file" name="IMAGE" id="IMAGE" class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100
                        "/>
                    </label>
                </div>

                <!-- Informations personnelles -->
                <div class="border-b border-gray-200 pb-5">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <svg class="mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informations Personnelles
                    </h3>

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- NUMERO -->
                        <div>
                            <label for="NUMERO" class="block text-sm font-medium text-gray-700">Numéro</label>
                            <input type="text" name="NUMERO" id="NUMERO" value="{{ old('NUMERO', $doctorant->NUMERO) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <!-- CNE -->
                        <div>
                            <label for="CNE" class="block text-sm font-medium text-gray-700">CNE</label>
                            <input type="text" name="CNE" id="CNE" value="{{ old('CNE', $doctorant->CNE) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <!-- CIN -->
                        <div>
                            <label for="CIN" class="block text-sm font-medium text-gray-700">CIN</label>
                            <input type="text" name="CIN" id="CIN" value="{{ old('CIN', $doctorant->CIN) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <!-- NOM -->
                        <div>
                            <label for="NOM" class="block text-sm font-medium text-gray-700">Nom (FR)</label>
                            <input type="text" name="NOM" id="NOM" value="{{ old('NOM', $doctorant->NOM) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <!-- PRENOM -->
                        <div>
                            <label for="PRENOM" class="block text-sm font-medium text-gray-700">Prénom (FR)</label>
                            <input type="text" name="PRENOM" id="PRENOM" value="{{ old('PRENOM', $doctorant->PRENOM) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <!-- NOMAR -->
                        <div>
                            <label for="NOMAR" class="block text-sm font-medium text-gray-700">Nom (AR)</label>
                            <input type="text" name="NOMAR" id="NOMAR" value="{{ old('NOMAR', $doctorant->NOMAR) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" dir="rtl">
                        </div>

                        <!-- PRENOMAR -->
                        <div>
                            <label for="PRENOMAR" class="block text-sm font-medium text-gray-700">Prénom (AR)</label>
                            <input type="text" name="PRENOMAR" id="PRENOMAR" value="{{ old('PRENOMAR', $doctorant->PRENOMAR) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" dir="rtl">
                        </div>

                        <!-- DATENAISSANCE -->
                        <div>
                            <label for="DATENAISSANCE" class="block text-sm font-medium text-gray-700">Date de naissance</label>
                            <input type="date" name="DATENAISSANCE" id="DATENAISSANCE" value="{{ old('DATENAISSANCE', optional($doctorant->DATENAISSANCE)->format('Y-m-d')) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <!-- LIEUNAISSANCE -->
                        <div>
                            <label for="LIEUNAISSANCE" class="block text-sm font-medium text-gray-700">Lieu de naissance</label>
                            <input type="text" name="LIEUNAISSANCE" id="LIEUNAISSANCE" value="{{ old('LIEUNAISSANCE', $doctorant->LIEUNAISSANCE) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <!-- LIEUNAISSANCEAR -->
                        <div>
                            <label for="LIEUNAISSANCEAR" class="block text-sm font-medium text-gray-700">Lieu de naissance (AR)</label>
                            <input type="text" name="LIEUNAISSANCEAR" id="LIEUNAISSANCEAR" value="{{ old('LIEUNAISSANCEAR', $doctorant->LIEUNAISSANCEAR) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" dir="rtl">
                        </div>

                        <!-- SEXE -->
                        <div>
                            <label for="SEXE" class="block text-sm font-medium text-gray-700">Sexe</label>
                            <select id="SEXE" name="SEXE" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                <option value="M" {{ old('SEXE', $doctorant->SEXE) == 'M' ? 'selected' : '' }}>Masculin</option>
                                <option value="F" {{ old('SEXE', $doctorant->SEXE) == 'F' ? 'selected' : '' }}>Féminin</option>
                            </select>
                        </div>

                        <!-- NATIONALITE -->
                        <div>
                            <label for="NATIONALITE" class="block text-sm font-medium text-gray-700">Nationalité</label>
                            <input type="text" name="NATIONALITE" id="NATIONALITE" value="{{ old('NATIONALITE', $doctorant->NATIONALITE) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <!-- EMAIL -->
                        <div>
                            <label for="EMAIL" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="EMAIL" id="EMAIL" value="{{ old('EMAIL', $doctorant->EMAIL) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <!-- TELEPHONE -->
                        <div>
                            <label for="TELEPHONE" class="block text-sm font-medium text-gray-700">Téléphone</label>
                            <input type="text" name="TELEPHONE" id="TELEPHONE" value="{{ old('TELEPHONE', $doctorant->TELEPHONE) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Informations académiques -->
                <div class="border-b border-gray-200 pb-5">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <svg class="mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                        </svg>
                        Informations Académiques
                    </h3>

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- FONCTIONNAIRE -->
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="FONCTIONNAIRE" name="FONCTIONNAIRE" type="checkbox" {{ old('FONCTIONNAIRE', $doctorant->FONCTIONNAIRE) ? 'checked' : '' }}
                                    class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="FONCTIONNAIRE" class="font-medium text-gray-700">Fonctionnaire</label>
                            </div>
                        </div>

                        <!-- BOURSE -->
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="BOURSE" name="BOURSE" type="checkbox" {{ old('BOURSE', $doctorant->BOURSE) ? 'checked' : '' }}
                                    class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="BOURSE" class="font-medium text-gray-700">Boursier</label>
                            </div>
                        </div>

                        <!-- PROMO -->
                        <div>
                            <label for="PROMO" class="block text-sm font-medium text-gray-700">Promotion</label>
                            <input type="text" name="PROMO" id="PROMO" value="{{ old('PROMO', $doctorant->PROMO) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <!-- FORMATION -->
                        <div>
                            <label for="FORMATION" class="block text-sm font-medium text-gray-700">Formation</label>
                            <input type="text" name="FORMATION" id="FORMATION" value="{{ old('FORMATION', $doctorant->FORMATION) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <!-- LABORATOIRE -->
                        <div>
                            <label for="LABORATOIRE" class="block text-sm font-medium text-gray-700">Laboratoire</label>
                            <input type="text" name="LABORATOIRE" id="LABORATOIRE" value="{{ old('LABORATOIRE', $doctorant->LABORATOIRE) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <!-- SITUATION -->
                        <div>
                            <label for="SITUATION" class="block text-sm font-medium text-gray-700">Situation</label>
                            <input type="text" name="SITUATION" id="SITUATION" value="{{ old('SITUATION', $doctorant->SITUATION) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Informations sur la thèse -->
                <div class="border-b border-gray-200 pb-5">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <svg class="mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Informations sur la Thèse
                    </h3>

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- THESE -->
                        <div class="md:col-span-2">
                            <label for="THESE" class="block text-sm font-medium text-gray-700">Titre de la thèse</label>
                            <input type="text" name="THESE" id="THESE" value="{{ old('THESE', $doctorant->THESE) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <!-- SUJET -->
                        <div class="md:col-span-2">
                            <label for="SUJET" class="block text-sm font-medium text-gray-700">Sujet de la thèse</label>
                            <textarea id="SUJET" name="SUJET" rows="3"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('SUJET', $doctorant->SUJET) }}</textarea>
                        </div>

                        <!-- DATESOUTENANCE -->
                        <div>
                            <label for="DATESOUTENANCE" class="block text-sm font-medium text-gray-700">Date de soutenance</label>
                            <input type="date" name="DATESOUTENANCE" id="DATESOUTENANCE" value="{{ old('DATESOUTENANCE', optional($doctorant->DATESOUTENANCE)->format('Y-m-d')) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <!-- ANNEESOUTENANCE -->
                        <div>
                            <label for="ANNEESOUTENANCE" class="block text-sm font-medium text-gray-700">Année de soutenance</label>
                            <input type="text" name="ANNEESOUTENANCE" id="ANNEESOUTENANCE" value="{{ old('ANNEESOUTENANCE', $doctorant->ANNEESOUTENANCE) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <!-- MENTIONFR -->
                        <div>
                            <label for="MENTIONFR" class="block text-sm font-medium text-gray-700">Mention (FR)</label>
                            <input type="text" name="MENTIONFR" id="MENTIONFR" value="{{ old('MENTIONFR', $doctorant->MENTIONFR) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <!-- MENTIONAR -->
                        <div>
                            <label for="MENTIONAR" class="block text-sm font-medium text-gray-700">Mention (AR)</label>
                            <input type="text" name="MENTIONAR" id="MENTIONAR" value="{{ old('MENTIONAR', $doctorant->MENTIONAR) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" dir="rtl">
                        </div>

                        <!-- REMARQUE -->
                        <div class="md:col-span-2">
                            <label for="REMARQUE" class="block text-sm font-medium text-gray-700">Remarques</label>
                            <textarea id="REMARQUE" name="REMARQUE" rows="3"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('REMARQUE', $doctorant->REMARQUE) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Encadrants -->
                <div class="border-b border-gray-200 pb-5">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <svg class="mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Encadrants
                    </h3>

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- ENCADRANT -->
                        <div>
                            <label for="ENCADRANT" class="block text-sm font-medium text-gray-700">Encadrant principal</label>
                            <input type="text" name="ENCADRANT" id="ENCADRANT" value="{{ old('ENCADRANT', $doctorant->ENCADRANT) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <!-- COENCADRANT -->
                        <div>
                            <label for="COENCADRANT" class="block text-sm font-medium text-gray-700">Co-encadrant</label>
                            <input type="text" name="COENCADRANT" id="COENCADRANT" value="{{ old('COENCADRANT', $doctorant->COENCADRANT) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Rapporteurs -->
                <div class="border-b border-gray-200 pb-5">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <svg class="mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Rapporteurs
                    </h3>

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                        @for($i = 1; $i <= 3; $i++)
                            @php
                                $rapporteur = 'RAPPORTEUR'.$i;
                                $etat = 'Etat_Rapporteur'.$i;
                                $depot = 'DateDeDepotRapport'.$i;
                            @endphp
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-700 mb-3">Rapporteur {{ $i }}</h4>
                                <div class="space-y-3">
                                    <div>
                                        <label for="{{ $rapporteur }}" class="block text-xs font-medium text-gray-500">Nom</label>
                                        <input type="text" name="{{ $rapporteur }}" id="{{ $rapporteur }}" value="{{ old($rapporteur, $doctorant->$rapporteur) }}"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-xs">
                                    </div>
                                    <div>
                                        <label for="{{ $etat }}" class="block text-xs font-medium text-gray-500">État</label>
                                        <input type="text" name="{{ $etat }}" id="{{ $etat }}" value="{{ old($etat, $doctorant->$etat) }}"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-xs">
                                    </div>
                                    <div>
                                        <label for="{{ $depot }}" class="block text-xs font-medium text-gray-500">Date de dépôt</label>
                                        <input type="date" name="{{ $depot }}" id="{{ $depot }}" value="{{ old($depot, optional(data_get($doctorant, $depot))->format('Y-m-d')) }}"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-xs">
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Jury -->
                <div class="pb-5">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <svg class="mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Membres du Jury
                    </h3>

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @for($i = 1; $i <= 7; $i++)
                            @php
                                $jury = 'JURY'.$i;
                                $grade = 'GRADE'.$i;
                                $status = 'STATUS'.$i;
                            @endphp
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-700 mb-3">Membre du Jury {{ $i }}</h4>
                                <div class="space-y-3">
                                    <div>
                                        <label for="{{ $jury }}" class="block text-xs font-medium text-gray-500">Nom</label>
                                        <input type="text" name="{{ $jury }}" id="{{ $jury }}" value="{{ old($jury, $doctorant->$jury) }}"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-xs">
                                    </div>
                                    <div>
                                        <label for="{{ $grade }}" class="block text-xs font-medium text-gray-500">Grade</label>
                                        <input type="text" name="{{ $grade }}" id="{{ $grade }}" value="{{ old($grade, $doctorant->$grade) }}"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-xs">
                                    </div>
                                    <div>
                                        <label for="{{ $status }}" class="block text-xs font-medium text-gray-500">Statut</label>
                                        <input type="text" name="{{ $status }}" id="{{ $status }}" value="{{ old($status, $doctorant->$status) }}"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-xs">
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('doctorants.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Annuler
                </a>
                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Image preview
    document.getElementById('IMAGE').addEventListener('change', function(event) {
        const output = document.getElementById('preview_img');
        if (event.target.files && event.target.files[0]) {
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src);
            }
        }
    });
</script>
@endsection
