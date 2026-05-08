<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\AnneeAcademique;

class AnneeAcademiqueTest extends TestCase
{
    use RefreshDatabase;

    /**
     * ✅ Test intégration : bonnes valeurs
     */
    public function test_creation_avec_bonnes_valeurs()
    {
        $response = $this->post('/annee-academique/store', [
            'libelle' => '2025-2026',
            'date_debut' => '2025-10-01',
            'date_fin' => '2026-07-01',
        ]);

        $response->assertSessionHasNoErrors();
    }

    /**
     * ❌ Test intégration : dates incohérentes
     */
    public function test_dates_incoherentes()
    {
        $response = $this->post('/annee-academique/store', [
            'libelle' => 'Test1',
            'date_debut' => '2025-10-01',
            'date_fin' => '2025-09-01',
        ]);

        $response->assertSessionHasErrors('date_fin');
    }

    /**
     * ❌ Test intégration : année ≠ 9 mois
     */
    public function test_annee_pas_9_mois()
    {
        $response = $this->post('/annee-academique/store', [
            'libelle' => 'Test2',
            'date_debut' => '2025-10-01',
            'date_fin' => '2026-06-01', // 8 mois
        ]);

        $response->assertSessionHasErrors('date_fin');
    }

    /**
     * ❌ Test intégration : année déjà existante
     */
    public function test_annee_existante()
    {
        AnneeAcademique::create([
            'libelle' => '2025-2026',
            'date_debut' => '2025-10-01',
            'date_fin' => '2026-07-01',
        ]);

        $response = $this->post('/annee-academique/store', [
            'libelle' => '2025-2026',
            'date_debut' => '2025-10-01',
            'date_fin' => '2026-07-01',
        ]);

        $response->assertSessionHasErrors('libelle');
    }
}