@extends('layouts.app')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Liste des Professeurs</h3>
        <a href="{{ route('profs.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">
            Ajouter Professeur
        </a>
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Etablissement</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Laboratoire</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($profs as $prof)
                <tr class="prof-row">
                    <td class="px-6 py-4 whitespace-nowrap nom">{{ $prof->nom }}</td>
                    <td class="px-6 py-4 whitespace-nowrap grade">{{ $prof->grade }}</td>
                    <td class="px-6 py-4 whitespace-nowrap etablissement">{{ $prof->etablissement }}</td>
                    <td class="px-6 py-4 whitespace-nowrap laboratoire">{{ $prof->laboratoire->nom }}</td>
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
                            <form action="{{ route('profs.destroy', $prof->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce professeur?')"
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
</div>
@endsection

@push('scripts')
<script>
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
                const etablissement = row.querySelector('.etablissement').textContent.toLowerCase();
                const laboratoire = row.querySelector('.laboratoire').textContent.toLowerCase();

                const matches =
                    nom.includes(filters.nom) &&
                    grade.includes(filters.grade) &&
                    etablissement.includes(filters.etablissement) &&
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
