<?php
namespace App\Services;

use App\Models\Niveau;

class NiveauService
{
    public function create(array $data)
    {
        return Niveau::create($data);
    }

    public function update(Niveau $niveau, array $data)
    {
        $niveau->update($data);
        return $niveau;
    }

    public function delete(Niveau $niveau)
    {
        return $niveau->delete();
    }
}