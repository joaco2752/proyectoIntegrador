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
            <h1>Crea tu Cuenta</h1>
            <form action="/enviarDonativo" method="POST" class="donation-form">
                @csrf
                <label for="correo">Correo Electrónico</label>
                <input type="text" id="correo" name="correo" placeholder="Tu Correo">
                <small class="text-danger fst-italic">{{ $errors->first('correo') }}</small>

                <label for="contraseña">Contraseña</label>
                <input type="password" id="contraseña" name="contraseña" placeholder="Crea tu Contraseña">
                <small class="text-danger fst-italic">{{ $errors->first('contraseña') }}</small>

                <label for="confirmar_contraseña">Confirmar Contraseña</label>
                <input type="password" id="confirmar_contraseña" name="confirmar_contraseña" placeholder="Confirma tu Contraseña">
                <small class="text-danger fst-italic">{{ $errors->first('confirmar_contraseña') }}</small>
                
                <button type="submit" class="play-btn" name="btnDonar">Crear Cuenta</button>
            </form>
            <p><a href="{{ route('rutaLogin') }}" class="Login-link">¿Ya tienes cuenta?</a></p>
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