<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menuCatalogoFijo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/galleta.css') }}">
    <title>Catálogo de Postres</title>
</head>
<body>
    <h1>Catálogo de Postres</h1>

    <!-- Dropdown para seleccionar categoría -->
    <select id="categorias" onchange="mostrarProductos()">
        <option value="">Selecciona una categoría</option> 
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->id_cat }}" @if($categoria->id_cat == $categoriaSeleccionada) selected @endif>
                {{ $categoria->nombre }}
            </option>
        @endforeach
    </select>

    <!-- Contenedor para los productos -->
    <div id="productos">
        <!-- Aquí se generarán dinámicamente los productos -->
    </div>

    <script>
        // Datos del catálogo proporcionados desde Laravel
        const catalogo = @json($catalogo);

        console.log("Catálogo: ", catalogo);

        // Función para renderizar los productos dinámicamente
        function mostrarProductos() {
            const categoriaId = document.getElementById("categorias").value; // Obtener categoría seleccionada
            const productosDiv = document.getElementById("productos");

            // Limpiar los productos actuales
            productosDiv.innerHTML = "";

            if (!categoriaId) {
                productosDiv.innerHTML = "<p>Por favor selecciona una categoría.</p>";
                return;
            }

            // Filtrar los productos según la categoría seleccionada
            const productosFiltrados = catalogo.filter(producto => producto.id_categoria == categoriaId);

            if (productosFiltrados.length === 0) {
                productosDiv.innerHTML = "<p>No hay productos en esta categoría.</p>";
                return;
            }

            // Generar los contenedores dinámicamente
            productosFiltrados.forEach(producto => {
                const productoHTML = `
                    <div class="main-container">
                        <h2>${producto.nombre}</h2>
                        <img src="${producto.imagen}" alt="${producto.nombre}">
                        <div class="outer-circle">
                            <div class="price-circle">
                                <span>12 pza:</span>
                                <span>$180</span>
                            </div>
                        </div>
                        <div class="description-container">
                            <span>${producto.descripcion}</span>
                            <img src="{{ asset('img/bolsa.png') }}" alt="Bolsa de compras">
                        </div>
                    </div>
                `;
                productosDiv.innerHTML += productoHTML;
            });
        }

        // Mostrar los productos iniciales al cargar la página
        window.onload = mostrarProductos;
    </script>

    <x-pie />

</body>

</html>
