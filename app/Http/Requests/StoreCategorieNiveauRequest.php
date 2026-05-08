<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategorieNiveauRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nom_categorieNiveau' => 'required'
        ];
    }
}