<link rel="stylesheet" href="{{ asset('css/pedidos.css') }}">
<link rel="stylesheet" href="{{ asset('css/pedidosTempPop.css') }}">
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
                        <div class="fila">
                            <p style="color: black;">Quedan <span id="porcionesRestantes">{{session('porciones')}}</span> porciones disponibles</p>
                        </div>
                    </div>
                    <div class="fila">
                        <label for="saborPan">Sabor de pan:</label>
                        <div class="custom-select">
                            <div>                               
                                <input type="text" id="agarrarValorPan" name="sabor_pan" readonly placeholder="Seleccione una opción">
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
                                <input type="text" id="agarrarValorRelleno" name="sabor_relleno" readonly placeholder="Seleccione una opción">
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
                                <input type="text" id="agarrarValorCobertura" name="cobertura" readonly placeholder="Seleccione una opción">
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
                                <input type="radio" name="tematica" value="figura" >
                                <p class="blanca"> XV años</p>
                            </label>
                            <label>
                                <input type="radio" name="tematica" value="figura">
                                <p class="blanca"> Boda</p>
                            </label>
                            <label>
                                <input type="radio" name="tematica" value="figura">
                                <p class="blanca"> Bautizo</p>
                            </label>
                            <label>
                                <input type="radio" name="tematica" value="figura">
                                <p class="blanca"> Otro</p>
                            </label>
                        </div>
                    </div>
                    <div class="fila">
                        <label for="tipoEntrega">Tipo de entrega:</label>
                        <div class="custom-select">
                            <button id="toggleSelect" class="custom-select-button" type="button">🔻</button>
                            <div id="selectOptions" class="custom-select-options" style="display: none;">
                                <div class="option" data-value="Sucursal">Recoger en sucursal</div>
                                <div class="option" data-value="Domicilio">Envío a domicilio</div>
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

<script>
    // Variables desde el controlador
    //let sabores = @json($sabores);
    //let rellenos = @json($rellenos);
    //let coberturas = @json($coberturas);
    //let elementos = @json($elementos);

    // Mostrar en la consola
    //console.log('Sabores:', sabores);
    //console.log('Rellenos:', rellenos);
    //console.log('Coberturas:', coberturas);
    //console.log('Elementos:', elementos);
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputPorciones = document.getElementById('porciones');
        const spanPorcionesRestantes = document.getElementById('porcionesRestantes');
        let porcionesRestantes = parseInt(spanPorcionesRestantes.textContent);

        function actualizarPorcionesRestantes() {
            const porcionesSolicitadas = parseInt(inputPorciones.value) || 0;
            const nuevasPorcionesRestantes = porcionesRestantes - porcionesSolicitadas;

            const botonEnviar = document.querySelector('button[type="submit"]');

            if (nuevasPorcionesRestantes < 0) {
                spanPorcionesRestantes.textContent = "SIN RESERVA";
                spanPorcionesRestantes.style.color = 'red';
                document.querySelector(".incrementar").disabled = true;
                botonEnviar.disabled = true; // Deshabilitar el botón de envío
            } else {
                spanPorcionesRestantes.textContent = nuevasPorcionesRestantes;
                spanPorcionesRestantes.style.color = 'green'; // Cambia a un color apropiado
                document.querySelector(".incrementar").disabled = false;
                botonEnviar.disabled = false; // Habilitar el botón de envío
            }
        }

        inputPorciones.addEventListener('input', actualizarPorcionesRestantes);

        document.querySelector('.incrementar').addEventListener('click', () => {
            inputPorciones.value = parseInt(inputPorciones.value || 0) + 1;
            actualizarPorcionesRestantes();
        });

        document.querySelector('.decrementar').addEventListener('click', () => {
            inputPorciones.value = Math.max(parseInt(inputPorciones.value || 0) - 1, 0);
            actualizarPorcionesRestantes();
        });

        actualizarPorcionesRestantes(); 
    });
</script>


<x-pie/>

<script src="{{ asset('js/pidiendoPersonalizados.js') }}" defer></script>

<script src="{{ asset('js/costoPersonalizado.js') }}" defer></script>

