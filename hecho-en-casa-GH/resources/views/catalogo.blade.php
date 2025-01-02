<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
</head>
<body>
    <h1>Catálogo de Postres</h1>

    <!-- Dropdown para seleccionar categoría -->
    <select id="categorias" onchange="cambiarCategoria(this.value)">
        <option value="">Selecciona una categoría</option> 
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->id_cat }}" 
                @if($categoria->id_cat == $categoriaSeleccionada) selected @endif>
                {{ $categoria->nombre }}
            </option>
        @endforeach
    </select>
    <button class="buscarProducto">Escojer</button>

    <!-- Contenedor para mostrar los productos -->
    <div id="productos"></div>

    <script>
        // Pasar los productos y categorías a JavaScript
        let catalogo = @json($catalogo);
        let categorias = @json($categorias);
        let categoriaSeleccionada = @json($categoriaSeleccionada); // Asegúrate de pasar esto desde el backend

        let buscarProductoBtn = document.querySelector(".buscarProducto");
        
        console.log("Catalogo", catalogo);
        console.log("Categorias", categorias);
        console.log("Categoría seleccionada por defecto", categoriaSeleccionada);

        // Función para mostrar los productos en el contenedor
        function mostrarProductos(categoriaId) {
            // Filtramos los productos según la categoría seleccionada
            let productosFiltrados = catalogo.filter(producto => producto.id_categoria == categoriaId);
            
            let productosContainer = document.getElementById("productos");
            productosContainer.innerHTML = ""; // Limpiar productos actuales
    
            // Mostrar los productos filtrados
            productosFiltrados.forEach(producto => {
                let productoElement = document.createElement("div");
                productoElement.classList.add("producto");
                productoElement.innerHTML = `
                    <h3>${producto.nombre}</h3>
                    <img src="${producto.imagen}" alt="${producto.nombre}">
                    <p>${producto.descripcion}</p>
                `;
                productosContainer.appendChild(productoElement);
            });
        }
    
        // Función para cambiar la URL
        function cambiarCategoria(categoriaId) {
            // Cambiar la URL sin recargar la página
            window.history.pushState({}, "", `/fijo/catalogo/${categoriaId}`);
            // Mostrar los productos de la categoría seleccionada
            mostrarProductos(categoriaId);
        }

        // Llamar a mostrarProductos con la categoría seleccionada por defecto cuando se carga la página
        if (categoriaSeleccionada) {
            mostrarProductos(categoriaSeleccionada);
        }
    </script>
    
</body>
</html>
