<!-- resources/views/components/dark-mode-toggle.blade.php -->
<div x-data="{ darkMode: @json(Auth::check() ? Auth::user()->dark_mode : false) }">
    <button @click="toggleDarkMode" class="p-2 rounded-full">
        <template x-if="darkMode">
            <svg class="w-6 h-6 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
        </template>
        <template x-if="!darkMode">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
            </svg>
        </template>
    </button>

    <script>
        function toggleDarkMode() {
            this.darkMode = !this.darkMode;
            document.documentElement.classList.toggle('dark', this.darkMode);
            localStorage.setItem('darkMode', this.darkMode);
            
            // Update server if user is authenticated
            if(@json(Auth::check())) {
                fetch('/profile/settings', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ dark_mode: this.darkMode })
                });
            }
        }
    </script>
</div>