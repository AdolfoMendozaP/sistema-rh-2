@extends('ausencia.dashboard')

@section('content')
    <div class="container">
        <h1>Administrador de Ausencias</h1>
        <table class="table">
            <!-- Encabezados de la tabla -->
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Duración</th>
                    <th>Estado</th>
                    <th>Motivo</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ausencias as $ausencia)
                    <tr>
                        <td>{{ $ausencia->IDausencia }}</td>
                        <td>{{ $ausencia->tipo }}</td>
                        <td>{{ $ausencia->inicio }}</td>
                        <td>{{ $ausencia->fin }}</td>
                        <td>{{ $ausencia->duracion }}</td>
                        <td>{{ $ausencia->estado }}</td>
                        <td>{{ $ausencia->motivo }}</td>
                        <td>
                            <form action="{{ route('ausencia.borrar', $ausencia->IDausencia) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que deseas borrar la ausencia con ID {{ $ausencia->IDausencia }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Borrar"><i class="fa-solid fa-trash-can"></i></button>
                            </form>

                            <form action="{{ route('ausencia.confirmar', $ausencia->IDausencia) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que deseas confirmar la ausencia con ID {{ $ausencia->IDausencia }}?')">
    @csrf
    <button type="submit" class="btn btn-success btn-sm" title="Confirmar"><i class="fa-solid fa-check"></i></button>
</form>

                            <form action="{{ route('ausencia.denegar', $ausencia->IDausencia) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que deseas denegar la ausencia con ID {{ $ausencia->IDausencia }}?')">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm" title="Denegar"><i class="fa-solid fa-times"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection