<?php

namespace App\Http\Controllers;
use App\Models\Ausencia;
use App\Models\Empleado;
use Illuminate\Http\Request;

class AusenciaController extends Controller
{
    public function index()
    {
        $ausencias = Ausencia::all();
        return view('ausencia.index', compact('ausencias'));
    }

    public function solicitarAusencia(Request $request)
{
    $request->validate([
        'folio' => 'required|string',
        'fecha' => 'required|date',
        'motivo' => 'required|string',
        'adjunto' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    $empleado = Empleado::where('folio', $request->input('folio'))->first();

    if ($empleado) {
        $ausenciaExistente = Ausencia::where('IDempleado', $empleado->IDempleado)
            ->where('inicio', $request->input('fecha'))
            ->first();

        if (!$ausenciaExistente) {
            $ausencia = new Ausencia();
            $ausencia->tipo = 'solicitud'; 
            $ausencia->inicio = $request->input('fecha');
            $ausencia->fin = $request->input('fecha'); 
            $ausencia->duracion = 1; 
            $ausencia->estado = 'pendiente'; 
            $ausencia->motivo = $request->input('motivo');
            $ausencia->IDempleado = $empleado->IDempleado;

            
            $adjunto = $request->file('adjunto');
            $adjuntoPath = $adjunto->store('adjuntos'); 
            $ausencia->adjunto = $adjuntoPath;

            $ausencia->save();

            return redirect('/welcome')->with('success', 'Solicitud de ausencia enviada correctamente. Ausencia solicitada.');
        } else {
            return redirect('/welcome')->with('error', 'Ya existe una solicitud de ausencia para la fecha proporcionada.');
        }
    } else {
        return redirect('/welcome')->with('error', 'No se encontró un empleado con el folio proporcionado.');
    }
}

public function confirmarAusencia($id)
{
    $ausencia = Ausencia::findOrFail($id);
    $ausencia->estado = 'confirmado';
    $ausencia->save();

    return redirect()->back()->with('success', 'Ausencia confirmada correctamente.');
}


}

