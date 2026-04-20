<?php
namespace App\Http\Controllers;
use App\Http\Requests\StoreAnneeAcademiqueRequest;
use App\Http\Requests\UpdateAnneeAcademiqueRequest;
use App\Services\AnneeAcademiqueService;
use App\Models\AnneeAcademique;

class AnneeAcademiqueController extends Controller
{
    private $service;

    public function __construct(AnneeAcademiqueService $service)
    {
        $this->service = $service;
    }

    public function create()
{
    $annees = AnneeAcademique::orderBy('date_debut', 'desc')->get();
    return view('annee_academique.create', compact('annees'));
}

     public function edit($id)
    {
        $annee = AnneeAcademique::findOrFail($id);
        return view('annee_academique.edit', compact('annee'));
    }

    public function store(StoreAnneeAcademiqueRequest $request)
    {
        $this->service->create($request->validated());

        return back()->with('success', 'Année créée');
    }

    public function update(UpdateAnneeAcademiqueRequest $request, $id)
    {
        $annee = AnneeAcademique::findOrFail($id);

        if ($annee->estCloture()) {
            return back()->with('error', 'Année clôturée');
        }

        $this->service->update($annee, $request->validated());

        return redirect('/annee-academique/create')->with('success', 'Modifiée');
    }

    public function publier($id)
    {
        $annee = AnneeAcademique::findOrFail($id);

        try {
            $this->service->publier($annee);
            return back()->with('success', 'Publié');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $annee = AnneeAcademique::findOrFail($id);

        try {
            $this->service->delete($annee);
            return back()->with('success', 'Supprimé');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}