<link rel="stylesheet" href="{{ asset('css/iniciando.css') }}">
<title>Iniciar sesión</title>
<x-menu/>    

<div class="flexi">
<div class = "contenedor">   
    
    <form action="{{route('login.post')}}" method="POST" id="inicioSesion">
        @csrf
        <input type="hidden" name="action" id="hiddenAction" value="">
        <h2>Iniciar sesión</h2>
        <label for="email">Correo: </label>
        <input type="email" id = "email" name = "email" onfocus="borrarParrafo('mensajeEmail')"> 
        <div class="mensajito">
            <p id="mensajeEmail" class="bien"></p>
        </div>
        <br>
        <div class="alineando">
            <label for="password">Contraseña: </label>
            <div class="campo-contrasena">
                <input type="password" id="password" name="password"  onfocus="borrarParrafo('mensajePass')">
                <i class="fi fi-rs-crossed-eye visibility" onclick="visibility('password', this)"></i>
            </div>
        </div>
        <div class="mensajito">
            <p id="mensajePass" class="bien"></p>
        </div>

        {!! NoCaptcha::renderJs() !!}
        {!! NoCaptcha::display() !!}

        <div>
            <button class="botoncito" type="submit" name="action" value="recuperar" id="olvidadizo">Olvide mi contraseña</button>
            <button class="botoncito" type="submit" name="action" value="register">Registrarme</button>
            <button class="botoncito" type="submit" name="action" value="login" >Continuar</button>
        </div>
</form>
</div>

    <div class="fondo-emergente" id="fondoEmergente">
        <div class="emergente">    
            <p class="mensajeEmergente">Se ha enviado un código de seguridad a tu correo.</p>
            <p class="mensajeEmergente"></p>
            <button id="aceptar" class="aceptando">✔</button>
        </div>
    </div>
</div>

<x-pie/>

<script src="{{ asset('js/iniciando.js') }}"></script>
<!--Para la animación del logo de usuario-->
<script src="{{asset ('js/despliegue-menu.js')}}" defer> </script>
<script src="{{ asset('js/icono.js') }}" defer></script>
<!--Para mostrar la contraseña-->
<script src="{{ asset('js/mostrarContra.js') }}" defer></script>
<!--Para borrar el parrafo al hacer click al input-->
<script src="{{ asset('js/borrandoParrafo.js') }}" defer></script>