<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TarifClasse extends Model
{
    protected $table = 'tarif_classe';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_classe',
        'id_tarif',
        'statut'
    ];

    public $timestamps = false;

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_classe', 'id_classe');
    }

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif', 'id_tarif');
    }
}