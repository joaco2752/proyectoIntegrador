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
            <a href="/info">Nosotros</a>

 
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
            
            <form action="{{ route('rutaDonar')}}" method="POST" class="donation-form">
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
                    <option value="credit_card">Tarjeta de Crédito</option>
                    <option value="paypal">PayPal</option>
                    <option value="crypto">Criptomoneda</option>
                </select>
                <small>{{ $errors->first('payment_method')}}</small>
                
                <!-- Credit Card Fields -->
                <div id="credit_card_fields" class="payment-fields">
                    <div class="payment-group">
                        <label for="card_number">Número de Tarjeta</label>
                        <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456">
                        <small>{{ $errors->first('card_number')}}</small>
                    </div>
                    
                    <div class="card-row">
                        <div class="payment-group">
                            <label for="expiry_date">Fecha de Expiración</label>
                            <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/AA">
                            <small>{{ $errors->first('expiry_date')}}</small>
                        </div>
                        
                        <div class="payment-group">
                            <label for="cvv">CVV</label>
                            <input type="text" id="cvv" name="cvv" placeholder="123">
                            <small>{{ $errors->first('cvv')}}</small>
                        </div>
                    </div>
                    
                    <div class="payment-group">
                        <label for="card_holder">Nombre en la Tarjeta</label>
                        <input type="text" id="card_holder" name="card_holder" placeholder="Nombre como aparece en la tarjeta">
                        <small>{{ $errors->first('card_holder')}}</small>
                    </div>
                </div>
                
                <!-- PayPal Fields -->
                <div id="paypal_fields" class="payment-fields">
                    <div class="payment-group">
                        <label for="paypal_email">Correo de PayPal</label>
                        <input type="email" id="paypal_email" name="paypal_email" placeholder="tu@email.com">
                        <small>{{ $errors->first('paypal_email')}}</small>
                    </div>
                    <div class="payment-group">
                        <label for="paypal_name">Nombre de la cuenta</label>
                        <input type="text" id="paypal_name" name="paypal_name" placeholder="Nombre de tu cuenta PayPal">
                        <small>{{ $errors->first('paypal_name')}}</small>
                    </div>
                </div>
                
                <!-- Cryptocurrency Fields -->
                <div id="crypto_fields" class="payment-fields">
                    <div class="payment-group">
                        <label for="crypto_type">Tipo de Criptomoneda</label>
                        <select id="crypto_type" name="crypto_type">
                            <option value="bitcoin">Bitcoin</option>
                            <option value="ethereum">Ethereum</option>
                            <option value="litecoin">Litecoin</option>
                            <option value="dogecoin">Dogecoin</option>
                        </select>
                        <small>{{ $errors->first('crypto_type')}}</small>
                    </div>
                    
                    <div class="payment-group">
                        <label for="wallet_address">Dirección de Billetera</label>
                        <input type="text" id="wallet_address" name="wallet_address" placeholder="Dirección de tu billetera">
                        <small>{{ $errors->first('wallet_address')}}</small>
                    </div>
                </div>
                
                <button type="submit" class="play-btn" name="btnDonar">Haz tu donación</button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentMethodSelect = document.getElementById('payment_method');
            const creditCardFields = document.getElementById('credit_card_fields');
            const paypalFields = document.getElementById('paypal_fields');
            const cryptoFields = document.getElementById('crypto_fields');
            
            // Hide all payment fields initially
            function hideAllPaymentFields() {
                creditCardFields.classList.remove('active');
                paypalFields.classList.remove('active');
                cryptoFields.classList.remove('active');
            }
            
            // Show fields based on selected payment method
            paymentMethodSelect.addEventListener('change', function() {
                hideAllPaymentFields();
                
                const selectedMethod = this.value;
                
                if (selectedMethod === 'credit_card') {
                    creditCardFields.classList.add('active');
                } else if (selectedMethod === 'paypal') {
                    paypalFields.classList.add('active');
                } else if (selectedMethod === 'crypto') {
                    cryptoFields.classList.add('active');
                }
            });
            
            // If there are validation errors, show the appropriate fields
            if (document.querySelectorAll('#credit_card_fields small:not(:empty)').length > 0) {
                paymentMethodSelect.value = 'credit_card';
                creditCardFields.classList.add('active');
            } else if (document.querySelectorAll('#paypal_fields small:not(:empty)').length > 0) {
                paymentMethodSelect.value = 'paypal';
                paypalFields.classList.add('active');
            } else if (document.querySelectorAll('#crypto_fields small:not(:empty)').length > 0) {
                paymentMethodSelect.value = 'crypto';
                cryptoFields.classList.add('active');
            }
            
            // If payment method is already selected (e.g., after form submission with errors)
            const selectedMethod = paymentMethodSelect.value;
            if (selectedMethod === 'credit_card') {
                creditCardFields.classList.add('active');
            } else if (selectedMethod === 'paypal') {
                paypalFields.classList.add('active');
            } else if (selectedMethod === 'crypto') {
                cryptoFields.classList.add('active');
            }
        });
    </script>
</body>
</html>