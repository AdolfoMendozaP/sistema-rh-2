@extends('perfil.welcome')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Perfil de Empleado') }}</div>

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

                    <div class="form-group row">
                     <label for="foto" class="col-md-4 col-form-label text-md-right">{{ __('Foto') }}</label>
                      <div class="col-md-6">
                       <img src="{{ asset('storage/' . $empleado->foto) }}" alt="Foto de perfil" class="img-thumbnail img-fluid" style="max-width: 150px;">
                       </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection