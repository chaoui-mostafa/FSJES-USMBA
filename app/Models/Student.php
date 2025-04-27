<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'NUMERO',
        'CNE',
        'CIN',
        'NOM',
        'PRENOM',
        'DATE_NAISSANCE',
        'NATIONALITE',
        'EMAIL',
        'TELEPHONE',
        'SPECIALITE',
        'SUJET',
        'ENCADREUR_1',
        'ENCADREUR_2',
        'PRESIDENT',
        'RAPPORTEUR_INT',
        'RAPPORTEUR_EXT',
    ];
}
