<?php

namespace App\Http\Controllers;

use App\Models\Doctorant;
use App\Models\Prof;
use App\Models\Laboratoire;
use Illuminate\Http\Request;
use App\Exports\DoctorantsExport;
use App\Imports\DoctorantsImport;
use Maatwebsite\Excel\Facades\Excel;

class DoctorantController extends Controller
{
    public function index()
    {
        $doctorants = Doctorant::with(['prof', 'laboratoire'])->get();
        return view('doctorants.index', compact('doctorants'));
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
            'user_id' => 'required|exists:users,id',
            'cne' => 'required|string|max:50|unique:doctorants',
            'cin' => 'required|string|max:50|unique:doctorants',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'nom_ar' => 'required|string|max:255',
            'prenom_ar' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string|max:255',
            'nationalite' => 'required|string|max:100',
            'sexe' => 'required|in:M,F',
            'fonctionnaire' => 'required|boolean',
            'bourse' => 'required|string|max:100',
            'formation' => 'required|string|max:255',
            'sujet' => 'required|string',
            'id_prof' => 'required|exists:profs,id_prof',
            'id_laboratoire' => 'required|exists:laboratoires,id_laboratoire',
            'date_soutenance' => 'nullable|date',
            'situation' => 'required|string|max:100',
            'these' => 'required|string|max:255',
            'mention' => 'nullable|string|max:100',
        ]);

        Doctorant::create($validated);

        return redirect()->route('doctorants.index')
                         ->with('success', 'Doctorant ajouté avec succès.');
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
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'nom_ar' => 'required|string|max:255',
            'prenom_ar' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string|max:255',
            'nationalite' => 'required|string|max:100',
            'fonctionnaire' => 'required|boolean',
            'bourse' => 'required|string|max:100',
            'formation' => 'required|string|max:255',
            'sujet' => 'required|string',
            'id_prof' => 'required|exists:profs,id_prof',
            'id_laboratoire' => 'required|exists:laboratoires,id_laboratoire',
            'date_soutenance' => 'nullable|date',
            'situation' => 'required|string|max:100',
            'these' => 'required|string|max:255',
        ]);

        $doctorant->update($validated);

        return redirect()->route('doctorants.index')
                         ->with('success', 'Doctorant mis à jour avec succès.');
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
            'new_prof_id' => 'required|exists:profs,id_prof'
        ]);

        $doctorant->update(['id_prof' => $request->new_prof_id]);

        return back()->with('success', 'Directeur de thèse changé avec succès.');
    }

    /**
     * Export doctorants to Excel
     */
    public function export()
    {
        return Excel::download(new DoctorantsExport, 'doctorants_' . now()->format('Y-m-d') . '.xlsx');
    }

    /**
     * Import doctorants from Excel
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048'
        ]);

        try {
            Excel::import(new DoctorantsImport, $request->file('file'));
            return back()->with('success', 'Importation réussie!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de l\'importation: ' . $e->getMessage());
        }
    }

    /**
     * Download import template
     */
    public function template()
    {
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];

        return response()->download(
            storage_path('app/public/import_template.xlsx'),
            'doctorants_template.xlsx',
            $headers
        );
    }
}
