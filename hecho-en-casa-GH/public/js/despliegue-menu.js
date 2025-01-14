document.addEventListener("DOMContentLoaded", function () {
    const usuarioIcon = document.getElementById("usuario-icon");
    const menuUsuario = document.getElementById("menu-usuario");

    usuarioIcon.addEventListener("click", function (e) {
        e.preventDefault();
        menuUsuario.classList.toggle("show");
    });

    // Opcional: Cerrar el menú si se hace clic fuera de él
    document.addEventListener("click", function (e) {
        if (!menuUsuario.contains(e.target) && !usuarioIcon.contains(e.target)) {
            menuUsuario.classList.remove("show");
        }
    });
});
