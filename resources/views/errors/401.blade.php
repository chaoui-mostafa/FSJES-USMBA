<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>401 - غير مصرح</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }
        .lock-animation {
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .glow-text {
            animation: glow 1.5s ease-in-out infinite alternate;
        }
        @keyframes glow {
            from { text-shadow: 0 0 5px rgba(220, 38, 38, 0.5); }
            to { text-shadow: 0 0 10px rgba(220, 38, 38, 0.8); }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
        <div class="p-8 text-center">
            <div class="lock-animation mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            
            <h1 class="glow-text text-6xl font-bold text-red-600 mb-4">401</h1>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">الدخول غير مصرح به</h2>
            <p class="text-gray-600 mb-6">يجب أن تكون مسجلاً في النظام للوصول إلى هذه الصفحة.</p>
            
            <div class="space-y-4">
                <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transition duration-300 hover:from-red-700 hover:to-red-800 w-full">
                    تسجيل الدخول
                </a>
                
                <div class="pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-500 mb-3">ليس لديك حساب؟</p>
                    <a href="{{ route('register') }}" class="inline-block px-4 py-2 border border-red-600 text-red-600 font-medium rounded-lg hover:bg-red-50 transition duration-300 w-full">
                        إنشاء حساب جديد
                    </a>
                </div>
            </div>
        </div>
        
        <div class="bg-gray-50 px-8 py-4 text-center">
            <p class="text-sm text-gray-500">© 2025 جميع الحقوق محفوظة</p>
        </div>
    </div>
</body>
</html>