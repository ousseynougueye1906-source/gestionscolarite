<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClasseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code_classe' => 'required|unique:classe,code_classe',
            'nom_classe' => 'required',
        ];
    }
}