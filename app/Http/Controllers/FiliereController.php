<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    public function create()
    {
        $filieres = Filiere::all();
        return view('filiere.create', compact('filieres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'nom_filiere' => 'required'
        ]);

        Filiere::create($request->all());

        return redirect()->back()->with('success', 'Filière ajoutée');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required',
            'nom_filiere' => 'required'
        ]);

        $filiere = Filiere::findOrFail($id);
        $filiere->update($request->all());

        return redirect('/filiere/create')->with('success', 'Filière modifiée avec succès');
    }
    public function edit($id)
    {
        $filiere = Filiere::findOrFail($id);
        return view('filiere.edit', compact('filiere'));
    }

    public function destroy($id)
    {
        $filiere = Filiere::findOrFail($id);
        $filiere->delete();
        return redirect('/filiere/create')->with('success', 'Filière supprimée avec succès');
    }
}