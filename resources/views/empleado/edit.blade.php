@extends('empleado.dashboard')

@section('content')
    <div class="container">
        <h1>Editar Empleado</h1>

        @if ($errors->any())
            <div id="error-alert" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill mr-2" viewBox="0 0 16 16">
                        <path d="M8.482 1.868a1.73 1.73 0 0 0-1.962 0L1.038 13.868a1.73 1.73 0 0 0-.04 1.601A1.762 1.762 0 0 0 2.75 16h10.5a1.762 1.762 0 0 0 1.752-1.531 1.73 1.73 0 0 0-.04-1.601L8.482 1.868zM8 14a1 1 0 0 1-1-1 1 1 0 0 1 2 0 1 1 0 0 1-1 1zM8 7a1 1 0 0 1-1-1V4a1 1 0 0 1 2 0v2a1 1 0 0 1-1 1z"/>
                    </svg>
                    <div>
                        <strong>Error:</strong> {{ $errors->first() }}
                    </div>
                </div>
            </div>
        @endif

        {!! Form::model($empleado, ['route' => ['empleado.update', $empleado->IDempleado], 'method' => 'put', 'enctype' => 'multipart/form-data', 'id' => 'empleadoForm']) !!}
        
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre') !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control form-control-m', 'required', 'maxlength' => '40', 'pattern' => '^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$', 'readonly']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('apellido', 'Apellido') !!}
                    {!! Form::text('apellido', null, ['class' => 'form-control form-control-m', 'required', 'maxlength' => '40', 'pattern' => '^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$', 'readonly']) !!}
                </div>
            </div>
        </div>

        <div class="col-sm-8">
            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', null, ['class' => 'form-control', 'required', 'pattern' => '^[a-z._%+-]+@consultancysc\.com$'], 'readonly') !!}
            </div>
        </div>

        <div class="row">
        <div class="col-sm-6">
        <div class="form-group">
    {!! Form::label('alta', 'Fecha de Alta') !!}
    {!! Form::date('alta', $empleado->alta, ['class' => 'form-control', 'required']) !!}
</div>
</div>
<div class="col-sm-6">
        <div class="form-group">
        
        {!! Form::label('termino', 'Fecha de Término') !!}
        {!! Form::date('termino', null, ['class' => 'form-control', 'required']) !!}
        </div>
        </div>
        </div>

        <div class="row">
        <div class="col-sm-4">
        <div class="form-group">
    {!! Form::label('IDdepartamento', 'Departamento') !!}
    {!! Form::select('IDdepartamento', ['' => '----Seleccione Departamento----'] + $departamentos->toArray(), null, ['class' => 'form-control text-center', 'required']) !!}
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
    {!! Form::label('puesto', 'Puesto') !!}
    {!! Form::select('puesto', ['' => '---Seleccione Puesto---'] + ['Jefe' => 'Jefe', 'Practicante' => 'Practicante'], null, ['class' => 'form-control text-center', 'required']) !!}
</div>
</div>
</div>

<div class="row">
<div class="col-sm-4">
        <div class="form-group">
    {!! Form::label('turnoEntrada', 'Turno de Entrada') !!}
    {!! Form::time('turnoEntrada', '08:00', ['class' => 'form-control', 'required', 'min' => '08:00', 'max' => '18:00']) !!}
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
    {!! Form::label('turnoSalida', 'Turno de Salida') !!}
    {!! Form::time('turnoSalida', '18:00', ['class' => 'form-control', 'required', 'min' => '08:00', 'max' => '18:00']) !!}
</div>
</div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('status', 'Estado') !!}
            {!! Form::select('status', ['Activo' => 'Activo', 'Retirado' => 'Retirado', 'Inactivo' => 'Inactivo', 'Baja' => 'Baja'], null, ['class' => 'form-control text-center', 'required']) !!}
        </div>
    </div>
</div>
</div>
<div class="form-group">
            {!! Form::label('foto', 'Foto') !!}
            
            <div class="input-group mb-2">
                {!! Form::file('foto', ['class' => 'form-control', 'id' => 'inputGroupFile02', 'onchange' => 'previewImage(this)']) !!}
            </div>
            
            <div class="text-center mt-2"> 
                <img id="foto-preview" src="#" alt="Foto" style="display: none; max-width: 200px; margin-top: 10px; border-radius: 50%;">
            </div>
        </div>

        <br>

        <div class="form-group">
            {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('empleado.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
        
        {!! Form::close() !!}
    </div>
    <script>
    function previewImage(input) {
        var fotoPreview = $('#foto-preview');
        fotoPreview.hide();

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                fotoPreview.attr('src', e.target.result);
                fotoPreview.show();
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection