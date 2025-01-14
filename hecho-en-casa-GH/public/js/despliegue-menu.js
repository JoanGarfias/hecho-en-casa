
document.addEventListener('DOMContentLoaded', function () {
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const menuIzquierdo = document.querySelector('.menu-izquierdo');
    const menuDerecho = document.querySelector('.menu-derecho');
    

    // Mostrar/ocultar menú desplegable al hacer clic en el ícono
    hamburgerMenu.addEventListener('click', function () {
        menuIzquierdo.classList.add('show');
        
    });

    // Cerrar el menú desplegable al hacer clic fuera de él
    document.addEventListener('click', function (event) {
        if (!hamburgerMenu.contains(event.target) && !menuIzquierdo.contains(event.target)) {
            menuIzquierdo.classList.remove('show');
        }
    });
});
