<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Upload;


class Doctorant extends Model
{
    protected $table = 'doctorants';

    /**
     * الحقول التي يمكن تعبئتها جماعياً (Mass Assignment)
     */
    protected $fillable = [
        'upload_id',
        'NUMERO',
        'CNE',
        'CIN',
        'NOM',
        'PRENOM',
        'NOMAR',
        'PRENOMAR',
        'DATENAISSANCE',
        'LIEUNAISSANCE',
        'LIEUNAISSANCEAR',
        'SEXE',
        'FONCTIONNAIRE',
        'BOURSE',
        'PROMO',
        'FORMATION',
        'LABORATOIRE',
        'IMAGE',
        'SITUATION',
        'THESE',
        'ANNEESOUTENANCE',
        'DATESOUTENANCE',
        'REMARQUE',
        'RAPPORTEUR1',
        'Etat_Rapporteur1',
        'DateDeDepotRapport1',
        'RAPPORTEUR2',
        'EtatRapporteur2',
        'DateDeDepotRapport2',
        'RAPPORTEUR3',
        'EtatRapporteur3',
        'DateDeDepotRapport3',
        'JURY1',
        'GRADE1',
        'STATUS1',
        'JURY2',
        'GRADE2',
        'STATUS2',
        'JURY3',
        'GRADE3',
        'STATUS3',
        'JURY4',
        'GRADE4',
        'STATUS4',
        'JURY5',
        'GRADE5',
        'STATUS5',
        'JURY6',
        'GRADE6',
        'STATUS6',
        'JURY7',
        'GRADE7',
        'STATUS7',
        'MENTIONFR',
        'MENTIONAR',
        'NATIONALITE',
        'EMAIL',
        'TELEPHONE',
        'SUJET',
        'ENCADRANT',
        'COENCADRANT',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * الحقول التي يتم تحويلها تلقائيًا لأنواع بيانات محددة
     */
    protected $casts = [
        'DATENAISSANCE' => 'date',
        'DATESOUTENANCE' => 'date',
        'DateDeDepotRapport1' => 'date',
        'DateDeDepotRapport2' => 'date',
        'DateDeDepotRapport3' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'FONCTIONNAIRE' => 'boolean',
        'BOURSE' => 'boolean',
        'TELEPHONE' => 'string',
    ];

    /**
     * العلاقة مع جدول الرفعات (Upload)
     */
    // public function upload()
    // {
    //     return $this->belongsTo(Upload::class, 'upload_id');
    // }

    /**
     * نطاق البحث عن الطلاب حسب رقم الرفع
     */
    public function scopeByUpload($query, $uploadId)
    {
        return $query->where('upload_id', $uploadId);
    }

    /**
     * نطاق البحث عن الطلاب الحاليين (أحدث رفع)
     */
    public function scopeCurrent($query)
    {
        return $query->where('upload_id', function($q) {
            $q->selectRaw('MAX(upload_id)')
              ->from('students');
        });
    }

    /**
     * مُعدّل لتحويل تاريخ الميلاد إلى صيغة مقروءة
     */
    public function getFormattedDateNaissanceAttribute()
    {
        return $this->DATENAISSANCE ? $this->DATENAISSANCE->format('d/m/Y') : 'غير محدد';
    }

    /**
     * مُعدّل للحصول على الاسم الكامل بالفرنسية
     */
    public function getFullNameAttribute()
    {
        return trim($this->NOM . ' ' . $this->PRENOM);
    }

    /**
     * مُعدّل للحصول على الاسم الكامل بالعربية
     */
    public function getFullNameArAttribute()
    {
        return trim($this->NOMAR . ' ' . $this->PRENOMAR);
    }
    public function prof()
    {
        return $this->belongsTo(Prof::class, 'id_prof');
    }
    public function laboratoire()
    {
        return $this->belongsTo(Laboratoire::class, 'id_laboratoire', 'id');
    }


//     public function upload()
// {
//     return $this->belongsTo(Upload::class);
// }
public function jury1()
{
    return $this->belongsTo(Prof::class, 'JURY1', 'nom_prenom');
}

public function jury2()
{
    return $this->belongsTo(Prof::class, 'JURY2', 'nom_prenom');
}

public function jury3()
{
    return $this->belongsTo(Prof::class, 'JURY3', 'nom_prenom');
}

public function jury4()
{
    return $this->belongsTo(Prof::class, 'JURY4', 'nom_prenom');
}
public function jury5()
{
    return $this->belongsTo(Prof::class, 'JURY5', 'nom_prenom');

}
public function jury6()
{
    return $this->belongsTo(Prof::class, 'JURY6', 'nom_prenom');
}
public function jury7()
{
    return $this->belongsTo(Prof::class, 'JURY7', 'nom_prenom');
}
}
