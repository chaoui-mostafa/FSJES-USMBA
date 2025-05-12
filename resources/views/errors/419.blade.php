<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>419 - انتهاء صلاحية الجلسة</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet>
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .rotate {
            animation: rotate 3s linear infinite;
        }
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
        <div class="p-8 text-center">
            <div class="mb-6 flex justify-center">
                <div class="relative">
                    <div class="w-24 h-24 bg-amber-100 rounded-full flex items-center justify-center rotate">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-amber-500 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <h1 class="text-6xl font-bold text-amber-500 mb-4">419</h1>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">انتهاء صلاحية الجلسة</h2>
            <p class="text-gray-600 mb-6">عذرًا، انتهت صلاحية جلسة العمل الخاصة بك. يرجى تحديث الصفحة والمحاولة مرة أخرى.</p>

            <div class="space-y-4">
                <a href="{{ url()->previous() }}" class="inline-block px-6 py-3 bg-gradient-to-r from-amber-400 to-amber-500 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition duration-300 hover:from-amber-500 hover:to-amber-600">
                    إعادة المحاولة
                </a>

                <div class="pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-500 mb-3">إذا استمرت المشكلة، جرب:</p>
                    <div class="flex flex-col space-y-2">
                        <a href="/login" class="text-sm text-amber-600 hover:underline">تسجيل الدخول مرة أخرى</a>
                        <a href="/contact" class="text-sm text-amber-600 hover:underline">الاتصال بالدعم الفني</a>
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
