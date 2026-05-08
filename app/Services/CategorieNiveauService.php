<?php
namespace App\Services;

use App\Models\CategorieNiveau;

class CategorieNiveauService
{
    public function create(array $data)
    {
        return CategorieNiveau::create($data);
    }

    public function update(CategorieNiveau $categorie, array $data)
    {
        $categorie->update($data);
        return $categorie;
    }

    public function delete(CategorieNiveau $categorie)
    {
        return $categorie->delete();
    }
}