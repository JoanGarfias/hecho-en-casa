<link rel="stylesheet" href="{{ asset('css/CalEdit.css') }}">
   <title>Calendario - Elegir fechas</title>          
<x-menu />
            <body>

                <h1> CALENDARIO 2025 </h1>

                <div class="container">
                <div class="calendar" id="calendar">

                    <ol class="ol">
                        <li class='nom-dia'>Lun</li>
                        <li class='nom-dia'>Mar</li>
                        <li class='nom-dia'>Mie</li>
                        <li class='nom-dia'>Jue</li>
                        <li class='nom-dia'>Vie</li>
                        <li class='nom-dia'>Sab</li>
                        <li class='nom-dia'>Dom</li>
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
                <div class="tre">
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

                    <div class="arrows">
                        <button id="prev-month" class="arrow">⬅</button>
                        <button id="next-month" class="arrow">➡</button>
                    </div>
                </div>
                </div>
                <br>
            </body>
            <x-pie/>

            <script src="{{ asset('js/calEdit.js') }}"></script>
            <!--Para la animación del logo de usuario-->
<script src="{{ asset('js/icono.js') }}" defer></script>
