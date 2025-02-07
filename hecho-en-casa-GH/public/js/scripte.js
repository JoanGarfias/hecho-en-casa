document.addEventListener("DOMContentLoaded", function () {
    function moveCarousel(carouselId, direction) {
        const carousel = document.getElementById(carouselId);
        const track = carousel.querySelector(".carousel-track");
        const items = Array.from(track.children);
        const itemWidth = items[0].offsetWidth + 10; // Ancho + gap
        const visibleItems = 3; // Cantidad de imágenes visibles a la vez
        let currentIndex = parseInt(track.getAttribute("data-index")) || 0;

        // Duplicamos los elementos al inicio y al final para hacer un efecto infinito
        if (items.length === 3) {
            track.innerHTML += track.innerHTML; // Duplica los elementos
        }

        const totalItems = track.children.length;

        // Actualizar el índice
        currentIndex += direction * visibleItems;

        // Lógica de ciclo infinito
        if (currentIndex < 0) {
            currentIndex = totalItems - visibleItems;
        } else if (currentIndex >= totalItems) {
            currentIndex = 0;
        }

        // Aplicar la transformación para mover el carrusel
        track.style.transition = "transform 0.5s ease-in-out";
        track.style.transform = `translateX(${-currentIndex * itemWidth}px)`;

        // Guardar el índice actual en el atributo data-index
        track.setAttribute("data-index", currentIndex);
    }

    // Asegurar que los botones funcionen correctamente
    document.querySelectorAll(".carousel-button").forEach((button) => {
        button.addEventListener("click", function () {
            const direction = this.classList.contains("left") ? -1 : 1;
            const carouselId = this.closest(".carousel").id;
            moveCarousel(carouselId, direction);
        });
    });
});
