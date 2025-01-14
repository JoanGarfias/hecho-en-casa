<link rel="stylesheet" href="{{ asset('css/CalEdit.css') }}">
   <title>Calendario - Elegir fechas</title>          
<x-menu />
            <body>

                <h1> CALENDARIO 2025 </h1>

                <div class="container">
                <div class="calendar" id="calendar">

                    <ol class="ol">
                        <li class='nom-dia'>L</li>
                        <li class='nom-dia'>M</li>
                        <li class='nom-dia'>M</li>
                        <li class='nom-dia'>J</li>
                        <li class='nom-dia'>V</li>
                        <li class='nom-dia'>S</li>
                        <li class='nom-dia'>D</li>
                    </ol>
                            <!-- Lista de días del mes
                            <li class='primer-dia'>1</li>
                            <li class='dias-semana'>2</li>
                            <li class='dias-semana'>3</li>
                            <li class='dias-semana'>4</li>
                            <li class='dias-semana'>5</li>
                            <li class='dias-semana'>6</li>
                            <li class='dias-semana'>7</li>
                            <li class='dias-semana'>8</li>
                            <li class='dias-semana'>9</li>
                            <li class='dias-semana'>10</li>
                            <li class='dias-semana'>11</li>
                            <li class='dias-semana'>12</li>
                            <li class='dias-semana'>13</li>
                            <li class='dias-semana'>14</li>
                            <li class='dias-semana'>15</li>
                            <li class='dias-semana'>16</li>
                            <li class='dias-semana'>17</li>
                            <li class='dias-semana'>18</li>
                            <li class='dias-semana'>19</li>
                            <li class='dias-semana'>20</li>
                            <li class='dias-semana'>21</li>
                            <li class='dias-semana'>22</li>
                            <li class='dias-semana'>23</li>
                            <li class='dias-semana'>24</li>
                            <li class='dias-semana'>25</li>
                            <li class='dias-semana'>26</li>
                            <li class='dias-semana'>27</li>
                            <li class='dias-semana'>28</li>
                            <li class='dias-semana'>29</li>
                            <li class='dias-semana'>30</li>
                            <li class='dias-semana'>31</li> -->
                    
                     <!-- Números de los días -->
                     <ol class="numbers" id="numbers">
                        <!-- Los días se generarán dinámicamente -->
                    </ol>
                    
                </div>
                <div class="cuacro">
                    <div class="legend">
                        <p><span class="closed"></span> Fechas cerradas</p>
                        <p><span class="current"></span> Fecha actual</p>
                        <p><span class="available"></span> Disponible</p>
                    </div>

                    <div class="hour">
                        <label for="time" class="seleccionarHora">Seleccionar hora:</label>
                        <div class="hora-selector">
                            <input type="time" id="horaEntrega" name="horaEntrega" min="11:00" max="19:00" required>
                            <div class="boton-wrapper">
                                <button type="button" id="incrementarHora" class="hora-boton">🔺</button>
                                <button type="button" id="decrementarHora" class="hora-boton">🔻</button>                                        
                            </div>
                        </div>
                    </div>
                    <div class="botAceptar">
                        <button class="aceptandoFecha">Aceptar fecha y hora</button>
                    </div>

                    <form action="{{route('calendario.post')}}" method="POST" id="cambioFecha">
                        @csrf
                        <input type="hidden" name="mes" id="mes" value="">
                        <input type="hidden" name="anio" id="anio" value="">
                        <input type="hidden" name="fechaSeleccionada" id="fechaSeleccionada" value="">
                        <div class="arrows">
                            <button type="submit" id="prev-month" class="arrow">⬅</button>
                            <button type="submit" id="next-month" class="arrow">➡</button>
                        </div>                        
                    </form>
                </div>
                </div>
                <br>
                <script>
                    const calendario = @json($calendarioJson);

                    const months = [
                        { bg: "url('{{ asset('img/enero.png') }}')" },
                        { bg: "url('{{ asset('img/febrero.png') }}')" },
                        { bg: "url('{{ asset('img/marzo.png') }}')" },
                        { bg: "url('{{ asset('img/abril.png') }}')" },
                        { bg: "url('{{ asset('img/mayo.png') }}')" },
                        { bg: "url('{{ asset('img/junio.png') }}')" },
                        { bg: "url('{{ asset('img/julio.png') }}')" },
                        { bg: "url('{{ asset('img/agosto.png') }}')" },
                        { bg: "url('{{ asset('img/septiembre.png') }}')" },
                        { bg: "url('{{ asset('img/octubre.png') }}')" },
                        { bg: "url('{{ asset('img/noviembre.png') }}')" },
                        { bg: "url('{{ asset('img/diciembre.png') }}')" },
                    ];        
                    
                    
                </script>
            </body>
            <x-pie/>
            <script src="{{ asset('js/calEdit.js') }}" defer></script>
            <script src="{{ asset('js/meses.js') }}" defer></script>
           
            
            <!--Para la animación del logo de usuario-->
<script src="{{asset ('js/despliegue-menu.js')}}" defer> </script>
<script src="{{ asset('js/icono.js') }}" defer></script>
