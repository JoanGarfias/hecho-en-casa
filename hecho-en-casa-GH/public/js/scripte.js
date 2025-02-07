document.addEventListener("DOMContentLoaded", function () {
    const tracks = document.querySelectorAll(".carousel-track"); // Para múltiples carruseles
    const itemsPerView = 3;

    tracks.forEach(track => {
        const items = track.querySelectorAll(".carousel-item");
        const totalItems = items.length;
        let index = 0;

        // Clonar los primeros y últimos elementos para el efecto infinito
        for (let i = 0; i < itemsPerView; i++) {
            let cloneFirst = items[i].cloneNode(true);
            let cloneLast = items[totalItems - 1 - i].cloneNode(true);
            track.appendChild(cloneFirst); // Agrega clones al final
            track.insertBefore(cloneLast, track.firstChild); // Agrega clones al inicio
        }

        // Ajustar el desplazamiento inicial para evitar el salto
        const itemWidth = items[0].offsetWidth + 10; // Incluye el margen
        track.style.transform = `translateX(${-itemsPerView * itemWidth}px)`;

        const prevButton = track.closest(".carousel").querySelector(".carousel-button.left");
        const nextButton = track.closest(".carousel").querySelector(".carousel-button.right");

        function updateCarousel() {
            track.style.transition = "transform 0.5s ease-in-out";
            track.style.transform = `translateX(${-(index * itemWidth)}px)`;

            // Reinicio sin transición cuando llegamos a los clones
            track.addEventListener("transitionend", function reset() {
                if (index >= totalItems) {
                    index = 0;
                    track.style.transition = "none";
                    track.style.transform = `translateX(${-itemsPerView * itemWidth}px)`;
                } else if (index < 0) {
                    index = totalItems - itemsPerView;
                    track.style.transition = "none";
                    track.style.transform = `translateX(${-index * itemWidth}px)`;
                }
                track.removeEventListener("transitionend", reset);
            });
        }

        nextButton.addEventListener("click", function () {
            index += itemsPerView;
            updateCarousel();
        });

        prevButton.addEventListener("click", function () {
            index -= itemsPerView;
            updateCarousel();
        });
    });
});
