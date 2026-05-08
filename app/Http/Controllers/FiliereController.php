<?php
namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Services\FiliereService;
use App\Http\Requests\StoreFiliereRequest;
use App\Http\Requests\UpdateFiliereRequest;

class FiliereController extends Controller
{
    private $service;

    public function __construct(FiliereService $service)
    {
        $this->service = $service;
    }

    public function create()
    {
        $filieres = Filiere::all();
        return view('filiere.create', compact('filieres'));
    }

    public function store(StoreFiliereRequest $request)
    {
        $this->service->create($request->validated());

        return back()->with('success', 'Filière ajoutée');
    }

    public function edit($id)
    {
        $filiere = Filiere::findOrFail($id);
        return view('filiere.edit', compact('filiere'));
    }

    public function update(UpdateFiliereRequest $request, $id)
    {
        $filiere = Filiere::findOrFail($id);

        $this->service->update($filiere, $request->validated());

        return redirect('/filiere/create')->with('success', 'Filière modifiée');
    }

    public function destroy($id)
    {
        $filiere = Filiere::findOrFail($id);

        $this->service->delete($filiere);

        return redirect('/filiere/create')->with('success', 'Filière supprimée');
    }
}