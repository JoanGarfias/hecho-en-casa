<link rel="stylesheet" href="{{ asset('css/iniciando.css') }}">
<title>Iniciar sesión</title>
<x-menu />    

<div class="flexi">
<div class = "contenedor">         
    <form action="procesar.php" method="POST" id = "inicioSesion">
        <h2>Iniciar sesión</h2>
        <label for="email">Correo: </label>
        <input type="email" id = "email" name = "email" required> 
        <div class="mensaje">
        <p id="errorEmail" class="error"></p>
        <p id="bienEmail" class="bien"></p>
        </div>

        <br>
        <label for="password">Contraseña: </label>
        <input type="password" id = "pass" name = "pass" required> 
        <div class="mensaje">
        <p id="errorPass" class="error"></p>
        <p id="bienPass" class="bien"></p>
        </div>

        <a href="" id="olvidadizo">Olvidé mi contraseña</a><br><br>

    <div>
        <button class="botoncito" type="submit" name="action" value="register">Registrarme</button>
        <button class="botoncito" type="submit" name="action" value="login" onclick="validateForm()">Continuar</button>
    </div>
</form>
</div>
</div>
<x-pie/>

<script src="{{ asset('js/iniciando.js') }}"></script>
<!--Para la animación del logo de usuario-->
<script src="{{ asset('js/icono.js') }}" defer></script>