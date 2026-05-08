<?php
namespace App\Services;

use App\Models\Filiere;

class FiliereService
{
    public function create(array $data)
    {
        return Filiere::create($data);
    }

    public function update(Filiere $filiere, array $data)
    {
        $filiere->update($data);
        return $filiere;
    }

    public function delete(Filiere $filiere)
    {
        return $filiere->delete();
    }
}