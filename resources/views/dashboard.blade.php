@php
    $user = auth()->user();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="https://consultancysc.com/wp-content/uploads/2023/08/LogoConsultancyITfinal-150x150.png" sizes="32x32">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('style.css')}}">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    
    <title>Portal Dashboard - Consultacy</title>
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
            <li class="active">
                <a href="{{ url('/dashboard') }}"></a>
                <div class="menu-item">
                    <i class="fa-solid fa-home fa-lg"></i>
                    <span class="small-text">Home</span>
                </div>
                
            </li>
            <li>
            <a href="{{ url('/asistencia') }}">
            <div class="menu-item">
                <i class="fa-solid fa-calendar-days fa-lg"></i>
                <span class="small-text">Asistencias</span>
            </div>
        </a>
    </li>
    <li>
    <a href="{{ url('/empleado') }}">
        <div class="menu-item">
            <i class="fa-solid fa-book fa-lg"></i>
            <span class="small-text">Registros</span>
        </div>
    </a>
</li>
            <li>
                <a href="#"></a>
                <div class="menu-item">
                    <i class="fa-solid fa-chart-column fa-lg"></i>
                    <span class="small-text">Estadisticas</span>
                </div>
            </li>
            <li class="logout">
               <a href="#" onclick="document.getElementById('logout-form').submit()">
                 <form action="{{ route('logout') }}" method="POST" id="logout-form">
                 @csrf
                <div class="menu-item">
                <i class="fa-solid fa-right-from-bracket fa-lg"></i>
                <span class="small-text">Cerrar Sesión</span>
               </div>
              </form>
              </a>
            </li>
        </ul>
    </div>
    <div class="main-content">
        <div class="container-fluid bg-primary text-light py-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="no-bold">Portal Dashboard</h2>
                </div>
                <div class="col-md-6 text-md-end"> 
                    <div class="d-flex align-items-center justify-content-end"> 
                        <p class="mb-0 me-3 no-bold"><span id="clock"></span></p>
                        <div class="d-flex align-items-center ms-4"> 
                        <img src="{{ $user->profile_image_url ?? 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png' }}" alt="Foto de perfil" class="rounded-circle" width="30">
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
                 <h5 class="card-title text-secondary">EMPLEADOS</h5>
                 <p class="card-text"><strong>Empleados activos</strong></p>
                 <p class="card-text text-secondary">#</p>
                 </div>
                    <div class="card-icon">
                        <i class="fas fa-id-card-alt text-danger"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-white">
                    <div class="card-body">
                        <h5 class="card-title text-secondary">PENDIENTES</h5>
                        <p class="card-text"><strong>0</strong></p>
                        <p class="card-text text-secondary">
                        <div class="dropdown">
            <button class="btn custom-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <button class="dropdown-item btn btn-info" type="button">Marcar Leído</button>
            <hr>
            </div>
        </div>
                        </p>
                    </div>
                    <div class="card-icon">
                            <i class="fas fa-note-sticky text-yellow"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
              <div class="card bg-white">
                 <div class="card-body">
                 <h5 class="card-title text-secondary">Notificaciones</h5>
                 <p class="card-text"><strong><span id="notificationCount">0</span></strong></p>
                 <p class="card-text text-secondary">
                 <div class="dropdown">
            <button class="btn custom-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <button class="dropdown-item btn btn-info" type="button">Marcar Leído</button>
            <hr>
            </div>
        </div>
                 </p>
                 </div>
                <div class="card-icon">
                <i id="notificationIcon" class="fas fa-bell text-blue"></i>
                </div>
               </div>
              </div>
            </div>
        </div>
    </div>
<div class="container-fluid bg-cream py-3">
    
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
        <div class="col-md-9">
    <div class="card bg-white h-100">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title text-secondary">REGISTROS NUEVOS</h5>
            <div class="table-responsive flex-grow-1">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Folio</th>
                            <th>Usuario</th>
                        </tr>
                    </thead>
                    <tbody id="registrosNuevosTableBody"></tbody>
                </table>
            </div>
            <p class="card-text mt-2"><strong><a href="{{ route('empleado.index') }}">Ver mas...</a></strong></p>
            <p class="card-text text-secondary"></p>
        </div>
        <div class="card-icon">
            <i class="fas fa-list text-yellow"></i>
        </div>
    </div>
</div>
<div class="col-md-3">
        <div class="card bg-white">
        <div class="card-body">
    <h5 class="card-title text-secondary">REPORTES DE ASISTENCIAS</h5>
    <hr>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Hora Entrada</th>
                    <th>Hora Salida</th>
                    <th>Nombre Completo</th>
                </tr>
            </thead>
            <tbody id="asistenciasTableBody"></tbody>
        </table>
    </div>
    <p class="card-text mt-2"><strong><a href="{{ route('asistencia.index') }}">Ver más...</a></strong></p>
    <p class="card-text text-secondary"></p>
</div>
            <div class="card-icon">
                <i class="fas fa-clock text-blue"></i>
            </div>
        </div>
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="{{asset('main.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    showNewRecords();
    showAttendanceReports();
    setTimeout(hideRecords, 3 * 24 * 60 * 60 * 1000);
});

function showNewRecords() {
    axios.get('/get-new-records')
        .then(function (response) {
            const registrosNuevosTableBody = document.getElementById('registrosNuevosTableBody');
            registrosNuevosTableBody.innerHTML = '';

            if (response.data.length > 0) {
                const limitedRecords = response.data.slice(0, 5);

                limitedRecords.forEach(function (record) {
                    const row = registrosNuevosTableBody.insertRow();
                    const cell1 = row.insertCell(0);
                    const cell2 = row.insertCell(1);
                    const cell3 = row.insertCell(2);
                    const cell4 = row.insertCell(3);

                    cell1.textContent = record.IDempleado;
                    cell2.textContent = `${record.nombre} ${record.apellido}`;
                    cell3.textContent = record.folio;
                    cell4.textContent = record.usuario; 
                });
            } else {
                registrosNuevosTableBody.innerHTML = '<tr><td colspan="4">No hay registros nuevos.</td></tr>';
            }
        })
        .catch(function (error) {
            console.error('Error al obtener los registros nuevos:', error);
            if (error.response) {
                console.error('Respuesta del servidor:', error.response.data);
            }
        });
}

function hideRecords() {
    document.getElementById('registrosNuevosList').innerHTML = '<p>No hay registros nuevos.</p>';
}

</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>
</html>