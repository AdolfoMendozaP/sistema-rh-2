<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $empleado = $user->empleado;

        return view('perfil.index', compact('empleado'));
    }
}
