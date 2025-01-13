<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/galleta.css') }}">
    <title>Catálogo</title>
</head>
<body>

    <x-menu/>


<div class="contenido-principal">
    <h1>Catálogo de Postres</h1>


    <!-- Dropdown para seleccionar categoría -->
    <select id="categorias" onchange="cambiarCategoria(this.value)">
        <option value="">Selecciona una categoría</option> 
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->id_cat }}" @if($categoria->id_cat == $categoriaSeleccionada) selected @endif>
                {{ $categoria->nombre }}
            </option>
        @endforeach
    </select>
    
    <!-- Contenedor para los productos  -->
    <div id="productos">
        @foreach($catalogo as $producto)
            <div class="main-container" id="producto-{{ $producto->id_postre }}">
                <h2>{{ $producto->nombre }}</h2>
                <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre }}">
                <div class="outer-circle">
                    <div class="price-circle">
                        <span>12 pza:</span>
                        <span>$180</span>
                    </div>
                </div>
                <div class="description-container">
                    <span>{{ $producto->descripcion }}</span>
                    <img src="{{ asset('img/bolsa.png') }}" alt="Bolsa de compras">
                </div>
            </div>
        @endforeach
    </div>
</div>
    <script>
        // Función para cambiar la URL y recargar la página
        function cambiarCategoria(categoriaId) {
            if (categoriaId) {
                // Cambiar la URL y recargar la página con la categoría seleccionada
                window.location.href = `/fijo/catalogo/${categoriaId}`;
            } else {
                // Si no se selecciona ninguna categoría, recarga la página principal
                window.location.href = `/fijo/catalogo`;
            }
        }
    </script>
</body>
<x-pie/>
</html>
