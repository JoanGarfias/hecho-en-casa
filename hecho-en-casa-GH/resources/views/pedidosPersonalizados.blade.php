<meta name="ruta-calendarioP" content="{{ route('personalizado.calendario.get') }}">
<link rel="stylesheet" href="{{ asset('css/mensajeErrorE.css') }}">
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
        <form id="formularioPedidos" action="{{route('personalizado.detallesPedido.post')}}" method="POST">
            @csrf
            <div class="dosColumnas">
                <div class="columna">
                    <div class="fila">
                        <label for="fechaEntrega">Fecha de entrega:</label>
                        <label for="" id="fechaEntrega" name="fechaEntrega" class="paraMostrar">{{session('fecha')}}</label>
                    </div>
                    <div class="fila">
                        <label for="horaEntrega">Hora de entrega: </label>
                        <label for="" id="horaEntrega" name="horaEntrega" class="paraMostrar tam">{{session('hora')}}</label>
                    </div>
                    <div class="fila">
                        <label for="tipoPostre">Tipo de postre:</label>
                        <label for="" id="tipoPostre" name="tipoPostre" class="paraMostrar tam">Pastel</label>                       
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
                                <label for="" id="agarrarValorPan" name="sabor_pan" class="paraMostrar">Seleccione una opción</label>           
                               
                            </div> 
                            <button id="seleccionarPan" class="diseñandobutton" type="button">🔻</button>
                            <div id="seleccionadoOpcionPan" class="customizandoOpciones" style="display: none;">
                                @foreach ($sabores as $sabor)
                                    <div class="darOpciones" data-value="{{$sabor->id_sp}}">{{$sabor->nom_pan}} {{$sabor->precio_p}} MXN</div>    
                                @endforeach
                            </div>           
                            <input type="hidden" id="panElegido" name="panElegido" value="">            
                        </div>
                    </div>
                    <div class="fila">
                        <label for="saborRelleno">Sabor de relleno:</label>
                        <div class="custom-select">
                            <div>               
                                <label for="" id="agarrarValorRelleno" name="sabor_relleno" class="paraMostrar">Seleccione una opción</label>                
                                
                            </div> 
                            <button id="seleccionarRelleno" class="diseñandobutton" type="button">🔻</button>
                            <div id="seleccionadoOpcionRelleno" class="customizandoOpciones" style="display: none;">
                                @foreach ($rellenos as $relleno)
                                    <div class="darOpciones" data-value="{{$relleno->id_sr}}">{{$relleno->nom_relleno}} {{$relleno->precio_sr}} MXN</div>    
                                @endforeach
                            </div>     
                            <input type="hidden" id="rellenoElegido" name="rellenoElegido" value="">                              
                        </div>
                    </div>
                    <div class="fila">
                        <label for="cobertura">Cobertura:</label>
                        <div class="custom-select">
                            <div>         
                                <label for="" id="agarrarValorCobertura" name="cobertura" class="paraMostrar">Seleccione una opción</label>                      
                                
                            </div> 
                            <button id="seleccionarCobertura" class="diseñandobutton" type="button">🔻</button>
                            <div id="seleccionadoOpcionCobertura" class="customizandoOpciones desborde" style="display: none;">
                                @foreach ($coberturas as $cobertura)
                                    <div class="darOpciones" data-value="{{$cobertura->id_c}}">{{$cobertura->nom_cobertura}} {{$cobertura->precio_c}} MXN</div>    
                                @endforeach
                            </div>                       
                            <input type="hidden" id="coberturaElegido" name="coberturaElegido" value="">                              
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
                                <input type="radio" name="tematica" value="Cumpleaños">
                                <p class="blanca"> Cumpleaños</p>
                            </label>
                            <label>
                                <input type="radio" name="tematica" value="XV Años" >
                                <p class="blanca"> XV años</p>
                            </label>
                            <label>
                                <input type="radio" name="tematica" value="Boda">
                                <p class="blanca"> Boda</p>
                            </label>
                            <label>
                                <input type="radio" name="tematica" value="Bautizo">
                                <p class="blanca"> Bautizo</p>
                            </label>
                            <label>
                                <input type="radio" name="tematica" value="Otro" id="otrosRadio">
                                <p class="blanca"> Otro</p>
                                <div id="campoOtros" style="display: none;">
                                    <input type="text" id="otrosTexto" name="otrosTexto" class="paraOtros">
                                </div>
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
                        <textarea id="imagen" name="imagen" class="escribiendo" placeholder="Pega aquí un enlace de Google o Pinterest..."></textarea>
                    </div>
                    <div class="fila">
                        <label for="descripcion">Descripción detallada:</label>
                        <textarea id="descripcion" name="descripcion" class="escribiendo" placeholder="Describe tu pedido"></textarea>
                    </div>

                    <div class="fila"> 
                        <label for="costo">Costo:</label>
                        <label for="" id="costo" name="costo" class="paraMostrar tam"></label>
                        
                        <br>
                        <p class="nota">NOTA: El costo es aproximado, el precio final puede variar según su ubicación.</p>
                    </div>
                </div>
            </div>
            <div class="arrows">
                <button id="prev" class="arrow">⬅</button>
                <button id="next" class="arrow">➡</button>
            </div>
            <input type="hidden" id="hiddenCosto" name="costot" value="">
            <input type="hidden" id="hiddenPorciones" name="porcionest" value="">
            <div class="fondo-emergente" id="fondoEmergente">
                <div class="emergente">    
                    <p class="mensajeEmergente">¿Estás seguro de tu elección?</p>
                    <br>
                    <button id="editar" class="botoncito">Seguir editando</button>
                    <button id="continuar" class="botoncito" type="submit">Continuar</button>
                </div>
            </div>
        </form>  
        <div id="mensajeEmergente"></div>
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
        // Variables y funciones del primer script
        const inputPorciones = document.getElementById('porciones');
        const spanPorcionesRestantes = document.getElementById('porcionesRestantes');
        let porcionesRestantes = parseInt(spanPorcionesRestantes.textContent) || 0;

        function actualizarPorcionesRestantes() {
            const porcionesSolicitadas = parseInt(inputPorciones.value) || 0;
            const nuevasPorcionesRestantes = porcionesRestantes - porcionesSolicitadas;
            const botonEnviar = document.querySelector('button[type="submit"]');

            if (nuevasPorcionesRestantes < 0) {
                spanPorcionesRestantes.textContent = "SIN RESERVA";
                spanPorcionesRestantes.style.color = 'red';
                document.querySelector(".incrementar").disabled = true;
                botonEnviar.disabled = true;
            } else {
                spanPorcionesRestantes.textContent = nuevasPorcionesRestantes;
                spanPorcionesRestantes.style.color = 'green';
                document.querySelector(".incrementar").disabled = false;
                botonEnviar.disabled = false;
            }
        }

        const precioPorPorcion = 100;
        let totalCosto = 8 * precioPorPorcion; 
        let costoPorcionesAnterior = totalCosto; 
        const costoInput = document.getElementById('costo');
        let costoPanAnterior = 0;
        let costoRellenoAnterior = 0;
        let costoCoberturaAnterior = 0;
        let costoElementosAnterior = 0;
        //let valorPorciones = parseInt(inputPorciones.value) || 0;
        //totalCosto = valorPorciones * precioPorPorcion;

        function actualizarCosto() {
            let valorPorciones = parseInt(inputPorciones.value) || 8; 
            let nuevoCostoPorciones = valorPorciones * precioPorPorcion; 

            totalCosto -= costoPorcionesAnterior; 
            totalCosto += nuevoCostoPorciones; 
            costoPorcionesAnterior = nuevoCostoPorciones;

            const saborPanSeleccionado = document.querySelector('#seleccionadoOpcionPan .darOpciones.seleccionado');
            if (saborPanSeleccionado) {
                const precioPan = parseFloat(saborPanSeleccionado.textContent.match(/\d+(\.\d+)?/)[0]);
                totalCosto -= costoPanAnterior; 
                totalCosto += precioPan; 
                costoPanAnterior = precioPan;
            }

            const saborRellenoSeleccionado = document.querySelector('#seleccionadoOpcionRelleno .darOpciones.seleccionado');
            if (saborRellenoSeleccionado) {
                const precioRelleno = parseFloat(saborRellenoSeleccionado.textContent.match(/\d+(\.\d+)?/)[0]);
                totalCosto -= costoRellenoAnterior;
                totalCosto += precioRelleno; 
                costoRellenoAnterior = precioRelleno;
            }

            const coberturaSeleccionada = document.querySelector('#seleccionadoOpcionCobertura .darOpciones.seleccionado');
            if (coberturaSeleccionada) {
                const precioCobertura = parseFloat(coberturaSeleccionada.textContent.match(/\d+(\.\d+)?/)[0]);
                totalCosto -= costoCoberturaAnterior; 
                totalCosto += precioCobertura; 
                costoCoberturaAnterior = precioCobertura;
            }

            const elementosCheckboxes = document.querySelectorAll('input[name="elementos[]"]:checked');
            let nuevoCostoElementos = 0;
            elementosCheckboxes.forEach(checkbox => {
                nuevoCostoElementos += parseFloat(checkbox.nextElementSibling.textContent.match(/\d+(\.\d+)?/)[0]);
            });
            totalCosto -= costoElementosAnterior; 
            totalCosto += nuevoCostoElementos; 
            costoElementosAnterior = nuevoCostoElementos; 

            costoInput.textContent = `${totalCosto.toFixed(2)} MXN`;  
            document.getElementById("hiddenCosto").value = totalCosto.toFixed(2);
            document.getElementById("hiddenPorciones").value = valorPorciones;
        }

        document.querySelector('.incrementar').addEventListener('click', function () {
            let valorActual = parseInt(inputPorciones.value) || 0;
            inputPorciones.value = valorActual + 1;
            actualizarCosto();
            actualizarPorcionesRestantes();
        });

        document.querySelector('.decrementar').addEventListener('click', function () {
            let valorActual = parseInt(inputPorciones.value) || 0;
            inputPorciones.value = Math.max(valorActual - 1, 8);  
            actualizarCosto();
            actualizarPorcionesRestantes();
        });

        inputPorciones.addEventListener('input', function () {
            let valorActual = parseInt(inputPorciones.value) || 0;
            if (valorActual < 8) {
                inputPorciones.value = 8; 
            }
            actualizarCosto();
            actualizarPorcionesRestantes();
        });

        document.querySelectorAll('.darOpciones').forEach(opcion => {
            opcion.addEventListener('click', () => {
                document.querySelectorAll('.darOpciones').forEach(op => op.classList.remove('seleccionado'));
                opcion.classList.add('seleccionado');
                actualizarCosto();
            });
        });

        document.querySelectorAll('input[name="elementos[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', actualizarCosto);
        });
        actualizarCosto();
        actualizarPorcionesRestantes();
    });
</script>
<x-pie/>

<script src="{{ asset('js/pidiendoPersonalizado.js')}}"></script>