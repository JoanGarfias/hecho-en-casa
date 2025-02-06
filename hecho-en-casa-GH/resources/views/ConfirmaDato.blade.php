
<title>CONFIRMA TUS DATOS</title>
<link rel="stylesheet" href="{{ asset('css/ConfirmaDato.css') }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<x-menu /> 
  
</head>
<body>
   <h1>CONFIRMA TUS DATOS</h1>
   
   
   <div class="main-container">
    <div class="container">
      <form id="direccion" action="{{route($rutaPost)}}" method="POST">
         @csrf
           <!-- Teléfono -->
           <label for="telefono">Teléfono:</label>
           <input type="text" id="telefono" name="telefono" value="{{session('telefono')}}" placeholder="{{session('telefono')}}">

  
           <!-- Ubicación del pedido -->
            <div class="radio-group">
               <label><input type="radio" name="ubicacion" value="predeterminada" onclick="toggleAddressFields()"> {{session('direccion')}}</label>
               <label><input type="radio" id="other" name="ubicacion" value="otra" onclick="toggleAddressFields()"> Otra...</label>
         </div>

         <!-- Vista emergente para ingresar nueva dirección -->
         <div id="address-fields" class="address-fields">
               <label for="codigo-postal">Código postal:</label>
               <input type="text" id="codigo_postal" name="codigo_postal" maxlength="5" pattern="\d{5}" placeholder="Ingresa código postal">

               <div id="botonCP" class="botonCP">
                  <button type="button" id="confirm-cp">
                  <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34
                  AAAAAXNSR0IArs4c6QAAAPBJREFUSEvNlIENwjAMBL+bwCYwCpPQTWATYBM2gb6UR6lJSOJQaKSq
                  iqL82Y7fAxZew8L6sIAdgBOAjRN8B3AAcNV9C7hMh4T0LEK2OcAjHHhL93bfCq0KwHfie92mrMeQ
                  +dcykDjfK665C8DozkGIgebEedYMoPgxiO9DGVgWG7maphnAaNm6/LMU/HLirgxUEkG4n/W5MUxz
                  BrqvTLh/mSjhRjdAmTD6T6sLUDM+/g/IDTuWhm2qEsVesJlxkqqlk+OafZ+aqIJQUF6w4sVxnapz
                  qxdmGrVjOYaUvOACxIYrecENqPVCF6DGC78FPAFFD0MZXIF3GgAAAABJRU5ErkJggg=="/>Confirmar CP
                  </button>
               </div>

               <p>
                  <a href="https://www.correosdemexico.gob.mx/sslservicios/consultacp/descarga.aspx" target="_blank">
                     No conozco mi código postal
                     <p></p>
                  </a>
               </p>

               <label for="estado">Estado:</label>
               <input type="text" id="estado" name="estado">

               <label for="ciudad">Ciudad:</label>
               <input type="text" id="ciudad" name="municipio">

               <div class="form-control">
                  <label>Colonia:</label>
                  <select id="asentamiento" name="asentamiento" disabled>
                     <option value="">Selecciona un asentamiento</option>
                  </select><br><br>
            </div>

               <label for="calle">Calle:</label>
               <input type="text" id="calle" name="calle">

               <label for="numero">Número int:</label>
               <input type="text" id="numeroInt" name="numeroI">

               <label for="numero">Número ext:</label>
               <input type="text" id="numeroExt" name="numeroE">
               
               <label for="referencias">Referencias:</label>
               <input type="text" id="referencias" name="referencia">
            <div class="checklist">
               <label>
                  <input type="checkbox" name="opciones" value="opcion1"> Establecer como predeterminada
               </label>
            </div>

         </div>

         <!-- Botón confirmar -->
         <button type="submit">Confirmar</button>
      </form>
   </div>
   </div>
   <script>
      $(document).ready(function () {
         // Manejar el clic del botón "Confirmar CP"
         $('#confirm-cp').on('click', function () {
            let codigoPostal = $('#codigo_postal').val().trim(); // Obtener el valor del código postal
            
            if (codigoPostal) { // Validar que no esté vacío
               $.ajax({
                     url: "{{ route('buscar') }}", // Ruta nombrada en Laravel
                     method: "POST",
                     data: {
                        _token: "{{ csrf_token() }}", // CSRF token para la seguridad
                        codigo_postal: codigoPostal // Enviar el código postal
                     },
                     success: function (response) {
                        if (response.estado) { // Si la respuesta contiene datos válidos
                           $('#estado').val(response.estado); // Llenar el campo estado
                           $('#ciudad').val(response.municipio); // Llenar el campo ciudad

                           let asentamientos = response.asentamientos; // Lista de asentamientos
                           let $asentamientoSelect = $('#asentamiento'); // Campo select para asentamientos
                           $asentamientoSelect.empty(); // Limpiar las opciones previas

                           // Agregar una opción inicial
                           $asentamientoSelect.append('<option value="">Selecciona un asentamiento</option>');

                           // Llenar las opciones con los datos recibidos
                           if (asentamientos && asentamientos.length > 0) {
                                 asentamientos.forEach(function (asentamiento) {
                                    $asentamientoSelect.append('<option value="' + asentamiento.asentamiento + '">' + asentamiento.asentamiento + '</option>');
                                 });
                                 $asentamientoSelect.prop('disabled', false); // Habilitar el campo select
                           } else {
                                 // Mostrar mensaje si no hay asentamientos
                                 $asentamientoSelect.append('<option value="">No se encontraron asentamientos</option>');
                                 $asentamientoSelect.prop('disabled', true); // Deshabilitar el campo select
                           }
                        } else {
                           // Manejo de error si no se encuentra el estado o municipio
                           $('#estado').val('');
                           $('#ciudad').val('');
                           alert("No se pudo obtener el estado o ciudad para ese código postal.");
                        }
                     },
                     error: function () {
                        // Manejo de error en la solicitud AJAX
                        alert("Error al buscar los datos del código postal.");
                     }
               });
            } else {
               // Validar si el código postal está vacío
               alert("Por favor, ingresa un código postal válido.");
            }
         });
      });
   </script>


<script src="{{ asset('js/ConfirmaDato.js') }}"></script>

</body>

<x-pie/>