
<link rel="stylesheet" href="{{ asset('css/estilosRegistro.css') }}">
<link rel="stylesheet" href="{{ asset('css/mensajeErrorE.css') }}">
<script src="{{ asset('js/MensajeError.js') }}"></script>   
<title>Registro</title>  
<x-menu />

<div class="flexi">
    <div class = "contenedor"><!-- café-->
        <form id="formularioRegistro" action="{{route('registrar.post')}}" method="POST">
            @csrf
            <input type="hidden" name="action" id="hiddenAction" value="">
            <h2 class="titule">Regístrate</h2>
            
            <label for="name" id = "campos">Nombre:</label>
            <input type="text" id="name" name="name" value="{{old('name')}}" onfocus="borrarParrafo('mensajeName')" required>
            <div class="mensajito">
                <p id="mensajeName" class="bien"></p><br>
            </div>

            <label for="apellidoP" id = "campos">Apellido paterno:</label>
            <input type="text" id="apellidoP" name="apellidoP" value="{{old('apellidoP')}}" onfocus="borrarParrafo('mensajeApellidoP')" required>
            <div class="mensajito">
                <p id="mensajeApellidoP" class="bien"></p><br>
            </div>

            <label for="apellidoM" id = "campos">Apellido materno:</label>
            <input type="text" id="apellidoM" name="apellidoM" value="{{old('apellidoM')}}" onfocus="borrarParrafo('mensajeApellidoM')" required>
            <div class="mensajito">
                <p id="mensajeApellidoM" class="bien"></p><br>
            </div>

            <label for="phone" id = "campos">Número de teléfono:</label>
            <input type="tel" id="phone" name="phone" value="{{old('phone')}}" onfocus="borrarParrafo('mensajePhone')" required>
            <div class="mensajito">
                <p id="mensajePhone" class="bien"></p><br>
            </div>

            <label for="email" id = "campos">Correo electrónico:</label>
            <input type="email" id="email" name="email" value="{{old('email')}}" onfocus="borrarParrafo('mensajeEmail')" required>
            <div class="mensajito">
                <p id="mensajeEmail" class="bien"></p><br>
            </div>

            <div class="captcha"> 
                {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display() !!} 
            </div>
           

            <button class="botoncito" type="submit" name="botones" value="login">Iniciar sesión</button>
            <button class="botoncito" type="submit" name="botones" value="register">Continuar</button>
            <p></p>
        </form>  
    </div>
</div>

<div class="pagination">
    <span class="dot active"></span>
    <span class="dot"></span>
    <span class="dot"></span>
  </div>
  
@if ($errors->has('email'))
    <!-- Mensaje de error si el pedido no existe -->
    <div id="mensajeEmergente"></div>
    <script>
        mostrarMensaje('{{$errors->first('email')}}');
    </script>
@elseif (session('errorRegistro'))
    <div id="mensajeEmergente"></div>
    <script>
        mostrarMensaje('{{session('errorRegistro')}}');
    </script>
@endif
<x-pie/>


    <script src="{{ asset('js/registrando.js') }}"></script>

<!--Para borrar el parrafo al hacer click al input-->
<script src="{{ asset('js/borrandoParrafo.js') }}" defer></script>
