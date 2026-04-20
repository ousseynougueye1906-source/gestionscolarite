<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    protected $table = 'filiere';

    protected $primaryKey = 'id_filiere';

    protected $fillable = [
        'code',
        'nom_filiere'
    ];

    public function classes()
    {
        return $this->hasMany(Classe::class, 'id_filiere');
    }
}