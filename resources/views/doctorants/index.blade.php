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
            <a href="{{ route('doctorants.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">
                Ajouter Doctorant
            </a>

            <form method="GET" action="{{ route('doctorants.index') }}" class="flex items-center">
                <input type="text" name="search" value="{{ old('search', $search) }}"
                       class="px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                       placeholder="Rechercher...">
                <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">
                    Rechercher
                </button>
            </form>
        </div>

       <!-- Success/Error Messages -->
       @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 my-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 my-4" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 my-4" role="alert">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CNE</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CIN</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prénom</th>
                  
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Naissance</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lieu Naissance</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nationalité</th>
                  
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Inscription</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Soutenance</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Année Soutenance</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Situation</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thèse</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mention (FR)</th>
   
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Formation</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Laboratoire</th>
                  
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Encadrant</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Co-encadrant</th>

                 
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Téléphone</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($doctorants as $doctorant)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->CNE }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->CIN }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->NOM }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->PRENOM }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->DATE_NAISSANCE }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->LIEU_NAISSANCE }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->NATIONALITE }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->DATE_INSCRIPTION }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->DATE_SOUTENANCE }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->ANNEE_SOUTENANCE }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->SITUATION }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->THESE }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->MENTIONFR }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->FORMATION }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->LABORATOIRE }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->ENCADRANT }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->COENCADRANT }}</td>

                        <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->EMAIL }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $doctorant->TELEPHONE }}</td>
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
        </div>

        <!-- Pagination -->
        <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 sm:px-6">
            {{ $doctorants->links() }}
        </div>
    </div>
</div>

<!-- Detailed View Modal -->
<div class="fixed inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="doctorant-modal" style="display: none;">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Détails du Doctorant</h3>
                <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4" id="doctorant-details">
                    <!-- Details will be loaded here via AJAX -->
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" id="close-modal">
                    Fermer
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Function to show doctorant details in modal
    function showDoctorantDetails(id) {
        fetch(`/doctorants/${id}/details`)
            .then(response => response.json())
            .then(data => {
                let detailsHtml = `
                    <div class="col-span-2">
                        <h4 class="font-medium">Informations Personnelles</h4>
                        <div class="grid grid-cols-2 gap-4 mt-2">
                            <div><span class="text-gray-500">CNE:</span> ${data.CNE}</div>
                            <div><span class="text-gray-500">CIN:</span> ${data.CIN}</div>
                            <div><span class="text-gray-500">Nom:</span> ${data.NOM}</div>
                            <div><span class="text-gray-500">Prénom:</span> ${data.PRENOM}</div>
                            <div><span class="text-gray-500">Nom (AR):</span> ${data.NOMAR}</div>
                            <div><span class="text-gray-500">Prénom (AR):</span> ${data.PRENOM_AR}</div>
                            <div><span class="text-gray-500">Date Naissance:</span> ${data.DATE_NAISSANCE}</div>
                            <div><span class="text-gray-500">Lieu Naissance:</span> ${data.LIEU_NAISSANCE}</div>
                            <div><span class="text-gray-500">Nationalité:</span> ${data.NATIONALITE}</div>
                            <div><span class="text-gray-500">Sexe:</span> ${data.SEXE}</div>
                            <div><span class="text-gray-500">Email:</span> ${data.EMAIL}</div>
                            <div><span class="text-gray-500">Téléphone:</span> ${data.TELEPHONE}</div>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-medium">Informations Académiques</h4>
                        <div class="mt-2 space-y-2">
                            <div><span class="text-gray-500">Formation:</span> ${data.FORMATION}</div>
                            <div><span class="text-gray-500">Laboratoire:</span> ${data.LABORATOIRE}</div>
                            <div><span class="text-gray-500">Sujet:</span> ${data.SUJET}</div>
                            <div><span class="text-gray-500">Encadrant:</span> ${data.ENCADRANT}</div>
                            <div><span class="text-gray-500">Co-encadrant:</span> ${data.COENCADRANT}</div>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-medium">Soutenance</h4>
                        <div class="mt-2 space-y-2">
                            <div><span class="text-gray-500">Date Soutenance:</span> ${data.DATE_SOUTENANCE}</div>
                            <div><span class="text-gray-500">Année Soutenance:</span> ${data.ANNEE_SOUTENANCE}</div>
                            <div><span class="text-gray-500">Situation:</span> ${data.SITUATION}</div>
                            <div><span class="text-gray-500">Thèse:</span> ${data.THESE}</div>
                            <div><span class="text-gray-500">Mention (FR):</span> ${data.MENTIONFR}</div>
                            <div><span class="text-gray-500">Mention (AR):</span> ${data.MENTIONAR}</div>
                        </div>
                    </div>
                `;
                document.getElementById('doctorant-details').innerHTML = detailsHtml;
                document.getElementById('doctorant-modal').style.display = 'block';
            });
    }

    // Close modal
    document.getElementById('close-modal').addEventListener('click', function() {
        document.getElementById('doctorant-modal').style.display = 'none';
    });

    // File input label update
    document.querySelector('input[type="file"]').addEventListener('change', function(e) {
        var fileName = e.target.files[0]?.name || 'Choisir fichier';
        var nextSibling = e.target.nextElementSibling;
        if (nextSibling) {
            nextSibling.innerText = fileName;
        }
    });
</script>
@endpush
