<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    public function create()
    {
        $classes = Classe::all();
        return view('classe.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code_classe' => 'required|unique:classe,code_classe',
            'nom_classe' => 'required',
        ]);

        Classe::create($request->all());

        return redirect()->back()->with('success', 'Classe ajoutée avec succès');
    }

    public function edit($id)
    {
        $classe = Classe::findOrFail($id);
        return view('classe.edit', compact('classe'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code_classe' => 'required|unique:classe,code_classe,' . $id,
            'nom_classe' => 'required',
        ]);

        $classe = Classe::findOrFail($id);
        $classe->update($request->all());

        return redirect('/classe/create')->with('success', 'Classe modifiée avec succès');
    }

    public function destroy($id)
    {
        $classe = Classe::findOrFail($id);
        $classe->delete();
        return redirect('/classe/create')->with('success', 'Classe supprimée avec succès');
    }
}