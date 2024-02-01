<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;

class PerfilController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $empleado = $user && $user->empleado ? $user->empleado : null;
        $puesto = $empleado ? $empleado->puesto : 'No asignado';

        return view('perfil.index', compact('user', 'empleado', 'puesto'));
    }
}
