document.getElementById("folio").addEventListener("input", function() {
    if (this.value < 0) {
        this.value = ""; // Borra el valor si es negativo
        alert("No se permiten folios negativos.");
    }
});

