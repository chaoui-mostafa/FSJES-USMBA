@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Liste des Doctorants</h1>

    <table class="table-auto w-full border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Nom</th>
                <th class="px-4 py-2">Prénom</th>
                <th class="px-4 py-2">CNE</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($doctorants as $doctorant)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $doctorant->NOM }}</td>
                    <td class="px-4 py-2">{{ $doctorant->PRENOM }}</td>
                    <td class="px-4 py-2">{{ $doctorant->CNE }}</td>
                    <td class="px-4 py-2 space-x-2">
                        @foreach (['these', 'rapport', 'attestation', 'fiche-inscription'] as $type)
                            <a href="{{ route('documents.generate', ['id' => $doctorant->id, 'type' => $type]) }}"
                               class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 text-sm"
                               target="_blank">
                                {{ ucfirst($type) }}
                            </a>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
