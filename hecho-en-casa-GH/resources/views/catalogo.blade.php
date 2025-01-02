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
    <select id="categoriaSelect" onchange="mostrarCatalogo(this.value)">
        <option value="">Selecciona una categoría</option> 
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->id_cat }}">{{ $categoria->nombre }}</option>
        @endforeach
    </select>

    <!-- Contenedor para mostrar los productos -->
    <div id="productos"></div>

    <script>
        // Pasar los productos a JavaScript
        let catalogo = @json($catalogo);
        let categorias = @json($categorias);
        console.log("Catalogo:");
        console.log(catalogo);

        console.log("Categorias:");
        console.log(categorias);

        // Función para mostrar los productos según la categoría seleccionada
        function mostrarCatalogo(categoria) {
            var productosFiltrados = catalogo.filter(function(producto) {
                return producto.id_categoria == categoria || categoria === "";
            });

            var productosContainer = document.getElementById('productos');
            productosContainer.innerHTML = ''; // Limpiar el contenedor antes de agregar los productos

            if (productosFiltrados.length > 0) {
                productosFiltrados.forEach(function(producto) {
                    var productoDiv = document.createElement('div');
                    productoDiv.value = producto.id_postre;
                    productoDiv.innerHTML = `
                        <h3>${producto.nombre}</h3>
                        <img src="${producto.imagen}" alt="${producto.nombre}" />
                        <p>${producto.descripcion}</p>
                    `;
                    productosContainer.appendChild(productoDiv);
                });
            } else {
                productosContainer.innerHTML = '<p>No se encontraron productos para esta categoría.</p>';
            }
        }

        // Mostrar los productos de la categoría por defecto al cargar la página
        mostrarCatalogo('');
    </script>
</body>
</html>
