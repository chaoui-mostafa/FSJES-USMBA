@extends('layouts.app')
@section('title', 'Tableau de Bord')

@section('content')
<div class="py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
    <h1 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">Tableau de Bord</h1>

    <!-- Stats Cards - 2 columns on mobile -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
        <!-- Users Card -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-4 sm:p-5 sm:py-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-indigo-500 rounded-md p-2 sm:p-3">
                        <svg class="h-5 sm:h-6 w-5 sm:w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="ml-4 sm:ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-xs sm:text-sm font-medium text-gray-500 truncate">Utilisateurs</dt>
                            <dd class="flex items-baseline">
                                <div class="text-lg sm:text-xl lg:text-2xl font-semibold text-gray-900">{{ $stats['users'] }}</div>
                                <div class="ml-1 sm:ml-2 flex items-baseline text-xs sm:text-sm font-semibold text-green-600">
                                    <svg class="self-center flex-shrink-0 h-4 sm:h-5 w-4 sm:w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="sr-only">Increased by</span>
                                    4%
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="mt-3 sm:mt-4">
                    <a href="{{ route('users.index') }}" class="text-xs sm:text-sm font-medium text-blue-600 hover:text-blue-500">Voir tous</a>
                </div>
            </div>
        </div>

        <!-- Laboratoires Card -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-4 sm:p-5 sm:py-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-2 sm:p-3">
                        <svg class="h-5 sm:h-6 w-5 sm:w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div class="ml-4 sm:ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-xs sm:text-sm font-medium text-gray-500 truncate">Laboratoires</dt>
                            <dd class="flex items-baseline">
                                <div class="text-lg sm:text-xl lg:text-2xl font-semibold text-gray-900">{{ $stats['laboratoires'] }}</div>
                                <div class="ml-1 sm:ml-2 flex items-baseline text-xs sm:text-sm font-semibold text-green-600">
                                    <svg class="self-center flex-shrink-0 h-4 sm:h-5 w-4 sm:w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="sr-only">Increased by</span>
                                    5%
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="mt-3 sm:mt-4">
                    <a href="{{ route('laboratoires.index') }}" class="text-xs sm:text-sm font-medium text-blue-600 hover:text-blue-500">Voir tous</a>
                </div>
            </div>
        </div>

        <!-- Professeurs Card -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-4 sm:p-5 sm:py-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-md p-2 sm:p-3">
                        <svg class="h-5 sm:h-6 w-5 sm:w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="ml-4 sm:ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-xs sm:text-sm font-medium text-gray-500 truncate">Professeurs</dt>
                            <dd class="flex items-baseline">
                                <div class="text-lg sm:text-xl lg:text-2xl font-semibold text-gray-900">{{ $stats['profs'] }}</div>
                                <div class="ml-1 sm:ml-2 flex items-baseline text-xs sm:text-sm font-semibold text-green-600">
                                    <svg class="self-center flex-shrink-0 h-4 sm:h-5 w-4 sm:w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="sr-only">Increased by</span>
                                    3%
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="mt-3 sm:mt-4">
                    <a href="{{ route('profs.index') }}" class="text-xs sm:text-sm font-medium text-blue-600 hover:text-blue-500">Voir tous</a>
                </div>
            </div>
        </div>

        <!-- Doctorants Card -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-4 sm:p-5 sm:py-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-500 rounded-md p-2 sm:p-3">
                        <svg class="h-5 sm:h-6 w-5 sm:w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div class="ml-4 sm:ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-xs sm:text-sm font-medium text-gray-500 truncate">Doctorants</dt>
                            <dd class="flex items-baseline">
                                <div class="text-lg sm:text-xl lg:text-2xl font-semibold text-gray-900">{{ $stats['doctorants'] }}</div>
                                <div class="ml-1 sm:ml-2 flex items-baseline text-xs sm:text-sm font-semibold text-green-600">
                                    <svg class="self-center flex-shrink-0 h-4 sm:h-5 w-4 sm:w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="sr-only">Increased by</span>
                                    8%
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div class="mt-3 sm:mt-4">
                    <a href="{{ route('doctorants.index') }}" class="text-xs sm:text-sm font-medium text-blue-600 hover:text-blue-500">Voir tous</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities & Quick Actions - Stacked on mobile -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
        <!-- Recent Activities -->
        <div class="bg-white shadow rounded-lg lg:col-span-2">
            <div class="px-4 py-4 sm:px-6 border-b border-gray-200">
                <h3 class="text-base sm:text-lg leading-6 font-medium text-gray-900">Activités Récentes</h3>
            </div>
            <!-- Sample Activity Items -->
            <div class="px-4 py-4 sm:px-6">
                <div class="text-sm text-gray-500 text-center py-4">
                    Aucune activité récente
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-4 sm:px-6 border-b border-gray-200">
                <h3 class="text-base sm:text-lg leading-6 font-medium text-gray-900">Actions Rapides</h3>
            </div>
            <div class="px-4 py-4 sm:p-5 sm:py-5">
                <div class="space-y-3 sm:space-y-4">
                    <a href="{{ route('laboratoires.create') }}" class="group flex items-center space-x-2 sm:space-x-3">
                        <div class="flex-shrink-0 h-8 sm:h-10 w-8 sm:w-10 rounded-lg bg-blue-100 flex items-center justify-center">
                            <svg class="h-5 sm:h-6 w-5 sm:w-6 text-blue-600 group-hover:text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs sm:text-sm font-medium text-gray-900 group-hover:text-gray-800">Ajouter un laboratoire</p>
                            <p class="text-xs sm:text-sm text-gray-500">Créer un nouveau laboratoire</p>
                        </div>
                        <div class="flex-shrink-0 self-center">
                            <svg class="h-4 sm:h-5 w-4 sm:w-5 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </a>

                    <a href="{{ route('profs.create') }}" class="group flex items-center space-x-2 sm:space-x-3">
                        <div class="flex-shrink-0 h-8 sm:h-10 w-8 sm:w-10 rounded-lg bg-green-100 flex items-center justify-center">
                            <svg class="h-5 sm:h-6 w-5 sm:w-6 text-green-600 group-hover:text-green-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs sm:text-sm font-medium text-gray-900 group-hover:text-gray-800">Ajouter un professeur</p>
                            <p class="text-xs sm:text-sm text-gray-500">Enregistrer un nouveau professeur</p>
                        </div>
                        <div class="flex-shrink-0 self-center">
                            <svg class="h-4 sm:h-5 w-4 sm:w-5 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </a>

                    <a href="{{ route('doctorants.create') }}" class="group flex items-center space-x-2 sm:space-x-3">
                        <div class="flex-shrink-0 h-8 sm:h-10 w-8 sm:w-10 rounded-lg bg-purple-100 flex items-center justify-center">
                            <svg class="h-5 sm:h-6 w-5 sm:w-6 text-purple-600 group-hover:text-purple-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs sm:text-sm font-medium text-gray-900 group-hover:text-gray-800">Ajouter un doctorant</p>
                            <p class="text-xs sm:text-sm text-gray-500">Enregistrer un nouveau doctorant</p>
                        </div>
                        <div class="flex-shrink-0 self-center">
                            <svg class="h-4 sm:h-5 w-4 sm:w-5 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </a>

                    <a href="{{ route('users.create') }}" class="group flex items-center space-x-2 sm:space-x-3">
                        <div class="flex-shrink-0 h-8 sm:h-10 w-8 sm:w-10 rounded-lg bg-indigo-100 flex items-center justify-center">
                            <svg class="h-5 sm:h-6 w-5 sm:w-6 text-indigo-600 group-hover:text-indigo-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs sm:text-sm font-medium text-gray-900 group-hover:text-gray-800">Ajouter un utilisateur</p>
                            <p class="text-xs sm:text-sm text-gray-500">Créer un nouveau compte</p>
                        </div>
                        <div class="flex-shrink-0 self-center">
                            <svg class="h-4 sm:h-5 w-4 sm:w-5 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </a>

                    <a href="#" class="group flex items-center space-x-2 sm:space-x-3">
                        <div class="flex-shrink-0 h-8 sm:h-10 w-8 sm:w-10 rounded-lg bg-yellow-100 flex items-center justify-center">
                            <svg class="h-5 sm:h-6 w-5 sm:w-6 text-yellow-600 group-hover:text-yellow-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-xs sm:text-sm font-medium text-gray-900 group-hover:text-gray-800">Voir le calendrier</p>
                            <p class="text-xs sm:text-sm text-gray-500">Soutenances et événements</p>
                        </div>
                        <div class="flex-shrink-0 self-center">
                            <svg class="h-4 sm:h-5 w-4 sm:w-5 text-gray-400 group-hover:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
