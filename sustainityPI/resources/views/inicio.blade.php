<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diseño con Transiciones</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    @vite('resources/css/inicio.css')

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
        <a href="#trailer">Trailer</a>
        <a href="/donar">Donativos</a>
        <a href="/info">Nosotros</a>
    </nav>
    <div class="navbar-right auth-buttons">
        <button class="login-btn" onclick="window.location.href='{{ route('rutaLogin') }}'">Iniciar Sesión</button>
        <button class="news-btn">Noticias</button>
    </div>
</header>

<div class="main-card appear-on-load">
    <div class="text-content">
        <h1>SUSTAINITY</h1>
        <p>Una aventura inolvidable te espera en un mundo de píxeles. Explora, lucha y descubre los secretos de esta tierra mística.</p>
        <button class="play-btn">Descargar Demo</button>
    </div>
    <img src="{{ asset('img/Descargaaaa.png') }}" alt="Personaje" class="character-image">
</div>

<div class="card-section">
    <h2>¡Conoce a nuestros personajes!</h2>
    <p>Start playing Sustainity with unique hero decks, each with special abilities.</p>
    <div class="card-container">
        <div class="card appear-from-bottom delay-1">
            <img src="{{ asset('img/card1.png') }}" alt="Card 1">
        </div>
        <div class="card appear-from-bottom delay-2">
            <img src="{{ asset('img/card2.png') }}" alt="Card 2">
        </div>
        <div class="card appear-from-bottom delay-3">
            <img src="{{ asset('img/card3.png') }}" alt="Card 3">
        </div>
        <div class="card appear-from-bottom delay-4">
            <img src="{{ asset('img/card4.png') }}" alt="Card 4">
        </div>
    </div>
</div>

<div class="trailer-card appear-on-load">
    <div class="text-content-left">
        <h1>Ver Tráiler</h1>
        <p>Sumérgete en el mundo de Sustainity y descubre los emocionantes desafíos que te esperan. Haz clic en el video para ver el tráiler oficial.</p>
    </div>
    <div class="video-content">
        <video controls>
            <source src="{{ asset('videos/trailer.mp4') }}" type="video/mp4">
            Tu navegador no soporta el elemento de video.
        </video>
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
