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
    <nav class="navbar" >
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
                <img src="img/DevPlay logo.png" alt="DevPlay Logo" class="logo-image">
            
            </a>
        </div>
        <div class="navbar-center">
        <a href="{{ route('rutaInicio') }}">Inicio</a>
        <a href="/donar">Donativos</a>
            <a href="{{ route('rutaNosotros')}}">Nosotros</a>

 
        </div>
        <div class="navbar-right">
        <button class="login-btn" onclick="window.location.href='{{ route('rutaLogin') }}'">Iniciar Sesión</button>
            <button class="news-btn">Noticias</button>
        </div>
    </nav>

    <div class="main-card">
        <div class="text-content">
            <h1>Apoya Sustainity</h1>
            <p>Ayudanos a hacer un mundo mejor, un juego a la vez</p>
            <form action="/enviarDonativo" method="POST" class="donation-form">
                @csrf
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" placeholder="Tu Nombre">
                <small>{{ $errors->first('name')}}</small>
                
                <label for="email">Correo</label>
                <input type="text" id="email" name="email" placeholder="Tu Correo">
                <small>{{ $errors->first('email')}}</small>
                
                <label for="amount">Cantidad a Donar ($):</label>
                <input type="text" id="amount" name="amount" placeholder="Cantidad">
                <small>{{ $errors->first('amount')}}</small>
                
                <label for="payment_method">Metodo de Pago</label>
                <select id="payment_method" name="payment_method">
                    <option value="">Selecciona tu metodo de pago</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="crypto">Cryptocurrency</option>
                </select>
                
                <button type="submit" class="play-btn" name="btnDonar">Haz tu donación</button>
            </form>
        </div>
        <img src="{{ asset('img/character.png') }}" alt="Game Character" class="character-image">
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