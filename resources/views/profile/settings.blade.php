@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-800 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Profile Settings</h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Manage your account preferences and settings</p>
        </div>

        <!-- Settings Card -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden mb-8">
            <div class="p-6 sm:p-8">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-6">Preferences</h2>

                <!-- Settings Form -->
                <form action="{{ route('profile.settings.update') }}" method="POST" id="settingsForm">
                    @csrf

                    <!-- Dark Mode Toggle -->
                    <div class="flex items-center justify-between py-4 border-b border-gray-100 dark:border-gray-700">
                        <div>
                            <label for="darkMode" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dark Mode</label>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Switch between light and dark theme</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="dark_mode" class="sr-only peer" id="darkMode" 
                                   {{ auth()->user()->dark_mode ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>

                    <!-- Notifications Toggle -->
                    <div class="flex items-center justify-between py-4 border-b border-gray-100 dark:border-gray-700">
                        <div>
                            <label for="notifications" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Notifications</label>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Receive important account notifications</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="receive_notifications" class="sr-only peer" id="notifications"
                                   {{ $user->receive_notifications ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>

                    <!-- Save Button -->
                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Danger Zone Card -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden border border-red-100 dark:border-red-700">
            <div class="p-6 sm:p-8">
                <h2 class="text-lg font-medium text-red-700 dark:text-red-500 mb-6">Danger Zone</h2>

                <!-- Delete Account Form -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-4 sm:mb-0">
                        <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100">Delete Account</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Permanently remove your account and all associated data</p>
                    </div>
                    <button
                        type="button"
                        onclick="confirmAccountDeletion()"
                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >
                        Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Confirmation Modal -->
<div id="deleteAccountModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
        <div class="flex items-start">
            <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mx-auto">
                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-medium text-gray-900">Delete Account</h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500">Are you sure you want to delete your account? All of your data will be permanently removed. This action cannot be undone.</p>
                </div>
            </div>
        </div>
        <div class="mt-4 flex justify-end space-x-3">
            <button type="button" onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Cancel
            </button>
            <form action="{{ route('profile.settings.delete') }}" method="POST" id="deleteAccountForm">
                @csrf
                <button type="submit" class="inline-flex justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Delete Account
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Success Message Toast -->
<div id="successToast" class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg hidden flex items-center">
    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
    </svg>
    <span id="toastMessage">Settings updated successfully!</span>
</div>

<script>
    // Delete account confirmation modal
    function confirmAccountDeletion() {
        document.getElementById('deleteAccountModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('deleteAccountModal').classList.add('hidden');
    }

    // Show success toast when settings are saved
    document.getElementById('settingsForm').addEventListener('submit', function() {
        setTimeout(() => {
            const toast = document.getElementById('successToast');
            toast.classList.remove('hidden');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000);
        }, 500);
    });

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('deleteAccountModal');
        if (event.target === modal) {
            closeModal();
        }
    }


    // Listen for dark mode toggle changes
    document.getElementById('darkMode').addEventListener('change', function() {
        // Immediately apply the change without waiting for form submission
        if(this.checked) {
            document.documentElement.classList.add('dark');
            localStorage.setItem('darkMode', 'true');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('darkMode', 'false');
        }
    });

    // Check for saved preference on page load
    if (localStorage.getItem('darkMode') === 'true' || 
        (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
        document.getElementById('darkMode').checked = true;
    } else {
        document.documentElement.classList.remove('dark');
        document.getElementById('darkMode').checked = false;
    }
</script>
@endsection
