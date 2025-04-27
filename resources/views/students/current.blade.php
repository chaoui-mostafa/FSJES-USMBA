@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold text-center text-blue-700 mb-6">📤 الطلبة المرفوعين الآن</h2>

    @if ($students->isEmpty())
        <div class="text-center text-gray-500">لا يوجد طلاب حاليًا.</div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-800">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <th class="px-3 py-2 text-left">#</th>
                        <th class="px-3 py-2 text-left">NUMERO</th>
                        <th class="px-3 py-2 text-left">CNE</th>
                        <th class="px-3 py-2 text-left">الاسم</th>
                        <th class="px-3 py-2 text-left">النسب</th>
                        <th class="px-3 py-2 text-left">🎓 التخصص</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $index => $student)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-3 py-2">{{ $index + 1 }}</td>
                            <td class="px-3 py-2">{{ $student->numero }}</td>
                            <td class="px-3 py-2">{{ $student->cne }}</td>
                            <td class="px-3 py-2">{{ $student->nom }}</td>
                            <td class="px-3 py-2">{{ $student->prenom }}</td>
                            <td class="px-3 py-2">{{ $student->specialite }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
