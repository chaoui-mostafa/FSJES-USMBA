<div class="p-6 bg-white rounded-lg shadow-md max-w-4xl mx-auto mt-10">
    <h2 class="text-xl font-bold mb-4 text-gray-700">🔍 تنفيذ استعلام SQL مخصص</h2>

    <form wire:submit.prevent="execute">
        <textarea wire:model.defer="sql" class="w-full p-3 border rounded mb-4 h-40 text-gray-800"
                  placeholder="أدخل استعلام SQL هنا..."></textarea>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
            تنفيذ
        </button>
    </form>

    @if (!is_null($error))
        <div class="mt-4 text-red-600 font-medium">❌ خطأ: {{ $error }}</div>
    @endif

    @if (!is_null($successMessage))
        <div class="mt-4 text-green-600 font-medium">{{ $successMessage }}</div>
    @endif

    @if ($results)
        <div class="overflow-auto mt-6">
            <table class="min-w-full bg-white border">
                <thead>
                    <tr>
                        @foreach (array_keys((array)$results[0]) as $column)
                            <th class="border px-4 py-2 bg-gray-100 text-gray-700">{{ $column }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $row)
                        <tr>
                            @foreach ((array)$row as $value)
                                <td class="border px-4 py-2 text-sm text-gray-800">
                                    {{ is_null($value) ? 'NULL' : $value }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
