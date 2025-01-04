<link rel="stylesheet" href="{{ asset('css/pedidos.css') }}">
 
    <title>Registro</title>
    <x-menu />
  
<div class = "titule">
    <h2>PEDIDOS</h2>
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
                        <div class="opciones">
                            <label>
                                <input type="radio" name="porciones" value="seis" required>
                                <p class="blanca"> 6</p>
                            </label>
                            <label>
                                <input type="radio" name="porciones" value="doce">
                                <p class="blanca"> 12</p>
                            </label>
                        </div>
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
                    <div class="fila">
                        <label for="sabor">Sabor:</label>
                        <input type="text" id="sabor" name="sabor" readonly>
                    </div>
                </div>
                <div class="columna">
                    <div class="fila">
                        <label for="tipoEntrega">Tipo de entrega:</label>
                        <select id="tipoEntrega" name="tipoEntrega" required>
                            <option value="" disabled selected>Selecciona una opción</option>
                            <option value="opcion1">Opción 1</option>
                            <option value="opcion2">Opción 2</option>
                        </select>
                    </div>
                    <div class="fila">
                        <label for="costo">Costo:</label>
                        <input type="text" id="costo" name="costo" readonly><br>
                        <p class="nota">NOTA: El costo es aproximado, el precio final puede variar según su ubicación.</p>
                    </div>
                </div>
            </div>
            
        </form>  
    </div>
</div>
<x-pie/>

<script src="{{ asset('js/pidiendo.js') }}" defer></script>

<!--Para la animación del logo de usuario-->
<script src="{{ asset('js/icono.js') }}" defer></script>