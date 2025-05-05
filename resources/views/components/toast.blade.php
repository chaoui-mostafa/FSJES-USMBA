{{-- resources/views/components/toast.blade.php --}}
@if(session('success') || session('error') || session('info') || session('warning'))
    <div 
        x-data="{ show: true }" 
        x-show="show" 
        x-init="setTimeout(() => show = false, 4000)" 
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-5"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-5"
        class="fixed top-5 right-5 z-50"
    >
        <div class="flex items-center justify-between px-4 py-3 rounded-lg shadow-lg text-white text-sm gap-3
                    @if(session('success')) bg-green-500
                    @elseif(session('error')) bg-red-500
                    @elseif(session('info')) bg-blue-500
                    @elseif(session('warning')) bg-yellow-500 text-black
                    @endif">
            
            <span>
                {{ session('success') ?? session('error') ?? session('info') ?? session('warning') }}
            </span>

            <button @click="show = false" class="text-white hover:text-gray-200 text-lg font-bold leading-none">&times;</button>
        </div>
    </div>
@endif
