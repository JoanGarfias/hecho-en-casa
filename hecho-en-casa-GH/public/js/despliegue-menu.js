document.addEventListener('DOMContentLoaded', function () {
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const menuIzquierdo = document.querySelector('.menu-izquierdo');
    const menuDerecho = document.querySelector('.menu-derecho');

    
    console.log('En despliegue ')
    // Mostrar/ocultar menús desplegables al hacer clic en el ícono
    hamburgerMenu.addEventListener('click', function (e) {
        e.preventDefault(); // Evita recargar la página al hacer clic
        menuIzquierdo.classList.add('show');
       // menuDerecho.classList.add('show');
       console.log('En despliegue: se seleciono señor ')
    });

    // Cerrar los menús desplegables al hacer clic fuera de ellos
    document.addEventListener('click', function (event) {
        if (!hamburgerMenu.contains(event.target) && 
            !menuIzquierdo.contains(event.target) && 
            !menuDerecho.contains(event.target)) {
            menuIzquierdo.classList.remove('show');
            menuDerecho.classList.remove('show');
        }
    });
});
