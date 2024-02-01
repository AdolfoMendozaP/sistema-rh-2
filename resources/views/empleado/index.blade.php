@extends('empleado.dashboard')

@section('content')
    <div class="container">
        <h2>Lista de Empleados</h2>
        <ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link{{ $status === 'todos' ? ' active' : '' }}" href="{{ route('empleado.index', ['status' => 'todos']) }}">Todos ({{ $totalEmpleados }})</a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $status === 'activo' ? ' active' : '' }}" href="{{ route('empleado.index', ['status' => 'activo']) }}">Activo ({{ $activos }})</a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ $status === 'retirado' ? ' active' : '' }}" href="{{ route('empleado.index', ['status' => 'retirado']) }}">Retirado ({{ $retirados }})</a>
    </li>
    <li class="nav-item">
                <a class="nav-link{{ $status === 'nuevo' ? ' active' : '' }}" href="{{ route('empleado.index', ['status' => 'nuevo']) }}">Nuevo ({{ isset($nuevos) ? $nuevos : 0 }})</a>
    </li>
</ul>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Foto</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Apellido</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Folio</th>
                        <th class="text-center">Fecha de Alta</th>
                        <th class="text-center">Fecha de Termino</th>
                        <th class="text-center">Turno</th>
                        <th class="text-center">Departamento</th>
                        <th class="text-center">Puesto</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($empleados as $empleado)
                        <tr>
                            <td class="text-center">{{ $empleado->IDempleado }}</td>
                            <td class="text-center">
                             @if($empleado->foto)
                             <img src="{{ asset('storage/' . $empleado->foto) }}" alt="Foto del empleado" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                             @else
                             <img src="{{ asset('storage/fotos/hombre.jpg') }}" alt="Foto por defecto" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
                             @endif
                             <style>
                                .img-infantil {
                                max-width: 100px;
                                max-height: 100px;
                                border-radius: 50%; 
                                overflow: hidden; 
                               }
                             </style>
                             </td>
                            <td class="text-center">{{ $empleado->nombre }}</td>
                            <td class="text-center">{{ $empleado->apellido }}</td>
                            <td class="text-center">{{ $empleado->email }}</td>
                            <td class="text-center">{{ $empleado->folio }}</td>
                            <td class="text-center">{{ $empleado->alta }}</td>
                            <td class="text-center">{{ $empleado->termino }}</td>
                            <td class="text-center">{{ date('H:i', strtotime($empleado->turnoEntrada)) }} - {{ date('H:i', strtotime($empleado->turnoSalida)) }}</td>
                            <td class="text-center">{{ $empleado->departamento->nombreDep }}</td>
                            <td class="text-center">{{ $empleado->puesto }}</td>
                            <td class="text-center 
                                @if($empleado->status == 'Activo') bg-success text-white
                                @elseif($empleado->status == 'Retirado') bg-secondary text-white
                                @elseif($empleado->status == 'Baja') bg-danger text-white
                                @elseif($empleado->status == 'Inactivo') bg-warning text-dark
                                @endif">
                                {{ $empleado->status }}
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Acciones" style="box-shadow: none;">
                                    <a href="{{ route('empleado.edit', $empleado->IDempleado) }}" class="btn btn-success" title="Editar"><i class="fa-solid fa-pencil-alt fa-sm" alt="Editar"></i></a>
                                    <form action="{{ route('empleado.destroy', $empleado->IDempleado) }}" method="POST" style="display: inline-block; margin-left: 5px;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')" title="Eliminar"><i class="fa-solid fa-trash-alt fa-sm" alt="Eliminar"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                        <td colspan="13" class="text-center">
                                @if(Request::get('tab') === 'todos')
                                    No hay empleados registrados.
                                @elseif(Request::get('tab') === 'activo')
                                    No hay empleados activos.
                                @elseif(Request::get('tab') === 'retirado')
                                    No hay empleados retirados.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <br>
        <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        {{ $empleados->links('vendor.pagination.bootstrap-4') }}
    </ul>
</nav>
    </div>
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.employee-photo').each(function () {
                    var employeeId = $(this).closest('tr').find('td:first-child').text();
                    var photoUrl = '/empleado/foto/' + employeeId;

                    var imgElement = $(this); 

                    $.ajax({
                        url: photoUrl,
                        type: 'GET',
                        success: function (data) {
                            imgElement.attr('src', photoUrl);
                        },
                        error: function () {
                            imgElement.attr('src', '/error-photo.jpg');
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
