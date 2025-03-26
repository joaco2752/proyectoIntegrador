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
        <a href="{{ route('rutaNosotros')}}">Nosotros</a>
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
            <form action="/CrearCuenta" method="POST" class="donation-form">
                @csrf
                <div class="password-field-container">
                <label for="correo">Correo Electrónico</label>
                    <input type="text" id="email" name="email" placeholder="" value="{{ old('email') }}">
                    <small class="text-danger fst-italic">{{ $errors->first('email') }}</small>
                </div>

                <label for="contraseña">Contraseña</label>
                <div class="password-field-container">
                    <input type="password" id="contraseña" name="contraseña" placeholder="">
                    <button type="button" id="togglePassword" class="password-toggle">Ver</button>
                </div>
                <small class="text-danger fst-italic">{{ $errors->first('contraseña') }}</small>
                
                <div id="passwordStrengthMeter" class="password-strength-meter">
                    <div id="passwordStrengthBar" class="password-strength-meter-bar"></div>
                </div>
                <div id="passwordFeedback" class="password-feedback"></div>

                <label for="confirmar_contraseña">Confirmar Contraseña</label>
                <div class="password-field-container">
                    <input type="password" id="confirmar_contraseña" name="confirmar_contraseña" placeholder="">
                    <button type="button" id="toggleConfirmPassword" class="password-toggle">Ver</button>
                </div>
                <small class="text-danger fst-italic">{{ $errors->first('confirmar_contraseña') }}</small>
                <div id="passwordMatchFeedback" class="password-match-feedback"></div>
                
                <button type="submit" class="play-btn" name="btnDonar">Crear Cuenta</button>
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
            const passwordStrengthMeter = document.getElementById('passwordStrengthMeter');
            const passwordStrengthBar = document.getElementById('passwordStrengthBar');
            const passwordFeedback = document.getElementById('passwordFeedback');
            const passwordMatchFeedback = document.getElementById('passwordMatchFeedback');
            const togglePasswordButton = document.getElementById('togglePassword');
            const toggleConfirmPasswordButton = document.getElementById('toggleConfirmPassword');
            
            // Show/hide password toggle for password field
            togglePasswordButton.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                togglePasswordButton.textContent = type === 'password' ? 'Ver' : 'Ocultar';
            });
            
            // Show/hide password toggle for confirm password field
            toggleConfirmPasswordButton.addEventListener('click', function() {
                const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordInput.setAttribute('type', type);
                toggleConfirmPasswordButton.textContent = type === 'password' ? 'Ver' : 'Ocultar';
            });
            
            // Password strength checker
            passwordInput.addEventListener('input', function() {
                const password = passwordInput.value;
                
                if (password.length === 0) {
                    passwordStrengthMeter.style.display = 'none';
                    passwordFeedback.style.display = 'none';
                    return;
                }
                
                passwordStrengthMeter.style.display = 'block';
                passwordFeedback.style.display = 'block';
                
                // Check password strength
                const strength = checkPasswordStrength(password);
                
                // Update strength meter
                passwordStrengthBar.className = 'password-strength-meter-bar';
                
                if (strength.score === 1) {
                    passwordStrengthBar.classList.add('strength-weak');
                    passwordFeedback.textContent = 'Contraseña débil: ' + strength.feedback;
                } else if (strength.score === 2) {
                    passwordStrengthBar.classList.add('strength-medium');
                    passwordFeedback.textContent = 'Contraseña media: ' + strength.feedback;
                } else if (strength.score === 3) {
                    passwordStrengthBar.classList.add('strength-good');
                    passwordFeedback.textContent = 'Contraseña buena: ' + strength.feedback;
                } else if (strength.score === 4) {
                    passwordStrengthBar.classList.add('strength-strong');
                    passwordFeedback.textContent = 'Contraseña fuerte: ' + strength.feedback;
                }
                
                // Check if passwords match
                checkPasswordsMatch();
            });
            
            // Check if passwords match
            confirmPasswordInput.addEventListener('input', checkPasswordsMatch);
            
            function checkPasswordsMatch() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;
                
                if (confirmPassword.length === 0) {
                    passwordMatchFeedback.style.display = 'none';
                    return;
                }
                
                passwordMatchFeedback.style.display = 'block';
                
                if (password === confirmPassword) {
                    passwordMatchFeedback.textContent = '¡Las contraseñas coinciden!';
                    passwordMatchFeedback.className = 'password-match-feedback password-match-success';
                } else {
                    passwordMatchFeedback.textContent = 'Las contraseñas no coinciden';
                    passwordMatchFeedback.className = 'password-match-feedback password-match-error';
                }
            }
            
            function checkPasswordStrength(password) {
                let score = 0;
                let feedback = [];
                
                // Check length
                if (password.length < 8) {
                    feedback.push('Añade más caracteres (mínimo 8)');
                } else {
                    score++;
                }
                
                // Check for uppercase letters
                if (!/[A-Z]/.test(password)) {
                    feedback.push('Añade letras mayúsculas');
                } else {
                    score++;
                }
                
                // Check for lowercase letters
                if (!/[a-z]/.test(password)) {
                    feedback.push('Añade letras minúsculas');
                } else {
                    score++;
                }
                
                // Check for numbers
                if (!/[0-9]/.test(password)) {
                    feedback.push('Añade números');
                } else {
                    score++;
                }
                
                // Check for special characters
                if (!/[^A-Za-z0-9]/.test(password)) {
                    feedback.push('Añade caracteres especiales (!@#$%^&*)');
                } else {
                    score++;
                }
                
                // Adjust score based on length
                if (password.length >= 12) {
                    score = Math.min(score + 1, 4);
                }
                
                // Generate feedback message
                let feedbackMessage = '';
                if (score < 4) {
                    feedbackMessage = feedback.slice(0, 2).join(', ');
                } else {
                    feedbackMessage = '¡Excelente contraseña!';
                }
                
                return {
                    score: Math.min(score, 4),
                    feedback: feedbackMessage
                };
            }
        });
    </script>
</body>
</html>