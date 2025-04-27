{{-- resources/views/components/delete-button.blade.php --}}

<button onclick="confirmDelete('{{ $action }}', event)"
        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-150 {{ $class }}">
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $iconClass }}" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H3a1 1 0 000 2h14a1 1 0 100-2h-2V3a1 1 0 00-1-1H6zm2 5a1 1 0 011 1v7a1 1 0 11-2 0V8a1 1 0 011-1zm4 0a1 1 0 011 1v7a1 1 0 11-2 0V8a1 1 0 011-1z" clip-rule="evenodd" />
    </svg>
    {{ $text }}
</button>

<form id="delete-form-{{ md5($action) }}" action="{{ $action }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
