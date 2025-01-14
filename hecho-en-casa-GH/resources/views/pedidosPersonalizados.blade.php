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
                        <input type="text" id="fechaEntrega" name="fechaEntrega" placeholder="{{session('fecha')}}" readonly>
                    </div>
                    <div class="fila">
                        <label for="horaEntrega">Hora de entrega: </label>
                        <input type="text" id="horaEntrega" name="horaEntrega" placeholder="{{session('hora')}}" readonly>
                    </div>
                    <div class="fila">
                        <label for="tipoPostre">Tipo de postre:</label>
                        <input type="text" id="tipoPostre" name="tipoPostre" placeholder="Pastel" readonly>
                    </div>
                    <div class="fila">
                        <label for="porciones">Porciones:</label>
                        <div class="porciones-wrapper">
                            
                            <input type="text" id="porciones" name="porciones" value="8" min="8" required>
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
                                <input type="text" id="agarrarValorPan" readonly placeholder="Seleccione una opción">
                                <input type="hidden" id="tipoEntrega" name="tipoEntrega">
                            </div> 
                            <button id="seleccionarPan" class="diseñandobutton" type="button">🔻</button>
                            <div id="seleccionadoOpcionPan" class="customizandoOpciones" style="display: none;">
                                @foreach ($sabores as $sabor)
                                    <div class="darOpciones" data-value="{{$sabor->id_sp}}">{{$sabor->nom_pan}} {{$sabor->precio_p}} MXN</div>    
                                @endforeach
                            </div>                       
                        </div>
                    </div>
                    <div class="fila">
                        <label for="saborRelleno">Sabor de relleno:</label>
                        <div class="custom-select">
                            <div>                               
                                <input type="text" id="agarrarValorRelleno" readonly placeholder="Seleccione una opción">
                                <input type="hidden" id="tipoEntrega" name="tipoEntrega">
                            </div> 
                            <button id="seleccionarRelleno" class="diseñandobutton" type="button">🔻</button>
                            <div id="seleccionadoOpcionRelleno" class="customizandoOpciones" style="display: none;">
                                @foreach ($rellenos as $relleno)
                                    <div class="darOpciones" data-value="{{$relleno->id_sr}}">{{$relleno->nom_relleno}} {{$relleno->precio_sr}} MXN</div>    
                                @endforeach
                            </div>                       
                        </div>
                    </div>
                    <div class="fila">
                        <label for="cobertura">Cobertura:</label>
                        <div class="custom-select">
                            <div>                               
                                <input type="text" id="agarrarValorCobertura" readonly placeholder="Seleccione una opción">
                                <input type="hidden" id="tipoEntrega" name="tipoEntrega">
                            </div> 
                            <button id="seleccionarCobertura" class="diseñandobutton" type="button">🔻</button>
                            <div id="seleccionadoOpcionCobertura" class="customizandoOpciones" style="display: none;">
                                @foreach ($coberturas as $cobertura)
                                    <div class="darOpciones" data-value="{{$cobertura->id_c}}">{{$cobertura->nom_cobertura}} {{$cobertura->precio_c}} MXN</div>    
                                @endforeach
                            </div>                       
                        </div>
                    </div>
                </div>
                <div class="columna">
                    <div class="fila">
                        <label for="elementos">Elementos:</label>
                        <div class="opciones">
                            @foreach ($elementos as $elemento)
                                <label>
                                    <input type="checkbox" name="elementos[]" value="{{$elemento->id_e}}">
                                    <p class="blanca">{{$elemento->nom_elemento}} {{ $elemento->precio_e }} MXN</p>
                                </label>    
                            @endforeach
                            
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
                            <button id="toggleSelect" class="custom-select-button" type="button">🔻</button>
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
<!--Para la animación del logo de usuario-->
<script src="{{asset ('js/despliegue-menu.js')}}" defer> </script>
<script src="{{ asset('js/icono.js') }}" defer></script>