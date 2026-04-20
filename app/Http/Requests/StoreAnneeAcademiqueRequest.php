<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class StoreAnneeAcademiqueRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'libelle' => 'required|unique:annee_academique,libelle',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'date_ouverture_inscription' => 'nullable|date',
            'date_fermeture_inscription' => 'nullable|date|after:date_ouverture_inscription',
            'date_ouverture_ecole' => 'nullable|date',
            'date_fermeture_classe' => 'nullable|date|after:date_ouverture_ecole',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $this->all();

            if (!empty($data['date_ouverture_inscription']) && !empty($data['date_ouverture_ecole'])) {
                $oi = Carbon::parse($data['date_ouverture_inscription']);
                $oe = Carbon::parse($data['date_ouverture_ecole']);

                if ($oi->diffInDays($oe) < 30) {
                    $validator->errors()->add('date_ouverture_inscription',
                        "Doit être au moins 1 mois avant l'ouverture de l'école");
                }
            }

            if (!empty($data['date_fermeture_inscription']) && !empty($data['date_ouverture_ecole'])) {
                $fi = Carbon::parse($data['date_fermeture_inscription']);
                $oe = Carbon::parse($data['date_ouverture_ecole']);

                if ($fi->lt($oe)) {
                    $validator->errors()->add('date_fermeture_inscription',
                        "Doit être après l'ouverture de l'école");
                }
            }
        });
    }
}