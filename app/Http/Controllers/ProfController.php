<?php

namespace App\Http\Controllers;

use App\Models\Prof;
use App\Models\Laboratoire;
use Illuminate\Http\Request;

class ProfController extends Controller
{
    public function index()
    {
        $profs = Prof::with('laboratoire')->get();
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
            'user_id' => 'required|exists:users,id',
            'nom' => 'required|string|max:255',
            'nom_ar' => 'required|string|max:255',
            'grade' => 'required|string|max:100',
            'etablissement' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'sexe' => 'required|in:M,F',
            'id_laboratoire' => 'required|exists:laboratoires,id_laboratoire',
        ]);

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
            'nom' => 'required|string|max:255',
            'nom_ar' => 'required|string|max:255',
            'grade' => 'required|string|max:100',
            'etablissement' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'id_laboratoire' => 'required|exists:laboratoires,id_laboratoire',
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
}
