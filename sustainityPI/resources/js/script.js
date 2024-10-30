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
