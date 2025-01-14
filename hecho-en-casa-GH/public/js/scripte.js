function moveCarousel(carouselId, direction) {
    const carousel = document.getElementById(carouselId);
    const track = carousel.querySelector('.carousel-track');
    const items = Array.from(track.children);
    const visibleItems = 3; // Número de elementos visibles al mismo tiempo
    const totalItems = items.length;
    const itemWidth = items[0].offsetWidth; // Ancho de un solo elemento

    // Obtener el índice actual basado en la posición de transform
    let currentTransform = parseFloat(track.style.transform.replace('translateX(', '').replace('px)', '')) || 0;
    let currentIndex = Math.round(Math.abs(currentTransform / itemWidth));

    // Calcular el nuevo índice
    let newIndex = currentIndex + direction * visibleItems;

    // Movimiento circular
    if (newIndex >= totalItems) {
        newIndex -= totalItems; // Ajustar índice para que sea circular
        track.style.transition = 'none'; // Quitar transición para evitar parpadeos
        currentTransform = 0; // Reiniciar posición al principio
        track.style.transform = `translateX(${currentTransform}px)`;
        setTimeout(() => {
            track.style.transition = 'transform 0.5s ease-in-out'; // Restaurar transición
            const newTransform = -newIndex * itemWidth;
            track.style.transform = `translateX(${newTransform}px)`;
        }, 50);
    } else if (newIndex < 0) {
        newIndex += totalItems; // Ajustar índice para que sea circular
        track.style.transition = 'none';
        currentTransform = -(totalItems - visibleItems) * itemWidth; // Posicionar al final
        track.style.transform = `translateX(${currentTransform}px)`;
        setTimeout(() => {
            track.style.transition = 'transform 0.5s ease-in-out';
            const newTransform = -newIndex * itemWidth;
            track.style.transform = `translateX(${newTransform}px)`;
        }, 50);
    } else {
        const newTransform = -newIndex * itemWidth;
        track.style.transform = `translateX(${newTransform}px)`;
    }
}
