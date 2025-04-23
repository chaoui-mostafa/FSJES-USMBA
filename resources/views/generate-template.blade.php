@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded shadow-md">
        <h2 class="text-2xl font-bold mb-4">استيراد / تصدير المستخدمين</h2>

        <form action="{{ route('import.users') }}" method="POST" enctype="multipart/form-data" class="mb-4 space-y-4">
            @csrf
            <input type="file" name="file" required class="border border-gray-300 p-2 rounded w-full" />
            <button type="submit"
                class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                استيراد Excel
            </button>
        </form>

        <a href="{{ route('export.users') }}"
            class="inline-block bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700">
            تصدير Excel
        </a>
    </div>
</div>
@endsection
