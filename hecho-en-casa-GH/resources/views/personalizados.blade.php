<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
</head>
<body>
    <h1>PASTELES PERSONALIZADOS CHIDOS</h1>
    <img src="https://i.ibb.co/R0SHGDw/6b80a8c81044.jpg" width="100" height="100"></img>
    <form method="POST" action="{{ route('personalizado.catalogo.post') }}">
        @csrf
        <button type="submit">Personalizar pastel! (varita magica)</button>
    </form>
</body>
</html>
