<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correo</title>
</head>
<body>
    <p>Gracias por usar nuestra aplicación.</p>
    <p>Entra al siguiente enlace:</p>
    <a href="#" onclick="document.getElementById('recuperar-form').submit()">/recuperacion/{{$token}}</a>

    <form id="recuperar-form" action="{{ route('recuperacion.get', ['token' => $token]) }}" method="POST" style="display: none;">
        @csrf
    </form>
</body>
</html>
