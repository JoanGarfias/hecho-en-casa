<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error de Ruta</title>
</head>
<body>
    <h1>Error {{ $message ?? '' }}</h1>
    <p>Ocurrió un error al procesar su solicitud.</p>
    <a href="{{route('inicio.get')}}">Volver al inicio</a>
</body>
</html>