const selencionMenu = document.getElementById("usuario-icon");
const seleccionadoDelMenu = document.getElementById("menu-usuario");

// Mostrar/Ocultar el menú desplegable
selencionMenu.addEventListener("click", (event) => {
    event.preventDefault(); // Evita que la página se desplace hacia arriba
    seleccionadoDelMenu.style.display =
        seleccionadoDelMenu.style.display === "none" ? "block" : "none";
});

// Cerrar el menú si haces clic fuera
document.addEventListener("click", (event) => {
    if (!selencionMenu.contains(event.target) && !seleccionadoDelMenu.contains(event.target)) {
        seleccionadoDelMenu.style.display = "none";
    }
});
