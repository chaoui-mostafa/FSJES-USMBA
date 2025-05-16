@extends('layouts.app')
@section('title', 'Users Management')

@section('content')
<div class="py-4 px-4 sm:px-6 lg:px-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <!-- Dark Mode Toggle -->
    <!-- <div class="flex justify-end mb-4">
        <button onclick="toggleDarkMode()" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 focus:outline-none">
            <svg id="dark-mode-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <svg id="light-mode-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
        </button>
    </div> -->

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 sm:mb-6 gap-3 sm:gap-4">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-gray-100">Users Management</h1>
        <div class="w-full sm:w-auto flex gap-2 sm:gap-3">
            <a href="{{ route('users.create') }}" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-3 sm:px-4 py-2 rounded-md transition-colors flex items-center justify-center gap-2 text-sm sm:text-base">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                </svg>
                <span class="hidden sm:inline">Add New User</span>
                <span class="sm:hidden">Add User</span>
            </a>
        </div>
    </div>

    <!-- Mobile Card View -->
    <div class="sm:hidden space-y-4">
        @foreach ($users as $user)
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden p-4">
            <div class="flex justify-between items-start">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                        <span class="text-gray-600 dark:text-gray-300 font-medium">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('users.show', $user->id) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </a>
                    <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="mt-3 grid grid-cols-2 gap-2 text-sm">
                <div>
                    <p class="text-gray-500 dark:text-gray-400">Phone</p>
                    <p class="text-gray-900 dark:text-gray-100">{{ $user->telephone ?? 'None' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 dark:text-gray-400">Last Login</p>
                    <p class="text-gray-900 dark:text-gray-100">{{ $user->last_login ? $user->last_login->diffForHumans() : 'Never' }}</p>
                </div>
            </div>

            <div class="mt-3 flex flex-wrap gap-1">
                <span class="px-2 py-1 text-xs font-medium rounded-full
                    {{ $user->role === 'admin' ? 'bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200' :
                       ($user->role === 'prof' ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200' :
                       'bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200') }}">
                    {{ ucfirst($user->role) }}
                </span>
                <span class="px-2 py-1 text-xs font-medium rounded-full
                    {{ $user->statut === 'active' ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200' :
                       'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200' }}">
                    {{ ucfirst($user->statut) }}
                </span>
                @if($user->isLocked)
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">
                    Locked
                </span>
                @endif
            </div>

            <div class="mt-3 flex justify-between items-center">
                <div class="text-xs text-gray-500 dark:text-gray-400">
                    Login attempts: {{ $user->login_attempts }}/5
                </div>
                <div class="flex gap-2">
                    @if($user->isLocked)
                    <form action="{{ route('users.unlock', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-xs text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                            </svg>
                            Unlock
                        </button>
                    </form>
                    @endif
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-xs text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 flex items-center gap-1"
                                onclick="return confirm('Are you sure you want to delete this user?')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Desktop Table View -->
    <div class="hidden sm:block bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">User</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Contact</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Role/Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Security</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($users as $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <!-- User Info -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                    <span class="text-gray-600 dark:text-gray-300 font-medium">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        @if($user->prof)
                                            Professor
                                        @elseif($user->doctorant)
                                            Doctoral Student
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Contact Info -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-gray-100">{{ $user->email }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->telephone ?? 'No phone' }}</div>
                            <div class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                Last login: {{ $user->last_login ? $user->last_login->diffForHumans() : 'Never' }}
                            </div>
                        </td>

                        <!-- Role/Status -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col gap-2">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $user->role === 'admin' ? 'bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200' :
                                       ($user->role === 'prof' ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200' :
                                       'bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $user->statut === 'active' ? 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200' :
                                       'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200' }}">
                                    {{ ucfirst($user->statut) }}
                                </span>
                            </div>
                        </td>

                        <!-- Security Status -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col gap-1">
                                @if($user->isLocked)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">
                                        Locked
                                    </span>
                                @endif
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    Attempts: {{ $user->login_attempts }}/5
                                </span>
                                @if($user->last_login_ip)
                                    <span class="text-xs text-gray-500 dark:text-gray-400 truncate" title="{{ $user->last_login_ip }}">
                                        IP: {{ $user->last_login_ip }}
                                    </span>
                                @endif
                            </div>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end items-center gap-3">
                                <a href="{{ route('users.show', $user->id) }}"
                                   class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300"
                                   title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <a href="{{ route('users.edit', $user->id) }}"
                                   class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300"
                                   title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                @if($user->isLocked)
                                    <form action="{{ route('users.unlock', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300"
                                                title="Unlock Account">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300"
                                            onclick="return confirm('Are you sure you want to delete this user?')"
                                            title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
        <div class="px-4 py-4 bg-gray-50 dark:bg-gray-700 sm:px-6">
            {{ $users->links() }}
        </div>
    </div>
</div>

<!-- <script>
    // Dark mode toggle functionality
    function toggleDarkMode() {
        const html = document.documentElement;
        html.classList.toggle('dark');

        const darkIcon = document.getElementById('dark-mode-icon');
        const lightIcon = document.getElementById('light-mode-icon');

        if (html.classList.contains('dark')) {
            darkIcon.classList.add('hidden');
            lightIcon.classList.remove('hidden');
            localStorage.setItem('darkMode', 'enabled');
        } else {
            darkIcon.classList.remove('hidden');
            lightIcon.classList.add('hidden');
            localStorage.setItem('darkMode', 'disabled');
        }
    }

    // Check for saved dark mode preference
    if (localStorage.getItem('darkMode') === 'enabled' ||
        (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
        document.getElementById('dark-mode-icon').classList.add('hidden');
        document.getElementById('light-mode-icon').classList.remove('hidden');
    }
</script> -->
@endsection
