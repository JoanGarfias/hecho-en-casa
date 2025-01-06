<link rel="stylesheet" href="{{ asset('css/pedidos.css') }}">
<link rel="stylesheet" href="{{ asset('css/pedidosPersonalizados.css') }}">
 
    <title>Pedidos</title>
    <x-menu />
  
<div class = "titule">
    <h2>PEDIDOS PERSONALIZADOS</h2>
</div>
<div class="flexi">
    
    <div class = "contenedor"><!-- café-->
        <form id="formularioPedidos" action="" method="">
            <div class="dosColumnas">
                <div class="columna">
                    <div class="fila">
                        <label for="fechaEntrega">Fecha de entrega:</label>
                        <input type="text" id="fechaEntrega" name="fechaEntrega" readonly>
                    </div>
                    <div class="fila">
                        <label for="horaEntrega">Hora de entrega: </label>
                        <input type="text" id="horaEntrega" name="horaEntrega" readonly>
                    </div>
                    <div class="fila">
                        <label for="tipoPostre">Tipo de postre:</label>
                        <input type="text" id="tipoPostre" name="tipoPostre" readonly>
                    </div>
                    <div class="fila">
                        <label for="porciones">Porciones:</label>
                        <div class="porciones-wrapper">
                            
                            <input type="text" id="porciones" name="porciones" value="1" required>
                            <div class="boton-wrapper">
                                <button type="button" class="incrementar">🔺</button>
                                <button type="button" class="decrementar">🔻</button>
                            </div>
                            
                        </div>
                    </div>
                    <div class="fila">
                        <label for="saborPan">Sabor de pan:</label>
                        <div class="custom-select">
                            <div>                               
                                <input type="text" id="agarrarValor" readonly placeholder="Seleccione una opción">
                                <input type="hidden" id="tipoEntrega" name="tipoEntrega">
                            </div> 
                            <button id="seleccionar" class="diseñandobutton">🔻</button>
                            <div id="seleccionadoOpcion" class="customizandoOpciones" style="display: none;">
                                <div class="darOpciones" data-value="opcion1">Opción 1</div>
                                <div class="darOpciones" data-value="opcion2">Opción 2</div>
                            </div>                       
                        </div>
                    </div>
                    <div class="fila">
                        <label for="saborRelleno">Sabor de relleno:</label>
                        <div class="custom-select">
                            <div>                               
                                <input type="text" id="agarrarValor" readonly placeholder="Seleccione una opción">
                                <input type="hidden" id="tipoEntrega" name="tipoEntrega">
                            </div> 
                            <button id="seleccionar" class="diseñandobutton">🔻</button>
                            <div id="seleccionadoOpcion" class="customizandoOpciones" style="display: none;">
                                <div class="darOpciones" data-value="opcion1">Opción 1</div>
                                <div class="darOpciones" data-value="opcion2">Opción 2</div>
                            </div>                       
                        </div>
                    </div>
                    <div class="fila">
                        <label for="cobertura">Cobertura:</label>
                        <div class="custom-select">
                            <div>                               
                                <input type="text" id="agarrarValor" readonly placeholder="Seleccione una opción">
                                <input type="hidden" id="tipoEntrega" name="tipoEntrega">
                            </div> 
                            <button id="seleccionar" class="diseñandobutton">🔻</button>
                            <div id="seleccionadoOpcion" class="customizandoOpciones" style="display: none;">
                                <div class="darOpciones" data-value="opcion1">Opción 1</div>
                                <div class="darOpciones" data-value="opcion2">Opción 2</div>
                            </div>                       
                        </div>
                    </div>
                </div>
                <div class="columna">
                    <div class="fila">
                        <label for="elementos">Elementos:</label>
                        <div class="opciones">
                            <label>
                                <input type="checkbox" name="elementos[]" value="figura" required>
                                <p class="blanca"> Figura de fondant</p>
                            </label>
                            <label>
                                <input type="checkbox" name="elementos[]" value="figura">
                                <p class="blanca"> Impresion de oblea</p>
                            </label>
                        </div>
                    </div>
                    <div class="fila">
                        <label for="tematica">Temática:</label>
                        <div class="opciones">
                            <label>
                                <input type="radio" name="tematica" value="figura" required>
                                <p class="blanca"> Cumpleaños</p>
                            </label>
                            <label>
                                <input type="radio" name="tematica" value="figura">
                                <p class="blanca"> XV años</p>
                            </label>
                        </div>
                    </div>
                    <div class="fila">
                        <label for="tipoEntrega">Tipo de entrega:</label>
                        <div class="custom-select">
                            <button id="toggleSelect" class="custom-select-button">🔻</button>
                            <div id="selectOptions" class="custom-select-options" style="display: none;">
                                <div class="option" data-value="opcion1">Recoger en sucursal</div>
                                <div class="option" data-value="opcion2">Envío a domicilio</div>
                            </div>
                            <input type="hidden" id="tipoEntrega" name="tipoEntrega">
                        </div>
                    </div>
                    
                </div>
                <div class="columna">
                    <div class="fila">
                        <label for="imagen">Añadir imagen:</label>
                        <textarea id="imagen" name="imagen" class="escribiendo" placeholder="Pega aquí un enlace de Google o Pinterest..." required></textarea>
                    </div>
                    <div class="fila">
                        <label for="descripcion">Descripción detallada:</label>
                        <textarea id="descripcion" name="descripcion" class="escribiendo" placeholder="Describe tu pedido" required></textarea>
                    </div>

                    <div class="fila"> 
                        <label for="costo">Costo:</label>
                        <input type="text" id="costo" name="costo" readonly>
                        <br>
                        <p class="nota">NOTA: El costo es aproximado, el precio final puede variar según su ubicación.</p>
                    </div>
                </div>
            </div>
            <div class="arrows">
                <button id="prev" class="arrow">⬅</button>
                <button id="next" class="arrow">➡</button>
            </div>
        </form>  
    </div>
</div>
<x-pie/>

<script src="{{ asset('js/pidiendoPersonalizados.js') }}" defer></script>

<!--Para la animación del logo de usuario-->
<script src="{{ asset('js/icono.js') }}" defer></script>