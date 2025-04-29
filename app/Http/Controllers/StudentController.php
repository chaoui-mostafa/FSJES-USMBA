<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\StudentImport;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Student;

class StudentController extends Controller
{
    // عرض جميع الطلاب مع إمكانية البحث
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->has('search')) {
            $query->where('NOM', 'like', '%' . $request->search . '%')
                  ->orWhere('CNE', 'like', '%' . $request->search . '%')
                  ->orWhere('CIN', 'like', '%' . $request->search . '%');
        }

        $students = $query->paginate(10);
        return view('students.index', compact('students'));
    }

    // رفع ملف إكسل واستيراد البيانات
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new StudentImport, $request->file('file'));

        return redirect()->route('students.index')->with('success', 'تم استيراد الطلبة بنجاح.');
    }

    // عرض تفاصيل طالب
    public function showDetails($id)
    {
        $student = Student::findOrFail($id);
        return view('students.partials.details', compact('student'));
    }

    // تعديل طالب
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    // تحديث بيانات طالب
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'تم تعديل بيانات الطالب بنجاح.');
    }

    // حذف طالب
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')->with('success', 'تم حذف الطالب بنجاح.');
    }

    // تصدير جميع بيانات الطلاب
    // public function export()
    // {
    //     return Excel::download(new StudentsExport, 'students.xlsx');
    // }
    public function showHistory($id)
{
    $student = Student::findOrFail($id);
    $history = $student->history; // أو أي علاقة / منطق خاص بالتاريخ

    return view('students.history', compact('student', 'history'));
}

}
