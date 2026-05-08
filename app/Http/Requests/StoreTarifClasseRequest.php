<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTarifClasseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_classe' => 'required|exists:classe,id',
            'id_tarif' => 'required|exists:tarif,id',
            'statut' => 'required|boolean',
        ];
    }
}