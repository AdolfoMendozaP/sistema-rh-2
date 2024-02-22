@extends('perfil.welcome')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Datos laborales') }}</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                        <div class="col-md-6">
                            <input id="nombre" type="text" class="form-control" name="nombre" value="{{ $empleado->nombre }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="apellido" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>
                        <div class="col-md-6">
                            <input id="apellido" type="text" class="form-control" name="apellido" value="{{ $empleado->apellido }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="folio" class="col-md-4 col-form-label text-md-right">{{ __('Folio') }}</label>
                        <div class="col-md-6">
                            <input id="folio" type="text" class="form-control" name="folio" value="{{ $empleado->folio }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="correo" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control" name="email" value="{{ $empleado->email }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Datos personales') }}</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                        <div class="col-md-6">
                            <input id="nombre" type="text" class="form-control" name="nombre" value="{{ $empleado->nombre }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="apellido" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>
                        <div class="col-md-6">
                            <input id="apellido" type="text" class="form-control" name="apellido" value="{{ $empleado->apellido }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cedula" class="col-md-4 col-form-label text-md-right">{{ __('Cédula') }}</label>
                        <div class="col-md-6">
                            <input id="cedula" type="text" class="form-control" name="cedula" value="{{ $empleado->cedula }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>
                        <div class="col-md-6">
                            <input id="telefono" type="text" class="form-control" name="telefono" value="{{ $empleado->telefono }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Datos de usuario') }}</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de usuario') }}</label>
                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control" name="username" value="" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>
                        <div class="col-md-6 input-group">
                            <input id="password" type="password" class="form-control" name="password" value="" disabled>
                            <button type="button" class="btn btn-primary ms-1" onclick="confirmarCambioContraseña()">{{ __('Actualizar') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mt-3 text-center">
                <div class="card-body">
                    <h5 class="card-title">Foto de perfil</h5>
                    <img src="{{ asset('storage/' . $empleado->foto) }}" alt="Foto de perfil" class="img-thumbnail img-fluid" style="max-width: 150px;">
                    <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#cambiarFotoModal">Cambiar Foto</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cambiarFotoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar Foto de Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="cambiarFotoForm" action="{{ route('empleado.update_photo', ['id' => $empleado->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nuevaFoto" class="form-label">Seleccionar nueva foto:</label>
                        <input class="form-control" type="file" id="nuevaFoto" name="foto" onchange="mostrarVistaPrevia()">
                        <img id="vistaPrevia" src="#" alt="Vista previa" style="max-width: 100%; display: none;">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmarCambioContraseña() {
        if (confirm('¿Está seguro de cambiar la contraseña?')) {
            alert('Contraseña cambiada exitosamente');
        } else {
            alert('No se cambió la contraseña');
        }
    }
    function mostrarVistaPrevia() {
        var archivo = document.getElementById('nuevaFoto').files[0];
        var vistaPrevia = document.getElementById('vistaPrevia');

        if (archivo) {
            var lector = new FileReader();
            lector.onload = function(evento) {
                vistaPrevia.src = evento.target.result;
                vistaPrevia.style.display = 'block';
            }
            lector.readAsDataURL(archivo);
        } else {
            vistaPrevia.src = '#';
            vistaPrevia.style.display = 'none';
        }
    }
</script>
@endsection
