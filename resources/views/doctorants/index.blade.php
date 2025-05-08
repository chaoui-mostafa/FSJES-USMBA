@extends('layouts.app')
@section('title', 'Doctorants')

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
            <div class="px-4 py-5 sm:px-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Liste des Doctorants</h3>

                <!-- Global Search Form -->
                <form method="GET" action="{{ route('doctorants.index') }}" class="w-full md:w-auto">
                    <div class="flex flex-col sm:flex-row gap-2">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                   class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:w-64"
                                   placeholder="Recherche globale">
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">
                            Rechercher
                        </button>
                        @if(request()->has('search'))
                            <a href="{{ route('doctorants.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none">
                                Réinitialiser
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Pagination Controls (Top) -->
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-700">
                        Affichage de <span class="font-medium">{{ $doctorants->firstItem() }}</span> à <span class="font-medium">{{ $doctorants->lastItem() }}</span> sur <span class="font-medium">{{ $doctorants->total() }}</span> résultats
                    </span>
                </div>
                <div class="flex space-x-1">
                    <!-- First Page -->
                    <a href="{{ $doctorants->url(1) }}" class="px-3 py-1 rounded-md border border-gray-300 text-sm font-medium {{ $doctorants->onFirstPage() ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                        </svg>
                    </a>

                    <!-- Previous Page -->
                    <a href="{{ $doctorants->previousPageUrl() }}" class="px-3 py-1 rounded-md border border-gray-300 text-sm font-medium {{ $doctorants->onFirstPage() ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>

                    <!-- Page Numbers -->
                    @foreach(range(1, $doctorants->lastPage()) as $i)
                        @if($i == 1 || $i == $doctorants->lastPage() || abs($i - $doctorants->currentPage()) < 3)
                            <a href="{{ $doctorants->url($i) }}" class="px-3 py-1 rounded-md border text-sm font-medium {{ $doctorants->currentPage() == $i ? 'bg-blue-500 text-white border-blue-500' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                                {{ $i }}
                            </a>
                        @elseif(abs($i - $doctorants->currentPage()) == 3)
                            <span class="px-3 py-1 text-gray-500">...</span>
                        @endif
                    @endforeach

                    <!-- Next Page -->
                    <a href="{{ $doctorants->nextPageUrl() }}" class="px-3 py-1 rounded-md border border-gray-300 text-sm font-medium {{ $doctorants->hasMorePages() ? 'bg-white text-gray-700 hover:bg-gray-50' : 'bg-gray-100 text-gray-400 cursor-not-allowed' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <!-- Last Page -->
                    <a href="{{ $doctorants->url($doctorants->lastPage()) }}" class="px-3 py-1 rounded-md border border-gray-300 text-sm font-medium {{ $doctorants->currentPage() == $doctorants->lastPage() ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Column-specific Search Filters -->
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">CNE</label>
                    <input type="text" id="filter-cne"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm filter-input">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">CIN</label>
                    <input type="text" id="filter-cin"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm filter-input">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Nom</label>
                    <input type="text" id="filter-nom"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm filter-input">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Prénom</label>
                    <input type="text" id="filter-prenom"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm filter-input">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-1">Encadrant</label>
                    <input type="text" id="filter-encadrant"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm filter-input">
                </div>
                <div class="flex items-end">
                    <button id="reset-filters" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 text-sm">
                        Réinitialiser
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CNE</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CIN</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prénom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Soutenance</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Situation</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Formation</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Encadrant</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($doctorants as $doctorant)
                        <tr class="doctorant-row"
                            data-cne="{{ $doctorant->CNE }}"
                            data-cin="{{ $doctorant->CIN }}"
                            data-nom="{{ $doctorant->NOM }}"
                            data-prenom="{{ $doctorant->PRENOM }}"
                            data-encadrant="{{ $doctorant->ENCADRANT }}">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->CNE }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->CIN }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->NOM }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->PRENOM }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($doctorant->DATESOUTENANCE)->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->SITUATION }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->FORMATION }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->ENCADRANT }}</td>
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
                                    <!-- <a href="{{ route('doctorants.edit', $doctorant->id) }}"
                                        class="text-green-600 hover:text-green-900"
                                        title="Modifier">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a> -->
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
            </div>

            <!-- Pagination Controls (Bottom) -->
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-700">
                        Affichage de <span class="font-medium">{{ $doctorants->firstItem() }}</span> à <span class="font-medium">{{ $doctorants->lastItem() }}</span> sur <span class="font-medium">{{ $doctorants->total() }}</span> résultats
                    </span>
                </div>
                <div class="flex space-x-1">
                    <!-- First Page -->
                    <a href="{{ $doctorants->url(1) }}" class="px-3 py-1 rounded-md border border-gray-300 text-sm font-medium {{ $doctorants->onFirstPage() ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                        </svg>
                    </a>

                    <!-- Previous Page -->
                    <a href="{{ $doctorants->previousPageUrl() }}" class="px-3 py-1 rounded-md border border-gray-300 text-sm font-medium {{ $doctorants->onFirstPage() ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>

                    <!-- Page Numbers -->
                    @foreach(range(1, $doctorants->lastPage()) as $i)
                        @if($i == 1 || $i == $doctorants->lastPage() || abs($i - $doctorants->currentPage()) < 3)
                            <a href="{{ $doctorants->url($i) }}" class="px-3 py-1 rounded-md border text-sm font-medium {{ $doctorants->currentPage() == $i ? 'bg-blue-500 text-white border-blue-500' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                                {{ $i }}
                            </a>
                        @elseif(abs($i - $doctorants->currentPage()) == 3)
                            <span class="px-3 py-1 text-gray-500">...</span>
                        @endif
                    @endforeach

                    <!-- Next Page -->
                    <a href="{{ $doctorants->nextPageUrl() }}" class="px-3 py-1 rounded-md border border-gray-300 text-sm font-medium {{ $doctorants->hasMorePages() ? 'bg-white text-gray-700 hover:bg-gray-50' : 'bg-gray-100 text-gray-400 cursor-not-allowed' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>

                    <!-- Last Page -->
                    <a href="{{ $doctorants->url($doctorants->lastPage()) }}" class="px-3 py-1 rounded-md border border-gray-300 text-sm font-medium {{ $doctorants->currentPage() == $doctorants->lastPage() ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all filter inputs
        const searchInput = document.querySelector('input[name="search"]');
        const cneFilter = document.getElementById('filter-cne');
        const cinFilter = document.getElementById('filter-cin');
        const nomFilter = document.getElementById('filter-nom');
        const prenomFilter = document.getElementById('filter-prenom');
        const encadrantFilter = document.getElementById('filter-encadrant');
        const resetButton = document.getElementById('reset-filters');
        const doctorantRows = document.querySelectorAll('.doctorant-row');

        // Function to filter rows
        function filterRows() {
            const searchValue = searchInput.value.toLowerCase();
            const cneValue = cneFilter.value.toLowerCase();
            const cinValue = cinFilter.value.toLowerCase();
            const nomValue = nomFilter.value.toLowerCase();
            const prenomValue = prenomFilter.value.toLowerCase();
            const encadrantValue = encadrantFilter.value.toLowerCase();

            doctorantRows.forEach(row => {
                const cne = row.getAttribute('data-cne').toLowerCase();
                const cin = row.getAttribute('data-cin').toLowerCase();
                const nom = row.getAttribute('data-nom').toLowerCase();
                const prenom = row.getAttribute('data-prenom').toLowerCase();
                const encadrant = row.getAttribute('data-encadrant').toLowerCase();

                // Check if row matches all filters
                const matchesSearch =
                    cne.includes(searchValue) ||
                    cin.includes(searchValue) ||
                    nom.includes(searchValue) ||
                    prenom.includes(searchValue) ||
                    encadrant.includes(searchValue);

                const matchesFilters =
                    cne.includes(cneValue) &&
                    cin.includes(cinValue) &&
                    nom.includes(nomValue) &&
                    prenom.includes(prenomValue) &&
                    encadrant.includes(encadrantValue);

                // Show/hide row based on filters
                if (matchesSearch && matchesFilters) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Add event listeners for real-time filtering
        if (searchInput) {
            searchInput.addEventListener('input', filterRows);
        }
        if (cneFilter) {
            cneFilter.addEventListener('input', filterRows);
        }
        if (cinFilter) {
            cinFilter.addEventListener('input', filterRows);
        }
        if (nomFilter) {
            nomFilter.addEventListener('input', filterRows);
        }
        if (prenomFilter) {
            prenomFilter.addEventListener('input', filterRows);
        }
        if (encadrantFilter) {
            encadrantFilter.addEventListener('input', filterRows);
        }

        // Reset all filters
        if (resetButton) {
            resetButton.addEventListener('click', function() {
                if (searchInput) searchInput.value = '';
                if (cneFilter) cneFilter.value = '';
                if (cinFilter) cinFilter.value = '';
                if (nomFilter) nomFilter.value = '';
                if (prenomFilter) prenomFilter.value = '';
                if (encadrantFilter) encadrantFilter.value = '';
                filterRows();
            });
        }
    });
    </script>
    @endpush
@endsection
