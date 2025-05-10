@extends('layouts.app')
@section('title', 'Liste des Professeurs')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    @if(session('warning'))
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
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
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
        <div class="flex items-center">
            <svg class="h-5 w-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="font-bold">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Liste des Professeurs</h3>
        <a href="{{ route('profs.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">
            Ajouter Professeur
        </a>
    </div>

    
    <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4">
            <!-- Import Form -->
            <form action="{{ route('professeurs.import') }}" method="POST" enctype="multipart/form-data"
                  class="flex flex-col sm:flex-row items-center space-y-3 sm:space-y-0 sm:space-x-4 w-full md:w-auto">
                @csrf
                <div class="w-full sm:w-64">
                    <label for="excel-file" class="sr-only">Importer depuis Excel</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <input type="file" id="excel-file" name="excel_file" accept=".xlsx, .xls, .csv" required
                               class="block w-full pl-10 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                    </div>
                </div>
                <button type="submit"
                        class="w-full sm:w-auto bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors flex items-center justify-center space-x-2">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    <span>Importer</span>
                </button>
            </form>

            <!-- Template Download -->
            <!-- <div class="flex space-x-4">
                <a href="{{ asset('storage/templates/professeurs_template.xlsx') }}" download
                   class="bg-blue-50 text-blue-700 hover:bg-blue-100 px-4 py-2 rounded-md transition-colors flex items-center space-x-2">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Télécharger modèle</span>
                </a> -->

                <!-- Export Button -->
                <!-- <a href=""
                   class="bg-green-50 text-green-700 hover:bg-green-100 px-4 py-2 rounded-md transition-colors flex items-center space-x-2">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    <span>Exporter</span>
                </a>
            </div>
        </div> -->

        <!-- File Requirements -->
        <!-- <div class="mt-3 text-xs text-gray-500">
            <p class="flex items-center">
                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Formats acceptés: .xlsx, .xls, .csv | Taille max: 800MB
            </p>
        </div> -->
    </div>
    <!-- Pagination Controls (Top) -->
    <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-700">
                Affichage de <span class="font-medium">{{ $profs->firstItem() }}</span> à <span class="font-medium">{{ $profs->lastItem() }}</span> sur <span class="font-medium">{{ $profs->total() }}</span> résultats
            </span>
        </div>
        <div class="flex space-x-1">
            <!-- First Page -->
            <a href="{{ $profs->url(1) }}" class="px-3 py-1 rounded-md border border-gray-300 text-sm font-medium {{ $profs->onFirstPage() ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                </svg>
            </a>
            
            <!-- Previous Page -->
            <a href="{{ $profs->previousPageUrl() }}" class="px-3 py-1 rounded-md border border-gray-300 text-sm font-medium {{ $profs->onFirstPage() ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            
            <!-- Page Numbers -->
            @foreach(range(1, $profs->lastPage()) as $i)
                @if($i == 1 || $i == $profs->lastPage() || abs($i - $profs->currentPage()) < 3)
                    <a href="{{ $profs->url($i) }}" class="px-3 py-1 rounded-md border text-sm font-medium {{ $profs->currentPage() == $i ? 'bg-blue-500 text-white border-blue-500' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                        {{ $i }}
                    </a>
                @elseif(abs($i - $profs->currentPage()) == 3)
                    <span class="px-3 py-1 text-gray-500">...</span>
                @endif
            @endforeach
            
            <!-- Next Page -->
            <a href="{{ $profs->nextPageUrl() }}" class="px-3 py-1 rounded-md border border-gray-300 text-sm font-medium {{ $profs->hasMorePages() ? 'bg-white text-gray-700 hover:bg-gray-50' : 'bg-gray-100 text-gray-400 cursor-not-allowed' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
            
            <!-- Last Page -->
            <a href="{{ $profs->url($profs->lastPage()) }}" class="px-3 py-1 rounded-md border border-gray-300 text-sm font-medium {{ $profs->currentPage() == $profs->lastPage() ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>


    <!-- Search Filters -->
    <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label for="search-nom" class="block text-xs font-medium text-gray-700">Nom</label>
                <input type="text" id="search-nom" placeholder="Rechercher par nom..."
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
            </div>
            <div>
                <label for="search-grade" class="block text-xs font-medium text-gray-700">Grade</label>
                <input type="text" id="search-grade" placeholder="Rechercher par grade..."
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
            </div>
            <div>
                <label for="search-etablissement" class="block text-xs font-medium text-gray-700">Etablissement</label>
                <input type="text" id="search-etablissement" placeholder="Rechercher par établissement..."
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

    <div class="border-t border-gray-200">
        <table class="min-w-full divide-y divide-gray-200" id="profs-table">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom et Prénom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom et Prénom (Arabe)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email Professionnel</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Numéro de Téléphone</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Département</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($profs as $prof)
                <tr class="prof-row">
                    <td class="px-6 py-4 whitespace-nowrap nom">{{ $prof->nom_prenom }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $prof->nom_prenom_arabe }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $prof->email_professionnel }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $prof->numero_telephone }}</td>
                    <td class="px-6 py-4 whitespace-nowrap grade">{{ $prof->grade }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $prof->departement }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('profs.show', $prof->id) }}"
                               class="text-blue-600 hover:text-blue-900"
                               title="Voir détails">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            <a href="{{ route('profs.edit', $prof->id) }}"
                               class="text-green-600 hover:text-green-900"
                               title="Modifier">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <button onclick="openDeleteModal({{ $prof->id }}, '{{ e($prof->nom_prenom) }}')"
                                    class="text-red-600 hover:text-red-900"
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

    <!-- Pagination Controls (Bottom) -->
    <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-700">
                Affichage de <span class="font-medium">{{ $profs->firstItem() }}</span> à <span class="font-medium">{{ $profs->lastItem() }}</span> sur <span class="font-medium">{{ $profs->total() }}</span> résultats
            </span>
        </div>
        <div class="flex space-x-1">
            <!-- First Page -->
            <a href="{{ $profs->url(1) }}" class="px-3 py-1 rounded-md border border-gray-300 text-sm font-medium {{ $profs->onFirstPage() ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                </svg>
            </a>
            
            <!-- Previous Page -->
            <a href="{{ $profs->previousPageUrl() }}" class="px-3 py-1 rounded-md border border-gray-300 text-sm font-medium {{ $profs->onFirstPage() ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            
            <!-- Page Numbers -->
            @foreach(range(1, $profs->lastPage()) as $i)
                @if($i == 1 || $i == $profs->lastPage() || abs($i - $profs->currentPage()) < 3)
                    <a href="{{ $profs->url($i) }}" class="px-3 py-1 rounded-md border text-sm font-medium {{ $profs->currentPage() == $i ? 'bg-blue-500 text-white border-blue-500' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                        {{ $i }}
                    </a>
                @elseif(abs($i - $profs->currentPage()) == 3)
                    <span class="px-3 py-1 text-gray-500">...</span>
                @endif
            @endforeach
            
            <!-- Next Page -->
            <a href="{{ $profs->nextPageUrl() }}" class="px-3 py-1 rounded-md border border-gray-300 text-sm font-medium {{ $profs->hasMorePages() ? 'bg-white text-gray-700 hover:bg-gray-50' : 'bg-gray-100 text-gray-400 cursor-not-allowed' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
            
            <!-- Last Page -->
            <a href="{{ $profs->url($profs->lastPage()) }}" class="px-3 py-1 rounded-md border border-gray-300 text-sm font-medium {{ $profs->currentPage() == $profs->lastPage() ? 'bg-gray-100 text-gray-400 cursor-not-allowed' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
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
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Confirmer la suppression</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Êtes-vous sûr de vouloir supprimer le professeur "<span id="profName" class="font-medium"></span>" ? Cette action est irréversible.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Supprimer
                    </button>
                </form>
                <button type="button" onclick="closeDeleteModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
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
            etablissement: document.getElementById('search-etablissement'),
            laboratoire: document.getElementById('search-laboratoire')
        };

        const resetButton = document.getElementById('reset-search');
        const rows = document.querySelectorAll('.prof-row');

        function filterRows() {
            const filters = {
                nom: searchInputs.nom.value.toLowerCase(),
                grade: searchInputs.grade.value.toLowerCase(),
                etablissement: searchInputs.etablissement.value.toLowerCase(),
                laboratoire: searchInputs.laboratoire.value.toLowerCase()
            };

            rows.forEach(row => {
                const nom = row.querySelector('.nom').textContent.toLowerCase();
                const grade = row.querySelector('.grade').textContent.toLowerCase();
                const etablissement = row.querySelector('.etablissement')?.textContent.toLowerCase() || '';
                const laboratoire = row.querySelector('.laboratoire')?.textContent.toLowerCase() || '';

                const matches =
                    nom.includes(filters.nom) &&
                    grade.includes(filters.grade) &&
                    etablissement.includes(filters.etablissement) &&
                    laboratoire.includes(filters.laboratoire);

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