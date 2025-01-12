<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Pedido</title>
</head>
<body>
    <center>
        <h1>Buscador de pedidos</h1>
        <form method="POST" action="{{ route('buscarpedido.post') }}">
            @csrf
            <label for="folio">Ingrese su folio:</label>
            <input type="number" name="folio" id="folio" required>
            <br><br>
            <button type="submit">Buscar</button>
        </form>
        <br>

        <!-- Muestra el mensaje de error -->
        @if (isset($error))
        <p style="color: red;">{{ $error }}</p>
        @endif

        <!-- Muestra la información del pedido si existe -->
        @if (isset($pedido))
            <h2>Detalles del pedido:</h2>
            <p>Folio: {{ $pedido->id_ped }}</p>
            <p>Tipo postre: {{ $tipopostre }}</p>
            <p>{{ $nombre_unidad }}: {{ (int)$pedido->porcionespedidas }}</p>
            <p>Estatus: {{ $pedido->status }}</p>
            <hr>
            <p>Nombre: {{ $nombre_completo }}</p>
            <p>Telefono: {{ $telefono }}</p>
            <p>Fecha de entrega: {{ $fecha_entrega }}</p>
            <p>Hora de entrega: {{ $hora_entrega }}</p>
            <p>Tipo de entrega: {{ $tipo_entrega }}</p>
            <p>Costo aprox: {{ $precio_final }}</p>
        @endif
    </center>
</body>
</html>
