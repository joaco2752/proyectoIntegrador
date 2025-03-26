<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gracias por tu donación</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    @vite(['resources/css/donativos.css'])
    @vite('resources/js/script.js')
</head>

<body>
    <nav class="navbar">
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
        <div class="navbar-left">
            <a href="#">
                <img src="{{ asset('img/DevPlay logo.png') }}" alt="DevPlay Logo" class="logo-image">
            </a>
        </div>
        <div class="navbar-center">
            <a href="{{ route('rutaInicio') }}">Inicio</a>
            <a href="/donar">Donativos</a>
            <a href="/info">Nosotros</a>
        </div>
        <div class="navbar-right auth-buttons">
            @if (!session('logged_in'))
                <button class="login-btn" onclick="window.location.href='{{ route('rutaLogin') }}'">Iniciar Sesión</button>
                
            @endif
            <button class="news-btn" onclick="window.location.href='{{ route('rutaNoticias') }}'">Noticias</button>
        </div>
    </nav>
    <div class="main-card">
        <div class="text-content">
            <h1>Pago cancelado</h1>
            <p>Tu pago no se ha completado. Si tienes algún problema, por favor intenta nuevamente.</p>
        </div>
        <img src="{{ asset('img/donativos_fondo.png') }}" alt="Personaje" class="character-image">
    </div>

    <footer class="footer">
        <div class="footer-content">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
        </div>
        <p>&copy; 2023 Sustainity. All rights reserved.</p>
    </footer>
</body>

</html>