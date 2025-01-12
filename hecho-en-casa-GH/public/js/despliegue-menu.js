document.addEventListener('DOMContentLoaded', function () {
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const menuIzquierdo = document.getElementById('menu-izquierdo');
    const menuDerecho = document.getElementById('menu-derecho');
    const usuarioIcon = document.getElementById('usuario-icon');
    const menuUsuario = document.getElementById('menu-usuario');

    // Mostrar/ocultar menús izquierdo y derecho al hacer clic en el ícono de hamburguesa
    hamburgerMenu.addEventListener('click', function () {
        menuIzquierdo.classList.toggle('show');
        menuDerecho.classList.toggle('show');
    });

    // Mostrar/ocultar menú usuario
    usuarioIcon.addEventListener('click', function (event) {
        event.preventDefault();
        menuUsuario.classList.toggle('show');
    });

    // Cerrar menús al hacer clic fuera de ellos
    document.addEventListener('click', function (event) {
        if (!hamburgerMenu.contains(event.target) && !menuIzquierdo.contains(event.target) && !menuDerecho.contains(event.target)) {
            menuIzquierdo.classList.remove('show');
            menuDerecho.classList.remove('show');
        }

        if (!usuarioIcon.contains(event.target) && !menuUsuario.contains(event.target)) {
            menuUsuario.classList.remove('show');
        }
    });
});
