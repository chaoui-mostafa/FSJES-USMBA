{{-- resources/views/components/toast.blade.php --}}
@if(session('success') || session('error') || session('info') || session('warning'))
<div
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 5000)"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-2 sm:translate-y-0 sm:translate-x-2"
    x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed z-50 w-full max-w-sm sm:max-w-xs"
    :class="{
        'bottom-4 left-4 right-4 sm:right-auto': window.innerWidth < 640,
        'top-4 right-4': window.innerWidth >= 640
    }"
>
    <div class="relative flex items-start p-4 rounded-xl shadow-lg overflow-hidden
                @if(session('success')) bg-green-50 border-l-4 border-green-500
                @elseif(session('error')) bg-red-50 border-l-4 border-red-500
                @elseif(session('info')) bg-blue-50 border-l-4 border-blue-500
                @elseif(session('warning')) bg-yellow-50 border-l-4 border-yellow-500
                @endif">

        <!-- Icon -->
        <div class="flex-shrink-0 mt-0.5">
            @if(session('success'))
                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            @elseif(session('error'))
                <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            @elseif(session('info'))
                <svg class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            @elseif(session('warning'))
                <svg class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            @endif
        </div>

        <!-- Content -->
        <div class="ml-3 flex-1">
            <p class="text-sm font-medium
                     @if(session('success')) text-green-800
                     @elseif(session('error')) text-red-800
                     @elseif(session('info')) text-blue-800
                     @elseif(session('warning')) text-yellow-800
                     @endif">
                {{ session('success') ?? session('error') ?? session('info') ?? session('warning') }}
            </p>
        </div>

        <!-- Close Button -->
        <div class="ml-4 flex-shrink-0 flex">
            <button @click="show = false" class="inline-flex rounded-md focus:outline-none
                      @if(session('success')) text-green-500 hover:text-green-600
                      @elseif(session('error')) text-red-500 hover:text-red-600
                      @elseif(session('info')) text-blue-500 hover:text-blue-600
                      @elseif(session('warning')) text-yellow-500 hover:text-yellow-600
                      @endif">
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
</div>
@endif
