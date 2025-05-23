<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sustainity - En Desarrollo</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    @vite('resources/css/inicio.css')
</head>

<body>
    <header class="navbar">
        <div class="navbar-left">
            <a href="{{ route('rutaInicio') }}">
                <img src="{{ asset('img/DevPlay logo.png') }}" alt="Logo" class="logo-image">
            </a>
        </div>
        <nav class="navbar-center nav-links">
            <a href="{{ route('rutaInicio') }}">Inicio</a>
            <a href="/donar">Donativos</a>
            <a href="/info">Nosotros</a>
            <a href="{{ route('rutaConsultar') }}">Consultar</a>
        </nav>
        <div class="navbar-right auth-buttons">
    @if (session('logged_in'))
        <div class="user-info">
            <span class="username" onclick="toggleLogoutDropdown()">
                {{ session('username') }}
            </span>
            <div id="logoutDropdown" class="logout-dropdown">
                <button onclick="window.location.href='{{ route('rutaLogout') }}'">Cerrar sesión</button>
            </div>
        </div>
    @else
        <button class="login-btn" onclick="window.location.href='{{ route('rutaLogin') }}'">Iniciar Sesión</button>
    @endif
    <button class="news-btn" onclick="window.location.href='{{ route('rutaNoticias') }}'">Noticias</button>
</div>
<script>
    function toggleLogoutDropdown() {
        const dropdown = document.getElementById('logoutDropdown');
        dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
    }
    // Opcional: ocultar el dropdown al hacer click fuera
    document.addEventListener('click', function(e) {
        const userInfo = document.querySelector('.user-info');
        if(userInfo && !userInfo.contains(e.target)) {
            document.getElementById('logoutDropdown').style.display = 'none';
        }
    });
</script>
    </header>

    <div class="development-container">
        <div class="development-card">
            <h1 class="development-title">¡Sustainity en Desarrollo!</h1>
            
            <div class="pixel-animation"></div>
            
            <img src="{{ asset('img/Daryl_fondo.png') }}" alt="Personaje Sustainity" class="development-image">
            
            <p class="development-message">
                Gracias por tu interés en Sustainity. El demo del juego se encuentra actualmente en desarrollo.
                Estamos trabajando arduamente para ofrecerte una experiencia de juego única y emocionante.
                ¡Vuelve pronto para descubrir las novedades!
            </p>
            
            <p class="development-message">
                Mientras tanto, puedes explorar más sobre el mundo de Sustainity en nuestra página principal
                y mantenerte al día con las últimas noticias.
            </p>
            
            <div class="pixel-animation"></div>
            
            
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