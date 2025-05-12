<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - الصفحة غير موجودة</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        }
        .animate-bounce {
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .glow {
            animation: glow 2s ease-in-out infinite alternate;
        }
        @keyframes glow {
            from { text-shadow: 0 0 10px rgba(239, 68, 68, 0.5); }
            to { text-shadow: 0 0 20px rgba(239, 68, 68, 0.8); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-xl shadow-2xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
        <div class="p-8 text-center">
            <div class="animate-bounce mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            <h1 class="glow text-8xl font-bold text-red-500 mb-4">404</h1>
            <h2 class="text-3xl font-bold text-gray-800 mb-2">الصفحة غير موجودة</h2>
            <p class="text-gray-600 mb-6">عذرًا، الصفحة التي تبحث عنها غير موجودة أو قد تم نقلها.</p>

            <div class="space-y-4">
                <a href="/" class="inline-block px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition duration-300">
                    العودة إلى الصفحة الرئيسية
                </a>

                <div class="pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-500 mb-3">ربما تريد زيارة هذه الصفحات:</p>
                    <div class="flex justify-center space-x-4 space-x-reverse">
                        <a href="/about" class="text-sm text-red-500 hover:underline">من نحن</a>
                        <a href="/contact" class="text-sm text-red-500 hover:underline">اتصل بنا</a>
                        <a href="/services" class="text-sm text-red-500 hover:underline">خدماتنا</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 px-8 py-4 text-center">
            <p class="text-sm text-gray-500">© 2025 جميع الحقوق محفوظة</p>
        </div>
    </div>
</body>
</html>
