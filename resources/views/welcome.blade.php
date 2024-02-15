@php
    $user = auth()->user();
    use Carbon\Carbon;
    $fechaAlta = $user && $user->empleado && $user->empleado->alta ? new Carbon($user->empleado->alta) : null;
    $fechaTermino = $user && $user->empleado && $user->empleado->termino ? new Carbon($user->empleado->termino) : null;
    $diasLaborados = $fechaAlta ? $fechaAlta->diffInDays(Carbon::now()) : 0;
    if ($fechaTermino && $fechaTermino->isPast()) {
        $diasLaborados = $fechaAlta->diffInDays($fechaTermino);
    }

    $puesto = $user && $user->empleado ? $user->empleado->puesto : 'No asignado';
    $departamento = $user && $user->empleado && $user->empleado->departamento ? $user->empleado->departamento->nombreDep : 'No asignado';
    $horarioEntrada = $user && $user->empleado ? new DateTime($user->empleado->turnoEntrada) : null;
    $horarioSalida = $user && $user->empleado ? new DateTime($user->empleado->turnoSalida) : null;

    $horarioCompleto = $horarioEntrada && $horarioSalida ? $horarioEntrada->format('H:i') . ' a ' . $horarioSalida->format('H:i') : 'No especificado';
    $fotoPerfilURL = $user->foto ? asset('storage/' . $user->foto) : null;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="https://consultancysc.com/wp-content/uploads/2023/08/LogoConsultancyITfinal-150x150.png" sizes="32x32">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('style.css')}}">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    
    <title>Portal de Empleados - Consultacy</title>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="https://consultancysc.com/wp-content/uploads/2023/08/LogoConsultancyITfinal-150x150.png" alt="Logo Consultancy">
            <div class="logo-text">
                <strong>Consultancy</strong>
                <span class="small-text">Servicios Contables</span>
            </div>
        </div>

        <ul class="menu">
            <li>
                <a href="{{ url('/welcome') }}">
                <div class="menu-item">
                    <i class="fa-solid fa-home fa-lg"></i>
                    <span class="small-text">Home</span>
                </div>
                </a>
            </li>
            <li>
                <a href="#"></a>
                <div class="menu-item">
                    <i class="fa-solid fa-calendar-days fa-lg"></i> 
                    <span class="small-text">Vacaciones</span>
                </div>
            </li>
             
            <li>
                <a href="{{ url('/orboarding') }}">
                <div class="menu-item">
                    <i class="fa-solid fa-book fa-lg"></i>
                    <span class="small-text">Onboarding</span>
                </div>
                </a>
            </li>

            <li>
                <a href="#"></a>
                <div class="menu-item">
                    <i class="fa-solid fa-users fa-lg"></i>
                    <span class="small-text">Equipo</span>
                </div>
            </li>

            <li>
                <a href="#"></a>
                <div class="menu-item">
                    <i class="fa-solid fa-chart-column fa-lg"></i>
                    <span class="small-text">Estadisticas</span>
                </div>
            </li>

            <li>
            <a href="{{ route('perfil') }}">
             <div class="menu-item">
              <i class="fa-solid fa-circle-user fa-lg"></i>
              <span class="small-text">Perfil</span>
             </div>
            </a>
            </li>

            <li class="logout">
                <a href="#" onclick="document.getElementById('logout-form').submit()">
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                   @csrf
                <div class="menu-item">
                    <i class="fa-solid fa-right-from-bracket fa-lg"></i>
                    <span class="small-text">Cerrar Sesión</span>
                </div>
                </a>
                </form>
            </li>
        </ul>
    </div>
    <div class="main-content">
        <div class="container-fluid bg-primary text-light py-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="no-bold">Portal del Empleado</h2>
                </div>
                <div class="col-md-6 text-md-end"> 
                    <div class="d-flex align-items-center justify-content-end"> 
                        <p class="mb-0 me-3 no-bold"><span id="clock"></span></p>
                        <div class="d-flex align-items-center ms-4">
                        <img src="{{ $fotoPerfilURL }}" alt="Foto de perfil" class="rounded-circle" width="30">
                        <span class="ms-2">{{ auth()->user()->name }}</span>
                       </div>
                    </div>
                </div>
            </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-white">
                    <div class="card-body">
                        <h5 class="card-title text-secondary">PUESTO</h5>
                        <p class="card-text"><strong>{{ $puesto }}</strong></p>
                        <p class="card-text text-secondary">Área de {{ $departamento }}</p>
                    </div>
                    <div class="card-icon">
                        <i class="fas fa-id-card-alt text-danger"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-white">
                    <div class="card-body">
                        <h5 class="card-title text-secondary">HORARIO</h5>
                        <strong>Horario:</strong> 
                        <p class="card-text text-secondary">{{ $horarioCompleto }}</p>
                    </div>
                    <div class="card-icon">
                        <i class="fas fa-clock text-orange"></i> 
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-white">
                    <div class="card-body">
                        <h5 class="card-title text-secondary">PENDIENTES</h5>
                        <p class="card-text"><strong>0</strong></p>
                        <p class="card-text text-secondary"></p>
                    </div>
                    <div class="card-icon">
                            <i class="fas fa-file text-yellow"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-white">
                    <div class="card-body">
                        <h5 class="card-title text-secondary">Notificaciones</h5>
                        <p class="card-text"><strong>0</strong></p>
                        <p class="card-text text-secondary"></p>
                    </div>
                    <div class="card-icon">
                        <i class="fas fa-bell text-blue"></i>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    @php
        $errorClass = session('alert-class', 'alert-danger');
    @endphp

    <div class="alert {{ $errorClass }} alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="container-fluid bg-cream py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Ausencia y Retardos</h2>
            </div>
            <div class="col-md-6 text-md-end"><button type="button" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Registrar Asistencia</button>
            <form method="post" action="{{ route('asistencia.registrar') }}">
             @csrf
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Bienvenido a Consultancy - {{ auth()->user()->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-right">
            <h5 class="font-weight-light">Por favor, registra tu asistencia</h5>
    <div id="clock-container">
    </div>
    <div>
        <label for="folio">Ingrese su Folio:</label>
                    <input type="text" id="folio" name="folio" class="form-control mb-3" placeholder="Folio de Empleado">
                    <div class="text-center mt-3">
    <button type="submit" class="btn btn-success me-2">Entrada</button>
    <button type="submit" class="btn btn-danger">Salida</button>
</div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
                
            </div>
            @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
            <div class="container">
    <button class="btn btn-purple-light" data-bs-toggle="modal" data-bs-target="#solicitudAusenciaModal">Solicitar Ausencia</button>
    <div class="modal" id="solicitudAusenciaModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Solicitud de Ausencia</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ausencia.solicitar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="folio">Folio del Empleado:</label>
                        <input type="text" name="folio" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha">Fecha de Ausencia:</label>
                        <input type="date" name="fecha" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="motivo">Motivo de la Ausencia:</label>
                        <textarea name="motivo" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
        <label for="adjunto">Adjuntar archivo (PDF o imagen):</label>
        <input type="file" name="adjunto" accept=".pdf, .jpg, .jpeg, .png" class="form-control-file" required>
    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Enviar Solicitud</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
        <div class="row mt-4">
            <div class="col-md-3">
                <p class="info-text">Días laborados</p>
                <p class="info-number">{{ $diasLaborados }}</p>
            </div>
            <div class="col-md-3">
                <p class="info-text">Ausencias</p>
                <p class="info-number"></p>
            </div>
            <div class="col-md-3">
                <p class="info-text">Retardos</p>
                <p class="info-number"></p>
            </div>
            <div class="col-md-3">
                <p class="info-text">Sin justificar</p>
                <p class="info-number"></p>
            </div>
        </div>
    </div>
    <br>
    <div class="container-calendar">
    <div class="row">
    <div class="col-md-3">
            <div class="calendar">
                <h3 id="currentMonth"></h3>
                <select id="selectMes" class="form-select mb-3" aria-label="Seleccionar Mes"></select>
                <table>
                    <thead>
                        <tr>
                            <th>L</th>
                            <th>M</th>
                            <th>M</th>
                            <th>J</th>
                            <th>V</th>
                            <th>S</th>
                            <th>D</th>
                        </tr>
                    </thead>
                    <tbody id="calendarBody"></tbody>
                </table>
            </div>
        </div>
</div>
<footer class="footer mt-auto py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="mb-0 text-muted">Copyright © 2024 Consultancy SC</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-0 text-muted">v2.0</p>
            </div>
        </div>
    </div>
</footer>
<script>
    function actualizarReloj() {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: false };
        const formattedDate = now.toLocaleDateString('es-ES', options);
        document.getElementById('clock-container').innerHTML = `<p>${formattedDate}</p>`;
    }
    setInterval(actualizarReloj, 1000);

    $('#exampleModal').on('shown.bs.modal', function () {
        actualizarReloj();
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="{{asset('main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>