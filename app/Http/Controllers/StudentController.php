<?php
// app/Http/Controllers/StudentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\StudentImport;
use App\Models\Student;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class StudentController extends Controller
{
    public function index()
    {
        // جلب آخر رفع (upload_id) للطلاب
        $latestUploadId = Student::max('upload_id');

        // جلب الطلاب الذين يحملون نفس upload_id
        $students = Student::where('upload_id', $latestUploadId)->paginate(10); // إضافة التصفح

        // جلب جميع الطلاب في الترتيب العكسي حسب upload_id
        $allStudents = Student::orderBy('upload_id', 'desc')->get();

        return view('students.index', compact('students', 'allStudents')); // تمرير المتغيرات إلى العرض
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv' // تأكد من أن الملف هو Excel أو CSV
        ]);

        // تعيين الـ upload_id استنادًا إلى الوقت الحالي
        $uploadId = Carbon::now()->timestamp; // استخدام Carbon للحصول على timestamp الحالي

        // استيراد البيانات من الملف إلى النموذج Student
        Excel::import(new StudentImport($uploadId), $request->file('file'));

        // إعادة التوجيه إلى صفحة الطلاب مع رسالة النجاح
        return redirect()->route('students.index')->with('success', 'تم رفع الملف بنجاح.');
    }

    public function showCurrent()
    {
        // جلب آخر 50 طالب
        $students = Student::latest()->take(50)->get();
        return view('students.current', compact('students')); // عرض الطلاب
    }

    public function showHistory()
    {
        // جلب كل الطلاب
        $allStudents = Student::all();
        return view('students.history', compact('allStudents')); // عرض جميع الطلاب
    }
    public function showImportForm()
    {
        return view('students.import');
    }
}
