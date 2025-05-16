<div class="p-6 bg-white rounded-xl shadow-lg max-w-4xl mx-auto mt-10 border border-gray-100">
    <!-- Header with icon and title -->
    <div class="flex items-center mb-6">
        <div class="bg-blue-100 p-3 rounded-full mr-4">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">🔍 تنفيذ استعلام SQL مخصص</h2>
    </div>

    <!-- SQL Query Form -->
    <form wire:submit.prevent="executeSilently" class="mb-6">
        <div class="relative">
            <textarea 
                wire:model.defer="sql" 
                class="w-full p-4 border border-gray-300 rounded-lg mb-4 h-40 text-gray-800 font-mono text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="أدخل استعلام SQL هنا..."
                dir="ltr"
            ></textarea>
            <div class="absolute bottom-3 left-3 text-xs text-gray-400">
                <span class="bg-gray-100 px-2 py-1 rounded">Ctrl+Enter</span> لتنفيذ الاستعلام
            </div>
        </div>

        <div class="flex justify-end">
            <button 
                type="submit" 
                class="flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow-md transition-colors duration-200"
            >
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                تنفيذ الاستعلام
            </button>
        </div>
    </form>

    <!-- Success confirmation only (no results/errors) -->
    @if ($executed)
        <div class="mt-6 p-4 bg-blue-50 border-l-4 border-blue-500 text-blue-700 rounded-r-lg flex items-start">
            <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <div>
                <h3 class="font-bold">✔ تم تنفيذ الاستعلام بنجاح</h3>
                <p class="mt-1 text-sm">تم تنفيذ الأمر SQL بنجاح بدون عرض النتائج</p>
            </div>
        </div>
    @endif
</div>

