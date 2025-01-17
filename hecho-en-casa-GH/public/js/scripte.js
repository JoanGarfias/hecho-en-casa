function moveCarousel(carouselId, direction) {
    const carousel = document.getElementById(carouselId);
    const track = carousel.querySelector('.carousel-track');
    const items = track.children;
    const itemWidth = items[0].offsetWidth;
    const visibleItems = Math.floor(carousel.offsetWidth / itemWidth); // Calcula cuántos caben
    const totalItems = items.length;

    // Calcular la posición actual
    let currentIndex = Math.round(
        Math.abs(parseFloat(track.style.transform.replace('translateX(', '').replace('px)', '')) || 0) / itemWidth
    );

    // Determinar nueva posición
    let newIndex = currentIndex + direction * visibleItems;

    // Movimiento circular
    if (newIndex >= totalItems) {
        newIndex = 0;
    } else if (newIndex < 0) {
        newIndex = totalItems - visibleItems;
    }

    // Aplicar transformación
    const newTransform = -newIndex * itemWidth;
    track.style.transform = `translateX(${newTransform}px)`;
    track.style.transition = 'transform 0.5s ease-in-out';
}
