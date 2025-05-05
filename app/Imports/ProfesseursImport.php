<?php

namespace App\Imports;

use App\Models\Prof;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Facades\Log;

class ProfesseursImport implements ToModel, WithHeadingRow, SkipsOnError, SkipsOnFailure
{
    use \Maatwebsite\Excel\Concerns\SkipsErrors;
    use \Maatwebsite\Excel\Concerns\SkipsFailures;

    private $rowCount = 0;
    private $importedCount = 0;
    private $customErrors = [];

    public function model(array $row)
    {
        $this->rowCount++;

        try {
            $prof = new Prof([
                'nom_prenom'          => $row['nomprenom'] ?? null,
                'nom_prenom_arabe'    => $row['nomprenomarabe'] ?? null,
                'email_professionnel' => $row['emailprofessionnel'] ?? null,
                'numero_telephone'    => $row['numerotelephone'] ?? null,
                'grade'               => $row['grade'] ?? null,
                'grade_ar'            => $row['gradear'] ?? null,
                'departement'         => $row['departement'] ?? null,
                'departement_ar'      => $row['departementar'] ?? null,
                'etablissement_fr'    => $row['etablissementfr'] ?? null,
                'etablissement_ar'    => $row['etablissementar'] ?? null,
                'type'                => $row['type'] ?? null,
                'sexe'                => $row['sexe'] ?? null,
                'doc'                 => $row['doc'] ?? null,
                'prof'                => $row['prof'] ?? null,
                'genre'               => $row['genre'] ?? null,
                'status_ar'           => $row['statusar'] ?? null,
            ]);

            $this->importedCount++;
            return $prof;

        } catch (\Exception $e) {
            $this->addError($this->rowCount, $e->getMessage(), $row);
            Log::error('Import Error - Row '.$this->rowCount.': '.$e->getMessage());
            return null;
        }
    }

    // public function rules(): array
    // {
    //     return [
    //         'nomprenom'          => 'required|string|max:255',
    //         'nomprenomarabe'     => 'required|string|max:255',
    //         'emailprofessionnel' => 'required|email|max:255|unique:profs,email_professionnel',
    //         'numerotelephone'    => 'nullable|string|max:20',
    //         'grade'              => 'required|string|max:100',
    //         'gradear'            => 'required|string|max:100',
    //         'departement'        => 'required|string|max:255',
    //         'departementar'      => 'required|string|max:255',
    //         'etablissementfr'    => 'required|string|max:255',
    //         'etablissementar'    => 'required|string|max:255',
    //         'type'              => 'required|string|max:50',
    //         'sexe'              => 'required|string|in:M,F',
    //         'doc'               => 'nullable|string|max:50',
    //         'prof'              => 'nullable|string|max:50',
    //         'genre'             => 'required|string|max:50',
    //         'statusar'          => 'required|string|max:100',
    //     ];
    // }

    public function customValidationMessages()
    {
        return [
            'emailprofessionnel.unique' => 'Cet email professionnel existe déjà dans la base de données',
            'required' => 'Le champ :attribute est obligatoire',
            'string' => 'Le champ :attribute doit être une chaîne de caractères',
            'max' => 'Le champ :attribute ne doit pas dépasser :max caractères',
            'email' => 'Le champ :attribute doit être une adresse email valide',
            'in' => 'Le champ :attribute a une valeur non valide',
        ];
    }

    private function addError(int $row, string $message, array $data = [])
    {
        $this->customErrors[] = [
            'row' => $row,
            'message' => $message,
            'data' => $data
        ];
    }

    public function getRowCount(): int
    {
        return $this->rowCount;
    }

    public function getImportedCount(): int
    {
        return $this->importedCount;
    }

    public function getErrorCount(): int
    {
        return count($this->failures()) + count($this->customErrors);
    }

    public function getAllErrors(): array
    {
        return array_merge(
            $this->failures()->toArray(),
            $this->customErrors
        );
    }
    public function getErrors(): array
    {
        return $this->errors;
    }
}
