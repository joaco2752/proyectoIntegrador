<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <title>Acerca de Nosotros</title>
    @vite(['resources/css/nosotros.css'])
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
                <img src="{{ asset('img/DevPlay logo.png') }}" alt="Logo" class="logo-image">
            </a>
        </div>
        <nav class="navbar-center nav-links">
            <a href="{{ route('rutaInicio') }}">Inicio</a>
            <a href="/donar">Donativos</a>
            <a href="/info">Nosotros</a>
        </nav>
        <div class="navbar-right auth-buttons">
            @if (!session('logged_in'))
                <button class="login-btn" onclick="window.location.href='{{ route('rutaLogin') }}'">Iniciar Sesión</button>
                
            @endif
            <button class="news-btn" onclick="window.location.href='{{ route('rutaNoticias') }}'">Noticias</button>
        </div>
    </nav>

    <div class="main-card">
        <div class="info-section">
            <h1>Acerca de Sustainity</h1>
            <p>Explora un mundo donde la sustentabilidad se vuelve diversión!</p>
        </div>

        <div class="game-info">
            <h2>Características del Juego</h2>
            <ul>
                <li>Desafíos ecológicos atractivos</li>
                <li>Construye y gestiona ciudades sostenibles</li>
                <li>Aprende sobre la conservación del medio ambiente</li>
                <li>Compite con amigos para encontrar las soluciones más ecológicas</li>
            </ul>
        </div>

        <div class="how-to-play-section">
            <h2>Cómo Jugar</h2>
            <ol>
                <li>Crear tu cuenta</li>
                <li>Completa misiones de sustentabilidad</li>
                <li>Mejora tu tecnología ecológica</li>
            </ol>
        </div>

        <div class="form-section">
            <h2>Solicita Información</h2>
            <form action="{{ route('rutaInfo')}}" method="POST">
                @csrf
                <div>
                    <label for="email">Danos tu correo para más información</label>
                </div>
                <div>
                    <input type="text" id="email" name="email" placeholder="Tu Correo">
                    <small>{{ $errors->first('email')}}</small>
                </div>
                <br>
                <label for="">Presiona aquí y te mandaremos la información a tu correo</label>
                <button type="submit" class="info-btn">Solicita más información</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Contacto</a>
        </div>
        <p>&copy; {{ date('Y') }} Sustainity. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
