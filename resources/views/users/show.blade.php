@extends('layouts.app')
@section('title', 'Détails Utilisateur')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Détails de l'Utilisateur</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Profil complet et activités</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('users.edit', $user->id) }}" class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    Modifier
                </a>
                <a href="{{ route('users.index') }}" class="flex items-center gap-2 bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Retour
                </a>
            </div>
        </div>

        <!-- Messages de statut -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 dark:bg-green-800 dark:border-green-600 dark:text-green-100 rounded">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <!-- En-tête -->
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Informations du Compte</h3>
            </div>

            <!-- Informations principales -->
            <div class="px-4 py-5 sm:p-6">
                <div class="flex flex-col sm:flex-row gap-8">
                    <!-- Avatar -->
                    <div class="flex-shrink-0">
                        <div class="h-24 w-24 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 text-3xl font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    </div>

                    <!-- Détails -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 flex-grow">
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nom Complet</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->email }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Téléphone</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->telephone ?? 'Non renseigné' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Rôle</dt>
                            <dd class="mt-1">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800 dark:bg-purple-800 dark:text-purple-100' :
                                       ($user->role === 'prof' ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' :
                                       'bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Statut</dt>
                            <dd class="mt-1">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $user->statut === 'active' ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' :
                                       'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' }}">
                                    {{ ucfirst($user->statut) }}
                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Compte Activé</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                                {{ $user->is_active ? 'Oui' : 'Non' }}
                            </dd>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Sécurité -->
            <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Sécurité et Connexion</h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Dernière Connexion</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                            {{ $user->last_login ? $user->last_login->format('d/m/Y H:i') : 'Jamais connecté' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Adresse IP</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                            {{ $user->last_login_ip ?? 'Inconnue' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Appareil</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white truncate" title="{{ $user->last_login_user_agent ?? '' }}">
                            {{ $user->last_login_user_agent ? Str::limit($user->last_login_user_agent, 50) : 'Inconnu' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tentatives Échouées</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                            {{ $user->login_attempts }} / 5
                            @if($user->isLocked)
                                <span class="ml-2 text-red-600 dark:text-red-400">(Compte verrouillé)</span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date de Création</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                            {{ $user->created_at->format('d/m/Y H:i') }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Dernière Mise à Jour</dt>
                        <dd class="mt-1 text-sm text-gray-900 dark:text-white">
                            {{ $user->updated_at->format('d/m/Y H:i') }}
                        </dd>
                    </div>
                </div>
            </div>

            <!-- Section Actions -->
            <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Actions</h3>
            </div>
            <div class="px-4 py-4 sm:px-6 bg-gray-50 dark:bg-gray-700 flex justify-between flex-wrap gap-4">
                @if($user->isLocked)
                    <form action="{{ route('users.unlock', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                            Déverrouiller le Compte
                        </button>
                    </form>
                @else
                    <div></div> <!-- Espaceur -->
                @endif

                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        Supprimer l'Utilisateur
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
