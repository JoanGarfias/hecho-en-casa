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
        <p><strong>Tipo de postre:</strong> {{ $pedido->id_tipopostre}}</p>
        <p><strong>Porciones:</strong> {{ $pedido->porcionespedidas }}</p>
        <p><strong>Estatus:</strong> <span style="background-color: yellow; padding: 0.2em;">{{ $pedido->status}}</span></p>
    </div>

    <div>
        <p><strong>Nombre:</strong> {{ $usuario->nombre." ". $usuario->apellido_paterno." ".$usuario->apellido_materno}}</p>
        <p><strong>Teléfono:</strong> {{ $usuario->telefono}}</p>
        <p><strong>Fecha de entrega:</strong> {{ $fecha}}</p>
        <p><strong>Hora de entrega:</strong> {{ $hora }}</p>
        <p><strong>Tipo de entrega:</strong> {{session('tipo_entrega')}}</p>
        <p><strong>Costo aprox:</strong> {{ $pedido->precio_final}}</p>
    </div>
</body>
</html>
