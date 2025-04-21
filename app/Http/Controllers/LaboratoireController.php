<?php

namespace App\Http\Controllers;

use App\Models\Laboratoire;
use Illuminate\Http\Request;

class LaboratoireController extends Controller
{
    public function index()
    {
        $laboratoires = Laboratoire::all();
        return view('laboratoires.index', compact('laboratoires'));
    }

    public function create()
    {
        return view('laboratoires.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'nom_ar' => 'required|string|max:255',
            'localisation' => 'required|string|max:255',
        ]);

        Laboratoire::create($validated);

        return redirect()->route('laboratoires.index')
                         ->with('success', 'Laboratoire créé avec succès.');
    }

    public function show(Laboratoire $laboratoire)
    {
        return view('laboratoires.show', compact('laboratoire'));
    }

    public function edit(Laboratoire $laboratoire)
    {
        return view('laboratoires.edit', compact('laboratoire'));
    }

    public function update(Request $request, Laboratoire $laboratoire)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'nom_ar' => 'required|string|max:255',
            'localisation' => 'required|string|max:255',
        ]);

        $laboratoire->update($validated);

        return redirect()->route('laboratoires.index')
                         ->with('success', 'Laboratoire mis à jour avec succès.');
    }

    public function destroy(Laboratoire $laboratoire)
    {
        $laboratoire->delete();
        return redirect()->route('laboratoires.index')
                         ->with('success', 'Laboratoire supprimé avec succès.');
    }

    public function members(Laboratoire $laboratoire)
    {
        $profs = $laboratoire->profs;
        $doctorants = $laboratoire->doctorants;

        return view('laboratoires.members', compact('laboratoire', 'profs', 'doctorants'));
    }
}
