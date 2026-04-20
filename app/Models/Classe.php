<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $table = 'classe';

    protected $primaryKey = 'id_classe';

    protected $fillable = [
        'nom_classe',
        'code_classe'
    ];

    public $timestamps = false;

    public function tarifs()
    {
        return $this->hasMany(Tarif::class, 'id_classe');
    }
}