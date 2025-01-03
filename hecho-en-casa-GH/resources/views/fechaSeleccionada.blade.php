<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fecha Seleccionada</title>
</head>
<body>
    <h1>Fecha Seleccionada: {{ $fecha }}</h1>
    <p><strong>Postre ID:</strong> {{ $postre }}</p>
    <p><strong>Porciones Pedidas en el Día:</strong> {{ $porciones_dia }}</p>
    <p><strong>Porciones Mínimas:</strong> {{ $cantidad_minima }}</p>

    @if (($porciones_dia + $cantidad_minima) < 100)
        <p><strong>¡La fecha ha sido seleccionada correctamente!</strong></p>
    @else
        <p><strong>¡No se puede seleccionar esta fecha debido al límite de porciones!</strong></p>
    @endif

    <a href="/fijo/seleccionar-fecha">Volver a seleccionar otra fecha</a>
</body>
</html>
