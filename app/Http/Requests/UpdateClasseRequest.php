<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClasseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('id'); // récupère l'id de la route

        return [
            'code_classe' => 'required|unique:classe,code_classe,' . $id,
            'nom_classe' => 'required',
        ];
    }
}