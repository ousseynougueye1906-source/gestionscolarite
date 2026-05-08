<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use App\Models\CategorieNiveau;
use App\Services\NiveauService;
use App\Http\Requests\StoreNiveauRequest;
use App\Http\Requests\UpdateNiveauRequest;

class NiveauController extends Controller
{
    private $service;

    public function __construct(NiveauService $service)
    {
        $this->service = $service;
    }

    public function create()
    {
        $categories = CategorieNiveau::all();
        $niveaux = Niveau::with('categorieNiveau')->get();

        return view('niveaux.create', compact('categories', 'niveaux'));
    }

    public function store(StoreNiveauRequest $request)
    {
        $this->service->create($request->validated());

        return back()->with('success', 'Niveau ajouté');
    }

    public function edit($id)
    {
        $niveau = Niveau::findOrFail($id);
        $categories = CategorieNiveau::all();

        return view('niveaux.edit', compact('niveau', 'categories'));
    }

    public function update(UpdateNiveauRequest $request, $id)
    {
        $niveau = Niveau::findOrFail($id);

        $this->service->update($niveau, $request->validated());

        return redirect('/niveaux/create')->with('success', 'Niveau modifié');
    }

    public function destroy($id)
    {
        $niveau = Niveau::findOrFail($id);

        $this->service->delete($niveau);

        return redirect('/niveaux/create')->with('success', 'Niveau supprimé');
    }
}