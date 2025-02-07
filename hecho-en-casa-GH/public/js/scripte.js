document.addEventListener("DOMContentLoaded", function () {
    function moveCarousel(carouselId, direction) {
        const carousel = document.getElementById(carouselId);
        const track = carousel.querySelector(".carousel-track");
        const items = Array.from(track.children);
        
        // Mover 3 elementos a la vez
        let step = 3;
        
        if (direction === 1) {
            // Mueve los primeros 3 al final
            for (let i = 0; i < step; i++) {
                track.appendChild(items[i]);
            }
        } else {
            // Mueve los últimos 3 al inicio
            for (let i = 0; i < step; i++) {
                track.prepend(items[items.length - 1 - i]);
            }
        }

        // Reiniciar la animación para una transición más suave
        track.style.transition = "none";
        track.style.transform = "translateX(0)";

        setTimeout(() => {
            track.style.transition = "transform 0.5s ease-in-out";
        }, 50);
    }

    document.querySelectorAll(".carousel-button").forEach((button) => {
        button.addEventListener("click", function () {
            const direction = this.classList.contains("right") ? 1 : -1;
            moveCarousel(this.closest(".carousel").id, direction);
        });
    });
});
