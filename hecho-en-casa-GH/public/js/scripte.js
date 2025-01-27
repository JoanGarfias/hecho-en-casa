function moveCarousel(carouselId, direction) {
    const carousel = document.getElementById(carouselId);
    const track = carousel.querySelector('.carousel-track');
    const itemWidth = track.querySelector('.carousel-item').offsetWidth;

    // Obtén el desplazamiento actual
    const currentTransform = getComputedStyle(track).transform;
    const matrix = new DOMMatrix(currentTransform);
    const currentX = matrix.m41;

    // Calcula el nuevo desplazamiento
    const newX = currentX + direction * itemWidth;

    // Aplica el nuevo transform
    track.style.transform = `translateX(${newX}px)`;
}
