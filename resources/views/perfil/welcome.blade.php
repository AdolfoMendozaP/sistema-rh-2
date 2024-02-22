@php
    $user = auth()->user();
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
                        
                        <span class="ms-2">{{ auth()->user()->name }}</span>
                       </div>
                    </div>
                </div>
            </div>
    <div class="container mt-5">
        <div class="row">
            </div>
        </div>
    </div>
<div class="container-fluid bg-cream py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Perfil de Empleado</h2>
            </div>
            
            <div class="container">
                <br>
            @yield('content')
    
</div>
    </div>
    <br><br><br>
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