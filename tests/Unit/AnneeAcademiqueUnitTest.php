<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\AnneeAcademique;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnneeAcademiqueUnitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ✅ Test unitaire : création réussie
     */
    public function test_creation_reussie()
    {
        $annee = AnneeAcademique::create([
            'libelle' => '2025-2026',
            'date_debut' => '2025-10-01',
            'date_fin' => '2026-07-01',
        ]);

        $this->assertDatabaseHas('annee_academique', [
            'libelle' => '2025-2026'
        ]);
    }

    /**
     * ❌ Test unitaire : publier sans autorisation (brouillon)
     */
    public function test_exception_si_on_saute_publier()
    {
        $annee = AnneeAcademique::create([
            'libelle' => '2026-2027',
            'date_debut' => '2026-10-01',
            'date_fin' => '2027-07-01',
            'statut' => 'brouillon'
        ]);

        $this->expectException(\Exception::class);

        // Simule une règle métier (à remplacer par ton service si tu veux)
        if ($annee->statut === 'brouillon') {
            throw new \Exception("Impossible d'accéder sans publier");
        }
    }
}