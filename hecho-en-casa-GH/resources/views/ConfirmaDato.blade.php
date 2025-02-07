
<title>CONFIRMA TUS DATOS</title>
<link rel="stylesheet" href="{{ asset('css/mensajeErrorE.css') }}">
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
         <div id="address-fields" class="address-fields dosColumnas">
            <div class="columna">
               <div class="fila">
                  <label for="codigo-postal">Código postal:</label>
                  <input type="text" id="codigo_postal" name="codigo_postal" maxlength="5" pattern="\d{5}" placeholder="Ingresa código postal" onfocus="borrarParrafo('mensajeCodigo')">
                  
                  <div class="mensajito">
                     <p id="mensajeCodigo"></p>
                  </div>
               </div>
               

               <p>
                  <a href="https://www.correosdemexico.gob.mx/sslservicios/consultacp/descarga.aspx" target="_blank">
                     No conozco mi código postal 
                     <p></p>
                  </a>
               </p>
               
               <div class="fila">
                  <label for="estado">Estado:</label>
                  <input type="text" id="estado" name="estado" onfocus="borrarParrafo('mensajeEstado')" readonly>
                  <div class="mensajito">
                     <p id="mensajeEstado" ></p>
                  </div>
               </div>

               <div class="fila">
                  <label for="ciudad">Ciudad:</label>
                  <input type="text" id="ciudad" name="ciudad" onfocus="borrarParrafo('mensajeMuni')" readonly>
                  <div class="mensajito">
                     <p id="mensajeMuni"></p>
                  </div>
               </div>

               <div class="fila">
                  <label for="calle">Calle:</label>
                  <input type="text" id="calle" name="calle" onfocus="borrarParrafo('mensajeCalle')">
                  <div class="mensajito">
                     <p id="mensajeCalle" ></p>
                  </div>
               </div>

               <div class="checklist">
                  <label>
                     <input type="checkbox" name="opciones" value="opcion1"> Establecer como predeterminada
                  </label>
               </div>
            </div>

            <div class="columna">
               <div class="fila">
                  <label for="numero">Número int:</label>
                  <input type="text" id="numeroInt" name="numeroI" onfocus="borrarParrafo('mensajeInt')">
                  <div class="mensajito">
                     <p id="mensajeInt"></p>
                 </div>
               </div>

               <div class="fila">
                  <label for="numero">Número ext:</label>
                  <input type="text" id="numeroExt" name="numeroE" onfocus="borrarParrafo('mensajeExt')">
                  <div class="mensajito">
                     <p id="mensajeExt" ></p>
                 </div>
               </div>

               <div class="fila form-control">
                  <label>Colonia:</label>
                  <select id="asentamiento" name="asentamiento" onfocus="borrarParrafo('mensajeAsent')" disabled>
                     <option value="">Selecciona un asentamiento</option>
                  </select><br><br>
                  <div class="mensajito">
                     <p id="mensajeAsent" ></p>
                 </div>
               </div>

               <div class="fila">
                  <label for="referencias">Referencias:</label>
                  <input type="text" id="referencias" name="referencia" onfocus="borrarParrafo('mensajeRef')">
                  <div class="mensajito">
                     <p id="mensajeRef"></p>
                  </div>
               </div>
            </div>
         </div>

         <!-- Botón confirmar -->
         <button type="submit">Confirmar</button>
      </form>
   </div>
   </div>
   <div id="mensajeEmergente"></div>
   <script>
      $(document).ready(function () {
         document.getElementById('codigo_postal').addEventListener('input', async function () {
         // Manejar el clic del botón "Confirmar CP"
            let valido = true
            const codigoPostal = this.value.trim();// Obtener el valor del código postal
            
            if (codigoPostal.length >= 5) { // Validar que no esté vacío
               document.getElementById("mensajeEstado").textContent = '';
               document.getElementById("mensajeMuni").textContent = ''
    
               mostrarMensaje("Espere un momento, por favor")

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
                           valido = false
                           mostrarMensaje("No se pudo obtener el estado o ciudad para ese código postal.");
                        }
                     },
                     error: function () {
                        // Manejo de error en la solicitud AJAX
                        valido = false
                        mostrarMensaje("Error al buscar los datos del código postal.");
                     }
               });
            } 
            if (!valido) {
               // Validar si el código postal está vacío
               mostrarMensaje("Por favor, ingresa un código postal válido.");
            }
         });
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


<script src="{{ asset('js/ConfirmaDato.js') }}"></script>
<!--Para borrar el parrafo al hacer click al input-->
<script src="{{ asset('js/borrandoParrafo.js') }}" defer></script>

</body>

<x-pie/>