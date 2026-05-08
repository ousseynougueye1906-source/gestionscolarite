<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNiveauRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nom_niveaux' => 'required',
            'id_categorieNiveau' => 'required|exists:categorie_niveau,id'
        ];
    }
}