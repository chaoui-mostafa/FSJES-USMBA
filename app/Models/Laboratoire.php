<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laboratoire extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_laboratoire';
    protected $fillable = [
        'nom',
        'nom_ar',
        'localisation'
    ];

    /**
     * Get all profs for the laboratoire
     */
    public function profs(): HasMany
    {
        return $this->hasMany(Prof::class, 'id_laboratoire');
    }

    /**
     * Get all doctorants for the laboratoire
     */
    public function doctorants(): HasMany
    {
        return $this->hasMany(Doctorant::class, 'id_laboratoire');
    }
}
