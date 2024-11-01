<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sustainity</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    @vite(['resources/css/login.css'])
</head>
<body>

    <div class="main-card">
        <div class="text-content">
            <h1>Inicia Sesión</h1>
            <form action="/enviarDonativo" method="POST" class="donation-form">
                @csrf
                <label for="name">Correo Electronico</label>
                <input type="text" id="name" name="name" placeholder="Tu Correo" required>
                
                <label for="email">Contraseña</label>
                <input type="email" id="email" name="email" placeholder="Tu Contraseña" required>
                
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
    
</body>
</html>