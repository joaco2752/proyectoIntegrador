<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate to Sustainity</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    @vite(['resources/css/donativos.css'])
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
                <img src="{{ asset('img/DevPlay logo.png') }}" alt="DevPlay Logo" class="logo-image">
            </a>
        </div>
        <div class="navbar-center">
            <a href="{{ route('rutaInicio') }}">Inicio</a>
            <a href="/donar">Donativos</a>
            <a href="/info">Nosotros</a>
        </div>
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
    </nav>

    <div class="main-card">
        <div class="text-content">
            <h1>Apoya Sustainity</h1>
            <p>Ayudanos a hacer un mundo mejor, un juego a la vez</p>
            
            <form action="{{ route('rutaCheckout') }}" method="POST" class="donation-form">
                @csrf
                <label for="amount">Cantidad a Donar ($):</label>
                <input type="number" id="amount" name="amount" placeholder="Cantidad" min="1.00" max="9999.99" step="0.01" required>
                <small>{{ $errors->first('amount') }}</small>
                
                <button type="submit" class="play-btn">Haz tu donación</button>
            </form>
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