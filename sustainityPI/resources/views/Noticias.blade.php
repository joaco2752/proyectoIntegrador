<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diseño con Transiciones</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    @vite('resources/css/login.css')
    @vite('resources/js/script.js')

    <!-- Cargar Font Awesome para los iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <style>
        .news-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
            padding: 20px;
        }
        .main-card {
            width: 100%;
            max-width: 800px; /* Tamaño máximo del recuadro */
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #fff;
            text-align: left;
        }
        .text-content {
            margin-bottom: 10px;
        }
        .news-title {
            margin: 0 0 15px;
            font-size: 1.8rem;
            font-weight: bold;
        }
        .news-description {
            margin: 0 0 15px;
            font-size: 1.1rem;
        }
        .news-actions {
            display: flex; /* Alineación horizontal */
            gap: 10px;
            margin-top: 10px;
            justify-content: flex-start;
        }
        .like-btn, .dislike-btn, .toggle-comments-btn {
            cursor: pointer;
            font-size: 1.1rem;
            padding: 10px 15px;
            border: 2px solid transparent;
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        /* Estilo para los iconos y texto dentro de los botones */
        .like-btn i, .dislike-btn i, .toggle-comments-btn i {
            margin-right: 5px; /* Espacio entre el icono y el texto */
        }

        /* Estilo para el botón "Like" */
        .like-btn {
            background-color: #007bff;   /* Color de fondo azul */
            color: white;                /* Texto blanco */
            border-color: #007bff;       /* Borde azul */
        }

        /* Estilo para el botón "Like" al pasar el mouse */
        .like-btn:hover {
            background-color: #0056b3;   /* Cambio de color al pasar el mouse */
            border-color: #0056b3;
        }

        /* Estilo para el botón "Dislike" */
        .dislike-btn {
            background-color: #dc3545;   /* Color de fondo rojo */
            color: white;                /* Texto blanco */
            border-color: #dc3545;       /* Borde rojo */
        }

        /* Estilo para el botón "Dislike" al pasar el mouse */
        .dislike-btn:hover {
            background-color: #c82333;   /* Cambio de color al pasar el mouse */
            border-color: #c82333;
        }

        /* Estilo para el botón "Ver comentarios" */
        .toggle-comments-btn {
            background-color: #28a745;   /* Color de fondo verde */
            color: white;                /* Texto blanco */
            border-color: #28a745;       /* Borde verde */
        }

        /* Estilo para el botón "Ver comentarios" al pasar el mouse */
        .toggle-comments-btn:hover {
            background-color: #218838;   /* Cambio de color al pasar el mouse */
            border-color: #218838;
        }

        /* Estilo para los botones cuando están desactivados */
        .like-btn:disabled, .dislike-btn:disabled, .toggle-comments-btn:disabled {
            background-color: #d6d6d6;  /* Color gris para botones desactivados */
            border-color: #d6d6d6;
            color: #7a7a7a;             /* Texto gris */
            cursor: not-allowed;        /* Cursor deshabilitado */
        }

        /* Ajuste de la imagen para que siempre se muestre adecuadamente */
        .news-image {
            width: 100%;
            height: 300px; /* Fija la altura para evitar que se salga del contenedor */
            object-fit: cover; /* Recorta la imagen conservando la relación sin deformación */
            border-radius: 5px;
            margin-bottom: 15px;
        }

        /* Estilo para los comentarios */
        .comments {
            margin-top: 10px;
        }

        .new-comment {
            width: 100%;
            margin-top: 5px;
        }
    </style>
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
        @if (!session('logged_in'))
            <button class="login-btn" onclick="window.location.href='{{ route('rutaLogin') }}'">Iniciar Sesión</button>
        @endif
        <button class="news-btn" onclick="window.location.href='{{ route('rutaNoticias') }}'">Noticias</button>
    </div>
</header>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="news-container">
    @foreach($news as $newsItem)
        <div class="main-card appear-on-load">
            <div class="text-content">
                <h1 class="news-title">{{ $newsItem['title'] }}</h1>
                <p class="news-description">{{ $newsItem['description'] }}</p>
            </div>
            @if(isset($newsItem['image']) && $newsItem['image'])
                <img class="news-image" src="data:image/jpeg;base64,{{ $newsItem['image'] }}" alt="Imagen de la noticia">
            @endif
            <div class="news-actions">
                <button class="like-btn">
                    <i class="fas fa-thumbs-up"></i> <span class="like-count">{{ $newsItem['likes'] }}</span>
                </button>
                <button class="dislike-btn">
                    <i class="fas fa-thumbs-down"></i> <span class="dislike-count">{{ $newsItem['dislikes'] }}</span>
                </button>
                <button class="toggle-comments-btn">
                    <i class="fas fa-comment-dots"></i> Ver comentarios
                </button>
            </div>
            <div class="comments" style="display: none;">
                <div class="comments-list">
                    <!-- Los comentarios se cargarán aquí -->
                </div>
                <textarea class="new-comment" placeholder="Escribe un comentario"></textarea>
                <button class="post-comment-btn">Publicar comentario</button>
            </div>
        </div>
    @endforeach
</div>

<footer class="footer">
    <div class="footer-content">
        <a href="#">Política de Privacidad</a> | 
        <a href="#">Términos y Condiciones</a> | 
        <a href="#">Contacto</a>
    </div>
    <p>&copy; 2024 Sustainity. Todos los derechos reservados.</p>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
