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

        /* Modal para comentarios */
        #commentsModal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            z-index: 1000;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            max-width: 600px;
            width: 90%;
            display: none;
        }
        #commentsModal h2 {
            margin-top: 0;
        }
        #modalOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            display: none;
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
</header>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="news-container">
    @foreach($news as $newsItem)
        <!-- Se agrega data-post-id para identificar el post -->
        <div class="main-card appear-on-load" data-post-id="{{ $newsItem['id'] }}">
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

<!-- Modal y overlay para comentarios -->
<div id="modalOverlay"></div>
<div id="commentsModal">
    <h2>Comentarios</h2>
    <div id="modalCommentsList"></div>
    <textarea id="modalNewComment" placeholder="Escribe tu comentario" style="width:100%; height: 80px;"></textarea>
    <button id="modalPostCommentBtn">Publicar comentario</button>
    <button id="modalCloseBtn">Cerrar</button>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {

    // Define la URL base de la API
    const baseUrl = 'https://api-yovy.onrender.com';

    // Manejo de Like
    document.querySelectorAll('.like-btn').forEach(button => {
        button.addEventListener('click', function() {
            const card = this.closest('.main-card');
            const postId = card.dataset.postId;
            fetch(`${baseUrl}/news/news/posts/${postId}/like`, {
                method: "POST"
            })
            .then(response => {
                // Intenta parsear JSON y lanza error si no es JSON
                return response.headers.get('content-type').includes('application/json') ?
                    response.json() :
                    Promise.reject("No se recibió JSON");
            })
            .then(data => {
                this.querySelector('.like-count').textContent = data.likes;
            })
            .catch(err => console.error("Error en Like:", err));
        });
    });

    // Manejo de Dislike
    document.querySelectorAll('.dislike-btn').forEach(button => {
        button.addEventListener('click', function() {
            const card = this.closest('.main-card');
            const postId = card.dataset.postId;
            fetch(`${baseUrl}/news/news/posts/${postId}/dislike`, {
                method: "POST"
            })
            .then(response => {
                return response.headers.get('content-type').includes('application/json') ?
                    response.json() :
                    Promise.reject("No se recibió JSON");
            })
            .then(data => {
                this.querySelector('.dislike-count').textContent = data.dislikes;
            })
            .catch(err => console.error("Error en Dislike:", err));
        });
    });

    // Manejo para abrir el modal de comentarios
    document.querySelectorAll('.toggle-comments-btn').forEach(button => {
        button.addEventListener('click', function() {
            const card = this.closest('.main-card');
            const postId = card.dataset.postId;
            openCommentsModal(postId);
        });
    });
    
    // Función para abrir el modal de comentarios
    function openCommentsModal(postId) {
        const modal = document.getElementById("commentsModal");
        const overlay = document.getElementById("modalOverlay");
        modal.style.display = "block";
        overlay.style.display = "block";
        modal.dataset.postId = postId;
        loadComments(postId);
    }
    
    // Función para cargar comentários
    function loadComments(postId) {
        fetch(`${baseUrl}/news/news/posts/${postId}/comments`)
            .then(response => {
                return response.headers.get('content-type').includes('application/json') ?
                    response.json() :
                    Promise.reject("No se recibió JSON");
            })
            .then(data => {
                const commentsList = document.getElementById("modalCommentsList");
                commentsList.innerHTML = "";
                data.forEach(comment => {
                    const commentDiv = document.createElement("div");
                    commentDiv.textContent = comment.description + " - by user " + comment.user_id;
                    commentsList.appendChild(commentDiv);
                });
            })
            .catch(err => console.error("Error al cargar comentarios:", err));
    }
    
    document.getElementById("modalPostCommentBtn").addEventListener("click", function() {
        const modal = document.getElementById("commentsModal");
        const postId = modal.dataset.postId;
        const commentText = document.getElementById("modalNewComment").value;
        fetch(`${baseUrl}/news/news/posts/${postId}/comments`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ description: commentText })
        })
        .then(response => {
            return response.headers.get('content-type').includes('application/json') ?
                response.json() :
                Promise.reject("No se recibió JSON");
        })
        .then(data => {
            loadComments(postId);
            document.getElementById("modalNewComment").value = "";
        })
        .catch(err => console.error("Error al publicar comentario:", err));
    });
    
    document.getElementById("modalCloseBtn").addEventListener("click", function() {
        document.getElementById("commentsModal").style.display = "none";
        document.getElementById("modalOverlay").style.display = "none";
    });
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
