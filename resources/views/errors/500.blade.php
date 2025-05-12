<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - خطأ في الخادم الداخلي</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
        }
        .shake {
            animation: shake 0.82s cubic-bezier(.36,.07,.19,.97) both;
        }
        @keyframes shake {
            10%, 90% { transform: translateX(-1px); }
            20%, 80% { transform: translateX(2px); }
            30%, 50%, 70% { transform: translateX(-4px); }
            40%, 60% { transform: translateX(4px); }
        }
        .pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
        <div class="p-8 text-center">
            <div class="mb-6 shake">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto text-red-500 pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>

            <h1 class="text-6xl font-bold text-red-500 mb-4">500</h1>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">خطأ في الخادم الداخلي</h2>
            <p class="text-gray-600 mb-6">حدث خطأ غير متوقع في الخادم. نحن نعمل على إصلاح المشكلة.</p>

            <div class="space-y-4">
                <a href="{{ url('/') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition duration-300 hover:from-red-600 hover:to-red-700">
                    العودة إلى الصفحة الرئيسية
                </a>

                <div class="pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-500 mb-3">يمكنك أيضًا:</p>
                    <div class="flex flex-col space-y-2">
                        <button onclick="window.location.reload()" class="text-sm text-red-500 hover:underline">إعادة تحميل الصفحة</button>
                        <a href="/contact" class="text-sm text-red-500 hover:underline">الإبلاغ عن المشكلة</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 px-8 py-4 text-center">
            <p class="text-sm text-gray-500">نعتذر للإزعاج • © 2025 جميع الحقوق محفوظة</p>
        </div>
    </div>

    <script>
        // Add occasional shake to emphasize the error state
        setInterval(() => {
            document.querySelector('.shake').classList.add('shake');
            setTimeout(() => {
                document.querySelector('.shake').classList.remove('shake');
            }, 1000);
        }, 10000);
    </script>
</body>
</html>
