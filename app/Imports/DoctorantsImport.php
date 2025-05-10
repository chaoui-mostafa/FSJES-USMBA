<?php

namespace App\Imports;

use App\Models\Doctorant;
use App\Models\Student;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\ShouldQueue;
// use Maatwebsite\Excel\Concerns\ShouldQueue;

class DoctorantsImport implements ToModel, WithHeadingRow, WithChunkReading
{
public function model(array $row)
    {
        $row = array_map(function($item) {
            return is_string($item) ? trim($item) : $item;
        }, $row);

        // تحقق إذا كانت القيم الأساسية موجودة، وإذا كانت فارغة، تجاهل الصف
        if (empty($row['numero']) && empty($row['nom']) && empty($row['prenom'])) {
            return null; // هذا سيمنع إضافة صف فارغ
        }

        return new Doctorant([
            'NUMERO' => $row['numero'] ?? null,
            'CNE' => $row['cne'] ?? null,
            'CIN' => $row['cin'] ?? null,
            'NOM' => $row['nom'] ?? null,
            'PRENOM' => $row['prenom'] ?? null,
            'EMAIL' => $row['email'] ?? null,
            'TELEPHONE' => isset($row['telephone']) ? (string) $row['telephone'] : null,
            'NOMAR' => $row['nomar'] ?? null,
            'PRENOMAR' => $row['prenomar'] ?? null,
            'LIEUNAISSANCE' => $row['lieunaissance'] ?? null,
            'LIEUNAISSANCEAR' => $row['lieunaissancear'] ?? null,

            'DATENAISSANCE' => $this->transformDate($row['datenaissance'] ?? null),
            'NATIONALITE' => $row['nationalite'] ?? null,
            'SEXE' => $row['sexe'] ?? null,
            'FONCTIONNAIRE' => $this->transformBoolean($row['fonctionnaire'] ?? null),
            'BOURSE' => $this->transformBoolean($row['bourse'] ?? null),
            'PROMO' => $row['promo'] ?? null,
            'FORMATION' => $row['formation'] ?? null,
            'SUJET' => $row['sujet'] ?? null,
            'ENCADRANT' => $row['encadrant'] ?? null,
            'LABORATOIRE' => $row['laboratoire'] ?? null,
            'IMAGE' => $row['image'] ?? null,
            'SITUATION' => $row['situation'] ?? null,
            'THESE' => $row['these'] ?? null,
            'ANNEESOUTENANCE' => $row['anneesoutenance'] ?? null,
            'DATESOUTENANCE' => $this->transformDate($row['datesoutenance'] ?? null),
            'REMARQUE' => $row['remarque'] ?? null,
            'RAPPORTEUR1' => $row['rapporteur1'] ?? null,
            'EtatRapporteur1' => $row['etatrapporteur1'] ?? null,
            'DateDeDepotRapport1' => $this->transformDate($row['datededepotrapport1'] ?? null),
            'RAPPORTEUR2' => $row['rapporteur2'] ?? null,
            'EtatRapporteur2' => $row['etatrapporteur2'] ?? null,
            'DateDeDepotRapport2' => $this->transformDate($row['datededepotrapport2'] ?? null),
            'RAPPORTEUR3' => $row['rapporteur3'] ?? null,
            'EtatRapporteur3' => $row['etatrapporteur3'] ?? null,
            'DateDeDepotRapport3' => $this->transformDate($row['datededepotrapport3'] ?? null),
            'JURY1' => $row['jury1'] ?? null,
            'GRADE1' => $row['grade1'] ?? null,
            'STATUS1' => $row['status1'] ?? null,
            'JURY2' => $row['jury2'] ?? null,
            'GRADE2' => $row['grade2'] ?? null,
            'STATUS2' => $row['status2'] ?? null,
            'JURY3' => $row['jury3'] ?? null,
            'GRADE3' => $row['grade3'] ?? null,
            'STATUS3' => $row['status3'] ?? null,
            'JURY4' => $row['jury4'] ?? null,
            'GRADE4' => $row['grade4'] ?? null,
            'STATUS4' => $row['status4'] ?? null,
            'JURY5' => $row['jury5'] ?? null,
            'GRADE5' => $row['grade5'] ?? null,
            'STATUS5' => $row['status5'] ?? null,
            'JURY6' => $row['jury6'] ?? null,
            'GRADE6' => $row['grade6'] ?? null,
            'STATUS6' => $row['status6'] ?? null,
            'JURY7' => $row['jury7'] ?? null,
            'GRADE7' => $row['grade7'] ?? null,
            'STATUS7' => $row['status7'] ?? null,

            'MENTIONFR' => $row['mentionfr'] ?? null,
            'MENTIONAR' => $row['mentionar'] ?? null,

        ]);
    }


    private function transformDate($value)
    {
        if (!$value) {
            return null;
        }

        $value = trim($value); // إزالة الفراغات الزائدة

        try {
            // إذا كانت القيمة رقمية (تاريخ Excel)
            if (is_numeric($value)) {
                return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);
            }

            // قائمة بالتنسيقات المحتملة
            $formats = ['Y-m-d', 'd/m/Y', 'm/d/Y', 'd-m-Y'];

            foreach ($formats as $format) {
                $date = Carbon::createFromFormat($format, $value);
                if ($date && $date->format($format) === $value) {
                    return $date;
                }
            }

            // محاولة أخيرة باستخدام parse
            return Carbon::parse($value);

        } catch (\Exception $e) {
            return null;
        }
    }

    private function transformBoolean($value)
{
    return strtolower(trim($value)) === 'oui' ? 1 : 0;
}
 public function chunkSize(): int
    {
        return 5000; // حجم chunk أكبر لمعالجة الملفات الكبيرة
    }
}
