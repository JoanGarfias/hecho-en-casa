<link rel="stylesheet" href="{{ asset('css/pedidos.css') }}">
<link rel="stylesheet" href="{{ asset('css/pedidosTempPop.css') }}">
 
    <title>Pedidos</title>
    <x-menu />
  
<div class = "titule">
    <h2>PEDIDOS</h2>
</div>
<div class="flexi">
    
    <div class = "contenedor"><!-- café-->
        <form id="formularioPedidos" action="{{route('fijo.detallesPedido.post')}}" method="POST">
            @csrf
            <div class="dosColumnas">
                <div class="columna">
                    <div class="fila">
                        <label for="fechaEntrega">Fecha de entrega:</label>
                        <label for="" class="paraMostrar" id="fechaEntrega" name="fechaEntrega">{{session('fecha_entrega')}}</label>
                    </div>
                    <div class="fila">
                        <label for="horaEntrega">Hora de entrega:</label>
                        <label for=""  class="paraMostrar" id="horaEntrega" name="horaEntrega">{{session('hora_entrega')}}</label>
                        <!--<div class="hora-selector">
                            <input type="time" id="horaEntrega" name="horaEntrega" min="11:00" max="19:00" required>
                            <div class="boton-wrapper">
                                <button type="button" id="incrementarHora" class="hora-boton">🔺</button>
                                <button type="button" id="decrementarHora" class="hora-boton">🔻</button>                                        
                            </div>
                        </div>-->
                    </div>
                    <div class="fila">
                        <label for="tipoPostre">Tipo de postre:</label>
                        <label for="" id="tipoPostre" name="tipoPostre" class="paraMostrar" >{{session('nombre_categoria')}}</label>
                    </div>
                    <div class="fila">
                        <label for="unidad_m"> 
                            {{ session('lista_unidad')[0]['nombreunidad'] == 'Porciones' ? 'porciones:' : 
                               (session('lista_unidad')[0]['nombreunidad'] == 'Piezas' ? 'piezas:' : 
                               (session('lista_unidad')[0]['nombreunidad'] == 'Piezas Mini' ? 'piezas mini:' : 'Cantidad:')) }}
                        </label>  

                        <div class="opciones" id="unidadm" name="unidadm" onchange="sumarSeleccionado()">
                            @if (session('lista_unidad') && count(session('lista_unidad')) > 0)
                                @foreach (session('lista_unidad') as $unidad)
                                <label>
                                    <input type="radio" name="porciones" value="{{ $unidad['cantidadporciones'] }}|{{ $unidad['nombreunidad'] }}|{{ $unidad['precio'] }}" required>
                                    <span class="blanca">{{ $unidad['cantidadporciones'] }}</span>
                                </label>
                                @endforeach
                            @else
                                <p class="blanca">No hay opciones disponibles</p>
                            @endif
                        </div>
                
                    </div>
                    <div class="fila">
                        <label for="cantidad">Cantidad:</label>
                        <div class="cantidad-wrapper">
                            
                            <input type="text" id="cantidad" name="cantidad" min="1" value="1">
                            <div class="boton-wrapper">
                                <button type="button" class="flechitas incrementar">🔺</button>
                                <button type="button" class="flechitas decrementar">🔻</button>
                            </div>
                            
                        </div>
                    </div>
                    <div class="fila">
                        <label for="sabor">Sabor:</label>
                        <label for="" id="sabor" name="sabor" class="paraMostrar">{{session('sabor_postre')}}</label>
                    </div>
                </div>

                @if (!empty($atributosSesion))
                @foreach ($atributosSesion as $nombreTipo => $atributos)
                    <div class="fila"> 
                        <label for="{{ strtolower($nombreTipo) }}">{{ ucfirst($nombreTipo) }}:</label>
                        <div class="opciones"> 
                            <select id="{{ strtolower($nombreTipo) }}" name="{{ strtolower($nombreTipo) }}">
                                @foreach ($atributos as $atributo)
                                    <option value="{{ $atributo['nom_atributo'] }}|{{ $atributo['precio_a'] }}">
                                        {{ ucfirst($atributo['nom_atributo']) }} ({{ number_format($atributo['precio_a'], 2) }} $)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endforeach
            @endif

                <div class="columna">
                    <div class="fila">
                        <label for="tipoEntrega">Tipo de entrega:</label>
                        <div class="custom-select">
                            <button id="toggleSelect" class="custom-select-button">🔻</button>
                            <div id="selectOptions" class="custom-select-options" style="display: none;">
                                <div class="option" data-value="Sucursal">Recoger en sucursal</div>
                                <div class="option" data-value="Domicilio">Envío a domicilio</div>
                            </div>
                            <input type="hidden" id="tipoEntrega" name="tipoEntrega" value="">
                        </div>
                    </div>
                    <div class="fila">
                        <label for="costo">Costo:</label>
                        <label for="" id="costo" name="costo" class="paraMostrar"></label>
                        <br>
                        <p class="nota">NOTA: El costo es aproximado, el precio final puede variar según su ubicación.</p>
                        <p>Porciones restantes del día: <span id="porcionesRestantes">{{session('porciones')}}</span></p> <br>
                        <p class="porciones-a-pedir">Porciones a pedir: </p>
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
    <script>
        let porcionesDisponibles = parseInt(document.getElementById("porcionesRestantes").textContent) || 0;
        function sumarSeleccionado() {
            let total = 0;
            const labelCosto = document.getElementById("costo");
            const labelPorciones = document.querySelector('.porciones-a-pedir');
            const porcionesRestantesLabel = document.getElementById("porcionesRestantes");
            const formulario = document.getElementById("formularioPedidos");
        
            let radioSeleccionado = document.querySelector("#unidadm input[type='radio']:checked");
            let cantidad = parseFloat(document.getElementById("cantidad").value) || 0;
            
            let cantidadPorciones = 0;
        
            if (radioSeleccionado) {
                let opcion = radioSeleccionado.value.split('|');
                let precioUnidad = parseFloat(opcion[2]);
                cantidadPorciones = parseFloat(opcion[0]);
                total += isNaN(precioUnidad) ? 0 : precioUnidad;
            }
        
            total *= cantidad;
            labelCosto.textContent = total.toFixed(2);
        
            let porcionesTotales = cantidadPorciones * cantidad;
            labelPorciones.textContent = `Porciones a pedir: ${porcionesTotales}`;
        
            
            let porcionesRestantes = porcionesDisponibles - porcionesTotales;
        
            if (porcionesRestantes < cantidadPorciones) {
                porcionesRestantesLabel.textContent = "SIN RESERVA";
                porcionesRestantesLabel.style.color = 'red';
                formulario.querySelector('button[type="submit"]').disabled = true;
            } else {
                porcionesRestantesLabel.textContent = porcionesRestantes;
                porcionesRestantesLabel.style.color = '';
                formulario.querySelector('button[type="submit"]').disabled = false;
            }
        
            if (porcionesRestantes <= 0) {
                document.querySelector(".flechitas.incrementar").disabled = true;
                document.getElementById("cantidad").disabled = true;
            } else {
                document.querySelector(".flechitas.incrementar").disabled = false;
                document.getElementById("cantidad").disabled = false;
            }
        
            let selects = document.querySelectorAll('select');
            selects.forEach(select => {
                let selectedOption = select.options[select.selectedIndex];
                console.log(`Seleccionado en ${select.id}: ${selectedOption.value} - ${selectedOption.textContent}`);
                let optionValue = parseFloat(selectedOption.value.split('|')[1]); 
                if (!isNaN(optionValue)) {
                    total += optionValue; 
                }
            });
            labelCosto.textContent = total.toFixed(2);
        }
        
        document.querySelectorAll('select').forEach(function(selectElement) {
            selectElement.addEventListener('change', function() {
                sumarSeleccionado(); 
            });
        });
        
        const btn = document.querySelectorAll('.flechitas');
        btn.forEach(b => {
            b.addEventListener('click', () => {
                sumarSeleccionado();
            });
        });
        
        window.onload = function () {
            sumarSeleccionado();
        };
    </script>
    </div>
</div>
<x-pie/>

<script src="{{ asset('js/pidiendo.js') }}" defer></script>