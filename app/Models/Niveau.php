<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    protected $table = 'niveaux';

    protected $primaryKey = 'id_niveaux';

    protected $fillable = [
        'nom_niveaux',
        'id_categorieNiveau'
    ];

    public $timestamps = false;

    public function categorieNiveau()
    {
        return $this->belongsTo(CategorieNiveau::class, 'id_categorieNiveau');
    }

    public function classes()
    {
        return $this->hasMany(Classe::class, 'id_niveaux');
    }
}
