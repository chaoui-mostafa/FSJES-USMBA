@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Supervised PhD Students</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Professor: {{ $prof->nom }}</p>
        </div>

        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            @if($doctorants->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CNE</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thesis Title</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($doctorants as $doctorant)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <a href="{{ route('doctorants.show', $doctorant->id) }}" class="text-blue-600 hover:text-blue-900">
                                        {{ $doctorant->nom }} {{ $doctorant->prenom }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $doctorant->cne }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ Str::limit($doctorant->these, 50) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $doctorant->situation == 'In Progress' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $doctorant->situation == 'Submitted' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $doctorant->situation == 'Defended' ? 'bg-green-100 text-green-800' : '' }}">
                                        {{ $doctorant->situation }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="mt-2 text-sm text-gray-500">This professor is not currently supervising any PhD students.</p>
            @endif
        </div>
    </div>
</div>
@endsection
