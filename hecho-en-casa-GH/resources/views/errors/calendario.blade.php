<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error en el calendario</title>
    <link rel="stylesheet" href="{{ asset('css/errorCalendario.css') }}">
</head>
<body>
    
    <div class="contenedor">
        <h1>❌ Error en el calendario</h1>
    <br>
        <br>
        <p><b>Hubo un error al seleccionar la fecha :(</b></p>
        <br>

        <p>Nuestros ingenieros de DxiCode están trabajando para que tengas una mejor experiencia</p>
        <p>Disculpe los inconvenientes.</p>
        <br>

        <a href="{{route('inicio.get')}}">Volver al inicio</a>
        <br>
    </div>
    <img src="{{ asset('img/errorCalendarioImg.png') }}" alt="Calendario">
</body>
</html>