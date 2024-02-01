@extends('orboarding.welcome')

@section('content')
<div class="container">
<header>
        <div id="menu-icon">&#9776;</div>
    </header>

    <nav>
        <ul>
            <li><a href="#">Menú 1</a></li>
            <li><a href="#">Menú 2</a></li>
            <!-- Agregar más elementos de menú según sea necesario -->
        </ul>
    </nav>

    <div class="main-container">

        <div class="welcome-box">
            <div class="icons">
                <a href="pagina1.html">
                    <img src="img/mssj.png" alt="icono-mssj">
                </a>
                <a href="pagina2.html">
                    <img src="img/cal.png" alt="icono-cal">
                </a>
                <a href="pagina3.html">
                    <img src="img/pos.png" alt="icono-pos">
                </a>
                <a href="pagina4.html">
                    <img src="img/inf.png" alt="icono-inf">
                </a>
            </div>

            <h1>Welcome Aboard!</h1>
            <p>
                This portal is designed to help you learn more about us before you join,
                what to expect in your first few<br>
                weeks with us, and get some of the pesky paperwork out of the way. We hope you find it useful.
                If you have<br>
                any questions, just get in touch.
            </p>
        </div>

        <div class="task">
            <div class="tit">
                <p>Tasks</p>
            </div>
            <a href="#" class="button-link">View Tasks</a>
        </div>

        <div class="video-section">
            <div class="tit-video">
                <p>Company Video</p>
            </div>
            
            <video width="100%" height="247px" controls>
                <!-- Origen del video (archivo local o una URL) -->
                <source src="video/pexel.mp4" type="video/mp4">
            </video>
        </div>

        <div class="topics-box">
            <div class="tit-video">
                    <p>Your First Day</p>
            </div>
            <h3>We understand that your first day can be a busy, sometimes <br>
                nervy experience, so here´s a heads up on what to expect
            </h3>
            <ul class="list">
                <li><p>Arrive at reception for 9am.</p></li>
                <li><p>We´ll give you the grand tour of the office, followed by a coffe </p>
                    <p>with your new team so you can get well acquainted.</p>
                </li>
                <li><p>We will then take you through the health and safety procedures.</p></li>
                <li><p>There will be a desk and computer set up for you when you arrive. </p>
                    <p>However we will need to spend some time setting up passwords.</p>
                </li>
                <!-- Agregar más puntos según sea necesario -->
            </ul>
        </div>

        <div class="advisors-section">
            <!-- Aquí colocar las fotos -->
            <div class="advisor-marc">
                <div class="title"><p>Manager</p></div>
                <div class="advisor"><img src="img/ases1.png" alt="manager-1"></div>
                <p>Charlie Cross</p>
                <p>Customer Services</p>
                <a href="#" class="button-bio">View Bio</a>
            </div>
            <div class="advisor-marc">
                <div class="title"><p>Peer</p></div>
                <div class="advisor"><img src="img/ases2.png" alt="peer-2"></div>
                <p>Name</p>
                <p>Customer Services</p>
                <a href="#" class="button-bio">View Bio</a>
            </div>
            <div class="advisor-marc">
                <div class="title"><p>Peer</p></div>
                <div class="advisor"><img src="img/ases3.png" alt="peer-3"></div>
                <p>Name</p>
                <p>Customer Services</p>
                <a href="#" class="button-bio">View Bio</a>
            </div>
            <div class="advisor-marc">
                <div class="title"><p>Peer</p></div>
                <div class="advisor"><img src="img/ases4.png" alt="peer-4"></div>
                <p>Name</p>
                <p>Customer Services</p>
                <a href="#" class="button-bio">View Bio</a>
            </div>
            <div class="advisor-marc">
                <div class="title"><p>Peer</p></div>
                <div class="advisor"><img src="img/ases5.png" alt="peer-5"></div>
                <p>Name</p>
                <p>Customer Services</p>
                <a href="#" class="button-bio">View Bio</a>
            </div>
            <div class="advisor-marc">
                <div class="title"><p>Peer</p></div>
                <div class="advisor"><img src="img/ases6.png" alt="peer-6"></div>
                <p>Name</p>
                <p>Customer Services</p>
                <a href="#" class="button-bio">View Bio</a>
            </div>
            <div class="advisor-marc">
                <div class="title"><p>Peer</p></div>
                <div class="advisor"><img src="img/ases7.png" alt="peer-7"></div>
                <p>Name</p>
                <p>Customer Services</p>
                <a href="#" class="button-bio">View Bio</a>
            </div>
            
        </div>

    </div>
</div>

@endsection