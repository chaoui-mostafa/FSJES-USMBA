@props(['doctorant'])

@if(isset($doctorant))
<div class="fixed right-0 top-0 h-full flex z-40">
    <!-- Toggle Button -->
    <button id="toggleSidebar"
    class="fixed left-0 top-1/2 transform -translate-y-1/2 z-50 bg-blue-600 text-white p-3 rounded-r-lg shadow-lg hover:bg-blue-700 transition-all duration-300">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16" />
    </svg>
    Documents
</button>

    <!-- Sidebar Content -->
    <aside id="sidebar"
           class="w-64 bg-white shadow-lg transform translate-x-full transition-transform duration-300 overflow-y-auto flex flex-col">
        <div class="p-4 flex-1">
            <h2 class="text-xl font-bold mb-6 text-gray-800 border-b pb-2">الوثائق والإجراءات</h2>

            <!-- Documents Section -->
            <div class="space-y-3 mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">الوثائق الرسمية</h3>
                <a href="{{ route('doctorants.generate', ['doctorant' => $doctorant->id, 'type' => 'these']) }}"
                   class="flex items-center gap-3 p-3 bg-blue-50 hover:bg-blue-100 rounded-lg text-blue-800 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    doc 1
                </a>
                <a href="{{ route('doctorants.generate', ['doctorant' => $doctorant->id, 'type' => 'attestation']) }}"
                   class="flex items-center gap-3 p-3 bg-green-50 hover:bg-green-100 rounded-lg text-green-800 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                  doc 2
                </a>

                <!-- Word Export Button - Triggers Modal -->
                <button onclick="openWordExportModal()"
                   class="w-full flex items-center gap-3 p-3 bg-red-50 hover:bg-red-100 rounded-lg text-red-800 transition-colors text-right">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16h16M4 12h16M4 8h16" />
                    </svg>
                    تصدير إلى Word

                </button>

                <a href="{{ route('doctorants.generate', ['doctorant' => $doctorant->id, 'type' => 'rapport']) }}"
                   class="flex items-center gap-3 p-3 bg-yellow-50 hover:bg-yellow-100 rounded-lg text-yellow-800 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Doc 3
                </a>
            </div>

            <!-- Invitation Section -->
            <div class="space-y-3 mb-6">
                <!-- <h3 class="text-lg font-semibold text-gray-700 mb-2">الدعوات والمناقشات</h3> -->
                <a href="{{ route('doctorants.generate', ['doctorant' => $doctorant->id, 'type' => 'invitation']) }}"
                   class="flex items-center gap-3 p-3 bg-purple-50 hover:bg-purple-100 rounded-lg text-purple-800 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                  Doc 4
                </a>

                <a href="{{ route('doctorants.generate', ['doctorant' => $doctorant->id, 'type' => 'jury']) }}"
                   class="flex items-center gap-3 p-3 bg-indigo-50 hover:bg-indigo-100 rounded-lg text-indigo-800 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Doc 5
                </a>
            </div>
        </div>

        <!-- Bottom Navigation -->
        <div class="bg-gray-50 p-3 border-t flex justify-between">
            <a href="{{ route('doctorants.show', $doctorant->id) }}"
               class="text-blue-600 hover:text-blue-800 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                الملف الشخصي
            </a>
            <a href="{{ route('doctorants.edit', $doctorant->id) }}"
               class="text-green-600 hover:text-green-800 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                تعديل
            </a>
        </div>
    </aside>
</div>

<!-- Word Export Modal -->
<div id="wordExportModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
        <!-- Modal Header -->
        <div class="flex justify-between items-center border-b p-4">
            <h3 class="text-xl font-semibold text-gray-800">إعداد تصدير Word</h3>
            <button onclick="closeWordExportModal()" class="text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

       <!-- Modal Body -->
<div class="p-6">
    <form id="wordExportForm" action="{{ route('doctorant.annonce.generate') }}" method="POST">
        @csrf
        <input type="hidden" name="doctorant_id" value="{{ $doctorant->id }}">

        <div class="mb-4">
            <label for="exportDate" class="block text-sm font-medium text-gray-700 mb-1">تاريخ المناقشة</label>
            <input type="date" id="exportDate" name="date" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="exportTime" class="block text-sm font-medium text-gray-700 mb-1">وقت المناقشة</label>
            <input type="time" id="exportTime" name="heure" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="exportLocation" class="block text-sm font-medium text-gray-700 mb-1">مكان المناقشة</label>
            <input type="text" id="exportLocation" name="lieu" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                   placeholder="قاعة المناقشات - كلية العلوم">
        </div>

        <!-- <div class="mb-4">
            <label for="exportLanguage" class="block text-sm font-medium text-gray-700 mb-1">لغة الأسماء</label>
            <select id="exportLanguage" name="language" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <option value="ar">عربية</option>
                <option value="fr">فرنسية</option>
            </select>
        </div> -->
    </form>
</div>


        <!-- Modal Footer -->
        <div class="flex justify-end border-t p-4">
            <button onclick="closeWordExportModal()"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 rounded-md border border-gray-300 mr-2">
                Annuler
            </button>
            <button onclick="submitWordExportForm()"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow-sm">
                Downleod
            </button>
        </div>
    </div>
</div>

<script>
    // Sidebar functionality
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const toggleButton = document.getElementById('toggleSidebar');

        // Toggle sidebar
        function toggleSidebar() {
            sidebar.classList.toggle('translate-x-full');
        }

        toggleButton.addEventListener('click', toggleSidebar);

        // Close sidebar when clicking outside
        document.addEventListener('click', function(event) {
            if (!sidebar.contains(event.target) && event.target !== toggleButton) {
                sidebar.classList.add('translate-x-full');
            }
        });

        // Keyboard shortcut (Ctrl+Shift+X)
        document.addEventListener('keydown', function(event) {
            if (event.ctrlKey && event.shiftKey && event.key.toLowerCase() === 'x') {
                event.preventDefault();
                toggleSidebar();
            }
        });
    });

    // Word Export Modal functions
    function openWordExportModal() {
        document.getElementById('wordExportModal').classList.remove('hidden');
        document.getElementById('sidebar').classList.add('translate-x-full');
    }

    function closeWordExportModal() {
        document.getElementById('wordExportModal').classList.add('hidden');
    }

    function submitWordExportForm() {
        document.getElementById('wordExportForm').submit();
    }

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('wordExportModal');
        if (event.target === modal) {
            closeWordExportModal();
        }
    });
</script>
@else
<div class="p-4 bg-red-100 text-red-800 rounded-lg">
    <p>خطأ: لم يتم تحميل بيانات الطالب</p>
</div>
@endif
