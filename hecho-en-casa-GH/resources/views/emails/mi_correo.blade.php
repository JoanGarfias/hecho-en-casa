<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correo</title>
    <link rel="stylesheet" href="{{ asset('css/recuperando.css') }}">
</head>
<body>
    <img class="logo" src="{{ asset('img/loguito.png') }}" alt="Hecho en casa">
    <div class="contenedor">
        <h1 class="texto">Olvidaste tu contraseña  :(</h1>
        <div class="parrafo">
            <p>No te preocupes :D</p>
            <p>Ingresa al siguiente enlace para obtener una nueva: </p>
            <a href="#" onclick="document.getElementById('recuperar-form').submit()">hechoencasa.com/recuperacion/{{$token}}</a>
        </div>
        <img class="feli" src="{{ asset('img/olvideC.png') }}" alt="Hecho en casa">
    </div>

    <form id="recuperar-form" action="{{ route('recuperacion.get', ['token' => $token]) }}" method="POST" style="display: none;">
        @csrf
    </form>
</body>
</html>
