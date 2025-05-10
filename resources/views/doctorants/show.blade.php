@extends('layouts.app')
@section('title', 'Détails du Doctorant')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <x-sidebar-documents :doctorant="$doctorant" />

    <!-- Modern Profile Card -->
    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
        <!-- Profile Header with Gradient Background -->
        <div class="bg-gradient-to-r from-indigo-600 to-blue-700 px-8 py-10 relative">
            <!-- Floating action buttons -->
            <!-- <div class="absolute top-4 right-4 flex space-x-2">
                <a href="{{ route('doctorants.edit', $doctorant->id) }}"
                   class="inline-flex items-center px-4 py-2 bg-white/90 hover:bg-white text-indigo-700 rounded-lg shadow-sm transition-all duration-200 hover:shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Modifier
                </a>
                <form action="{{ route('doctorants.destroy', $doctorant->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow-sm transition-all duration-200 hover:shadow-md"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce doctorant ?')">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Supprimer
                    </button>
                </form>
            </div> -->

            <!-- Profile Content -->
            <div class="flex flex-col md:flex-row items-center">
                <!-- Profile Picture with Ring -->
                <div class="relative w-36 h-36 mb-6 md:mb-0 md:mr-8">
                    @if($doctorant->IMAGE)
                        <img src="{{ asset('storage/' . $doctorant->IMAGE) }}" alt="Photo de profil"
                             class="w-full h-full rounded-full object-cover border-4 border-white/30 shadow-xl ring-4 ring-white/20">
                    @else
                        <div class="w-full h-full rounded-full bg-white/20 flex items-center justify-center border-4 border-white/30 shadow-xl ring-4 ring-white/20">
                            <svg class="h-20 w-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Profile Info -->
                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-3xl font-bold text-white">{{ $doctorant->NOM }} {{ $doctorant->PRENOM }}</h1>
                    <p class="text-blue-100 mt-2 text-lg">{{ $doctorant->THESE }}</p>

                    <!-- Badges -->
                    <div class="flex flex-wrap gap-3 mt-4 justify-center md:justify-start">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white backdrop-blur-sm">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $doctorant->CNE }}
                        </span>

                        @if($doctorant->PROMO)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Promotion: {{ $doctorant->PROMO }}
                        </span>
                        @endif

                        @if($doctorant->MENTIONFR)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            Mention: {{ $doctorant->MENTIONFR }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Sections -->
        <div class="divide-y divide-gray-200/50">
            <!-- Personal Information Section -->
            <div class="px-8 py-6">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informations Personnelles
                    </h3>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                        Doctorant
                    </span>
                </div>

                <!-- Grid Layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Personal Info Cards -->
                    <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                        <div class="text-sm font-medium text-gray-500 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            CIN
                        </div>
                        <div class="mt-1 text-base font-medium text-gray-800">{{ $doctorant->CIN ?? 'N/A' }}</div>
                    </div>

                    <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                        <div class="text-sm font-medium text-gray-500">Nom complet (AR)</div>
                        <div class="mt-1 text-base font-medium text-gray-800">{{ $doctorant->NOMAR }} {{ $doctorant->PRENOMAR }}</div>
                    </div>

                    <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                        <div class="text-sm font-medium text-gray-500 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Date de naissance
                        </div>
                        <div class="mt-1 text-base font-medium text-gray-800">{{ optional($doctorant->DATENAISSANCE)->format('d/m/Y') ?? 'N/A' }}</div>
                    </div>

                    <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                        <div class="text-sm font-medium text-gray-500">Lieu de naissance</div>
                        <div class="mt-1 text-base font-medium text-gray-800">{{ $doctorant->LIEUNAISSANCE ?? 'N/A' }}</div>
                    </div>

                    <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                        <div class="text-sm font-medium text-gray-500">Nationalité</div>
                        <div class="mt-1 text-base font-medium text-gray-800">{{ $doctorant->NATIONALITE ?? 'N/A' }}</div>
                    </div>

                    <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                        <div class="text-sm font-medium text-gray-500">Sexe</div>
                        <div class="mt-1 text-base font-medium text-gray-800">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $doctorant->SEXE == 'M' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                {{ $doctorant->SEXE == 'M' ? 'Masculin' : 'Féminin' }}
                            </span>
                        </div>
                    </div>

                    <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                        <div class="text-sm font-medium text-gray-500 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Email
                        </div>
                        <div class="mt-1 text-base font-medium text-gray-800">{{ $doctorant->EMAIL ?? 'N/A' }}</div>
                    </div>

                    <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                        <div class="text-sm font-medium text-gray-500 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Téléphone
                        </div>
                        <div class="mt-1 text-base font-medium text-gray-800">{{ $doctorant->TELEPHONE ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <!-- Academic Information Section -->
            <div class="px-8 py-6">
                <h3 class="text-xl font-semibold text-gray-800 flex items-center mb-5">
                    <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                    </svg>
                    Informations Académiques
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                        <div class="text-sm font-medium text-gray-500">Fonctionnaire</div>
                        <div class="mt-1">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $doctorant->FONCTIONNAIRE ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $doctorant->FONCTIONNAIRE ? 'Oui' : 'Non' }}
                            </span>
                        </div>
                    </div>

                    <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                        <div class="text-sm font-medium text-gray-500">Boursier</div>
                        <div class="mt-1">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $doctorant->BOURSE ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $doctorant->BOURSE ? 'Oui' : 'Non' }}
                            </span>
                        </div>
                    </div>

                    <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                        <div class="text-sm font-medium text-gray-500">Formation</div>
                        <div class="mt-1 text-base font-medium text-gray-800">{{ $doctorant->FORMATION ?? 'N/A' }}</div>
                    </div>

                    <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                        <div class="text-sm font-medium text-gray-500">Laboratoire</div>
                        <div class="mt-1 text-base font-medium text-gray-800">{{ $doctorant->LABORATOIRE ?? 'N/A' }}</div>
                    </div>

                    <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                        <div class="text-sm font-medium text-gray-500">Promotion</div>
                        <div class="mt-1 text-base font-medium text-gray-800">{{ $doctorant->PROMO ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <!-- Thesis Information Section -->
            <div class="px-8 py-6">
                <h3 class="text-xl font-semibold text-gray-800 flex items-center mb-5">
                    <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Informations sur la Thèse
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                        <div class="text-sm font-medium text-gray-500">Titre de la thèse</div>
                        <div class="mt-1 text-base font-medium text-gray-800">{{ $doctorant->THESE ?? 'N/A' }}</div>
                    </div>

                    <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                        <div class="text-sm font-medium text-gray-500">Sujet de la thèse</div>
                        <div class="mt-1 text-base font-medium text-gray-800">{{ $doctorant->SUJET ?? 'N/A' }}</div>
                    </div>

                    <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                        <div class="text-sm font-medium text-gray-500">Date de soutenance</div>
                        <div class="mt-1 text-base font-medium text-gray-800">
                            @if($doctorant->DATESOUTENANCE)
                                {{ $doctorant->DATESOUTENANCE->format('d/m/Y') }}
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $doctorant->ANNEESOUTENANCE }}
                                </span>
                            @else
                                Non programmée
                            @endif
                        </div>
                    </div>

                    <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                        <div class="text-sm font-medium text-gray-500">Mention (FR)</div>
                        <div class="mt-1 text-base font-medium text-gray-800">{{ $doctorant->MENTIONFR ?? 'N/A' }}</div>
                    </div>

                    <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                        <div class="text-sm font-medium text-gray-500">Mention (AR)</div>
                        <div class="mt-1 text-base font-medium text-gray-800">{{ $doctorant->MENTIONAR ?? 'N/A' }}</div>
                    </div>

                    <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                        <div class="text-sm font-medium text-gray-500">Situation</div>
                        <div class="mt-1 text-base font-medium text-gray-800">{{ $doctorant->SITUATION ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <!-- Supervisors Section -->
            <div class="px-8 py-6">
                <h3 class="text-xl font-semibold text-gray-800 flex items-center mb-5">
                    <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Encadrants
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                        <div class="text-sm font-medium text-gray-500">Encadrant principal</div>
                        <div class="mt-1 text-base font-medium text-gray-800">{{ $doctorant->ENCADRANT ?? 'N/A' }}</div>
                    </div>

                    <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                        <div class="text-sm font-medium text-gray-500">Co-encadrant</div>
                        <div class="mt-1 text-base font-medium text-gray-800">{{ $doctorant->COENCADRANT ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <!-- Jury Members Section -->
            @if($doctorant->JURY1 || $doctorant->JURY2 || $doctorant->JURY3)
            <div class="px-8 py-6">
                <h3 class="text-xl font-semibold text-gray-800 flex items-center mb-5">
                    <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Membres du Jury
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @for($i = 1; $i <= 7; $i++)
                        @php
                            $jury = 'JURY'.$i;
                            $grade = 'GRADE'.$i;
                            $status = 'STATUS'.$i;
                        @endphp
                        @if($doctorant->$jury)
                        <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                            <div class="text-sm font-medium text-gray-500">Membre du jury {{ $i }}</div>
                            <div class="mt-1 text-base font-medium text-gray-800">
                                <div>{{ $doctorant->$jury }}</div>
                                <div class="text-sm text-gray-500 mt-2">
                                    <span class="font-medium">Grade:</span> {{ $doctorant->$grade ?? 'N/A' }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    <span class="font-medium">Statut:</span> {{ $doctorant->$status ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                        @endif
                    @endfor
                </div>
            </div>
            @endif

            <!-- Reporters Section -->
            @if($doctorant->RAPPORTEUR1 || $doctorant->RAPPORTEUR2 || $doctorant->RAPPORTEUR3)
            <div class="px-8 py-6">
                <h3 class="text-xl font-semibold text-gray-800 flex items-center mb-5">
                    <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Rapporteurs
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @for($i = 1; $i <= 3; $i++)
                        @php
                            $rapporteur = 'RAPPORTEUR'.$i;
                            $etat = 'Etat_Rapporteur'.$i;
                            $depot = 'DateDeDepotRapport'.$i;
                        @endphp
                        @if($doctorant->$rapporteur)
                        <div class="bg-gray-50/50 hover:bg-gray-50 p-4 rounded-xl border border-gray-200/50 transition-all duration-200">
                            <div class="text-sm font-medium text-gray-500">Rapporteur {{ $i }}</div>
                            <div class="mt-1 text-base font-medium text-gray-800">
                                <div>{{ $doctorant->$rapporteur }}</div>
                                <div class="text-sm text-gray-500 mt-2">
                                    <span class="font-medium">Statut:</span> {{ $doctorant->$etat ?? 'N/A' }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    <span class="font-medium">Dépôt du rapport:</span> {{ optional($doctorant->$depot)->format('d/m/Y') ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                        @endif
                    @endfor
                </div>
            </div>
            @endif

            <!-- Remarks Section -->
            @if($doctorant->REMARQUE)
            <div class="px-8 py-6">
                <h3 class="text-xl font-semibold text-gray-800 flex items-center mb-5">
                    <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                    Remarques
                </h3>

                <div class="bg-gray-50/50 p-5 rounded-xl border border-gray-200/50">
                    <p class="text-gray-700">{{ $doctorant->REMARQUE }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Add some modern styling -->
<style>
    /* Smooth transitions for hover effects */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 150ms;
    }

    /* Better shadow effects */
    .shadow-2xl {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
    }

    /* Improved rounded corners */
    .rounded-2xl {
        border-radius: 1rem;
    }

    /* Subtle border effects */
    .border-gray-200/50 {
        border-color: rgba(229, 231, 235, 0.5);
    }

    /* Better hover effects for cards */
    .hover\\:bg-gray-50:hover {
        background-color: rgba(249, 250, 251, 1);
    }
</style>
@endsection
