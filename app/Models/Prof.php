<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prof extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nom_prenom',
        'nom_prenom_arabe',
        'email_professionnel',
        'numero_telephone',
        'grade',
        'grade_ar',
        'departement',
        'departement_ar',
        'etablissement_fr',
        'etablissement_ar',
        'type',
        'sexe',
        'doc',
        'prof',
        'genre',
        'status_ar',
        'id_laboratoire'
    ];

    protected $casts = [
        'sexe' => 'string',
        'numero_telephone' => 'string',
    ];

    /**
     * Get the user that owns the prof
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the laboratoire that owns the prof
     */
  // داخل Prof.php
  public function laboratoire()
{
    return $this->belongsTo(Laboratoire::class, 'id_laboratoire');
}


    /**
     * Get all doctorants supervised by this prof
     */
    public function doctorants(): HasMany
    {
        return $this->hasMany(Doctorant::class, 'id_prof');
    }

    /**
     * Get the prof's full name (French)
     */
    public function getFullNameAttribute(): string
    {
        return $this->nom_prenom;
    }

    /**
     * Get the prof's full name (Arabic)
     */
    public function getFullNameArAttribute(): string
    {
        return $this->nom_prenom_arabe;
    }

    /**
     * Scope a query to search professors
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('nom_prenom', 'like', '%'.$search.'%')
                    ->orWhere('nom_prenom_arabe', 'like', '%'.$search.'%')
                    ->orWhere('email_professionnel', 'like', '%'.$search.'%');
    }
}
