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
        <form id="formularioPedidos" action="" method="">
            <div class="dosColumnas">
                <div class="columna">
                    <div class="fila">
                        <label for="fechaEntrega">Fecha de entrega:</label>
                        <input type="text" id="fechaEntrega" name="fechaEntrega" placeholder="{{session('fecha_entrega')}}" readonly>
                    </div>
                    <div class="fila">
                        <label for="horaEntrega">Hora de entrega:</label>
                        <input type="text" id="horaEntrega" name="horaEntrega" placeholder="{{session('hora_entrega')}}" readonly>
                        
                    </div>
                    <div class="fila">
                        <label for="tipoPostre">Tipo de postre:</label>
                        <label for="" id="tipoPostre" name="tipoPostre" class="paraMostrar"></label>                        
                    </div>
                    <div class="fila">
                        <label for="cantidad">Cantidad:</label>
                        <div class="cantidad-wrapper">
                            <input type="text" id="cantidad" name="cantidad" value="1" required>
                            <div class="boton-wrapper">
                                <button type="button" class="incrementar">🔺</button>
                                <button type="button" class="decrementar">🔻</button>
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
                        <label for="" id="costo" name="costo" class="paraMostrar"></label>
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
    </div>
</div>
<x-pie/>

<script src="{{ asset('js/pidiendoTemPop.js') }}" defer></script>

