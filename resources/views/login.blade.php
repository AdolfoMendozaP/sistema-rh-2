<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Iniciar Sesión - Portal del Empleado</title>

    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('login.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WyD8YiAeIyojqM7xjFOEm05Zfw2QpiFZ" crossorigin="anonymous">
    <link rel="icon" href="https://consultancysc.com/wp-content/uploads/2023/08/LogoConsultancyITfinal-150x150.png" sizes="32x32">
    
</head>
<body>
<div class="container" id="container">
    <div class="form-container register-container">
        <form action="{{ route('password.email') }}" method="post">
            @csrf
            <img src="https://consultancysc.com/wp-content/uploads/2023/08/LogoConsultancyITfinal-150x150.png" alt="Logo Consultancy">
            <input type="email" name="email" placeholder="Correo Electronico" required>
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="text" name="folio" placeholder="Folio" required>
            <button type="submit">Reestablecer</button>
        </form>
    </div>

    <div class="form-container login-container">
        <form action="{{ url('/login') }}" method="post">
            @csrf
            <img src="https://consultancysc.com/wp-content/uploads/2023/08/LogoConsultancyITfinal-150x150.png" alt="Logo Consultancy">
            <input type="text" name="name" id="name" placeholder="Nombre" autocomplete="name" required>
            <input type="text" name="username" id="username" placeholder="Usuario" autocomplete="username" required>
            <input type="password" name="password" id="password" placeholder="Contraseña" autocomplete="current-password" required>
            <button type="submit">Ingresar</button>
        </form>
    </div>

    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h2 class="title">Reestablecer <br> contraseña</h2>
                <p>Para restablecer tu contraseña, por favor, introduce a continuación tu usuario y folio de empleado.</p>
                <button class="ghost" id="login">Regresar
                    <i class="lni lni-arrow-left login"></i>
                </button>
            </div>
            <div class="overlay-panel overlay-right">
                <h2 class="title">Bienvenido a Consultacy Servicios Contables</h2>
                <p>Haz olvidado tu contraseña</p>
                <button class="ghost" id="register">Recuperar contraseña
                    <i class="lni lni-arrow-right register"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    const registerButton = document.getElementById("register");
    const loginButton = document.getElementById("login");
    const container = document.getElementById("container");

    registerButton.addEventListener("click", () => {
        container.classList.add("right-panel-active");
    });

    loginButton.addEventListener("click", () => {
        container.classList.remove("right-panel-active");
    });
</script>
</body>
</html>