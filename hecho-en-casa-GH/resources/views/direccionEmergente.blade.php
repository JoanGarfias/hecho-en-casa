<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirma tus Datos</title>
</head>
<body>
    <h1>CONFIRMA TUS DATOS</h1>

    <form acction="{{route('emergente.detallesPedido.post')}}" method="POST">
        <!-- Teléfono -->
        @csrf
        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" placeholder="{{session('telefono')}}">
        
        <!-- Ubicación del pedido -->
        <h2>Ubicación del pedido:</h2>
        <div>
            <input type="radio" id="direccion1" name="ubicacion" value="Predeterminado">
            <label for="direccion1">{{session('direccion')}}</label>
        </div>
        <div>
            <input type="radio" id="otra" name="ubicacion" value="Nueva">
            <label for="otra">Otra...</label>
        </div>

        <!-- Dirección alternativa -->
        <div>
            <label for="codigo-postal">Código postal:</label>
            <input type="text" id="codigo-postal" name="codigo-postal">

            <label for="calle">Calle:</label>
            <input type="text" id="calle" name="calle">

            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero">

            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado">

            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad">

            <label for="colonia">Colonia:</label>
            <input type="text" id="colonia" name="colonia">
        </div>

        <!-- Establecer como predeterminado -->
        <div>
            <input type="checkbox" id="predeterminado" name="cambiar">
            <label for="predeterminado">Establecer como predeterminado</label>
        </div>

        <!-- Botón Confirmar -->
        <button type="submit">Confirmar</button>
    </form>
</body>
</html>
