<?php
namespace App\Services;

use App\Models\AnneeAcademique;

class AnneeAcademiqueService
{
    public function create(array $data)
    {
        return AnneeAcademique::create($data);
    }

    public function update(AnneeAcademique $annee, array $data)
    {
        $annee->update($data);
        return $annee;
    }

    public function publier(AnneeAcademique $annee)
    {
        if (!$annee->peutPublier()) {
            throw new \Exception("Impossible de publier");
        }

        return $annee->update(['statut' => 'publie']);
    }

    public function ouvrirInscriptions(AnneeAcademique $annee)
    {
        if (!$annee->peutOuvrirInscriptions()) {
            throw new \Exception("Impossible d'ouvrir");
        }

        return $annee->update(['statut' => 'inscription_ouverte']);
    }

    public function fermerInscriptions(AnneeAcademique $annee)
    {
        if (!$annee->peutFermerInscriptions()) {
            throw new \Exception("Impossible de fermer");
        }

        return $annee->update(['statut' => 'inscription_fermee']);
    }

    public function cloturer(AnneeAcademique $annee)
    {
        if (!$annee->peutCloturer()) {
            throw new \Exception("Impossible de clôturer");
        }

        return $annee->update(['statut' => 'cloture']);
    }

    public function delete(AnneeAcademique $annee)
    {
        if (!$annee->estBrouillon()) {
            throw new \Exception("Suppression interdite");
        }

        return $annee->delete();
    }
}