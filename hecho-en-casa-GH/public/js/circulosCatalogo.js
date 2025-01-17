document.addEventListener("DOMContentLoaded", function() {
    const productos = document.querySelectorAll(".outer-circle");

    productos.forEach((producto) => {
        const precios = JSON.parse(producto.getAttribute('data-precios'));  // Obtener los precios del atributo 'data-precios'

        if (precios.length === 2) {
            // Si hay dos presentaciones, generar dos círculos
            precios.forEach((presentacion, index) => {
                const circle = document.createElement('div');
                circle.classList.add('price-circle');
                circle.classList.add(index === 0 ? 'left' : 'right');  // Posicionar el primer círculo a la izquierda, el segundo a la derecha
                
                const contenido = `
                    <span>${presentacion.cantidad} ${presentacion.nombre_unidad}:</span>
                    <span>${presentacion.precio_um}</span>
                `;
                
                circle.innerHTML = contenido;
                producto.appendChild(circle);  // Añadir el círculo al contenedor
            });
        }
        // Si solo hay una presentación, solo creas un círculo
        else if (precios.length === 1) {
            const circle = document.createElement('div');
            circle.classList.add('price-circle');
            circle.innerHTML = `
                <span>${precios[0].cantidad} ${precios[0].nombre_unidad}:</span>
                <span>${precios[0].precio_um}</span>
            `;
            producto.appendChild(circle);
        }
    });
});
