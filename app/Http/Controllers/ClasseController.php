<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Services\ClasseService;
use App\Http\Requests\StoreClasseRequest;
use App\Http\Requests\UpdateClasseRequest;

class ClasseController extends Controller
{
    private $service;

    public function __construct(ClasseService $service)
    {
        $this->service = $service;
    }

    public function create()
    {
        $classes = Classe::all();
        return view('classe.create', compact('classes'));
    }

    public function store(StoreClasseRequest $request)
    {
        $this->service->create($request->validated());

        return back()->with('success', 'Classe ajoutée');
    }

    public function edit($id)
    {
        $classe = Classe::findOrFail($id);
        return view('classe.edit', compact('classe'));
    }

    public function update(UpdateClasseRequest $request, $id)
    {
        $classe = Classe::findOrFail($id);

        $this->service->update($classe, $request->validated());

        return redirect('/classe/create')->with('success', 'Classe modifiée');
    }

    public function destroy($id)
    {
        $classe = Classe::findOrFail($id);

        $this->service->delete($classe);

        return redirect('/classe/create')->with('success', 'Classe supprimée');
    }
}