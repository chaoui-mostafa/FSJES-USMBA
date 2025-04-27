<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رفع ملف Excel</title>
</head>
<body>
    <h1>رفع ملف Excel</h1>

    <form action="{{ route('students.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file">اختر ملف Excel أو CSV</label>
        <input type="file" name="file" id="file" required>
        <button type="submit">رفع الملف</button>
    </form>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
</body>
</html>
