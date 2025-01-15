<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correo</title>
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
</head>
<body>
    <img class="logo" src="{{ asset('img/loguito.png') }}" alt="Hecho en casa">
    <div class="contenedor">
        <img src="{{ asset('img/coraCorreo.png') }}" alt="Hecho en casa">
        <h1 class="texto">¡Gracias por registrarte!</h1>
        <div class="parrafo">
            <p>Gracias por usar nuestra aplicación.</p>
            <p>Entra al siguiente enlace:</p>
            <a href="#" onclick="document.getElementById('registrar').submit()">hechoencasa.com</a>
        </div>
        
    </div>
    <form id="registrar" action="{{ route('inicio.get'}}" method="POST" style="display: none;">
        @csrf
    </form>

</body>
</html>
