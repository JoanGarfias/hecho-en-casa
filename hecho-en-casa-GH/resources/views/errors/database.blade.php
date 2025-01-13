<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error de Conexión</title>
    <link rel="stylesheet" href="{{ asset('css/errorCalendario.css') }}">
    <style>
        body{
            background: #92b4f2;
        }
    </style>
</head>
<body>
    <body>
    
        <div class="contenedor">
            <h1>❌ Error en la Conexión a la Base de Datos</h1>
        <br>
            <p>Disculpe los inconvenientes.</p>
            <br>
            <p>Por favor, intente más tarde o contacte al administrador del sistema.</p>
            <br>
    
            <a href="{{route('inicio.get')}}">Volver al inicio</a>
            <br>
        </div>
        <img src="{{ asset('img/errorbaseDatos.png') }}" alt="Base de datos">
    </body>
</body>
</html>
