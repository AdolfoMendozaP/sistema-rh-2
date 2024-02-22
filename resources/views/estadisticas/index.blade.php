@extends('estadisticas.dashboard')

@section('content')
    <div class="container">
        <h2>Estadisticas de Entrenamiento</h2>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#induccion" data-toggle="tab">Cursos de Inducción</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#departamento" data-toggle="tab">Cursos de Departamento</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#externos" data-toggle="tab">Cursos Externos</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="induccion" class="tab-pane fade show active">
               
            </div>
            <div id="departamento" class="tab-pane fade">
                
            </div>
            <div id="externos" class="tab-pane fade">
                
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Apellido</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Folio</th>
                        <th class="text-center">Departamento</th>
                        <th class="text-center">Inicio</td>
                        <th class="text-center">Finalización</td>
                        <th class="text-center">Estado</td>
                        <th class="text-center">Calificacion</td>
                        <th class="text-center">Progreso</td>
                        <th class="text-center">Adjuntos</td>
                    </tr>
                </thead>
                <tbody>
                        <td colspan="13" class="text-center">
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
        <br>
        <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
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
