<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pedido</title>
</head>
<body>
    <h2>Pedido con folio: <span style="color: red;">{{$pedido->id_ped }}</span></h2>

    <div>
        <p><strong>Tipo de postre:</strong> {{ $pedido['tipo_postre'] ?? 'Selección' }}</p>
        <p><strong>Sabor:</strong> {{ $pedido['sabor'] ?? 'Selección' }}</p>
        <p><strong>Porciones:</strong> {{ $pedido['porciones'] ?? 'xx' }}</p>
        <p><strong>Cantidad:</strong> {{ $pedido['cantidad'] ?? '01' }}</p>
        <p><strong>Estatus:</strong> <span style="background-color: yellow; padding: 0.2em;">{{ $pedido['estatus'] ?? 'Pendiente' }}</span></p>
    </div>

    <div>
        <p><strong>Nombre:</strong> {{ $pedido['nombre'] ?? 'xxxxx' }}</p>
        <p><strong>Teléfono:</strong> {{ $pedido['telefono'] ?? 'xxxxx' }}</p>
        <p><strong>Fecha de entrega:</strong> {{ $pedido['fecha_entrega'] ?? 'xx/xx/xxxx' }}</p>
        <p><strong>Hora de entrega:</strong> {{ $pedido['hora_entrega'] ?? '00:00' }}</p>
        <p><strong>Tipo de entrega:</strong> {{ $pedido['tipo_entrega'] ?? 'Selección' }}</p>
        <p><strong>Costo aprox:</strong> {{ $pedido['costo_aprox'] ?? '$550.00' }}</p>
    </div>
</body>
</html>
