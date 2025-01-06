<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cambio contraseña</title>
</head>
<body>
    <form action="{{route('guardar-contrasena.post')}}" method="POST">
        <h1>Ingrese su nueva contraseña</h1>
        <input type="text" name="nueva_contraseña" required>
        
        <h1>Confirme su contraseña</h1>
        <input type="text" name="confirmar_contraseña" required>
        <button type="submit">Enviar</button>
    </form>
    
</body>
</html>