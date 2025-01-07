<link rel="stylesheet" href="{{ asset('css/estilosRegistro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/estilosDirec.css') }}">

    <title>Registro</title>
    <x-menu />

<div class="flexi">
    <div class = "contenedor"><!-- café-->
        <form id="formularioRegistro" action="{{route('registrar.direccion.post')}}" method="POST">
            @csrf
            <h2 class="titule">Regístrate</h2>
                    
            <div class="dosColumnas">
                <div class="columna">
                    <div class="fila">
                        <label for="codigoPostal">Codigo postal:</label>
                        <input type="text" id="codigoPostal" name="codigoPostal" required>
                    </div>
                    
                    <div class="fila">
                        <label for="estado">Estado:</label>
                        <input type="text" id="estado" name="estado" required>
                    </div>
                    <div class="fila">
                        <label for="ciudad">Ciudad:</label>
                        <input type="text" id="ciudad" name="ciudad" required>
                    </div>
                    <div class="fila">
                        <label for="calle">Calle: </label>
                        <input type="text" id="calle" name="calle" required>
                    </div>
                </div>
                <div class="columna">
                    <div class="fila">
                        <label for="numInt">Número int.:</label>
                        <input type="text" id="numInt" name="numInt">
                    </div>
                    <div class="fila">
                        <label for="numExt">Número ext.:</label>
                        <input type="text" id="numExt" name="numExt" required>
                    </div>
                    <div class="fila">
                        <label for="colonia">Colonia:</label>
                        <input type="text" id="colonia" name="colonia" required>
                    </div>
                    <div class="fila">
                        <label for="referencias">Referencias:</label>
                        <textarea id="referencias" name="referencias" required></textarea>
                    </div>
                </div>
            </div>
            <br>

            <button class="botoncito" type="submit" name="action" value="register">Confirmar</button>
            <p></p>
        </form>  
    </div>
</div>
<x-pie/>
<!--Para la animación del logo de usuario-->
<script src="{{ asset('js/icono.js') }}" defer></script>