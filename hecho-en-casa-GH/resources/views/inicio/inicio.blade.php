<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Pastelería</title>
    <link rel="stylesheet" href="{{ mix('build/assets/menu-CX5Ov8oT.css') }}">
<link rel="stylesheet" href="{{ mix('build/assets/cuerpo-BjCxLUjj.css') }}">
<link rel="stylesheet" href="{{ mix('build/assets/pie-C4YBsxw8.css') }}">

</head>
<body>


    <!-- Encabezado -->
    <header>
        <div class="menu">
            <nav>
                <ul class="menu-izquierdo">
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Calendario</a></li>
                    <li><a href="#">Catálogo</a></li>
                </ul>
                <div class="logo">
                    <img src="/img/inicio/logo.png" alt="Logo">
                </div>
                <ul class="menu-derecho">
                    <li><a href="#">Conócenos</a></li>
                    <li><a href="#">Buscar pedido</a></li>
                    <li><a href="#"><img src="{{ asset('/img/inicio/usuario.png') }}" alt="Usuario"></a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Banner -->

    <section class="banner">
        <img src="{{ asset('/img/inicio/Banner.png') }}" alt="Banner de pasteles">
    </section>
    <div class="registro-banner">
        ¿No tienes una cuenta? ¡Regístrate y gana increíbles premios!
    </div>

    <!-- Contenido principal -->

    <main>
        <h2>DESCUBRE</h2>
        <div class="contenedor">
            <div class="seccion temporada">
                <h3>TEMPORADA</h3>
		<img src="{{ asset('/img/inicio/temporada.png') }}" alt="Pasteles de temporada">
            </div>
            <div class="seccion pasteles">
                <h3>PASTELES</h3>
                <div class="contenedor-flex">
		    <img src="{{ asset('/img/inicio/pasteles.png') }}" alt="Pasteles personalizados">
                    <button class="personaliza">
			<img src="{{ asset('/img/inicio/varita.png') }}" alt="Personaliza tu pastel">
                        Personaliza tu pastel
                    </button>
                </div>
            </div>    
        </div>
    </main>

    <!-- Pie de página -->
    <div class="piePa">
        <img src="{{ asset('/img/inicio/PiePag.png') }}" alt="Pie de página">
    </div>
</body>
</html>