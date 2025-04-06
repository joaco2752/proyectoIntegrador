<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta - Sustainity</title>
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
        <button class="login-btn" onclick="window.location.href='{{ route('rutaLogin') }}'">Iniciar Sesión</button>
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
        <h1>Crea tu Cuenta</h1>
        <form id="registerForm" method="POST">
            @csrf
            <div class="password-field-container">
                <label for="email">Correo Electrónico</label>
                <input type="text" id="email" name="email" placeholder="Correo Electrónico" value="{{ old('email') }}">
                <small class="text-danger fst-italic">{{ $errors->first('email') }}</small>
            </div>
            <div class="password-field-container">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Username" value="{{ old('username') }}">
                <small class="text-danger fst-italic">{{ $errors->first('username') }}</small>
            </div>
            <label for="contraseña">Contraseña</label>
            <div class="password-field-container">
                <input type="password" id="contraseña" name="contraseña" placeholder="Contraseña">
                <button type="button" id="togglePassword" class="password-toggle">Ver</button>
            </div>
            <small class="text-danger fst-italic">{{ $errors->first('contraseña') }}</small>
            
            <label for="confirmar_contraseña">Confirmar Contraseña</label>
            <div class="password-field-container">
                <input type="password" id="confirmar_contraseña" name="confirmar_contraseña" placeholder="Confirmar Contraseña">
                <button type="button" id="toggleConfirmPassword" class="password-toggle">Ver</button>
            </div>
            <small class="text-danger fst-italic">{{ $errors->first('confirmar_contraseña') }}</small>
            
            <button type="submit" class="play-btn">Crear Cuenta</button>
        </form>
        <p><a href="{{ route('rutaLogin') }}" class="Login-link">¿Ya tienes cuenta?</a></p>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('contraseña');
        const confirmPasswordInput = document.getElementById('confirmar_contraseña');
        const togglePasswordButton = document.getElementById('togglePassword');
        const toggleConfirmPasswordButton = document.getElementById('toggleConfirmPassword');
        
        togglePasswordButton.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            togglePasswordButton.textContent = type === 'password' ? 'Ver' : 'Ocultar';
        });
        
        toggleConfirmPasswordButton.addEventListener('click', function() {
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);
            toggleConfirmPasswordButton.textContent = type === 'password' ? 'Ver' : 'Ocultar';
        });
    });

    // Envío del formulario a la API externa para crear cuenta sin notificaciones
    document.getElementById('registerForm').addEventListener('submit', function(event) {
        event.preventDefault();
        
        const formData = new FormData(this);
        const password = formData.get('contraseña');
        const confirmPassword = formData.get('confirmar_contraseña');

        if(password !== confirmPassword) {
            return;
        }

        const userData = {
            username: formData.get('username'),
            email: formData.get('email'),
            password: password,
            role_id: 2
        };

        fetch('https://api-yovy.onrender.com/usuarios', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(userData)
        })
        .then(response => response.json())
        .then(data => {
            // Si se creó el usuario correctamente, se redirecciona al login.
            if (data.message === "Usuario Guardado" || data.id) {
                window.location.href = '/login/create';
            } else {
                window.location.href = '/login/create';
            }
        })
        .catch(error => {
            window.location.href = '/login/create';
        });
    });
</script>

</body>
</html>