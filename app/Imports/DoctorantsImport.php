<?php
namespace App\Imports;

use App\Models\Doctorant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DoctorantsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Retourne un nouveau modèle Doctorant avec les données de chaque ligne du fichier
        return new Doctorant([
            'nomar' => $row['nomar'],
            'prenomar' => $row['prenomar'],
            'datenaissance' => \Carbon\Carbon::parse($row['datenaissance']),
            'email' => $row['email'],
            'telephone' => $row['telephone'],
            'fonctionnaire' => $row['fonctionnaire'],
            'bourse' => $row['bourse'],
            'promo' => $row['promo'],
            'formation' => $row['formation'],
            'laboratoire' => $row['laboratoire'],
            'sujet' => $row['sujet'],
            'encadrant' => $row['encadrant'],
            // Ajoutez tous les champs nécessaires ici
        ]);
    }
}
