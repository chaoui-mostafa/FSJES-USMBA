<!-- resources/views/laboratoires/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Liste des Laboratoires</h3>
        <a href="{{ route('laboratoires.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Ajouter</a>
    </div>
    <div class="border-t border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom (AR)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Localisation</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($laboratoires as $laboratoire)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $laboratoire->nom }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $laboratoire->nom_ar }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $laboratoire->localisation }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('laboratoires.show', $laboratoire->id_laboratoire) }}" class="text-blue-600 hover:text-blue-900 mr-3">Voir</a>
                        <a href="{{ route('laboratoires.edit', $laboratoire->id_laboratoire) }}" class="text-green-600 hover:text-green-900 mr-3">Modifier</a>
                        <form action="{{ route('laboratoires.destroy', $laboratoire->id_laboratoire) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
