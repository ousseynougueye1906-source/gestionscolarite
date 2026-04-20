<?php

namespace App\Http\Controllers;

use App\Models\CategorieNiveau;
use Illuminate\Http\Request;

class CategorieNiveauController extends Controller
{
    public function create()
    {
        $categories = CategorieNiveau::all();
        return view('categorie_niveau.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_categorieNiveau' => 'required'
        ]);

        CategorieNiveau::create($request->all());

        return redirect()->back()->with('success', 'Catégorie ajoutée');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_categorieNiveau' => 'required',
        ]);

        $categorie = CategorieNiveau::findOrFail($id);
        $categorie->update($request->all());

        return redirect('/categorie-niveau/create')->with('success', 'Catégorie modifiée avec succès');
    }
    public function edit($id)
{
    $categorie = CategorieNiveau::findOrFail($id);
    return view('categorie-niveau.edit', compact('categorie'));
}
    public function destroy($id)
    {
        $categorie = CategorieNiveau::findOrFail($id);
        $categorie->delete();
        return redirect('/categorie-niveau/create')->with('success', 'Catégorie supprimée avec succès');
    }
}
