<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error de Ruta</title>
    <style>
        body{
            background: lightslategray;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h1>❌ Error 503</h1>
    <br>
        <br>
        <p><b>Ocurrió un error al procesar su solicitud.</b></p>
        <br>

        <p>Nuestros ingenieros de DxiCode están trabajando para que tengas una mejor experiencia</p>
        <p>Disculpe los inconvenientes.</p>
        <br>

        <a href="{{route('inicio.get')}}">Volver al inicio</a>
        <br>
    </div>
    <img src="{{ asset('img/pensando.png') }}" alt="Error 503">
</body>
</html>