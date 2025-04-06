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
        <a href="{{ route('rutaNosotros') }}">Nosotros</a>
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

@if(session('message'))
    <div id="alerta_tiempo" class="alert" 
         style="display: none; width: 100%; padding: 15px 0; position: fixed; top: -100px; left: 0; z-index: 1000; background-color: #d4edda; color: #155724; text-align: center;">
        {{ session('message') }}
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const alerta = document.getElementById("alerta_tiempo");
            alerta.style.display = "block";
            setTimeout(() => {
                alerta.style.transition = "top 0.5s ease";
                alerta.style.top = "80px";
            }, 100);
            setTimeout(() => {
                alerta.style.top = "-100px";
            }, 5000);
        });
    </script>
@endif

<!-- Modal de carga -->
<div id="loadingModal" style="display:none; position: fixed; top:0; left:0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index:2000; align-items:center; justify-content:center;">
    <div style="background: #fff; padding: 20px; border-radius: 5px; font-family: 'Press Start 2P', cursive; text-align: center;">
    <p class="loading-text">Cargando...</p>
        
    </div>
</div>

<div class="main-card">
    <div class="text-content">
        <h1>Inicia Sesión</h1>
        <!-- Contenedor para mensajes de error de login -->
        <div id="loginError" style="color:#ff4d4d; font-size:0.8em; margin-bottom:10px; display:none;"></div>
        <form id="loginForm" action="{{ route('rutaLogin') }}" method="POST" class="donation-form">
              @csrf 
              <label for="email">Correo Electrónico</label>
              <input type="text" id="email" name="email" placeholder="Correo" value="{{ old('email') }}"> 
              <small class="text-danger fst-italic">{{ $errors->first('email') }}</small> 
              <label for="contraseña">Contraseña</label> 
              <div class="password-field-container">
    <input type="password" id="contraseña" name="contraseña" placeholder="Contraseña">
    <button type="button" id="togglePasswordLogin" class="password-toggle">Ver</button>
</div>
<small class="text-danger fst-italic">{{ $errors->first('contraseña') }}</small>
              <button type="submit" class="play-btn">Iniciar Sesión</button>
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
    document.addEventListener('DOMContentLoaded', function() {
        const loginForm = document.getElementById('loginForm');
        const loadingModal = document.getElementById('loadingModal');

        if (loginForm) {
            loginForm.addEventListener('submit', function(event) {
                // Mostrar el modal de carga
                loadingModal.style.display = 'flex';
            });
        }

        const passwordInput = document.getElementById('contraseña');
        const togglePasswordButton = document.getElementById('togglePasswordLogin');

        if (togglePasswordButton) {
            togglePasswordButton.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                togglePasswordButton.textContent = type === 'password' ? 'Ver' : 'Ocultar';
            });
        }
    });
</script>
</body>
</html>