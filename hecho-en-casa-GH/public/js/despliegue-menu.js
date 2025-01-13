document.addEventListener("DOMContentLoaded", () => {
    const menuIcon = document.getElementById("menu-icon");
    const dropdownMenu = document.getElementById("dropdown-menu");

    menuIcon.addEventListener("click", (e) => {
        e.preventDefault(); // Evita recargar la página al hacer clic
        dropdownMenu.style.display =
            dropdownMenu.style.display === "block" ? "none" : "block";
    });

    // Ocultar el menú al hacer clic fuera de él
    document.addEventListener("click", (e) => {
        if (!menuIcon.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.style.display = "none";
        }
    });
});
