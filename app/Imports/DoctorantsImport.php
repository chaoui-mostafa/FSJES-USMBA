<?php
namespace App\Imports;

use App\Models\Doctorant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DoctorantsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Doctorant([
            'NUMERO' => $row['numero'],
            'CNE' => $row['cne'],
            'CIN' => $row['cin'],
            'NOM' => $row['nom'],
            'PRENOM' => $row['prenom'],
            'NOMAR' => $row['nomar'],
            'PRENOMAR' => $row['prenomar'],
            'DATENAISSANCE' => $row['datenaissance'] ?? null,
            'LIEUNAISSANCE' => $row['lieunaissance'],
            'LIEUNAISSANCEAR' => $row['lieunaissancear'],
            'NATIONALITE' => $row['nationalite'],
            'EMAIL' => $row['email'],
            'TELEPHONE' => $row['telephone'],
            'SEXE' => $row['sexe'],
            'IMAGE' => $row['image'],
            'FONCTIONNAIRE' => $row['fonctionnaire'],
            'BOURSE' => $row['bourse'],
            'PROMO' => $row['promo'],
            'FORMATION' => $row['formation'],
            'LABORATOIRE' => $row['laboratoire'],
            'SUJET' => $row['sujet'],
            'ENCADRANT' => $row['encadrant'],
            'COENCADRANT' => $row['coencadrant'],
            'DATESOUTENANCE' => $row['datesoutenance'] ?? null,
            'ANNEESOUTENANCE' => $row['anneesoutenance'],
            'REMARQUE' => $row['remarque'],
            'SITUATION' => $row['situation'],
            'THESE' => $row['these'],
            'RAPPORTEUR1' => $row['rapporteur1'],
            'EtatRapporteur1' => $row['etatrapporteur1'],
            'DateDeDepotRapport1' => $row['datededepotrapport1'] ?? null,
            'RAPPORTEUR2' => $row['rapporteur2'],
            'EtatRapporteur2' => $row['etatrapporteur2'],
            'DateDeDepotRapport2' => $row['datededepotrapport2'] ?? null,
            'RAPPORTEUR3' => $row['rapporteur3'],
            'EtatRapporteur3' => $row['etatrapporteur3'],
            'DateDeDepotRapport3' => $row['datededepotrapport3'] ?? null,
            'JURY1' => $row['jury1'],
            'GRADE1' => $row['grade1'],
            'STATUS1' => $row['status1'],
            'JURY2' => $row['jury2'],
            'GRADE2' => $row['grade2'],
            'STATUS2' => $row['status2'],
            'JURY3' => $row['jury3'],
            'GRADE3' => $row['grade3'],
            'STATUS3' => $row['status3'],
            'JURY4' => $row['jury4'],
            'GRADE4' => $row['grade4'],
            'STATUS4' => $row['status4'],
            'JURY5' => $row['jury5'],
            'GRADE5' => $row['grade5'],
            'STATUS5' => $row['status5'],
            'JURY6' => $row['jury6'],
            'GRADE6' => $row['grade6'],
            'STATUS6' => $row['status6'],
            'JURY7' => $row['jury7'],
            'GRADE7' => $row['grade7'],
            'STATUS7' => $row['status7'],
            'MENTIONFR' => $row['mentionfr'],
            'MENTIONAR' => $row['mentionar'],
            'PASSWORD' => $row['password'],
            'TOKEN' => $row['token'],
            'last_login' => $row['last_login'] ?? null,
            'last_logout' => $row['last_logout'] ?? null,
        ]);
    }
}
