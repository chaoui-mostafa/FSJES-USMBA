<?php

namespace App\Http\Controllers;

use App\Models\Prof;
use App\Models\Laboratoire;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProfesseursImport;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;


class ProfController extends Controller
{
    public function index(Request $request)
    {
        // For AJAX requests (live search)
        if ($request->ajax()) {
            return response()->json([
                'profs' => Prof::with('laboratoire')
                    ->when($request->search, function($query) use ($request) {
                        $query->where('nom_prenom', 'like', '%'.$request->search.'%')
                              ->orWhere('email_professionnel', 'like', '%'.$request->search.'%')
                              ->orWhere('numero_telephone', 'like', '%'.$request->search.'%');
                    })
                    ->limit(20)
                    ->get()
            ]);
        }

        // For regular page load
        $profs = Prof::with('laboratoire')->paginate(15);
        return view('profs.index', compact('profs'));
    }

    public function create()
    {
        $laboratoires = Laboratoire::all();
        return view('profs.create', compact('laboratoires'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_prenom' => 'required|string|max:255',
            'nom_prenom_arabe' => 'required|string|max:255',
            'email_professionnel' => 'required|email|unique:profs,email_professionnel',
            'numero_telephone' => 'required|string|max:20',
            'sexe' => 'required|in:M,F',
            'grade' => 'required|string|max:255',
            'grade_ar' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'departement_ar' => 'required|string|max:255',
            'etablissement_fr' => 'required|string|max:255',
            'etablissement_ar' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'status_ar' => 'nullable|string|max:255',
            'id_laboratoire' => 'nullable|exists:laboratoires,id',
            'doc' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('doc')) {
            $path = $request->file('doc')->store('prof_documents', 'public');
            $validated['doc'] = $path;
        }

        // Create the professor
        Prof::create($validated);

        return redirect()->route('profs.index')
            ->with('success', 'Professeur ajouté avec succès.');
    }

    public function show(Prof $prof)
    {
        return view('profs.show', compact('prof'));
    }

    public function edit(Prof $prof)
    {
        $laboratoires = Laboratoire::all();
        return view('profs.edit', compact('prof', 'laboratoires'));
    }

    public function update(Request $request, Prof $prof)
{
    $validated = $request->validate([
        'nom_prenom' => 'required|string|max:255',
        'nom_prenom_arabe' => 'required|string|max:255',
        'email_professionnel' => 'required|email|unique:profs,email_professionnel,'.$prof->id,
        'numero_telephone' => 'required|string|max:20',
        'sexe' => 'required|in:M,F',
        'genre' => 'required|string|max:255',
        'grade' => 'required|string|max:255',
        'grade_ar' => 'required|string|max:255',
        'departement' => 'required|string|max:255',
        'departement_ar' => 'required|string|max:255',
        'etablissement_fr' => 'required|string|max:255',
        'etablissement_ar' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'status_ar' => 'nullable|string|max:255',
        'id_laboratoire' => 'nullable|exists:laboratoires,id',
        'doc' => 'nullable|string|max:255',
    ]);



    $prof->update($validated);

    return redirect()->route('profs.index')
        ->with('success', 'Professeur mis à jour avec succès.');
}

    public function destroy(Prof $prof)
    {
        $prof->delete();
        return redirect()->route('profs.index')
                         ->with('success', 'Professeur supprimé avec succès.');
    }

    public function supervisions(Prof $prof)
    {
        $doctorants = $prof->doctorants;
        return view('profs.supervisions', compact('prof', 'doctorants'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls,csv|max:10240'
        ]);
        try {
            Prof::truncate();
            $import = new ProfesseursImport;
            Excel::import($import, $request->file('excel_file'));

            $importedCount = $import->getRowCount();
            $errorCount = $import->getErrorCount();

            if ($errorCount > 0) {
                return back()
                    ->with('warning', "Importation partielle réussie: $importedCount enregistrements importés, $errorCount erreurs")
                    ->with('import_errors', $import->getErrors());
            }

            return back()->with('success', "Importation réussie: $importedCount professeurs importés");

        } catch (\Exception $e) {
            Log::error('Import Error: '.$e->getMessage());
            return back()
                ->with('error', 'Erreur lors de l\'importation: '.$e->getMessage())
                ->withInput();
        }
    }


}
