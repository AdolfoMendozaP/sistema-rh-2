@extends('users.dashboard')

@section('content')
    <div class="container">
        <h2>Lista de Usuarios</h2>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#standards">Standards ({{ $standardUsersCount }})</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#admins">Admin</a>
            </li>
        </ul>
        <div id="standards" class="tab-content">
            <table class="table table-bordered">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Usuario</th>
                    <th class="text-center">Tipo Usuario</th>
                    <th class="text-center">Opciones</th>
                </tr>
                @foreach ($standardUsers as $user)
                    <tr>
                        <td class="text-center align-middle">{{ $user->id }}</td>
                        <td class="text-center align-middle">{{ $user->name }}</td>
                        <td class="text-center align-middle">{{ $user->username }}</td>
                        <td class="text-center align-middle">{{ $user->typeuser }}</td>
                        <td class="text-center align-middle">
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @if($user->typeuser !== 'admin')
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success" title="Editar"><i class="fa-solid fa-pencil-alt fa-sm" alt="Editar"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')" title="Eliminar"><i class="fa-solid fa-trash-alt fa-sm" alt="Eliminar"></i></button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            @if ($standardUsersCount > 10)
                {{ $standardUsers->links() }}
            @endif
        </div>

        <div id="admins" class="tab-content">
            <table class="table table-bordered">
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Usuario</th>
                    <th class="text-center">Tipo Usuario</th>
                    <th class="text-center">Opciones</th>
                </tr>
                @foreach ($adminUsers as $user)
                    <tr class="{{ $user->typeuser === 'admin' ? 'table-active' : '' }}">
                        <td class="text-center align-middle">{{ $user->id }}</td>
                        <td class="text-center align-middle">{{ $user->name }}</td>
                        <td class="text-center align-middle">{{ $user->username }}</td>
                        <td class="text-center align-middle">{{ $user->typeuser }}</td>
                        <td class="text-center align-middle">
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @if($user->typeuser !== 'admin')
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success" title="Editar"><i class="fa-solid fa-pencil-alt fa-sm" alt="Editar"></i></a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')" title="Eliminar"><i class="fa-solid fa-trash-alt fa-sm" alt="Eliminar"></i></button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.tab-content:not(:first)').hide();

            $('.nav-link').click(function(){
                $('.nav-link').removeClass('active');
                $(this).addClass('active');
                $('.tab-content').hide();
                $($(this).attr('href')).show();
            });
        });
    </script>
@endsection
