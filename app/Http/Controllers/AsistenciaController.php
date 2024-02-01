<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\Empleado;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\AsistenciaExport;
use Maatwebsite\Excel\Facades\Excel;

class AsistenciaController extends Controller
{
    public function index()
    {
        $asistencias = Asistencia::all();
        $empleado = Auth::user();

        return view('asistencia.index')->with('asistencias', $asistencias)->with('empleado', $empleado);
    }

    public function registrar(Request $request)
    {
        $request->validate([
            'folio' => 'required|string',
        ]);

        $empleado = Empleado::where('folio', $request->input('folio'))->first();

        if ($empleado) {
            $asistencia = Asistencia::where('fecha', now()->toDateString())
                ->where('IDasistencia', $empleado->IDempleado)
                ->first();

            if (!$asistencia) {
                $asistencia = new Asistencia();
                $asistencia->fecha = now()->toDateString();
                $asistencia->entrada = now()->setTimezone('America/Mexico_City')->toTimeString();
                $asistencia->salida = '00:00:00';
                $asistencia->validar = $this->calcularValidacion($asistencia->entrada, $empleado->turnoEntrada);

                $this->actualizarDatosAsistencia($asistencia, $empleado);
                $asistencia->save();

                $empleado->IDasistencia = $asistencia->IDasistencia;
                $empleado->save();

                return redirect('/welcome')->with('success', 'Asistencia registrada correctamente.');
            } elseif ($asistencia->salida == '00:00:00') {
                $asistencia->salida = now()->setTimezone('America/Mexico_City')->toTimeString();
                $asistencia->validar = $this->calcularValidacion($asistencia->salida, $empleado->turnoSalida);

                $this->actualizarDatosAsistencia($asistencia, $empleado);
                $asistencia->save();

                $empleado->IDasistencia = $asistencia->IDasistencia;
                $empleado->save();

                return redirect('/welcome')->with('success', 'Salida registrada correctamente.');
            }  else {
                return redirect('/welcome')->with('error', 'Ya se registró la asistencia para hoy.')->with('alert-class', 'alert-secondary');
            }
        } else {
            return redirect('/welcome')->with('error', 'No se encontró un empleado con el folio proporcionado.');
        }

        
    }

    private function actualizarDatosAsistencia($asistencia, $empleado)
    {
        Carbon::setLocale('es');
        $asistencia->semana = now()->weekOfYear;
        $asistencia->dia = ucfirst(now()->isoFormat('dddd'));
        $asistencia->empleado()->associate($empleado);
    }

    private function calcularValidacion($horaRegistro, $horaTurno)
    {
        $retraso = strtotime($horaRegistro) - strtotime($horaTurno);
        if ($retraso > 0 && $retraso <= 30 * 60) {
            return 'no'; 
        } elseif ($retraso > 30 * 60) {
            return 'no'; 
        } else {
            return 'si'; 
        }
    }

    public function depurarRegistros(Request $request)
    {
        $confirmation = $request->input('confirmation');

        if ($confirmation == 'yes') {
            Empleado::whereNotNull('IDasistencia')->delete();
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Asistencia::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return redirect('/asistencia')->with('success', 'Todos los registros de asistencias han sido borrados.');
        } else {
            return redirect('/asistencia')->with('info', 'Borrado cancelado.');
        }
    }

    private function colorCelda($horaRegistro, $horaTurno)
    {
        $tolerancia = 10; 
        $horaRegistro = strtotime($horaRegistro);
        $horaTurno = strtotime($horaTurno);

        if ($horaRegistro == '00:00:00' || ($horaRegistro - $horaTurno) > 30 * 60) {
            return 'bg-black text-white';
        }

        $diferencia = $horaRegistro - $horaTurno;

        if ($diferencia < 0) {
            return 'bg-info text-white';
        } elseif ($diferencia <= $tolerancia * 60) {
            return 'bg-success text-white';
        } elseif ($diferencia <= 2 * $tolerancia * 60) {
            return 'bg-warning text-dark';
        } else {
            return 'bg-danger text-white';
        }
    }

    public function exportExcel()
    {
        return Excel::download(new AsistenciaExport, 'asistencias.xlsx');
    }
    
}