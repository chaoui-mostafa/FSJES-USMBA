@foreach ($messages as $message)
    <div x-data="{ showConfirm{{ $message->id }}: false }" class="mb-4 p-4 border rounded shadow-sm bg-white">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-800 font-semibold">{{ $message->content }}</p>
                <p class="text-sm text-gray-500">من: {{ $message->sender_name }}</p>
            </div>

            <button
                @click="showConfirm{{ $message->id }} = true"
                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700"
            >
                🗑️ حذف
            </button>
        </div>

        <!-- نافذة تأكيد الحذف -->
        <div
            x-show="showConfirm{{ $message->id }}"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        >
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                <h2 class="text-lg font-bold text-gray-800 mb-4">هل أنت متأكد من حذف الرسالة؟</h2>
                <p class="text-gray-600 mb-6">لن تتمكن من استرجاع هذه الرسالة لاحقًا.</p>

                <div class="flex justify-end space-x-3">
                    <button
                        @click="showConfirm{{ $message->id }} = false"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400"
                    >
                        إلغاء
                    </button>

                    <form method="POST" action="{{ route('messages.destroy', $message->id) }}">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"
                        >
                            تأكيد الحذف
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
