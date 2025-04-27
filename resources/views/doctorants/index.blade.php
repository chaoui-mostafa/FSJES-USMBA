@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Excel Operations Card -->
    <div class="bg-white shadow rounded-lg mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Opérations Excel</h3>
        </div>
        <div class="px-6 py-4">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <!-- Export Button -->
                <a href="{{ route('doctorants.export') }}"
                   class="flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Exporter vers Excel
                </a>

                <!-- Download Template -->
                <a href="{{ route('doctorants.template') }}"
                   class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Télécharger le Modèle
                </a>

                <!-- Import Form -->
                <form action="{{ route('doctorants.import') }}" method="POST" enctype="multipart/form-data" class="flex-grow">
                    @csrf
                    <div class="flex items-center gap-4">
                        <div class="flex-grow">
                            <label class="block">
                                <span class="sr-only">Choisir fichier Excel</span>
                                <input type="file" name="file" required accept=".xlsx,.xls"
                                       class="block w-full text-sm text-gray-500
                                              file:mr-4 file:py-2 file:px-4
                                              file:rounded-md file:border-0
                                              file:text-sm file:font-semibold
                                              file:bg-gray-100 file:text-gray-700
                                              hover:file:bg-gray-200">
                            </label>
                        </div>
                        <button type="submit"
                                class="flex items-center px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            Importer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Doctorants List -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Liste des Doctorants</h3>
            <!-- <a href="{{ route('doctorants.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">
                Ajouter Doctorant
            </a> -->
            <livewire@custom-sql-query />

            <form method="GET" action="{{ route('doctorants.index') }}" class="flex items-center">
                    <input type="text" name="search" value="{{ old('search', $search) }}" class="px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="ابحث عن طالب دكتوراه...">
                    <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">بحث</button>
                </form>
        </div>

        <!-- Search Filters -->
        <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                <div>
                    <label for="search-cne" class="block text-xs font-medium text-gray-700">CNE</label>
                    <input type="text" id="search-cne" placeholder="Rechercher par CNE..."
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                </div>
                <div>
                    <label for="search-nom" class="block text-xs font-medium text-gray-700">Nom</label>
                    <input type="text" id="search-nom" placeholder="Rechercher par nom..."
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                </div>
                <div>
                    <label for="search-prenom" class="block text-xs font-medium text-gray-700">Prénom</label>
                    <input type="text" id="search-prenom" placeholder="Rechercher par prénom..."
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                </div>
                <div>
                    <label for="search-directeur" class="block text-xs font-medium text-gray-700">Directeur</label>
                    <input type="text" id="search-directeur" placeholder="Rechercher par directeur..."
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                </div>
                <div>
                    <label for="search-laboratoire" class="block text-xs font-medium text-gray-700">Laboratoire</label>
                    <input type="text" id="search-laboratoire" placeholder="Rechercher par laboratoire..."
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                </div>
                <div class="flex items-end">
                    <button id="reset-search" class="bg-gray-200 text-gray-700 px-3 py-1 rounded-md text-sm hover:bg-gray-300 transition-colors">
                        Réinitialiser
                    </button>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mx-6 my-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mx-6 my-4" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mx-6 my-4" role="alert">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="border-t border-gray-200">
            <table class="min-w-full divide-y divide-gray-200" id="doctorants-table">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CNE</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prénom</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Directeur</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Laboratoire</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($doctorants as $doctorant)
                    <tr class="doctorant-row">
                        <td class="px-6 py-4 whitespace-nowrap cne">{{ $doctorant->cne }}</td>
                        <td class="px-6 py-4 whitespace-nowrap nom">{{ $doctorant->nom }}</td>
                        <td class="px-6 py-4 whitespace-nowrap prenom">{{ $doctorant->prenom }}</td>
                        <td class="px-6 py-4 whitespace-nowrap directeur">{{ $doctorant->prof->nom ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap laboratoire">{{ $doctorant->laboratoire->nom ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('doctorants.show', $doctorant->id) }}"
                                   class="text-blue-600 hover:text-blue-900"
                                   title="Voir détails">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('doctorants.edit', $doctorant->id) }}"
                                   class="text-green-600 hover:text-green-900"
                                   title="Modifier">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('doctorants.destroy', $doctorant->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce doctorant?')"
                                            title="Supprimer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 sm:px-6">
                {{ $doctorants->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // File input label update
    document.querySelector('input[type="file"]').addEventListener('change', function(e) {
        var fileName = e.target.files[0]?.name || 'Choisir fichier';
        var nextSibling = e.target.nextElementSibling;
        if (nextSibling) {
            nextSibling.innerText = fileName;
        }
    });

    // Live search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInputs = {
            cne: document.getElementById('search-cne'),
            nom: document.getElementById('search-nom'),
            prenom: document.getElementById('search-prenom'),
            directeur: document.getElementById('search-directeur'),
            laboratoire: document.getElementById('search-laboratoire')
        };

        const resetButton = document.getElementById('reset-search');
        const rows = document.querySelectorAll('.doctorant-row');

        function filterRows() {
            const filters = {
                cne: searchInputs.cne.value.toLowerCase(),
                nom: searchInputs.nom.value.toLowerCase(),
                prenom: searchInputs.prenom.value.toLowerCase(),
                directeur: searchInputs.directeur.value.toLowerCase(),
                laboratoire: searchInputs.laboratoire.value.toLowerCase()
            };

            rows.forEach(row => {
                const cne = row.querySelector('.cne').textContent.toLowerCase();
                const nom = row.querySelector('.nom').textContent.toLowerCase();
                const prenom = row.querySelector('.prenom').textContent.toLowerCase();
                const directeur = row.querySelector('.directeur').textContent.toLowerCase();
                const laboratoire = row.querySelector('.laboratoire').textContent.toLowerCase();

                const matches =
                    cne.includes(filters.cne) &&
                    nom.includes(filters.nom) &&
                    prenom.includes(filters.prenom) &&
                    directeur.includes(filters.directeur) &&
                    laboratoire.includes(filters.laboratoire);

                row.style.display = matches ? '' : 'none';
            });
        }

        // Add event listeners to all search inputs
        Object.values(searchInputs).forEach(input => {
            input.addEventListener('input', filterRows);
        });

        // Reset button functionality
        resetButton.addEventListener('click', function() {
            Object.values(searchInputs).forEach(input => {
                input.value = '';
            });
            filterRows();
        });
    });
</script>
@endpush
