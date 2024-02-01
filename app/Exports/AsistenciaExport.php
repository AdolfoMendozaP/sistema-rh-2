<?php

namespace App\Exports;

use App\Models\Asistencia;
use Maatwebsite\Excel\Concerns\FromCollection;

class AsistenciaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Asistencia::with('empleado')->get()->map(function ($asistencia) {
            return [
                'ID' => $asistencia->empleado->IDempleado,
                'Folio' => $asistencia->empleado->folio,
                'Nombre Completo' => $asistencia->empleado->nombre . ' ' . $asistencia->empleado->apellido,
                'Fecha' => $asistencia->fecha,
                'Entrada' => $asistencia->entrada,
                'Salida' => $asistencia->salida,
                'Semana' => $asistencia->semana,
                'Día' => $asistencia->dia,
                'Validar' => $asistencia->validar, 
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Folio',
            'Nombre Completo',
            'Fecha',
            'Entrada',
            'Salida',
            'Semana',
            'Día',
            'Validar', 
        ];
    }

}
