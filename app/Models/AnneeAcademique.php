<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AnneeAcademique extends Model
{
    use HasFactory;

    protected $table = 'annee_academique';
    protected $primaryKey = 'id_annee';

    protected $fillable = [
        'libelle',
        'date_debut',
        'date_fin',
        'date_ouverture_inscription',
        'date_fermeture_inscription',
        'date_ouverture_ecole',
        'date_fermeture_classe',
        'statut'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'date_ouverture_inscription' => 'date',
        'date_fermeture_inscription' => 'date',
        'date_ouverture_ecole' => 'date',
        'date_fermeture_classe' => 'date',
    ];

    // Vérifier si l'année est en brouillon
    public function estBrouillon()
    {
        return $this->statut === 'brouillon';
    }

    // Vérifier si l'année est publiée
    public function estPublie()
    {
        return $this->statut === 'publie';
    }

    // Vérifier si les inscriptions sont ouvertes
    public function inscriptionsOuvertes()
    {
        return $this->statut === 'inscription_ouverte';
    }

    // Vérifier si les inscriptions sont fermées
    public function inscriptionsFermees()
    {
        return $this->statut === 'inscription_fermee';
    }

    // Vérifier si l'année est clôturée
    public function estCloture()
    {
        return $this->statut === 'cloture';
    }

    // Vérifier si on peut publier
    public function peutPublier()
    {
        return $this->statut === 'brouillon';
    }

    // Vérifier si on peut ouvrir les inscriptions
    public function peutOuvrirInscriptions()
    {
        return $this->statut === 'publie';
    }

    // Vérifier si on peut fermer les inscriptions
    public function peutFermerInscriptions()
    {
        return $this->statut === 'inscription_ouverte';
    }

    // Vérifier si on peut clôturer
    public function peutCloturer()
    {
        return $this->statut === 'inscription_fermee';
    }

    // Obtenir le badge de statut pour l'affichage
    public function getBadgeStatut()
    {
        $badges = [
            'brouillon' => '<span class="badge bg-secondary">Brouillon</span>',
            'publie' => '<span class="badge bg-primary">Publié</span>',
            'inscription_ouverte' => '<span class="badge bg-success">Inscriptions Ouvertes</span>',
            'inscription_fermee' => '<span class="badge bg-warning text-dark">Inscriptions Fermées</span>',
            'cloture' => '<span class="badge bg-danger">Clôturé</span>',
        ];

        return $badges[$this->statut] ?? '';
    }
}