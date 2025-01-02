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
            <option value="{{ $categoria->id_cat }}" @if($categoria->id_cat == $categoriaSeleccionada) selected @endif>{{ $categoria->nombre }}</option>
        @endforeach
    </select>

    <div id="productos">
        @foreach($catalogo as $producto)
            <div class="producto">
                <h3>{{ $producto->nombre }}</h3>
                <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}">
                <p>{{ $producto->descripcion }}</p>
            </div>
        @endforeach
    </div>

    </div>
    <script>
        // Función para cambiar la URL y recargar la página
        function cambiarCategoria(categoriaId) {
            // Cambiar la URL y recargar la página
            window.location.href = `/fijo/catalogo/${categoriaId}`;
        }
    </script>
</body>
</html>
