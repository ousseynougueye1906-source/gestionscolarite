<?php

namespace App\Http\Controllers;

use App\Models\TarifClasse;
use App\Models\Classe;
use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifClasseController extends Controller
{
    public function create()
    {
        $classes = Classe::all();
        $tarifs = Tarif::all();
        $tarifClasses = TarifClasse::with('classe', 'tarif')->get();
        return view('tarif-classe.create', compact('classes', 'tarifs', 'tarifClasses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_classe' => 'required',
            'id_tarif' => 'required',
            'statut' => 'required|boolean',
        ]);

        TarifClasse::create($request->all());

        return redirect()->back()->with('success', 'Tarif-Classe ajouté avec succès');
    }

    public function edit($id)
    {
        $tarifClasse = TarifClasse::findOrFail($id);
        $classes = Classe::all();
        $tarifs = Tarif::all();
        return view('tarif-classe.edit', compact('tarifClasse', 'classes', 'tarifs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_classe' => 'required',
            'id_tarif' => 'required',
            'statut' => 'required|boolean',
        ]);

        $tarifClasse = TarifClasse::findOrFail($id);
        $tarifClasse->update($request->all());

        return redirect('/tarif-classe/create')->with('success', 'Tarif-Classe modifié avec succès');
    }

    public function destroy($id)
    {
        $tarifClasse = TarifClasse::findOrFail($id);
        $tarifClasse->delete();
        return redirect('/tarif-classe/create')->with('success', 'Tarif-Classe supprimé avec succès');
    }
}