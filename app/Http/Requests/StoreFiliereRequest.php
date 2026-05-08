<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFiliereRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code' => 'required',
            'nom_filiere' => 'required'
        ];
    }
}