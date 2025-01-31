<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Domicilio</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Detalles de domicilio</h1>

    <form method="POST" action="{{ route('personalizado.direccion.post') }}">
        @csrf
        <label for="domicilio">Tipo de domicilio:</label>
        <select name="tipo_domicilio" id="domicilio">
            <option value="Default">Domicilio por defecto</option>
            <option value="Nueva">Nueva ubicación</option>
        </select>
        <div id="nuevaDireccion" style="display: none; margin-top: 20px;">
            <label for="codigo_postal">Código Postal:</label>
            <input type="number" id="codigo_postal" name="codigo_postal" maxlength="5" pattern="\d{5}" placeholder="Ingresa código postal">
            <a href="https://www.correosdemexico.gob.mx/SSLServicios/ConsultaCP/Descarga.aspx">Buscar mi CP.</a><br><br>
            
            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado" readonly placeholder="Estado"><br><br>

            <label for="municipio">Municipio:</label>
            <input type="text" id="municipio" name="municipio" readonly placeholder="Municipio" style="width: 190px;"><br><br>

            <label for="asentamiento">Colonia:</label>
            <select id="asentamiento" name="asentamiento" disabled>
                <option value="">Selecciona un asentamiento</option>
            </select><br><br>

            <label for="calle">Calle:</label>
            <input type="text" id="calle" name="calle" style="width: 190px;"><br><br>

            <label for="numeroI">Numero Interior:</label>
            <input type="number" id="numeroI" name="numeroI"><br><br>

            <label for="numeroE">Numero Exterior:</label>
            <input type="number" id="numeroE" name="numeroE"><br><br>

            <label for="aceptar">Establecer como ubicación predeterminada</label>
            <input type="checkbox" id="aceptar" name="aceptar" value="1"><br><br>
        </div>
        <button type="submit">Siguiente</button>
    </form>

    <script>
        $(document).ready(function () {
            /*$('#domicilio').on('change', function () {
                if ($(this).val() === 'Nueva') {
                    $('#nuevaDireccion').show();
                } else {
                    $('#nuevaDireccion').hide();
                }
            });*/

            if ($('#domicilio').val() === 'Nueva') {
                $('#nuevaDireccion').show();
            } else {
                $('#nuevaDireccion').hide();
            }

            $('#domicilio').on('change', function () {
                if ($(this).val() === 'Nueva') {
                    $('#nuevaDireccion').show();
                } else {
                    $('#nuevaDireccion').hide();
                }
            });

            $('#codigo_postal').on('blur', function () {
                let codigoPostal = $(this).val().trim();
                if (codigoPostal) {
                    $.ajax({
                        url: "{{ route('buscar') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            codigo_postal: codigoPostal
                        },
                        success: function (response) {
                            if (response.estado) {
                                $('#estado').val(response.estado);
                                $('#municipio').val(response.municipio);

                                let asentamientos = response.asentamientos;
                                let $asentamientoSelect = $('#asentamiento');
                                $asentamientoSelect.empty();
                                $asentamientoSelect.append('<option value="">Selecciona un asentamiento</option>');

                                if (asentamientos && asentamientos.length > 0) {
                                    asentamientos.forEach(function(asentamiento) {
                                        //$asentamientoSelect.append('<option value="' + asentamiento.id_asenta_cpcons + '">' + asentamiento.asentamiento + '</option>');
                                        $asentamientoSelect.append('<option value="' + asentamiento.asentamiento + '">' + asentamiento.asentamiento + '</option>')
                                    });
                                    $asentamientoSelect.prop('disabled', false);
                                } else {
                                    $asentamientoSelect.append('<option value="">No se encontraron asentamientos</option>');
                                    $asentamientoSelect.prop('disabled', true);
                                }
                            } else {
                                $('#estado').val('');
                                $('#municipio').val('');
                                alert("No se pudo obtener el estado o municipio para ese código postal.");
                            }
                        },
                        error: function () {
                            alert("Error al buscar los datos del código postal.");
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
