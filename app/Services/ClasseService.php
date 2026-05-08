<?php
namespace App\Services;

use App\Models\Classe;

class ClasseService
{
    public function create(array $data)
    {
        return Classe::create($data);
    }

    public function update(Classe $classe, array $data)
    {
        $classe->update($data);
        return $classe;
    }

    public function delete(Classe $classe)
    {
        return $classe->delete();
    }
}