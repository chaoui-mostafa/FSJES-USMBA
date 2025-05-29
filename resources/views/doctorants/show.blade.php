@extends('layouts.app')
@section('title', 'Détails du Doctorant')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    <!-- Dark mode toggle -->
    <!-- <div class="flex justify-end mb-4">
        <button id="darkModeToggle" class="p-2 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
            <svg id="darkModeIcon" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path id="darkModeIconPath" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
        </button>
    </div> -->

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Left Column - Personal Info -->
        <div class="lg:w-1/3">
            <!-- Profile Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden border border-gray-200 dark:border-gray-700 mb-6">
                <!-- Profile Header -->
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-8 text-center">
                    @if($doctorant->IMAGE)
                        <img src="{{ asset('storage/' . $doctorant->IMAGE) }}" alt="Photo de profil"
                             class="w-32 h-32 mx-auto rounded-full object-cover border-4 border-white/30 shadow-lg">
                    @else
                        <div class="w-32 h-32 mx-auto rounded-full bg-white/20 flex items-center justify-center border-4 border-white/30">
                            <svg class="h-16 w-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    @endif
                    <h1 class="text-2xl font-bold text-white mt-4">{{ $doctorant->NOM }} {{ $doctorant->PRENOM }}</h1>
                    <p class="text-blue-100">{{ $doctorant->CNE }}</p>
                </div>

                <!-- Personal Info -->
                <div class="px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informations Personnelles
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">CIN</p>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $doctorant->CIN ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Date de naissance</p>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ optional($doctorant->DATENAISSANCE)->format('d/m/Y') ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Lieu de naissance</p>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $doctorant->LIEUNAISSANCE ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Nationalité</p>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $doctorant->NATIONALITE ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Sexe</p>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $doctorant->SEXE ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $doctorant->EMAIL ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Téléphone</p>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $doctorant->TELEPHONE ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents Sidebar -->
            <x-sidebar-documents :doctorant="$doctorant" />
        </div>

        <!-- Right Column - Academic Info -->
        <div class="lg:w-2/3">
            <!-- Academic Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden border border-gray-200 dark:border-gray-700 mb-6">
                <div class="px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                        </svg>
                        Informations Académiques
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Formation</p>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $doctorant->FORMATION ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Laboratoire</p>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $doctorant->LABORATOIRE ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Promotion</p>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $doctorant->PROMO ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Statut</p>
                            <p class="font-medium text-gray-800 dark:text-gray-200">
                                @if($doctorant->FONCTIONNAIRE)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100">
                                        Fonctionnaire
                                    </span>
                                @elseif($doctorant->BOURSE)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-100">
                                        Boursier
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100">
                                        Régulier
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thesis Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden border border-gray-200 dark:border-gray-700 mb-6">
                <div class="px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Thèse
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Titre</p>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $doctorant->THESE ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Sujet</p>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $doctorant->SUJET ?? 'N/A' }}</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Date de soutenance</p>
                                <p class="font-medium text-gray-800 dark:text-gray-200">
                                    @if($doctorant->DATESOUTENANCE)
                                        {{ $doctorant->DATESOUTENANCE->format('d/m/Y') }}
                                    @else
                                        Non programmée
                                    @endif
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Mention</p>
                                <p class="font-medium text-gray-800 dark:text-gray-200">{{ $doctorant->MENTIONFR ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Supervisors Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden border border-gray-200 dark:border-gray-700 mb-6">
                <div class="px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Encadrement
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Encadrant principal</p>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $doctorant->ENCADRANT ?? 'N/A' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Co-encadrant</p>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $doctorant->COENCADRANT ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jury Card -->
            @if($doctorant->JURY1 || $doctorant->JURY2 || $doctorant->JURY3)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Jury
                    </h2>

                    <div class="space-y-4">
                        @for($i = 1; $i <= 7; $i++)
                            @php
                                $jury = 'JURY'.$i;
                                $grade = 'GRADE'.$i;
                                $status = 'STATUS'.$i;
                            @endphp
                            @if($doctorant->$jury)
                            <div class="border-b border-gray-200 dark:border-gray-700 pb-4 last:border-0 last:pb-0">
                                <p class="font-medium text-gray-800 dark:text-gray-200">{{ $doctorant->$jury }}</p>
                                <div class="flex text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    <span class="mr-3"><span class="font-medium">Grade:</span> {{ $doctorant->$grade ?? 'N/A' }}</span>
                                    <span><span class="font-medium">Rôle:</span> {{ $doctorant->$status ?? 'N/A' }}</span>
                                </div>
                            </div>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
            @endif
        </div>

    </div>
</div>

<!-- Dark mode toggle script -->
<script>
    const darkModeToggle = document.getElementById('darkModeToggle');
    const darkModeIcon = document.getElementById('darkModeIcon');
    const darkModeIconPath = document.getElementById('darkModeIconPath');

    // Check for dark mode preference
    if (localStorage.getItem('darkMode') === 'true' ||
        (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
        darkModeIconPath.setAttribute('d', 'M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z');
    }

    darkModeToggle.addEventListener('click', () => {
        document.documentElement.classList.toggle('dark');
        localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));

        if (document.documentElement.classList.contains('dark')) {
            darkModeIconPath.setAttribute('d', 'M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z');
        } else {
            darkModeIconPath.setAttribute('d', 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z');
        }
    });
</script>
@endsection
