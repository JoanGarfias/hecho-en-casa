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
                        <input type="text" id="codigo_postal" name="codigo_postal" required>
                    </div>
                    <div class="fila">
                        <label for="estado">Estado:</label>
                        <input type="text" id="estado" name="estado" required>
                    </div>
                    <div class="fila">
                        <label for="municipio">Ciudad:</label>
                        <input type="text" id="municipio" name="municipio" required>
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
                        <label for="asentamiento">Colonia:</label>
                        <select id="asentamiento" name="asentamiento" disabled>
                            <option value="">Selecciona un asentamiento</option>
                        </select>
                    </div>
                    <div class="fila">
                        <label for="referencias">Referencias:</label>
                        <textarea id="referencias" name="referencias" required></textarea>
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

<script>
    document.getElementById('codigo_postal').addEventListener('blur', async function () {
        const codigoPostal = this.value.trim();
        if (codigoPostal) {
            try {
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
                alert("Error al consultar los datos del código postal");
            }
        }
    });
</script>

<x-pie />
