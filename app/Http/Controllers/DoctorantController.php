<?php

namespace App\Http\Controllers;

use App\Models\Doctorant;
use App\Models\Prof;
use App\Models\Laboratoire;
use Illuminate\Http\Request;
use App\Imports\DoctorantsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DoctorantsExport;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Maatwebsite\Excel\Validators\ValidationException as ExcelValidationException;

class DoctorantController extends Controller
{
    public function index(Request $request)
    {
        try {
            $search = $request->input('search');

            $doctorants = Doctorant::where('CNE', 'like', '%' . $search . '%')
                ->orWhere('CIN', 'like', '%' . $search . '%')
                ->orWhere('nom', 'like', '%' . $search . '%')
                ->orWhere('prenom', 'like', '%' . $search . '%')
                ->orWhere('encadrant', 'like', '%' . $search . '%')
                ->orWhere('nomar', 'like','%' . $search . '%')
                ->orWhere('prenomar', 'like', '%' . $search . '%')
                ->orWhere('sujet', 'like','%' . $search . '%')
                ->orWhere('nationalite', 'like', '%' . $search . '%')
                ->paginate(1090);

            return view('doctorants.index', compact('doctorants'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'خطأ في جلب البيانات: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $profs = Prof::all();
            $laboratoires = Laboratoire::all();
            return view('doctorants.create', compact('profs', 'laboratoires'));
        } catch (\Exception $e) {
            return redirect()->route('doctorants.index')->with('error', 'خطأ في تحميل صفحة الإنشاء: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'CNE' => 'required|string|max:50|unique:doctorants',
                'CIN' => 'required|string|max:50|unique:doctorants',
                'NOM' => 'required|string|max:255',
                'PRENOM' => 'required|string|max:255',
                'NOMAR' => 'required|string|max:255',
                'PRENOM_AR' => 'required|string|max:255',
                'DATE_NAISSANCE' => 'required|date',
                'LIEU_NAISSANCE' => 'required|string|max:255',
                'NATIONALITE' => 'required|string|max:100',
                'SEXE' => 'required|in:M,F',
                'FONCTIONNAIRE' => 'required|boolean',
                'BOURSE' => 'required|string|max:100',
                'FORMATION' => 'required|string|max:255',
                'SUJET' => 'required|string',
                'ENCADRANT' => 'required|string|max:255',
                'LABORATOIRE' => 'required|string|max:255',
                'DATE_SOUTENANCE' => 'nullable|date',
                'SITUATION' => 'required|string|max:100',
                'THESE' => 'required|string|max:255',
                'MENTIONFR' => 'nullable|string|max:100',
                'EMAIL' => 'required|email|unique:doctorants',
                'TELEPHONE' => 'required|string|max:20',
                'NUMERO' => 'nullable|string|max:50',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('photo')) {
                try {
                    $validated['photo'] = $request->file('photo')->store('doctorants_photos', 'public');
                } catch (FileException $e) {
                    return redirect()->back()->with('error', 'فشل في تحميل الصورة: ' . $e->getMessage())->withInput();
                }
            }

            Doctorant::create($validated);

            return redirect()->route('doctorants.index')
                            ->with('success', 'تم إضافة الطالب بنجاح.');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'خطأ في قاعدة البيانات: ' . $e->getMessage())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ غير متوقع: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Doctorant $doctorant)
    {
        

        try {
            // dd($doctorant);

            return view('doctorants.show', compact('doctorant'));
        } catch (\Exception $e) {
            return redirect()->route('doctorants.index')->with('error', 'خطأ في عرض البيانات: ' . $e->getMessage());
        }
    }

    public function edit(Doctorant $doctorant)
    {
        try {
            $profs = Prof::all();
            $laboratoires = Laboratoire::all();
            return view('doctorants.edit', compact('doctorant', 'profs', 'laboratoires'));
        } catch (\Exception $e) {
            return redirect()->route('doctorants.index')->with('error', 'خطأ في تحميل صفحة التعديل: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Doctorant $doctorant)
    {
        try {
            $validated = $request->validate([
                'NOM' => 'required|string|max:255',
                'PRENOM' => 'required|string|max:255',
                'NOMAR' => 'required|string|max:255',
                'PRENOM_AR' => 'required|string|max:255',
                'DATE_NAISSANCE' => 'required|date',
                'LIEU_NAISSANCE' => 'required|string|max:255',
                'NATIONALITE' => 'required|string|max:100',
                'FONCTIONNAIRE' => 'required|boolean',
                'BOURSE' => 'required|string|max:100',
                'FORMATION' => 'required|string|max:255',
                'SUJET' => 'required|string',
                'ENCADRANT' => 'required|string|max:255',
                'LABORATOIRE' => 'required|string|max:255',
                'DATE_SOUTENANCE' => 'nullable|date',
                'SITUATION' => 'required|string|max:100',
                'THESE' => 'required|string|max:255',
                'EMAIL' => 'required|email|unique:doctorants,EMAIL,' . $doctorant->id,
                'TELEPHONE' => 'required|string|max:20',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('photo')) {
                try {
                    if ($doctorant->photo) {
                        Storage::disk('public')->delete($doctorant->photo);
                    }
                    $validated['photo'] = $request->file('photo')->store('doctorants_photos', 'public');
                } catch (FileException $e) {
                    return redirect()->back()->with('error', 'فشل في تحديث الصورة: ' . $e->getMessage())->withInput();
                }
            }

            $doctorant->update($validated);

            return redirect()->route('doctorants.index')
                            ->with('success', 'تم تحديث بيانات الطالب بنجاح.');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'خطأ في تحديث البيانات: ' . $e->getMessage())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ غير متوقع: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Doctorant $doctorant)
    {
        try {
            if ($doctorant->photo) {
                Storage::disk('public')->delete($doctorant->photo);
            }
            $doctorant->delete();
            return redirect()->route('doctorants.index')
                            ->with('success', 'تم حذف الطالب بنجاح.');
        } catch (\Exception $e) {
            return redirect()->route('doctorants.index')
                            ->with('error', 'خطأ في حذف الطالب: ' . $e->getMessage());
        }
    }

    public function thesisProgress(Doctorant $doctorant)
    {
        try {
            return view('doctorants.thesis', compact('doctorant'));
        } catch (\Exception $e) {
            return redirect()->route('doctorants.index')->with('error', 'خطأ في تحميل صفحة التقدم: ' . $e->getMessage());
        }
    }

    public function changeSupervisor(Request $request, Doctorant $doctorant)
    {
        try {
            $request->validate([
                'ENCADRANT' => 'required|string|max:255'
            ]);

            $doctorant->update(['ENCADRANT' => $request->ENCADRANT]);

            return back()->with('success', 'تم تغيير المشرف بنجاح.');

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'خطأ في تغيير المشرف: ' . $e->getMessage());
        }
    }

    public function importExportView()
    {
        try {
            return view('doctorants.import-export');
        } catch (\Exception $e) {
            return redirect()->route('doctorants.index')->with('error', 'خطأ في تحميل صفحة الاستيراد/التصدير: ' . $e->getMessage());
        }
    }

    public function import(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:xlsx,csv,xls',
            ]);

            Doctorant::truncate();

            Excel::import(new DoctorantsImport, $request->file('file'));

            return redirect()->back()->with('success', 'تم استيراد البيانات بنجاح بعد حذف البيانات القديمة.');

        } catch (ExcelValidationException $e) {
            $failures = $e->failures();
            $errors = [];
            foreach ($failures as $failure) {
                $errors[] = "سطر {$failure->row()}: {$failure->errors()[0]}";
            }
            return redirect()->back()->with('error', 'أخطاء في ملف الإكسل: ' . implode('<br>', $errors));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'خطأ في استيراد البيانات: ' . $e->getMessage());
        }
    }

    public function export()
    {
        try {
            return Excel::download(new DoctorantsExport, 'doctorants.xlsx');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'خطأ في تصدير البيانات: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        try {
            $filePath = public_path('templates/doctorants_template.xlsx');
            if (!file_exists($filePath)) {
                throw new \Exception('القالب غير موجود');
            }
            return response()->download($filePath);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'خطأ في تحميل القالب: ' . $e->getMessage());
        }
    }
}
