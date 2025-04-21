<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prof extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_prof';
    protected $fillable = [
        'user_id',
        'nom',
        'nom_ar',
        'grade',
        'etablissement',
        'departement',
        'type',
        'sexe',
        'id_laboratoire'
    ];

    protected $casts = [
        'sexe' => 'string',
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
    public function laboratoire(): BelongsTo
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
}
