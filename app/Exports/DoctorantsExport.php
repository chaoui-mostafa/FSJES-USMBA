<?php
namespace App\Exports;

use App\Models\Doctorant;
use Maatwebsite\Excel\Concerns\FromCollection;

class DoctorantsExport implements FromCollection {
    public function collection() {
        return Doctorant::all();
    }
}
