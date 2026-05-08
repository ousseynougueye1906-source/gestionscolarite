<?php
namespace App\Services;

use App\Models\TarifClasse;

class TarifClasseService
{
    public function create(array $data)
    {
        return TarifClasse::create($data);
    }

    public function update(TarifClasse $tarifClasse, array $data)
    {
        $tarifClasse->update($data);
        return $tarifClasse;
    }

    public function delete(TarifClasse $tarifClasse)
    {
        return $tarifClasse->delete();
    }
}