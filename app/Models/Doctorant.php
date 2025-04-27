<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doctorant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'cne',
        'cin',
        'nom',
        'prenom',
        'nom_ar',
        'prenom_ar',
        'date_naissance',
        'lieu_naissance',
        'nationalite',
        'sexe',
        'fonctionnaire',
        'bourse',
        'formation',
        'sujet',
        'id_prof',
        'id_laboratoire',
        'date_soutenance',
        'situation',
        'these',
        'mention'
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'date_soutenance' => 'date',
        'fonctionnaire' => 'boolean',
        'deleted_at' => 'datetime',
        'sexe' => 'string',
    ];

    /**
     * Get the user that owns the doctorant
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the prof (supervisor) for the doctorant
     */
    public function prof(): BelongsTo
    {
        return $this->belongsTo(Prof::class, 'id_prof');
    }

    /**
     * Get the laboratoire for the doctorant
     */
    public function laboratoire(): BelongsTo
    {
        return $this->belongsTo(Laboratoire::class, 'id_laboratoire');
    }
}
