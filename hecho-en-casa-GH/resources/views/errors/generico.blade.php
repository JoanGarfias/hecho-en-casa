<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error del Sistema</title>
    <link rel="stylesheet" href="{{ asset('css/errorCalendario.css') }}">
    <style>
        body{
            background: #fff8e3;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h1>❌ Error del Sistema</h1>
        <P>{{$message}}</P>
        <br>
        
        <br>

        <p>Ocurrió un error inesperado. Estamos trabajando para solucionarlo.</p>
        <br>
        <p>Disculpe los inconvenientes.</p>
        <br>
        <a href="{{route('inicio.get')}}">Volver al inicio</a>
        
        <br>

    </div>
    <img src="{{ asset('img/errorsistema.png') }}" alt="Sistema">
</body>
</html>
