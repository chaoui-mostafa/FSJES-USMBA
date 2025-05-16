@extends('layouts.app')
@section('title', 'Modifier Utilisateur')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Modifier l'Utilisateur</h1>
            <a href="{{ route('users.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Retour à la liste
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 dark:bg-red-900 border-l-4 border-red-500 dark:border-red-400 text-red-700 dark:text-red-100 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Nom -->
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom Complet *</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                               class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    </div>

                    <!-- Email -->
                    <div class="sm:col-span-2">
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email *</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                               class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    </div>

                    <!-- Mot de passe -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mot de passe (laisser vide pour ne pas changer)</label>
                        <input type="password" name="password" id="password"
                               class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Minimum 8 caractères, majuscules, minuscules, chiffres et symboles</p>
                    </div>

                    <!-- Confirmation mot de passe -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    </div>

                    <!-- Téléphone -->
                    <div>
                        <label for="telephone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Téléphone</label>
                        <input type="tel" name="telephone" id="telephone" value="{{ old('telephone', $user->telephone) }}"
                               class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                               placeholder="+212 600-000000">
                    </div>

                    <!-- Rôle -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rôle *</label>
                        <select name="role" id="role" required
                                class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrateur</option>
                            <option value="prof" {{ old('role', $user->role) === 'prof' ? 'selected' : '' }}>Professeur</option>
                            <option value="doctorant" {{ old('role', $user->role) === 'doctorant' ? 'selected' : '' }}>Doctorant</option>
                        </select>
                    </div>

                    <!-- Statut -->
                    <div>
                        <label for="statut" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Statut *</label>
                        <select name="statut" id="statut" required
                                class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            <option value="active" {{ old('statut', $user->statut) === 'active' ? 'selected' : '' }}>Actif</option>
                            <option value="inactive" {{ old('statut', $user->statut) === 'inactive' ? 'selected' : '' }}>Inactif</option>
                        </select>
                    </div>

                    <!-- Blocage du compte -->
                    <div class="sm:col-span-2">
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-3">Sécurité du Compte</h3>

                            @if($user->locked_until && $user->locked_until > now())
                                <div class="flex items-center justify-between bg-red-50 dark:bg-red-900 p-4 rounded-lg">
                                    <div>
                                        <p class="text-sm font-medium text-red-800 dark:text-red-200">Compte actuellement bloqué</p>
                                        <p class="text-xs text-red-600 dark:text-red-300 mt-1">
                                            Débloqué automatiquement le {{ $user->locked_until->format('d/m/Y à H:i') }}
                                        </p>
                                    </div>
                                    <form action="{{ route('users.unlock', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            Débloquer maintenant
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="flex items-center justify-between bg-yellow-50 dark:bg-yellow-900 p-4 rounded-lg">
                                    <div>
                                        <p class="text-sm font-medium text-yellow-800 dark:text-yellow-200">Actions de sécurité</p>
                                        <p class="text-xs text-yellow-600 dark:text-yellow-300 mt-1">
                                            Tentatives échouées : {{ $user->login_attempts }}/5
                                        </p>
                                    </div>
                                    <form action="{{ route('users.block', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Bloquer ce compte empêchera toute connexion. Continuer ?')">
                                            Bloquer le compte
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-8 space-x-3">
                    <button type="reset" class="bg-white dark:bg-gray-700 py-2 px-4 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Réinitialiser
                    </button>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection