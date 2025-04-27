<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsErrors;

use Maatwebsite\Excel\HeadingRowFormatter;
use Throwable;
// use Maatwebsite\Excel\HeadingRowFormatter;
use Maatwebsite\Excel\Validators\Failure;
use PhpOffice\PhpSpreadsheet\Shared\Date;

// HeadingRowFormatter::default('none');

class StudentImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, SkipsOnFailure
{
    use SkipsFailures, SkipsErrors;

    public $inserted = 0;

    public function model(array $row)
    {
        return new Student([
            'NUMERO'          => $row['numero'] ,
            'CNE'             => $row['cne'] ,
            'CIN'             => $row['cin'] ,
            'NOM'             => $row['nom'] ,
            'PRENOM'          => $row['prenom'] ,
            'DATE_NAISSANCE'  => isset($row['date_naisance']) ?
                                 Date::excelToDateTimeObject($row['date_naisance'])->format('Y-m-d') : null,
            'NATIONALITE'     => $row['nationalite'] ,
            'EMAIL'           => $row['email'] ,
            'TELEPHONE'       => $row['telephone'] ,
            'SPECIALITE'      => $row['specialite'] ,
            'SUJET'           => $row['sujet'] ,
            'ENCADREUR_1'     => $row['encadreur_1'] ,
            'ENCADREUR_2'     => $row['encadreur_2'] ,
            'PRESIDENT'       => $row['president'] ,
            'RAPPORTEUR_INT'  => $row['rapporteur_int'] ,
            'RAPPORTEUR_EXT'  => $row['rapporteur_ext'] ,
        ]);
        
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
