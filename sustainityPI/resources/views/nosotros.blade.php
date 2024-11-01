<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <title>Acerca de Nosotros</title>
    @vite(['resources/css/inicio.css'])
    @vite('resources/js/script.js')
</head>
<body>
<nav class="navbar">

@if (session('message'))
<div id="alerta_tiempo" class="alert" style="width: 100%; padding: 15px 0; position: fixed; top: 80px; left: 0; z-index: 1000;">
        {{ session('message') }}

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const alertMessage = document.getElementById("alerta_tiempo");
        if (alertMessage) {
            setTimeout(() => {
                alertMessage.style.display = "none";
            }, 5000); 
        }
    });
</script>

    </div>
@endif

        <div class="navbar-left">
            <a href="#">
                <img src="{{ asset('img/DevPlay logo.png') }}" alt="DevPlay Logo" class="logo-image">
                <img src="{{ asset('img/logo.png') }}" alt="Sustainity Logo" class="small-logo">
            </a>
        </div>
        <div class="navbar-center nav-links">
            <a href="{{ route('rutaInicio') }}">Home</a>
            <a href="#">About</a>
            <a href="#">Play</a>
        </div>
        <div class="navbar-right auth-buttons">
            <button class="login-btn">Login</button>
            <button class="news-btn">News</button>
        </div>
    </nav>

    <div class="main-card">
        <div class="text-content">
            <h1>Acerca de Sustainity</h1>
            <p>Explora un mundo donde la sustentabilidad se vuelve diversión!!</p>
            <div class="game-info">
                <h2>Caracteristicas del Juego</h2>
                <ul>
                    <li>Desafios ecologicos atractivos</li>
                    <li>Construye y gestiona ciudades sostenibles</li>
                    <li>Aprende sobre la conservación del medio ambiente</li>
                    <li>Compite con amigos para encontrar las soluciones mas ecologicas</li>
                </ul>
                <h2>Como jugarlo</h2>
                <ol>
                    <li>Crear tu cuenta</li>
                    <li>Completa misiones de sustentabilidad</li>
                    <li>Mejora tu tecnologia ecologica.</li>
                </ol>
                <form action="/enviarInfo" method="POST">
                    @csrf
                    <div>
                    <label for="email">Danos tu correo para más información</label>
                    </div>
                    <div>
                    <input type="text" id="email" name="email" placeholder="Tu Correo">
                    <small>{{ $errors->first('email')}}</small>
                    </div>
                    <div>
                <br>
                <label for="">Ahora presiona aqui y te mandaremos la información a tu correo</label>
                <button type="submit" class="info-btn">Solicita más información</button>
                </div>
                </form>
            </div>
        </div>
        <img src="{{ asset('img/escenario videojuego.png') }}" alt="Sustainity Game Screenshot" class="game-image">
    </div>

    <footer class="footer">
        <div class="footer-content">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
        </div>
        <p>&copy; {{ date('Y') }} Sustainity. All rights reserved.</p>
    </footer>
</body>
</html>