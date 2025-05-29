@extends('layouts.app')
@section('title', 'Liste des Professeurs')

@section('content')
<div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
    <!-- Alerts -->
    @if(session('warning'))
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-3 sm:p-4 mb-4" role="alert">
        <div class="flex items-center">
            <svg class="h-5 w-5 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <p class="font-bold">{{ session('warning') }}</p>
        </div>
        @if(session('import_errors'))
        <div class="mt-2 text-sm">
            <details class="cursor-pointer">
                <summary class="font-medium">Détails des erreurs</summary>
                <ul class="list-disc pl-5 mt-1 space-y-1">
                    @foreach(session('import_errors') as $error)
                    <li>
                        Ligne {{ $error['row'] }}:
                        @if(isset($error['errors']))
                            {{ implode(', ', $error['errors']) }}
                        @else
                            {{ $error['message'] }}
                        @endif
                    </li>
                    @endforeach
                </ul>
            </details>
        </div>
        @endif
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 sm:p-4 mb-4" role="alert">
        <div class="flex items-center">
            <svg class="h-5 w-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="font-bold">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <!-- Header with Add Button -->
    <div class="px-3 sm:px-4 py-3 sm:py-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">Liste des Professeurs</h3>
        <a href="{{ route('profs.create') }}" class="bg-blue-500 text-white px-3 py-2 rounded-md hover:bg-blue-600 transition-colors text-sm sm:text-base w-full sm:w-auto text-center">
            Ajouter Professeur
        </a>
    </div>

    <!-- Import Form -->
    <div class="px-3 sm:px-4 py-3 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
        <form action="{{ route('professeurs.import') }}" method="POST" enctype="multipart/form-data"
              class="flex flex-col sm:flex-row items-center gap-3">
            @csrf
            <div class="w-full">
                <label for="excel-file" class="sr-only">Importer depuis Excel</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 sm:h-5 w-4 sm:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <input type="file" id="excel-file" name="excel_file" accept=".xlsx, .xls, .csv" required
                           class="block w-full pl-10 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-xs sm:text-sm dark:bg-gray-800 dark:text-gray-100">
                </div>
            </div>
            <button type="submit"
                    class="w-full sm:w-auto bg-green-600 text-white px-3 py-2 rounded-md hover:bg-green-700 transition-colors flex items-center justify-center gap-2 text-sm sm:text-base">
                <svg class="h-4 sm:h-5 w-4 sm:w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
                <span>Importer</span>
            </button>
        </form>
    </div>

     <!-- Pagination Controls (Top) -->
    <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-700 dark:text-gray-300">
                Affichage de <span class="font-medium">{{ $profs->firstItem() }}</span> à <span class="font-medium">{{ $profs->lastItem() }}</span> sur <span class="font-medium">{{ $profs->total() }}</span>
            </span>
        </div>
        <div class="flex space-x-1">
            <!-- First Page -->
            <a href="{{ $profs->url(1) }}" class="px-3 py-1 rounded-md border border-gray-300 dark:border-gray-600 text-sm font-medium {{ $profs->onFirstPage() ? 'bg-gray-100 dark:bg-gray-600 text-gray-400 dark:text-gray-300 cursor-not-allowed' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                </svg>
            </a>

            <!-- Previous Page -->
            <a href="{{ $profs->previousPageUrl() }}" class="px-3 py-1 rounded-md border border-gray-300 dark:border-gray-600 text-sm font-medium {{ $profs->onFirstPage() ? 'bg-gray-100 dark:bg-gray-600 text-gray-400 dark:text-gray-300 cursor-not-allowed' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>

            <!-- Page Numbers -->
            @foreach(range(1, $profs->lastPage()) as $i)
                @if($i == 1 || $i == $profs->lastPage() || abs($i - $profs->currentPage()) < 3)
                    <a href="{{ $profs->url($i) }}" class="px-3 py-1 rounded-md border text-sm font-medium {{ $profs->currentPage() == $i ? 'bg-blue-500 text-white border-blue-500' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                        {{ $i }}
                    </a>
                @elseif(abs($i - $profs->currentPage()) == 3)
                    <span class="px-3 py-1 text-gray-500 dark:text-gray-400">...</span>
                @endif
            @endforeach

            <!-- Next Page -->
            <a href="{{ $profs->nextPageUrl() }}" class="px-3 py-1 rounded-md border border-gray-300 dark:border-gray-600 text-sm font-medium {{ $profs->hasMorePages() ? 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' : 'bg-gray-100 dark:bg-gray-600 text-gray-400 dark:text-gray-300 cursor-not-allowed' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            <!-- Last Page -->
            <a href="{{ $profs->url($profs->lastPage()) }}" class="px-3 py-1 rounded-md border border-gray-300 dark:border-gray-600 text-sm font-medium {{ $profs->currentPage() == $profs->lastPage() ? 'bg-gray-100 dark:bg-gray-600 text-gray-400 dark:text-gray-300 cursor-not-allowed' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Search Filters - Collapsible on mobile -->
    <div class="px-3 sm:px-4 py-2 sm:py-3 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
        <details class="group">
            <summary class="flex justify-between items-center cursor-pointer text-sm font-medium text-gray-700 dark:text-gray-300">
                <span>Filtres avancés</span>
                <svg class="h-5 w-5 text-gray-500 dark:text-gray-400 transform group-open:rotate-180 transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </summary>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 mt-3">
                <div>
                    <label for="search-nom" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Nom</label>
                    <input type="text" id="search-nom" placeholder="Rechercher par nom..."
                           class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-xs sm:text-sm dark:bg-gray-800 dark:text-gray-100">
                </div>
                <div>
                    <label for="search-grade" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Grade</label>
                    <input type="text" id="search-grade" placeholder="Rechercher par grade..."
                           class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-xs sm:text-sm dark:bg-gray-800 dark:text-gray-100">
                </div>
                <div>
                    <label for="search-etablissement" class="block text-xs font-medium text-gray-700 dark:text-gray-300">Etablissement</label>
                    <input type="text" id="search-etablissement" placeholder="Rechercher par établissement..."
                           class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-xs sm:text-sm dark:bg-gray-800 dark:text-gray-100">
                </div>
                <div class="flex items-end gap-2">
                    <button id="reset-search" class="bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 px-3 py-1 rounded-md text-xs sm:text-sm hover:bg-gray-300 dark:hover:bg-gray-500 transition-colors w-full">
                        Réinitialiser
                    </button>
                </div>
            </div>
        </details>
    </div>

    <!-- Table - Hidden on mobile -->
    <div class="border-t border-gray-200 dark:border-gray-600 hidden sm:block">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600" id="profs-table">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nom et Prénom</th>
                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email Professionnel</th>
                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Téléphone</th>
                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Grade</th>
                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Département</th>
                    <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                @foreach($profs as $prof)
                <tr class="prof-row">
                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap nom dark:text-gray-300">{{ $prof->nom_prenom }}</td>
                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap dark:text-gray-300">{{ $prof->email_professionnel }}</td>
                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap dark:text-gray-300">{{ $prof->numero_telephone }}</td>
                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap grade dark:text-gray-300">{{ $prof->grade }}</td>
                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap dark:text-gray-300">{{ $prof->departement }}</td>
                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('profs.show', $prof->id) }}"
                               class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                               title="Voir détails">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            <a href="{{ route('profs.edit', $prof->id) }}"
                               class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300"
                               title="Modifier">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <button onclick="openDeleteModal({{ $prof->id }}, '{{ e($prof->nom_prenom) }}')"
                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                    title="Supprimer">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Mobile List View -->
    <div class="sm:hidden space-y-3 p-3">
        @foreach($profs as $prof)
        <div class="prof-row bg-white dark:bg-gray-700 rounded-lg shadow p-4">
            <div class="flex justify-between items-start">
                <div>
                    <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ $prof->nom_prenom }}</h4>
                    <div class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1 space-y-1">
                        <div><span class="font-medium">Email:</span> {{ $prof->email_professionnel }}</div>
                        <div><span class="font-medium">Téléphone:</span> {{ $prof->numero_telephone }}</div>
                        <div><span class="font-medium">Grade:</span> {{ $prof->grade }}</div>
                        <div><span class="font-medium">Département:</span> {{ $prof->departement }}</div>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('profs.show', $prof->id) }}"
                       class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 p-1"
                       title="Voir détails">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </a>
                    <a href="{{ route('profs.edit', $prof->id) }}"
                       class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300 p-1"
                       title="Modifier">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </a>
                    <button onclick="openDeleteModal({{ $prof->id }}, '{{ e($prof->nom_prenom) }}')"
                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 p-1"
                            title="Supprimer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination Controls (Bottom) - Simplified for mobile -->
    <div class="px-3 sm:px-4 py-2 sm:py-3 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 flex flex-col sm:flex-row items-center justify-between gap-2">
        <div class="text-xs sm:text-sm text-gray-700 dark:text-gray-300">
            Affichage de <span class="font-medium">{{ $profs->firstItem() }}</span> à <span class="font-medium">{{ $profs->lastItem() }}</span> sur <span class="font-medium">{{ $profs->total() }}</span>
        </div>
        <div class="flex space-x-1">
            <!-- Previous Page -->
            <a href="{{ $profs->previousPageUrl() }}" class="px-2 py-1 rounded-md border border-gray-300 dark:border-gray-600 text-xs sm:text-sm font-medium {{ $profs->onFirstPage() ? 'bg-gray-100 dark:bg-gray-600 text-gray-400 dark:text-gray-300 cursor-not-allowed' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>

            <!-- Current Page -->
            <span class="px-3 py-1 rounded-md border text-xs sm:text-sm font-medium bg-blue-500 text-white border-blue-500">
                {{ $profs->currentPage() }}
            </span>

            <!-- Next Page -->
            <a href="{{ $profs->nextPageUrl() }}" class="px-2 py-1 rounded-md border border-gray-300 dark:border-gray-600 text-xs sm:text-sm font-medium {{ $profs->hasMorePages() ? 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' : 'bg-gray-100 dark:bg-gray-600 text-gray-400 dark:text-gray-300 cursor-not-allowed' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed z-50 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeDeleteModal()"></div>

        <!-- Modal content -->
        <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">Confirmer la suppression</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Êtes-vous sûr de vouloir supprimer le professeur "<span id="profName" class="font-medium"></span>" ? Cette action est irréversible.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Supprimer
                    </button>
                </form>
                <button type="button" onclick="closeDeleteModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-600 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Annuler
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function openDeleteModal(id, name) {
        document.getElementById('deleteForm').action = `/profs/${id}`;
        document.getElementById('profName').textContent = name;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        if (event.target === document.getElementById('deleteModal')) {
            closeDeleteModal();
        }
    });

    // Search and filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInputs = {
            nom: document.getElementById('search-nom'),
            grade: document.getElementById('search-grade'),
            etablissement: document.getElementById('search-etablissement')
        };

        const resetButton = document.getElementById('reset-search');
        const rows = document.querySelectorAll('.prof-row');

        function filterRows() {
            const filters = {
                nom: searchInputs.nom.value.toLowerCase(),
                grade: searchInputs.grade.value.toLowerCase(),
                etablissement: searchInputs.etablissement.value.toLowerCase()
            };

            rows.forEach(row => {
                const nom = row.querySelector('.nom').textContent.toLowerCase();
                const grade = row.querySelector('.grade').textContent.toLowerCase();
                const etablissement = row.querySelector('.etablissement')?.textContent.toLowerCase() || '';

                const matches =
                    nom.includes(filters.nom) &&
                    grade.includes(filters.grade) &&
                    etablissement.includes(filters.etablissement);

                row.style.display = matches ? '' : 'none';
            });
        }

        Object.values(searchInputs).forEach(input => {
            input.addEventListener('input', filterRows);
        });

        resetButton.addEventListener('click', function() {
            Object.values(searchInputs).forEach(input => {
                input.value = '';
            });
            filterRows();
        });

        // Auto-close success messages after 5 seconds
        setTimeout(() => {
            const successMessages = document.querySelectorAll('.bg-green-100');
            successMessages.forEach(msg => {
                msg.style.transition = 'opacity 1s ease-out';
                msg.style.opacity = '0';
                setTimeout(() => msg.remove(), 1000);
            });
        }, 5000);
    });
</script>
@endpush
