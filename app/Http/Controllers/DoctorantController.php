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

class DoctorantController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $doctorants = Doctorant::query()
            ->when($search, function($query) use ($search) {
                return $query->where('NOM', 'like', '%' . $search . '%')
                             ->orWhere('PRENOM', 'like', '%' . $search . '%')
                             ->orWhere('CNE', 'like', '%' . $search . '%')
                             ->orWhere('CIN', 'like', '%' . $search . '%')
                             ->orWhere('NOMAR', 'like', '%' . $search . '%')
                             ->orWhere('PRENOMAR', 'like', '%' . $search . '%')
                             ->orWhere('LIEUNAISSANCE', 'like', '%' . $search . '%')
                             ->orWhere('NATIONALITE', 'like', '%' . $search . '%')
                             ->orWhere('SUJET', 'like', '%' . $search . '%')
                             ->orWhere('FORMATION', 'like', '%' . $search . '%')
                             ->orWhere('THESE', 'like', '%' . $search . '%');
            })
            // ->orderBy('NOM')
            ->paginate(600);

        return view('doctorants.index', compact('doctorants', 'search'));
    }

    public function create()
    {
        $profs = Prof::all();
        $laboratoires = Laboratoire::all();
        return view('doctorants.create', compact('profs', 'laboratoires'));
    }

    public function store(Request $request)
    {
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
    
        // إذا تم رفع صورة، خزّنها وأضف المسار للمصفوفة
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('doctorants_photos', 'public');
        }
    
        Doctorant::create($validated);
    
        return redirect()->route('doctorants.index')
                         ->with('success', 'تم إضافة الطالب بنجاح.');
    }
    

    public function show(Doctorant $doctorant)
    {
        return view('doctorants.show', compact('doctorant'));
    }
    public function edit(Doctorant $doctorant)
    {
        $profs = Prof::all();
        $laboratoires = Laboratoire::all();
        return view('doctorants.edit', compact('doctorant', 'profs', 'laboratoires'));
    }

    public function update(Request $request, Doctorant $doctorant)
    {
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
    
        // إذا تم رفع صورة جديدة
        if ($request->hasFile('photo')) {
            // حذف الصورة القديمة إن وجدت
            if ($doctorant->photo) {
                Storage::disk('public')->delete($doctorant->photo);
            }
    
            // رفع الصورة الجديدة
            $validated['photo'] = $request->file('photo')->store('doctorants_photos', 'public');
        }
    
        $doctorant->update($validated);
    
        return redirect()->route('doctorants.index')
                         ->with('success', 'تم تحديث بيانات الطالب بنجاح.');
    }
    
    public function destroy(Doctorant $doctorant)
    {
        $doctorant->delete();
        return redirect()->route('doctorants.index')
                         ->with('success', 'Doctorant supprimé avec succès.');
    }

    public function thesisProgress(Doctorant $doctorant)
    {
        return view('doctorants.thesis', compact('doctorant'));
    }

    public function changeSupervisor(Request $request, Doctorant $doctorant)
    {
        $request->validate([
            'ENCADRANT' => 'required|string|max:255'
        ]);

        $doctorant->update(['ENCADRANT' => $request->ENCADRANT]);

        return back()->with('success', 'Directeur de thèse changé avec succès.');
    }

    // Excel Import/Export Methods
    public function importExportView()
    {
        return view('doctorants.import-export');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls',
        ]);
    
        // حذف كل البيانات القديمة
        Doctorant::truncate();
    
        // استخدام Laravel Excel أو أي معالجة خاصة بك:
        Excel::import(new DoctorantsImport, $request->file('file'));
    
        return redirect()->back()->with('success', 'تم استيراد البيانات بنجاح بعد حذف البيانات القديمة.');
    }
    

    public function export()
    {
        return Excel::download(new DoctorantsExport, 'doctorants.xlsx');
    }

    public function downloadTemplate()
    {
        $filePath = public_path('templates/doctorants_template.xlsx');
        return response()->download($filePath);
    }
    // public function import(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|mimes:xlsx,xls,csv'
    //     ]);

    //     Excel::import(new DoctorantsImport, $request->file('file'));

    //     return redirect()->back()->with('success', 'تم الاستيراد بنجاح');
    // }
}
