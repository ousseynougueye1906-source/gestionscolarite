<?php
namespace App\Http\Controllers;

use App\Models\CategorieNiveau;
use App\Services\CategorieNiveauService;
use App\Http\Requests\StoreCategorieNiveauRequest;
use App\Http\Requests\UpdateCategorieNiveauRequest;

class CategorieNiveauController extends Controller
{
    private $service;

    public function __construct(CategorieNiveauService $service)
    {
        $this->service = $service;
    }

    public function create()
    {
        $categories = CategorieNiveau::all();
        return view('categorie_niveau.create', compact('categories'));
    }

    public function store(StoreCategorieNiveauRequest $request)
    {
        $this->service->create($request->validated());

        return back()->with('success', 'Catégorie ajoutée');
    }

    public function edit($id)
    {
        $categorie = CategorieNiveau::findOrFail($id);
        return view('categorie_niveau.edit', compact('categorie'));
    }

    public function update(UpdateCategorieNiveauRequest $request, $id)
    {
        $categorie = CategorieNiveau::findOrFail($id);

        $this->service->update($categorie, $request->validated());

        return redirect('/categorie-niveau/create')->with('success', 'Catégorie modifiée');
    }

    public function destroy($id)
    {
        $categorie = CategorieNiveau::findOrFail($id);

        $this->service->delete($categorie);

        return redirect('/categorie-niveau/create')->with('success', 'Catégorie supprimée');
    }
}