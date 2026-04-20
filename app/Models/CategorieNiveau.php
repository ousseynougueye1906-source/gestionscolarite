<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorieNiveau extends Model
{
    protected $table = 'categorie_niveau';

    protected $primaryKey = 'id_categorieNiveau';

    protected $fillable = [
        'nom_categorieNiveau'
    ];

    public $timestamps = false;

    public function niveaux()
    {
        return $this->hasMany(Niveau::class, 'id_categorieNiveau');
    }
}
