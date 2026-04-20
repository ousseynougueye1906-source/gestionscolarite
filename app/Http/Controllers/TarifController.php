<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    public function create()
    {
        $tarifs = Tarif::all();
        return view('tarif.create', compact('tarifs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'inscription' => 'required|numeric|min:0',
            'mensualite' => 'required|numeric|min:0',
        ]);

        Tarif::create($request->all());

        return redirect()->back()->with('success', 'Tarif ajouté avec succès');
    }

    public function edit($id)
    {
        $tarif = Tarif::findOrFail($id);
        return view('tarif.edit', compact('tarif'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'inscription' => 'required|numeric|min:0',
            'mensualite' => 'required|numeric|min:0',
        ]);

        $tarif = Tarif::findOrFail($id);
        $tarif->update($request->all());

        return redirect('/tarif/create')->with('success', 'Tarif modifié avec succès');
    }

    public function destroy($id)
    {
        $tarif = Tarif::findOrFail($id);
        $tarif->delete();
        return redirect('/tarif/create')->with('success', 'Tarif supprimé avec succès');
    }
}