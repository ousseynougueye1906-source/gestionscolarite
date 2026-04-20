<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use App\Models\CategorieNiveau;
use Illuminate\Http\Request;

class NiveauController extends Controller
{
    public function create()
    {
        $categories = CategorieNiveau::all();
         $niveaux = Niveau::with('categorieNiveau')->get();
        return view('niveaux.create', compact('categories', 'niveaux'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_niveaux' => 'required',
            'id_categorieNiveau' => 'required'
        ]);

        Niveau::create($request->all());

        return redirect()->back()->with('success', 'Niveau ajouté');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_niveaux' => 'required',
            'id_categorieNiveau' => 'required',
        ]);

        $niveau = Niveau::findOrFail($id);
        $niveau->update($request->all());

        return redirect('/niveaux/create')->with('success', 'Niveau modifié avec succès');
    }
     public function edit($id)
    {
        $niveau = Niveau::findOrFail($id);
        $categories = CategorieNiveau::all();
        return view('niveaux.edit', compact('niveau', 'categories'));
    }
    public function destroy($id)
    {
        $niveau = Niveau::findOrFail($id);
        $niveau->delete();
        return redirect('/niveaux/create')->with('success', 'Niveau supprimé avec succès');
    }
}
