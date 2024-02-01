<?php

namespace App\Http\Controllers;
use App\Models\Personal;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function index()
    {
        $personales = Personal::all();
        return view('personales.index', compact('personales'));
    }

    public function create()
    {
        return view('personales.create');
    }

    public function store(Request $request)
    {
        
    }

    public function show(Personal $personal)
    {
        return view('personales.show', compact('personal'));
    }

    public function edit(Personal $personal)
    {
        return view('personales.edit', compact('personal'));
    }

    public function update(Request $request, Personal $personal)
    {
      
    }

    public function destroy(Personal $personal)
    {
        $personal->delete();
        return redirect()->route('personales.index')->with('success', 'Registro eliminado correctamente.');
    }
}
