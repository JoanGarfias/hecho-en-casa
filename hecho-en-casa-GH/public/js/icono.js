document.addEventListener("DOMContentLoaded", () => {
    const usuarioIcon = document.getElementById("usuario-icon");
    const menuUsuario = document.getElementById("menu-usuario");

    // Mostrar/Ocultar el menú al hacer clic en el ícono de usuario
    usuarioIcon.addEventListener("click", (e) => {
        e.preventDefault(); // Evita recargar la página al hacer clic
        menuUsuario.style.display =
            menuUsuario.style.display === "block" ? "none" : "block";
    });

    // Ocultar el menú al hacer clic fuera
    document.addEventListener("click", (e) => {
        if (!usuarioIcon.contains(e.target) && !menuUsuario.contains(e.target)) {
            menuUsuario.style.display = "none";
        }
    });
});
