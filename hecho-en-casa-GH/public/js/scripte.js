document.addEventListener("DOMContentLoaded", function () {
    const tracks = document.querySelectorAll(".carousel-track");

    tracks.forEach(track => {
        const items = Array.from(track.children);
        const totalItems = items.length;
        const itemWidth = items[0].offsetWidth + 10; // Incluye margen
        let index = 1; // Inicia en 1 para el efecto infinito
        let isTransitioning = false; // Evita múltiples clics rápidos

        // Clonar primer y último elemento
        const firstClone = items[0].cloneNode(true);
        const lastClone = items[totalItems - 1].cloneNode(true);

        track.appendChild(firstClone); // Agrega el primer clon al final
        track.insertBefore(lastClone, track.firstChild); // Agrega el último clon al inicio

        const newItems = track.children; // Ahora incluye los clones
        const newTotalItems = newItems.length;

        // Ajustar desplazamiento inicial para no ver el clon al inicio
        track.style.transform = `translateX(${-index * itemWidth}px)`;

        const carousel = track.closest(".carousel");
        const prevButton = carousel.querySelector(".carousel-button.left");
        const nextButton = carousel.querySelector(".carousel-button.right");

        function updateCarousel() {
            if (isTransitioning) return; // Evita doble clic rápido
            isTransitioning = true;

            track.style.transition = "transform 0.5s ease-in-out";
            track.style.transform = `translateX(${-index * itemWidth}px)`;

            track.addEventListener("transitionend", function reset() {
                isTransitioning = false;

                // Salto invisible si llega a los clones
                if (index >= newTotalItems - 1) {
                    index = 1;
                    track.style.transition = "none";
                    track.style.transform = `translateX(${-index * itemWidth}px)`;
                } else if (index <= 0) {
                    index = newTotalItems - 2;
                    track.style.transition = "none";
                    track.style.transform = `translateX(${-index * itemWidth}px)`;
                }
                track.removeEventListener("transitionend", reset);
            }, { once: true });
        }

        nextButton.addEventListener("click", function () {
            if (!isTransitioning) {
                index++;
                updateCarousel();
            }
        });

        prevButton.addEventListener("click", function () {
            if (!isTransitioning) {
                index--;
                updateCarousel();
            }
        });
    });
});
