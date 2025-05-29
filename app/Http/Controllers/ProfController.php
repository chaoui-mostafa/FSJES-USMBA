<?php

namespace App\Http\Controllers;

use App\Models\Prof;
use App\Models\Laboratoire;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProfesseurImport;
use App\Imports\ProfesseursImport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Maatwebsite\Excel\Validators\ValidationException as ExcelValidationException;

class ProfController extends Controller
{
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                return response()->json([
                    'profs' => Prof::where('is_new', true)
                        ->with('laboratoire')
                        ->when($request->search, function($query) use ($request) {
                            $query->where('nom_prenom', 'like', '%'.$request->search.'%')
                                  ->orWhere('email_professionnel', 'like', '%'.$request->search.'%')
                                  ->orWhere('numero_telephone', 'like', '%'.$request->search.'%');
                        })
                        ->limit(1090)
                        ->get()
                ]);
            }

            $profs = Prof::where('is_new', true)->with('laboratoire')->paginate(1090);
            return view('profs.index', compact('profs'));

        } catch (\Exception $e) {
            Log::error('Error in ProfController@index: ' . $e->getMessage());
            return $request->ajax()
                ? response()->json(['error' => 'Erreur lors du chargement des professeurs'], 500)
                : redirect()->back()->with('error', 'Erreur lors du chargement des professeurs: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $laboratoires = Laboratoire::all();
            return view('profs.create', compact('laboratoires'));
        } catch (\Exception $e) {
            Log::error('Error in ProfController@create: ' . $e->getMessage());
            return redirect()->route('profs.index')->with('error', 'Erreur lors du chargement du formulaire: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
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
            ]);

            $validated['is_new'] = true; // Mark new records as new

            if ($request->hasFile('doc')) {
                try {
                    $validated['doc'] = $request->file('doc')->store('prof_documents', 'public');
                } catch (FileException $e) {
                    Log::error('File upload error: ' . $e->getMessage());
                    return redirect()->back()->with('error', 'Erreur lors du téléchargement du document: ' . $e->getMessage())->withInput();
                }
            }

            Prof::create($validated);

            return redirect()->route('profs.index')
                ->with('success', 'Professeur ajouté avec succès.');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            Log::error('Database error in ProfController@store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur de base de données: ' . $e->getMessage())->withInput();
        } catch (\Exception $e) {
            Log::error('Error in ProfController@store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur inattendue: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Prof $prof)
    {
        try {
            return view('profs.show', compact('prof'));
        } catch (\Exception $e) {
            Log::error('Error in ProfController@show: ' . $e->getMessage());
            return redirect()->route('profs.index')->with('error', 'Erreur lors de l\'affichage du professeur: ' . $e->getMessage());
        }
    }

    public function edit(Prof $prof)
    {
        try {
            $laboratoires = Laboratoire::all();
            return view('profs.edit', compact('prof', 'laboratoires'));
        } catch (\Exception $e) {
            Log::error('Error in ProfController@edit: ' . $e->getMessage());
            return redirect()->route('profs.index')->with('error', 'Erreur lors du chargement du formulaire: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Prof $prof)
    {
        try {
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
            ]);

            if ($request->hasFile('doc')) {
                try {
                    if ($prof->doc) {
                        Storage::disk('public')->delete($prof->doc);
                    }
                    $validated['doc'] = $request->file('doc')->store('prof_documents', 'public');
                } catch (FileException $e) {
                    Log::error('File upload error: ' . $e->getMessage());
                    return redirect()->back()->with('error', 'Erreur lors du téléchargement du document: ' . $e->getMessage())->withInput();
                }
            }

            $prof->update($validated);

            return redirect()->route('profs.index')
                ->with('success', 'Professeur mis à jour avec succès.');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            Log::error('Database error in ProfController@update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur de base de données: ' . $e->getMessage())->withInput();
        } catch (\Exception $e) {
            Log::error('Error in ProfController@update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur inattendue: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Prof $prof)
    {
        try {
            if ($prof->doc) {
                Storage::disk('public')->delete($prof->doc);
            }

            $prof->delete();
            return redirect()->route('profs.index')
                             ->with('success', 'Professeur supprimé avec succès.');
        } catch (\Exception $e) {
            Log::error('Error in ProfController@destroy: ' . $e->getMessage());
            return redirect()->route('profs.index')
                             ->with('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    public function supervisions(Prof $prof)
    {
        try {
            $doctorants = $prof->doctorants;
            return view('profs.supervisions', compact('prof', 'doctorants'));
        } catch (\Exception $e) {
            Log::error('Error in ProfController@supervisions: ' . $e->getMessage());
            return redirect()->route('profs.index')->with('error', 'Erreur lors du chargement des supervisions: ' . $e->getMessage());
        }
    }

    public function history()
    {
        $profs = Prof::with('laboratoire')->where('is_new', false)->paginate(1090);
        return view('profs.history', compact('profs'));
    }

     public function import(Request $request)
    {
        try {
            $request->validate([
                'excel_file' => 'required|file|mimes:xlsx,xls,csv|max:10240'
            ]);

            // Get all existing emails to check for duplicates
            $existingEmails = Prof::pluck('email_professionnel')->toArray();

            // Delete all old data before import
            Prof::query()->delete();

            $import = new ProfesseursImport($existingEmails);
            Excel::import($import, $request->file('excel_file'));

            $importedCount = $import->getRowCount();
            $skippedCount = $import->getSkippedCount();
            $errorCount = $import->getErrorCount();

            // Get only the newly imported professors
            $newProfs = Prof::with('laboratoire')->get();

            if ($errorCount > 0 || $skippedCount > 0) {
                return back()
                    ->with('warning', "Importation partielle réussie: $importedCount enregistrements importés, $skippedCount doublons ignorés, $errorCount erreurs")
                    ->with('import_errors', $import->getErrors())
                    ->with('skipped_rows', $import->getSkippedRows())
                    ->with('new_profs', $newProfs);
            }

            return back()
                ->with('success', "Importation réussie: $importedCount professeurs importés")
                ->with('new_profs', $newProfs);

        } catch (ExcelValidationException $e) {
            $failures = $e->failures();
            $errors = [];
            foreach ($failures as $failure) {
                $errors[] = "Ligne {$failure->row()}: {$failure->errors()[0]}";
            }
            return back()->with('error', 'Erreurs dans le fichier Excel: ' . implode('<br>', $errors));
        } catch (ValidationException $e) {
            return back()->with('error', 'Erreur de validation: ' . $e->getMessage())->withInput();
        } catch (\Exception $e) {
            Log::error('Import Error: '.$e->getMessage());
            return back()
                ->with('error', 'Erreur lors de l\'importation: '.$e->getMessage())
                ->withInput();
        }
    }


    public function clearOldData()
    {
        try {
            // Delete all non-new professors
            $deletedCount = Prof::where('is_new', false)->delete();

            return back()->with('success', "Anciennes données supprimées avec succès: $deletedCount enregistrements supprimés");
        } catch (\Exception $e) {
            Log::error('Error clearing old data: '.$e->getMessage());
            return back()->with('error', 'Erreur lors de la suppression des anciennes données: '.$e->getMessage());
        }
    }
}
