<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-white">
                <div class="card-body">
                    <h5 class="card-title text-secondary">PUESTO</h5>
                    <p class="card-text"><strong>{{ $puesto }}</strong></p>
                    @if ($empleado)
                        <p class="card-text text-secondary">Área de {{ $empleado->nombreCompleto() }}</p>
                        <p class="card-text text-secondary">Correo Electrónico: {{ $empleado->email }}</p>
                        <p class="card-text text-secondary">Folio: {{ $empleado->folio }}</p>
                        <p class="card-text text-secondary">Fecha de Alta: {{ $empleado->alta }}</p>
                        <p class="card-text text-secondary">Fecha de Término: {{ $empleado->termino }}</p>
                        <p class="card-text text-secondary">Status: {{ $empleado->status }}</p>
                        <p class="card-text text-secondary">Turno de Entrada: {{ $empleado->turnoEntrada }}</p>
                        <p class="card-text text-secondary">Turno de Salida: {{ $empleado->turnoSalida }}</p>
                        <p class="card-text text-secondary">Puesto: {{ $empleado->puesto }}</p>
                        <p class="card-text text-secondary">Departamento: {{ $empleado->departamento->nombreDep }}</p>
                        <!-- Agrega más detalles según tus necesidades -->
                    @else
                        <p class="card-text text-secondary">Área no asignada</p>
                    @endif
                </div>
                <div class="card-icon">
                    <!-- Agrega el ícono correspondiente -->
                </div>
            </div>
        </div>
        <!-- Agrega más secciones según tus necesidades -->
    </div>
</div>