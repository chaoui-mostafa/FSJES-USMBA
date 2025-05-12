<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>429 - طلبات كثيرة جدًا</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Tajawal', sans-serif; }
        .spin { animation: spin 1s linear infinite; }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="min-h-screen bg-yellow-50 flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-8 text-center">
            <div class="mb-6">
                <svg class="h-24 w-24 mx-auto text-yellow-500 spin" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h1 class="text-6xl font-bold text-yellow-600 mb-4">429</h1>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">طلبات كثيرة جدًا</h2>
            <p class="text-gray-600 mb-6">لقد قمت بإرسال عدد كبير جدًا من الطلبات في وقت قصير.</p>
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 text-right">
                <p class="text-yellow-700">الرجاء الانتظار <span id="countdown">40</span> ثانية قبل المحاولة مرة أخرى</p>
            </div>
            <a href="/" class="px-6 py-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">الصفحة الرئيسية</a>
        </div>
    </div>

    <script>
        // Countdown timer
        let time = 40;
        const countdown = setInterval(() => {
            document.getElementById('countdown').textContent = --time;
            if (time <= 0) {
                clearInterval(countdown);
                document.querySelector('p.text-gray-600').innerHTML = 'يمكنك الآن المحاولة مرة أخرى';
            }
        }, 1000);
    </script>
</body>
</html>