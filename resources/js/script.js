document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".card");

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                // Agrega un retraso en escalera basado en el índice de la tarjeta
                entry.target.style.transitionDelay = `${index * 0.2}s`;
                entry.target.classList.add("visible");
            } else {
                // Quita la clase para permitir que la animación se reproduzca al volver a entrar en la vista
                entry.target.classList.remove("visible");
            }
        });
    }, { threshold: 0.1 });

    cards.forEach(card => observer.observe(card));
});

document.addEventListener("DOMContentLoaded", function () {
    const donationForm = document.querySelector(".donation-form");
    const amountInput = document.getElementById("amount");

    amountInput.addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada
            donationForm.submit(); // Envía el formulario manualmente
        }
    });
});

// Asegúrate de que este bloque se ejecute cuando el DOM esté completamente cargado
document.addEventListener("DOMContentLoaded", function () {
    // Define la URL base de la API
    const baseUrl = "https://api-yovy.onrender.com";
    // Obtiene el user_id desde la sesión (este valor se renderiza desde Blade)
    const userId = "{{ session('user_id') ?? 'null' }}";
    if (userId === "null") {
        console.warn("El usuario no está logueado; user_id es null.");
    }

    // Función para manejar Like
    function handleLike(button) {
        const postId = button.getAttribute('data-post-id');
        if (!postId) return;
        const isLiked = button.classList.contains('active');
        // Se envía el valor en formato x-www-form-urlencoded
        const bodyData = `user_id=${userId}`;
        
        console.log("Payload que se enviará:", { user_id: userId });
        
        fetch(`${baseUrl}/news/news/posts/${postId}/like`, {
            method: isLiked ? "DELETE" : "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: bodyData
        })
        .then(response => response.json())
        .then(data => {
            const countElem = button.querySelector('.like-count');
            if (data.message === "Like registrado") {
                countElem.textContent = parseInt(countElem.textContent) + 1;
                button.classList.add('active');
            } else if (data.message === "Like removido") {
                countElem.textContent = parseInt(countElem.textContent) - 1;
                button.classList.remove('active');
            }
            console.log("Respuesta del servidor:", data);
        })
        .catch(err => console.error("Error en Like:", err));
    }
    
    // Función para manejar Dislike
    function handleDislike(button) {
        const postId = button.getAttribute('data-post-id');
        if (!postId) return;
        const isDisliked = button.classList.contains('active');
        console.log({
            action: isDisliked ? "Eliminar Dislike" : "Registrar Dislike",
            endpoint: `${baseUrl}/news/news/posts/${postId}/dislike`,
            method: isDisliked ? "DELETE" : "POST",
            payload: { user_id: userId }
        });
        
        const bodyData = `user_id=${userId}`;
        fetch(`${baseUrl}/news/news/posts/${postId}/dislike`, {
            method: isDisliked ? "DELETE" : "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: bodyData
        })
        .then(response => response.json())
        .then(data => {
            const countElem = button.querySelector('.dislike-count');
            if (data.message === "Dislike registrado") {
                countElem.textContent = parseInt(countElem.textContent) + 1;
                button.classList.add('active');
                // Desactiva el like si está activo
                const likeButton = document.querySelector(`.like-btn[data-post-id="${postId}"]`);
                if (likeButton && likeButton.classList.contains('active')) {
                    likeButton.classList.remove('active');
                    const likeCount = likeButton.querySelector('.like-count');
                    likeCount.textContent = parseInt(likeCount.textContent) - 1;
                }
            } else if (data.message === "Dislike eliminado") {
                countElem.textContent = parseInt(countElem.textContent) - 1;
                button.classList.remove('active');
            }
            console.log("Respuesta del dislike:", data);
        })
        .catch(err => console.error("Error en Dislike:", err));
    }
    
    // Asigna los eventos a los botones de like
    const likeButtons = document.querySelectorAll('.like-btn');
    likeButtons.forEach(button => {
        button.addEventListener('click', () => {
            if (userId === "null") {
                alert("Debes estar logueado para dar like.");
                return;
            }
            handleLike(button);
        });
    });
    
    // Asigna los eventos a los botones de dislike
    const dislikeButtons = document.querySelectorAll('.dislike-btn');
    dislikeButtons.forEach(button => {
        button.addEventListener('click', () => {
            if (userId === "null") {
                alert("Debes estar logueado para dar dislike.");
                return;
            }
            handleDislike(button);
        });
    });
});