@extends('layouts.app')
@section('title', 'Professor Details')
@section('description', 'Details of the professor including personal and academic information')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Profile Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
        <!-- Profile Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-8 text-center">
            <div class="flex justify-between items-center">
                <div class="text-left">
                    <h1 class="text-2xl font-bold text-white">{{ $prof->nom_prenom }}</h1>
                    <p class="text-blue-100">{{ $prof->grade }}</p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('profs.edit', $prof->id)}}"
                       class="inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </a>
                    <button onclick="openDeleteModal('prof-{{ $prof->id }}', '{{ route('profs.destroy', $prof->id) }}', '{{ addslashes($prof->nom_prenom) }}')"
                            class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete
                    </button>
                      <a href="{{ route('profes.index') }}" class="flex items-center gap-2 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Retour
                </a>
                </div>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="divide-y divide-gray-200 dark:divide-gray-700">
            <!-- Personal Information Section -->
            <div class="px-6 py-5">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="p-2 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Personal Information</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Full Name (French)</p>
                        <p class="text-gray-800 dark:text-gray-100">{{ $prof->nom_prenom }}</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Full Name (Arabic)</p>
                        <p class="text-gray-800 dark:text-gray-100" dir="rtl">{{ $prof->nom_prenom_arabe }}</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</p>
                        <p class="text-gray-800 dark:text-gray-100">{{ $prof->email_professionnel }}</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Phone</p>
                        <p class="text-gray-800 dark:text-gray-100">{{ $prof->numero_telephone }}</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Gender</p>
                        <p class="text-gray-800 dark:text-gray-100">
                            @if($prof->sexe == 'M') Male @else Female @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Academic Information Section -->
            <div class="px-6 py-5">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="p-2 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Academic Information</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Grade (French)</p>
                        <p class="text-gray-800 dark:text-gray-100">{{ $prof->grade }}</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Grade (Arabic)</p>
                        <p class="text-gray-800 dark:text-gray-100" dir="rtl">{{ $prof->grade_ar }}</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Department (French)</p>
                        <p class="text-gray-800 dark:text-gray-100">{{ $prof->departement }}</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Department (Arabic)</p>
                        <p class="text-gray-800 dark:text-gray-100" dir="rtl">{{ $prof->departement_ar }}</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Institution (French)</p>
                        <p class="text-gray-800 dark:text-gray-100">{{ $prof->etablissement_fr }}</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Institution (Arabic)</p>
                        <p class="text-gray-800 dark:text-gray-100" dir="rtl">{{ $prof->etablissement_ar }}</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Professor Type</p>
                        <p class="text-gray-800 dark:text-gray-100">{{ $prof->type }}</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Status (Arabic)</p>
                        <p class="text-gray-800 dark:text-gray-100" dir="rtl">{{ $prof->status_ar }}</p>
                    </div>
                    @if($prof->doc)
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Doc</p>
                        <p class="text-gray-800 dark:text-gray-100">{{ $prof->doc }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Laboratory Information -->
            <div class="px-6 py-5">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="p-2 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Laboratory</h2>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    @if($prof->laboratoire)
                        <p class="text-gray-800 dark:text-gray-100">
                            {{ $prof->laboratoire->nom }} ({{ $prof->laboratoire->code }})
                        </p>
                    @else
                        <p class="text-gray-800 dark:text-gray-100">Not assigned to any laboratory</p>
                    @endif
                </div>
            </div>

            <!-- Supervisions Section -->
            <div class="px-6 py-5">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Supervisions</h2>
                    </div>
                    <a href="{{ route('profs.supervisions', $prof->id)}}"
                       class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors">
                        View All ({{ $prof->doctorants->count() }})
                    </a>
                </div>

                @if($prof->doctorants->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($prof->doctorants->take(4) as $doctorant)
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Doctorant</p>
                        <p class="text-gray-800 dark:text-gray-100">{{ $doctorant->nom_prenom }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $doctorant->these }}</p>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <p class="text-gray-800 dark:text-gray-100">No supervisions found</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<x-delete-modal
    id="prof-{{ $prof->id }}"
    title="Delete Professor"
    message="Are you sure you want to delete this professor? This action cannot be undone."
    confirmText="Delete Professor"
    class="dark:bg-gray-800 dark:text-gray-100"
/>
@endsection

@push('scripts')
<script>
    function openDeleteModal(id, url, name = '') {
        document.getElementById('deleteForm-'+id).action = url;
        if(name) {
            document.querySelector('#deleteModal-'+id+' .text-gray-500').innerHTML =
                `Are you sure you want to delete professor "<span class="font-medium">${name}</span>"? This action cannot be undone.`;
        }
        document.getElementById('deleteModal-'+id).classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeDeleteModal(id) {
        document.getElementById('deleteModal-'+id).classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
</script>
@endpush
