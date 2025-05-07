<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - الصفحة غير موجودة</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding-top: 10%;
        }

        .error-container {
            max-width: 500px;
            margin: auto;
            background: #fff;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            font-size: 100px;
            margin: 0;
            color: #ff4d4d;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            color: #666;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>404</h1>
        <h2>الصفحة غير موجودة</h2>
        <p>عذرًا، الصفحة التي تبحث عنها غير موجودة.</p>
        <a href="{{ url('/') }}">العودة إلى الصفحة الرئيسية</a>
    </div>
</body>
</html>
