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

    public function messages()
    {
        return [
            'date_fin.after' => 'La date de fin doit être après la date de début',
            'date_fermeture_inscription.after' => 'La fermeture des inscriptions doit être après l’ouverture',
            'date_fermeture_classe.after' => 'La fermeture des classes doit être après l’ouverture de l’école',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $data = $this->all();

            // 🔹 1. Vérifier durée = 9 mois
            if (!empty($data['date_debut']) && !empty($data['date_fin'])) {
                $debut = Carbon::parse($data['date_debut']);
                $fin = Carbon::parse($data['date_fin']);

            if (!$debut->copy()->addMonths(9)->equalTo($fin)) {
                $validator->errors()->add(
                'date_fin',
                "Une année académique doit durer exactement 9 mois"
                );
            }
            }

            // 🔹 2. Ouverture inscription = 1 mois avant école
            if (!empty($data['date_ouverture_inscription']) && !empty($data['date_ouverture_ecole'])) {
                $oi = Carbon::parse($data['date_ouverture_inscription']);
                $oe = Carbon::parse($data['date_ouverture_ecole']);

                if ($oi->diffInDays($oe) < 30) {
                    $validator->errors()->add(
                        'date_ouverture_inscription',
                        "L'ouverture des inscriptions doit être au moins 1 mois avant l'ouverture de l'école"
                    );
                }
            }

            // 🔹 3. Fermeture inscription après ouverture école
            if (!empty($data['date_fermeture_inscription']) && !empty($data['date_ouverture_ecole'])) {
                $fi = Carbon::parse($data['date_fermeture_inscription']);
                $oe = Carbon::parse($data['date_ouverture_ecole']);

                if ($fi->lt($oe)) {
                    $validator->errors()->add(
                        'date_fermeture_inscription',
                        "La fermeture des inscriptions doit être après l'ouverture de l'école"
                    );
                }
            }

        });
    }
}