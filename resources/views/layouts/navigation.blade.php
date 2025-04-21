<!-- resources/views/layouts/navigation.blade.php -->
<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <span class="text-xl font-bold">Lab Management</span>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <x-nav-link href="{{ route('laboratoires.index') }}" :active="request()->routeIs('laboratoires.*')">
                        Laboratoires
                    </x-nav-link>
                    <x-nav-link href="{{ route('profs.index') }}" :active="request()->routeIs('profs.*')">
                        Professeurs
                    </x-nav-link>
                    <x-nav-link href="{{ route('doctorants.index') }}" :active="request()->routeIs('doctorants.*')">
                        Doctorants
                    </x-nav-link>
                </div>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-500 hover:text-gray-700">Déconnexion</button>
                </form>
            </div>
        </div>
    </div>
</nav>
