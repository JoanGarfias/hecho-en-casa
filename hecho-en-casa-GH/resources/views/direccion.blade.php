<link rel="stylesheet" href="{{ asset('css/mensajeErrorE.css') }}">
<link rel="stylesheet" href="{{ asset('css/estilosRegistro.css') }}">
<link rel="stylesheet" href="{{ asset('css/estilosDirec.css') }}">

<title>Registro</title>
<x-menu />

<div class="flexi">
    <div class="contenedor">
        <form id="formularioRegistro" action="{{ route('registrar.direccion.post') }}" method="POST">
            @csrf
            <h2 class="titule">Regístrate</h2>
            <div class="dosColumnas">
                <div class="columna">
                    <div class="fila">
                        <label for="codigo_postal">Código postal:</label>
                        <input type="text" id="codigo_postal" name="codigo_postal" onfocus="borrarParrafo('mensajeCodigo')">
                        <div class="mensajito">
                            <p id="mensajeCodigo"></p>
                        </div>
                    </div>
                    <div class="fila">
                        <label for="estado">Estado:</label>
                        <input type="text" id="estado" name="estado" onfocus="borrarParrafo('mensajeEstado')">
                        <div class="mensajito">
                            <p id="mensajeEstado" ></p>
                        </div>
                    </div>
                    <div class="fila">
                        <label for="municipio">Ciudad:</label>
                        <input type="text" id="municipio" name="municipio" onfocus="borrarParrafo('mensajeMuni')">
                        <div class="mensajito">
                            <p id="mensajeMuni"></p>
                        </div>
                    </div>
                    <div class="fila">
                        <label for="calle">Calle: </label>
                        <input type="text" id="calle" name="calle" onfocus="borrarParrafo('mensajeCalle')">
                        <div class="mensajito">
                            <p id="mensajeCalle" ></p>
                        </div>
                    </div>
                </div>
                <div class="columna">
                    <div class="fila">
                        <label for="numInt">Número int.:</label>
                        <input type="text" id="numInt" name="numInt" onfocus="borrarParrafo('mensajeInt')">
                        <div class="mensajito">
                            <p id="mensajeInt"></p>
                        </div>
                    </div>
                    <div class="fila">
                        <label for="numExt">Número ext.:</label>
                        <input type="text" id="numExt" name="numExt" onfocus="borrarParrafo('mensajeExt')">
                        <div class="mensajito">
                            <p id="mensajeExt" ></p>
                        </div>
                    </div>
                    <div class="fila">
                        <label for="asentamiento">Colonia:</label>
                        <select id="asentamiento" name="asentamiento" onfocus="borrarParrafo('mensajeAsent')" disabled>
                            <option value="" >Selecciona un asentamiento</option>
                        </select>
                        <div class="mensajito">
                            <p id="mensajeAsent" ></p>
                        </div>
                    </div>
                    <div class="fila">
                        <label for="referencias">Referencias:</label>
                        <textarea id="referencias" name="referencias" onfocus="borrarParrafo('mensajeRef')"></textarea>
                        <div class="mensajito">
                            <p id="mensajeRef"></p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <button class="botoncito" type="submit" name="action" value="register">Confirmar</button>
        </form>
    </div>
</div>

<div class="pagination">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot active"></span>
</div>
<div id="mensajeEmergente"></div>

<script src="{{ asset('js/direccionRegistro.js') }}"></script>

<!--Para borrar el parrafo al hacer click al input-->
<script src="{{ asset('js/borrandoParrafo.js') }}" defer></script>


<script>
    document.getElementById('codigo_postal').addEventListener('input', async function () {
        const codigoPostal = this.value.trim();
        if (codigoPostal.length >= 5) {
            try {
                document.getElementById("mensajeEstado").textContent = ''
                document.getElementById("mensajeMuni").textContent = ''
    
                mostrarMensaje("Espere un momento, por favor")

                const response = await fetch("{{ route('buscar') }}", {

                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ codigo_postal: codigoPostal })
                });

                if (!response.ok) {
                    throw new Error("Error en la API");
                }

                const data = await response.json();

                // Rellenar los campos con la respuesta
                document.getElementById('estado').value = data.estado || '';
                document.getElementById('municipio').value = data.municipio || '';

                const asentamientoSelect = document.getElementById('asentamiento');
                asentamientoSelect.innerHTML = '<option value="">Selecciona un asentamiento</option>';

                if (data.asentamientos && data.asentamientos.length > 0) {
                    data.asentamientos.forEach(asentamiento => {
                        asentamientoSelect.innerHTML += `<option value="${asentamiento.asentamiento}">${asentamiento.asentamiento}</option>`;
                    });
                    asentamientoSelect.disabled = false;
                } else {
                    asentamientoSelect.innerHTML = '<option value="">No se encontraron asentamientos</option>';
                    asentamientoSelect.disabled = true;
                }
            } catch (error) {
                mostrarMensaje("Error al consultar los datos del código postal");
            }
        }
    });

    function mostrarMensaje(texto) {
        const mensaje = document.getElementById('mensajeEmergente');
        mensaje.textContent = texto; // Agregar texto al mensaje
        mensaje.style.opacity = '1'; // Mostrar el mensaje
        mensaje.style.visibility = 'visible'; // Asegurarse de que sea visible

        // Ocultar el mensaje después de 3 segundos
        setTimeout(() => {
            mensaje.style.opacity = '0'; // Inicia la transición para ocultar
            setTimeout(() => {
                mensaje.style.visibility = 'hidden'; // Ocultar completamente
            }, 500); // Coincidir con el tiempo de transición de opacity
        }, 3000);
    }
</script>

<x-pie />