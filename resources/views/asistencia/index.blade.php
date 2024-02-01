@if (!function_exists('colorCelda'))
    @php
        function colorCelda($horaRegistro, $horaTurno)
        {
            $tolerancia = 5; 
            if ($horaRegistro == '00:00:00' || (strtotime($horaRegistro) - strtotime($horaTurno)) > 30 * 60) {
                return 'bg-black text-white';
            }

            $horaRegistro = strtotime($horaRegistro);
            $horaTurno = strtotime($horaTurno);

            $diferencia = $horaRegistro - $horaTurno;

            if ($diferencia < 0) {
                return 'bg-primary text-white'; 
            } elseif ($diferencia <= $tolerancia * 60) {
                return 'bg-success text-white'; 
            } elseif ($diferencia <= 2 * $tolerancia * 60) {
                return 'bg-warning text-dark'; 
            } else {
                return 'bg-danger text-white';
            }
        }
    @endphp
@endif
@extends('asistencia.dashboard')

@section('content')
    <div class="container">
        <h1>Control de Asistencia</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Folio</th>
                    <th>Nombre Completo</th>
                    <th>Fecha</th>
                    <th>Entrada</th>
                    <th>Salida</th>
                    <th>Semana</th>
                    <th>Día</th>
                    <th>Validar Asistencia</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($asistencias as $asistencia)
                    <tr>
                        <td>{{ $asistencia->empleado->IDempleado }}</td>
                        <td>{{ $asistencia->empleado->folio }}</td>
                        <td>{{ $asistencia->empleado->nombreCompleto() }}</td>
                        <td>{{ $asistencia->fecha }}</td>
                        <td class="{{ colorCelda($asistencia->entrada, $asistencia->empleado->turnoEntrada) }}">
                            {{ $asistencia->entrada }}
                        </td>
                        <td class="{{ colorCelda($asistencia->salida, $asistencia->empleado->turnoSalida) }}">
                            {{ $asistencia->salida }}
                        </td>
                        <td>{{ $asistencia->semana }}</td>
                        <td>{{ $asistencia->dia }}</td>
                        <td>{{ $asistencia->validar }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No hay asistencias registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection