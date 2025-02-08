<meta name="ruta-calendarioTP" content="{{ route('emergente.calendario.get') }}">
<link rel="stylesheet" href="{{ asset('css/mensajeErrorE.css') }}">
<link rel="stylesheet" href="{{ asset('css/pedidos.css') }}">
<link rel="stylesheet" href="{{ asset('css/pedidosTempPop.css') }}">
 
    <title>Pedidos</title>
    <x-menu />
  
<div class = "titule">

    @if (session('tipo_postre_e') == 'temporada') <!--Recuerda poner este-->
        <h2>PEDIDOS DE TEMPORADA</h2>   
    @elseif(session('tipo_postre_e') == 'pop-up')
        <h2>PEDIDOS POP UP</h2>   
    @endif
    
</div>
<div class="flexi">
    
    <div class = "contenedor"><!-- café-->
        <form id="formularioPedidos" action="{{route('emergente.detallesPedido.post')}}" method="POST">
            @csrf
            <div class="dosColumnas">
                <div class="columna">
                    <div class="fila">
                        <label for="fechaEntrega">Fecha de entrega:</label>
                        <label for="" class="paraMostrar" id="fechaEntrega" name="fechaEntrega">{{session('fecha_entrega')}}</label>
                    </div>
                    <div class="fila">
                        <label for="horaEntrega">Hora de entrega:</label>
                        <label for="" class="paraMostrar" id="horaEntrega" name="horaEntrega">{{session('hora_entrega')}}</label>
                        
                    </div>
                    <div class="fila">
                        <label for="tipoPostre">Tipo de postre:</label>
                        <label for="" id="tipoPostre" name="tipoPostre" class="paraMostrar">{{session('nombre_postre')}}</label>                        
                    </div>
                    <div class="fila">
                        <label for="cantidad">Cantidad:</label>
                        <div class="cantidad-wrapper">
                            <input type="text" id="cantidad" name="cantidad" value="1" required>
                            <div class="boton-wrapper">
                                <button type="button" class="incrementar flechitas">🔺</button>
                                <button type="button" class="decrementar flechitas">🔻</button>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="columna">
                    <div class="fila">
                        <label for="tipoEntrega">Tipo de entrega:</label>
                        <div class="custom-select">
                            <button id="toggleSelect" class="custom-select-button">🔻</button>
                            <div id="selectOptions" class="custom-select-options" style="display: none;">
                                <div class="option" value="Sucursal">Recoger en sucursal</div>
                                <div class="option" value="Domicilio">Envío a domicilio</div>
                            </div>
                            <input type="hidden" id="tipoEntrega" name="tipoEntrega">
                        </div>
                    </div>
                    <div class="fila">
                        <label for="costo">Costo:</label>
                        <label for="" id="costo" name="costo" class="paraMostrar">{{session('precio')}}</label>
                        <input type="hidden" id="precio" value="{{session('precio')}}">
                        
                        <br>
                        <p class="nota">NOTA: El costo es aproximado, el precio final puede variar según su ubicación.</p>
                    </div>
                </div>
            </div>
            <div class="arrows">
                <button id="prev" class="arrow">⬅</button> <!--Para regresar a la anterior-->
                <button id="next" class="arrow">➡</button>
            </div>

            <div class="fondo-emergente" id="fondoEmergente">
                <div class="emergente">    
                    <p class="mensajeEmergente">¿Estás seguro de tu elección?</p>
                    <br>
                    <button id="editar" class="botoncito">Seguir editando</button>
                    <button id="continuar" class="botoncito" type="submit">Continuar</button>
                </div>
            </div>
        </form> 
        

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                function sumarSeleccionado() {
                    // Obtener valores actuales
                    let total = parseFloat(document.getElementById('precio').value) || 0;
                    let cantidad = parseFloat(document.getElementById("cantidad").value) || 1;
        
                    // Multiplicar por la cantidad ingresada
                    total *= cantidad;
        
                    // Actualizar el valor del costo en el label
                    document.getElementById("costo").innerText = total.toFixed(2);
                }
        
                // Evento para cambios en la cantidad
                const cantidadInput = document.getElementById("cantidad");
                const flechitas = document.querySelectorAll('.flechitas');
        
                // Escuchar eventos de cambio en cantidad
                cantidadInput.addEventListener('input', sumarSeleccionado);
        
                // Escuchar clics en las flechitas
                flechitas.forEach(button => {
                    button.addEventListener('click', () => {
                        sumarSeleccionado();
                    });
                });
        
                // Ejecutar inicialmente por si es necesario actualizar desde el inicio
                sumarSeleccionado();
            });
        </script>
    </div>
</div>
<x-pie/>

<script src="{{ asset('js/pidiendoTemPop.js') }}" defer></script>

