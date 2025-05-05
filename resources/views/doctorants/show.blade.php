@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
<x-sidebar-documents :doctorant="$doctorant" />
    <div class="bg-white shadow-xl rounded-xl overflow-hidden">
        <!-- En-tête avec photo et actions -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-8">
            <div class="flex flex-col md:flex-row items-center">
                <!-- Photo -->
                <div class="relative w-32 h-32 mb-4 md:mb-0 md:mr-6">
                    @if($doctorant->IMAGE)
                        <img src="{{ asset('storage/' . $doctorant->IMAGE) }}" alt="Photo de profil"
                             class="w-full h-full rounded-full object-cover border-4 border-white/30 shadow-md">
                    @else
                        <div class="w-full h-full rounded-full bg-white/20 flex items-center justify-center border-4 border-white/30 shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    @endif
                </div>

                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-2xl font-bold text-white">{{ $doctorant->NOM }} {{ $doctorant->PRENOM }}</h1>
                    <p class="text-blue-100">{{ $doctorant->THESE }}</p>
                    <div class="flex flex-wrap gap-2 mt-2 justify-center md:justify-start">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $doctorant->CNE }}
                        </span>
                        @if($doctorant->PROMO)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                            Promotion: {{ $doctorant->PROMO }}
                        </span>
                        @endif
                        @if($doctorant->MENTIONFR)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Mention: {{ $doctorant->MENTIONFR }}
                        </span>
                        @endif
                    </div>
                </div>

                <div class="flex space-x-2 mt-4 md:mt-0">
                    <a href="{{ route('doctorants.edit', $doctorant->id) }}"
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white transition-colors duration-200">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Modifier
                    </a>
                    <form action="{{ route('doctorants.destroy', $doctorant->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce doctorant ?')">
                            <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sections de détails -->
        <div class="divide-y divide-gray-200">
            <!-- Informations personnelles -->
            <div class="px-6 py-5">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-medium text-gray-900 flex items-center">
                        <svg class="mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informations Personnelles
                    </h3>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        Doctorant
                    </span>
                </div>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500">CIN</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $doctorant->CIN ?? 'N/A' }}</dd>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500">Nom complet (AR)</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $doctorant->NOMAR }} {{ $doctorant->PRENOMAR }}</dd>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500">Date de naissance</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ optional($doctorant->DATENAISSANCE)->format('d/m/Y') ?? 'N/A' }}</dd>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500">Lieu de naissance</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $doctorant->LIEUNAISSANCE ?? 'N/A' }}</dd>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500">Nationalité</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $doctorant->NATIONALITE ?? 'N/A' }}</dd>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500">Sexe</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $doctorant->SEXE == 'M' ? 'Masculin' : 'Féminin' }}</dd>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $doctorant->EMAIL ?? 'N/A' }}</dd>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500">Téléphone</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $doctorant->TELEPHONE ?? 'N/A' }}</dd>
                    </div>
                </div>
            </div>

            <!-- Informations académiques -->
            <div class="px-6 py-5">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <svg class="mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                    </svg>
                    Informations Académiques
                </h3>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500">Fonctionnaire</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $doctorant->FONCTIONNAIRE ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $doctorant->FONCTIONNAIRE ? 'Oui' : 'Non' }}
                            </span>
                        </dd>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500">Boursier</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $doctorant->BOURSE ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $doctorant->BOURSE ? 'Oui' : 'Non' }}
                            </span>
                        </dd>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500">Formation</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $doctorant->FORMATION ?? 'N/A' }}</dd>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500">Laboratoire</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $doctorant->LABORATOIRE ?? 'N/A' }}</dd>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500">Promotion</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $doctorant->PROMO ?? 'N/A' }}</dd>
                    </div>
                </div>
            </div>

            <!-- Informations sur la thèse -->
            <div class="px-6 py-5">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <svg class="mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Informations sur la Thèse
                </h3>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500">Titre de la thèse</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $doctorant->THESE ?? 'N/A' }}</dd>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500">Sujet de la thèse</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $doctorant->SUJET ?? 'N/A' }}</dd>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500">Date de soutenance</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            @if($doctorant->DATESOUTENANCE)
                                {{ $doctorant->DATESOUTENANCE->format('d/m/Y') }}
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $doctorant->ANNEESOUTENANCE }}
                                </span>
                            @else
                                Non programmée
                            @endif
                        </dd>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500">Mention (FR)</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $doctorant->MENTIONFR ?? 'N/A' }}</dd>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500">Mention (AR)</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $doctorant->MENTIONAR ?? 'N/A' }}</dd>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500">Situation</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $doctorant->SITUATION ?? 'N/A' }}</dd>
                    </div>
                </div>
            </div>

            <!-- Encadrants -->
            <div class="px-6 py-5">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <svg class="mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Encadrants
                </h3>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500">Encadrant principal</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $doctorant->ENCADRANT ?? 'N/A' }}</dd>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <dt class="text-sm font-medium text-gray-500">Co-encadrant</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $doctorant->COENCADRANT ?? 'N/A' }}</dd>
                    </div>
                </div>
            </div>

            <!-- Membres du jury -->
            @if($doctorant->JURY1 || $doctorant->JURY2 || $doctorant->JURY3)
            <div class="px-6 py-5">
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
                        @if($doctorant->$jury)
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <dt class="text-sm font-medium text-gray-500">Membre du jury {{ $i }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <div>{{ $doctorant->$jury }}</div>
                                <div class="text-xs text-gray-500 mt-1">
                                    <span class="font-medium">Grade:</span> {{ $doctorant->$grade ?? 'N/A' }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    <span class="font-medium">Statut:</span> {{ $doctorant->$status ?? 'N/A' }}
                                </div>
                            </dd>
                        </div>
                        @endif
                    @endfor
                </div>
            </div>
            @endif

            <!-- Rapporteurs -->
            @if($doctorant->RAPPORTEUR1 || $doctorant->RAPPORTEUR2 || $doctorant->RAPPORTEUR3)
            <div class="px-6 py-5">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <svg class="mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Rapporteurs
                </h3>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @for($i = 1; $i <= 3; $i++)
                        @php
                            $rapporteur = 'RAPPORTEUR'.$i;
                            $etat = 'Etat_Rapporteur'.$i;
                            $depot = 'DateDeDepotRapport'.$i;
                        @endphp
                        @if($doctorant->$rapporteur)
                        <div class="bg-gray-50 p-3 rounded-lg">
                            <dt class="text-sm font-medium text-gray-500">Rapporteur {{ $i }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <div>{{ $doctorant->$rapporteur }}</div>
                                <div class="text-xs text-gray-500 mt-1">
                                    <span class="font-medium">Statut:</span> {{ $doctorant->$etat ?? 'N/A' }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    <span class="font-medium">Dépôt du rapport:</span> {{ optional($doctorant->$depot)->format('d/m/Y') ?? 'N/A' }}
                                </div>
                            </dd>
                        </div>
                        @endif
                    @endfor
                </div>
            </div>
            @endif

            <!-- Remarques -->
            @if($doctorant->REMARQUE)
            <div class="px-6 py-5">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <svg class="mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                    Remarques
                </h3>
                <div class="mt-4 bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-700">{{ $doctorant->REMARQUE }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
    
</div>

@endsection
