<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/HechoEnCasaFront/hecho-en-casa/hecho-en-casa-GH/resources/css/estilos.css"> <!-- Ruta absoluta -->
    <title>Document</title>
</head>
<body>
</body>
<header>
    <div class="menu">
        <nav>
            <ul class="menu-izquierdo">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Calendario</a></li>
                <li><a href="#">Catálogo</a></li>
            </ul>

            <!-- Logo directamente en el menú -->
            <img class="logo" src="{{ asset('img/logo.png') }}" alt="Logo"> <!-- Ruta absoluta -->

            <ul class="menu-derecho">
                <li><a href="#">Conócenos</a></li>
                <li><a href="#">Buscar pedido</a></li>
                <li><a href="#"><img src="{{ asset('resources/img/usuario.png') }}" alt="Usuario"></a></li> <!-- Subimos un nivel para llegar a img -->
            </ul>
        </nav>
    </div>
</header>
</html>
