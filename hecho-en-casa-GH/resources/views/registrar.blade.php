
<link rel="stylesheet" href="{{ asset('css/estilosRegistro.css') }}">
<title>Registro</title>  
<x-menu />

<div class="flexi">
    <div class = "contenedor"><!-- café-->
        <form id="formularioRegistro" action="" method="">
            <h2 class="titule">Regístrate</h2>
            
            <label for="name" id = "campos">Nombre:</label>
            <input type="text" id="name" name="name" onfocus="borrarParrafo('mensajeName')" required>
            <div class="mensajito">
                <p id="mensajeName" class="bien"></p><br>
            </div>

            <label for="apellidoP" id = "campos">Apellido paterno:</label>
            <input type="text" id="apellidoP" name="apellidoP" onfocus="borrarParrafo('mensajeApellidoP')" required>
            <div class="mensajito">
                <p id="mensajeApellidoP" class="bien"></p><br>
            </div>

            <label for="apellidoM" id = "campos">Apellido materno:</label>
            <input type="text" id="apellidoM" name="apellidoM" onfocus="borrarParrafo('mensajeApellidoM')" required>
            <div class="mensajito">
                <p id="mensajeApellidoM" class="bien"></p><br>
            </div>

            <label for="phone" id = "campos">Número de teléfono:</label>
            <input type="tel" id="phone" name="phone" onfocus="borrarParrafo('mensajePhone')" required>
            <div class="mensajito">
                <p id="mensajePhone" class="bien"></p><br>
            </div>

            <label for="email" id = "campos">Correo electrónico:</label>
            <input type="email" id="email" name="email" onfocus="borrarParrafo('mensajeEmail')" required>
            <div class="mensajito">
                <p id="mensajeEmail" class="bien"></p><br>
            </div>

            <button class="botoncito" type="submit" name="action" value="login">Iniciar sesión</button>
            <button class="botoncito" type="submit" name="action" value="register" onclick="validateForm()">Continuar</button>
            <p></p>
        </form>  
    </div>
</div>

<x-pie/>

    <script src="{{ asset('js/registrando.js') }}"></script>
    <!--Para la animación del logo de usuario-->
<script src="{{ asset('js/icono.js') }}" defer></script>