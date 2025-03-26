<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sustainity</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    @vite(['resources/css/login.css'])
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

    <div class="main-card">
        <div class="text-content">
            <h1>Inicia Sesión</h1>
            <form action="{{ route('rutaLogin') }}" method="POST" class="donation-form">
                @csrf
                <label for="name">Correo Electronico</label>
                <input type="text" id="email" name="email" placeholder="Correo">
                <small class="text-danger fst-italic">{{ $errors->first('email') }}</small>
                
                <label for="email">Contraseña</label>
                <input type="password" id="contraseña" name="contraseña" placeholder="Contraseña">
                <small class="text-danger fst-italic">{{ $errors->first('contraseña') }}</small>
                
                <button type="submit" class="play-btn" name="btnDonar">Iniciar Sesión</button>
            </form>
            <p><a href="{{ route('rutaCrear') }}" class="create-account-link">¿No tienes cuenta?</a></p>
        </div>
        <img src="{{ asset('img/character.png') }}" alt="Game Character" class="character-image">
    </div>

    <footer class="footer">
        <div class="footer-content">
            <a href="#">Política de Privacidad</a> | 
            <a href="#">Términos y Condiciones</a> | 
            <a href="#">Contacto</a>
        </div>
        <p>&copy; 2024 Sustainity. Todos los derechos reservados.</p>
    </footer>

    <script>
        document.getElementById('loginBtn').addEventListener('click', function() {
            // Ocultar el botón al hacer clic
            this.style.display = 'none';
        });
    </script>
    
</body>
</html>