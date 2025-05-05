<nav class="bg-white shadow-sm sticky top-0 z-50 transition-all duration-300" x-data="{ open: false, profileOpen: false, isFullscreen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo and mobile menu button -->
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <a href="{{ route('dashboard') }}" class="text-xl font-bold text-blue-600 hover:text-blue-800 transition-colors duration-300">
                        FSJES Management
                    </a>
                
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden sm:ml-6 sm:flex sm:space-x-2">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 2a1 1 0 00-.707.293l-7 7a1 1 0 001.414 1.414L4 9.414V17a1 1 0 001 1h10a1 1 0 001-1V9.414l1.293 1.293a1 1 0 001.414-1.414l-7-7A1 1 0 0010 2z" />
                        </svg>
                        dashboard
                    </x-nav-link>

                    <x-nav-link href="{{ route('laboratoires.index') }}" :active="request()->routeIs('laboratoires.*')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M11.17 3a1 1 0 01.98.8l1.5 8a1 1 0 01-.46 1.07l-1.26.63V15a1 1 0 01-1 1h-1a1 1 0 01-1-1v-1.5l-1.26-.63a1 1 0 01-.46-1.07l1.5-8a1 1 0 01.98-.8h1.66zm-1.76 7h2.19l-1.09-5.8h-.01L9.41 10zM6 4a1 1 0 00-1 1v10a1 1 0 001 1h1a1 1 0 001-1v-2.5l.5-.25V15a1 1 0 001 1h1a1 1 0 001-1V5a1 1 0 00-1-1H6z" clip-rule="evenodd" />
                        </svg>
                        Laboratoires
                    </x-nav-link>

                    <x-nav-link href="{{ route('profes.index') }}" :active="request()->routeIs('profs.*')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-1a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v1h-3zM4.75 12.094A5.973 5.973 0 004 15v1H1v-1a3 3 0 013.75-2.906z" />
                        </svg>
                        Professeurs
                    </x-nav-link>

                    <x-nav-link href="{{ route('doctorants.index') }}" :active="request()->routeIs('doctorants.*')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                        Doctorants
                    </x-nav-link>
                </div>
            </div>

            <!-- Right side (profile dropdown and logout) -->
            <div class="hidden sm:flex sm:items-center space-x-4">
                @auth
                <!-- User Management Link -->
                <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.*')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Utilisateurs
                </x-nav-link>
                
              

                <!-- Profile dropdown -->
                <div class="ml-3 relative" x-data="{ open: false }">
                    <div>
                        <button @click="open = !open" class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold">
                                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                            </div>
                            <span class="ml-2 text-gray-700">{{ auth()->user()->name ?? 'Utilisateur' }}</span>
                            <svg class="ml-1 h-4 w-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>

                    <div x-show="open"
                        @click.away="open = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                        <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            Mon Profil
                        </a>
                        <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            Paramètres
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                                </svg>
                                Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 transition-colors duration-300">Connexion</a>
                <a href="" class="text-gray-600 hover:text-blue-600 transition-colors duration-300">Inscription</a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="sm:hidden" x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
        <div class="pt-2 pb-3 space-y-1">
            <x-mobile-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                dashboard
            </x-mobile-nav-link>
            <x-mobile-nav-link href="{{ route('laboratoires.index') }}" :active="request()->routeIs('laboratoires.*')">
                Laboratoires
            </x-mobile-nav-link>
            <x-mobile-nav-link href="{{ route('profes.index') }}" :active=" request()->routeIs('profs.*')">
                Professeurs
            </x-mobile-nav-link>
            <x-mobile-nav-link href="{{ route('doctorants.index') }}" :active="request()->routeIs('doctorants.*')">
                Doctorants
            </x-mobile-nav-link>
            @auth
            <x-mobile-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.*')">
                Utilisateurs
            </x-mobile-nav-link>
            @endauth

            @auth
            <div class="border-t border-gray-200 pt-4 pb-3">
                <div class="flex items-center px-4">
                    <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800">{{ auth()->user()->name ?? 'Utilisateur' }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ auth()->user()->email ?? '' }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                        Mon Profil
                    </a>
                    <a href="" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                        Paramètres
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full px-4 py-2 text-left text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
            @else
            <div class="border-t border-gray-200 pt-4 pb-3">
                <div class="space-y-1">
                    <a href="{{ route('login') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                        Connexion
                    </a>
                    <a href="" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                        Inscription
                    </a>
                </div>
            </div>
            @endauth
            
            <!-- Fullscreen Toggle for Mobile -->
            <div class="border-t border-gray-200 pt-4 pb-3">
                <button @click="toggleFullscreen" class="w-full flex items-center px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              x-show="!isFullscreen"
                              d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              x-show="isFullscreen"
                              d="M6 16v4m0 0h4m-4 0l5-5m5 5l-5-5m5 5v-4m0 4h-4" 
                              style="display: none;" />
                    </svg>
                    <span x-text="isFullscreen ? 'Quitter le plein écran' : 'Plein écran'"></span>
                </button>
            </div>
        </div>
    </div>
</nav>
