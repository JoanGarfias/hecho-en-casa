document.addEventListener('DOMContentLoaded', function () {
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const menuIzquierdo = document.querySelector('.menu-izquierdo');
    const menuDerecho = document.querySelector('.menu-derecho');

    // Verifica que los elementos existan en el DOM antes de añadir eventos
    if (hamburgerMenu && menuIzquierdo) {
        // Mostrar/ocultar menú izquierdo al hacer clic en el ícono
        hamburgerMenu.addEventListener('click', function (e) {
            e.preventDefault(); // Evita recargar la página al hacer clic
            menuIzquierdo.style.display =
                menuIzquierdo.style.display === 'block' ? 'none' : 'block';
        });
    }

    // Cerrar los menús desplegables al hacer clic fuera de ellos
    document.addEventListener('click', function (event) {
        // Verifica que los elementos existan antes de evaluar condiciones
        if (
            hamburgerMenu &&
            menuIzquierdo &&
            !hamburgerMenu.contains(event.target) &&
            !menuIzquierdo.contains(event.target)
        ) {
            menuIzquierdo.style.display = 'none';
        }

        // Si quieres manejar el menú derecho en el futuro:
        if (menuDerecho && !menuDerecho.contains(event.target)) {
            menuDerecho.style.display = 'none';
        }
    });
});
