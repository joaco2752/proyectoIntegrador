<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('Login') Sustainity</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    @vite(['resources/css/login.css'])
    @vite('resources/js/script.js')
</head>

<body></body>

@if (session('message'))
    <div id="alerta_tiempo" class="alert"
        style="width: 100%; padding: 15px 0; position: fixed; top: 80px; left: 0; z-index: 1000;">
        {{ session('message') }}

        <script>
            document.addEventListener("DOMContentLoaded", function () {
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
        <h1>Actualiza el Usuario</h1>
        <form action="{{route('rutaActualizar', ['id' => $usuario->id]) }}" method="POST" class="donation-form">
            @csrf
            @method('PUT')
            <label for="correo">Correo Electrónico</label>
            <input type="text" id="email" name="email" placeholder="Tu Correo">
            <small class="text-danger fst-italic">{{ $errors->first('email') }}</small>

            <label for="contraseña">Contraseña</label>
            <input type="password" id="contraseña" name="contraseña" placeholder="Actualiza tu Contraseña">
            <small class="text-danger fst-italic">{{ $errors->first('contraseña') }}</small>

            <label for="confirmar_contraseña">Confirmar Contraseña</label>
            <input type="password" id="confirmar_contraseña" name="confirmar_contraseña"
                placeholder="Confirma tu Contraseña">
            <small class="text-danger fst-italic">{{ $errors->first('confirmar_contraseña') }}</small>

            <button type="submit" class="play-btn" name="btnDonar">Actualizar Cuenta</button>
        </form>
    </div>
    <img src="{{ asset('img/character.png') }}" alt="Game Character" class="character-image">
</div>
</body>

</html>