<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diseño con Transiciones</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    @vite('resources/css/login.css')

    @vite('resources/js/script.js')

</head>
<body>
<header class="navbar">
    <div class="navbar-left">
        <a href="#">
            <img src="{{ asset('img/DevPlay logo.png') }}" alt="Logo" class="logo-image">
        </a>
    </div>
    <nav class="navbar-center nav-links">
    <a href="{{ route('rutaInicio') }}">Inicio</a>
        <a href="/donar">Donativos</a>
        <a href="{{ route('rutaNosotros')}}">Nosotros</a>
    </nav>
    <div class="navbar-right auth-buttons">
        @if (!session('logged_in'))
            <button class="login-btn" onclick="window.location.href='{{ route('rutaLogin') }}'">Iniciar Sesión</button>
            
        @endif
        <button class="news-btn" onclick="window.location.href='{{ route('rutaNoticias') }}'">Noticias</button>
    </div>
</header>

<div class="main-card appear-on-load">
    <div class="text-content">
        <h1>SUSTAINITY</h1>
        <p>El parche 1 ya está aquí, trayendo consigo emocionantes mejoras y nuevas características que transformarán tu experiencia de juego.</p>
    </div>
    <img src="{{ asset('img/Patch 1.webp') }}" alt="Parche" class="Parche-image">
</div>

<div class="trailer-card appear-on-load">
    <div class="text-content-left">
        <h1>Discord</h1>
        <p>Únete a Nuestra Comunidad de Discord, conéctate con otros jugadores, comparte tus experiencias, y mantente al día con las últimas actualizaciones y eventos. Nuestra comunidad está llena de jugadores apasionados como tú, listos para ayudarte y compartir consejos."</p>
    </div>
    <div class="video-content">
        <img src="{{ asset('img/QrDc.png') }}" alt="Qr" class="discord-image">
    </div>
</div>

<footer class="footer">
    <div class="footer-content">
        <a href="#">Política de Privacidad</a> | 
        <a href="#">Términos y Condiciones</a> | 
        <a href="#">Contacto</a>
    </div>
    <p>&copy; 2024 Sustainity. Todos los derechos reservados.</p>
</footer>
</body>
</html>