<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pedidos fijos</title>
</head>
<body>
    <form action="{{ route('fijo.detallesPedido.post') }}" method="POST">
        @csrf

        <label for="fecha-entrega">Fecha de entrega:</label>
        <input type="date" id="fecha-entrega" name="fecha_entrega" value="{{ session('fecha') }}">
        @error('fecha_entrega')
            <p style="color: red; font-size: 12px;">{{ $message }}</p>
        @enderror

        <label for="hora_entrega">Hora de entrega:</label>
        <input type="time" id="hora_entrega" name="hora_entrega" value="{{ session('hora_entrega') }}">
        @error('hora_entrega')
            <p style="color: red; font-size: 12px;">{{ $message }}</p>
        @enderror

        <label for="nombre_categoria">Tipo de postre:</label>
        <input type="text" id="nombre_categoria" name="nombre_categoria" value="{{ session('nombre_categoria') }}">
        @error('nombre_categoria')
            <p style="color: red; font-size: 12px;">{{ $message }}</p>
        @enderror

        <label for="sabor_postre">Sabor:</label>
        <input type="text" id="sabor_postre" name="sabor_postre" value="{{ session('sabor_postre') }}">
        @error('sabor_postre')
            <p style="color: red; font-size: 12px;">{{ $message }}</p>
        @enderror

        <label for="unidad_m"> 
            {{ session('lista_unidad')[0]['nombreunidad'] == 'Porciones' ? 'Porciones:' : 
            (session('lista_unidad')[0]['nombreunidad'] == 'Piezas' ? 'Piezas:' : 
            (session('lista_unidad')[0]['nombreunidad'] == 'Piezas Mini' ? 'Piezas mini:' : 'Cantidad:')) }}
        </label>

        <select id="unidadm" name="unidadm" onchange="sumarSeleccionado()">
            @if (session('lista_unidad') && count(session('lista_unidad')) > 0)
                @foreach (session('lista_unidad') as $unidad)
                <option value="{{ $unidad['cantidadporciones'] }}|{{ $unidad['nombreunidad'] }}|{{ $unidad['precio'] }}">
                    {{ $unidad['cantidadporciones'] }} {{ $unidad['nombreunidad'] }} - ${{ $unidad['precio'] }}
                </option>
                @endforeach
            @else
                <option>No hay opciones disponibles</option>
            @endif
        </select>

        @error('unidadm')
            <p style="color: red; font-size: 12px;">{{ $message }}</p>
        @enderror

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" min="{{session('cantidad_minima')}}" value="{{session('cantidad_minima')}}">
        @error('cantidad')
            <p style="color: red; font-size: 12px;">{{ $message }}</p>
        @enderror

        @if (!empty($atributosSesion))
            @foreach ($atributosSesion as $nombreTipo => $atributos)
                <label for="atributo_{{ strtolower($nombreTipo) }}">{{ ucfirst($nombreTipo) }}:</label>
                <select id="atributo_{{ strtolower($nombreTipo) }}" name="{{ strtolower($nombreTipo) }}" onchange="sumarSeleccionado()">
                    @foreach ($atributos as $atributo)
                        <option value="{{ $atributo['nom_atributo'] }}|{{ $atributo['precio_a'] }}">
                            {{ ucfirst($atributo['nom_atributo']) }} - ${{ number_format($atributo['precio_a'], 2) }}
                        </option>
                    @endforeach
                </select>
            @endforeach
        @endif

        <br>
        <br>
        <label>Tipo de entrega:</label>
        <br>
        <br>
        <div>
            <label>
                <input type="radio" name="tipo_entrega" value="Sucursal" 
                    {{ old('tipo_entrega', 'sucursal') == 'sucursal' ? 'checked' : '' }}> Recoger en sucursal
            </label>
            <label>
                <input type="radio" name="tipo_entrega" value="Domicilio" 
                    {{ old('tipo_entrega', 'sucursal') == 'domicilio' ? 'checked' : '' }}> Envío a domicilio
            </label>
        </div>

        @error('tipo_entrega')
            <p style="color: red; font-size: 12px;">{{ $message }}</p>
        @enderror

        <br>
        <label>Costo:</label><br>
        <input type="number" id="costo" name="costo" value="0" min="100" readonly><br><br>
        <button type="submit">Continuar</button>
    </form>

    <script>
        function sumarSeleccionado() {
            let total = 0;
            
            let opcionesSeleccionadas = document.getElementById("unidadm").selectedOptions;
            let cantidad = parseFloat(document.getElementById("cantidad").value);
            for (let i = 0; i < opcionesSeleccionadas.length; i++) {
                let opcion = opcionesSeleccionadas[i].value.split('|');
                let precioUnidad = parseFloat(opcion[2]);
    
                total += isNaN(precioUnidad) ? 0 : precioUnidad;
            }

            let selectsAtributos = document.querySelectorAll("select[id^='atributo']");
            selectsAtributos.forEach(select => {
                let opcionAtributoSeleccionada = select.selectedOptions[0];
                if (opcionAtributoSeleccionada) {
                    let precioAtributo = parseFloat(opcionAtributoSeleccionada.value.split('|')[1]);
                    total += isNaN(precioAtributo) ? 0 : precioAtributo;
                }
            });
            //Falto esto xd
            total *= cantidad;
            document.getElementById("costo").value = total.toFixed(2);
        }
    
        document.getElementById("cantidad").addEventListener('input', function() {
            sumarSeleccionado();  
        });

        window.onload = function() {
            sumarSeleccionado();
        };
    </script>
       
</body>
</html>