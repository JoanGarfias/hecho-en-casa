<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error de Conexión</title>
</head>
<body>
    <h1>Error en la Conexión a la Base de Datos</h1>
    <p>Por favor, intente más tarde o contacte al administrador del sistema.</p>
    <p>{{$message}}</p>
    <a href="{{route('inicio.get')}}">Volver al inicio</a>
</body>
</html>
