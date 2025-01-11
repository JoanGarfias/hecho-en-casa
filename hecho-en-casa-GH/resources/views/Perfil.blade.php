
<title>Perfil de Usuario</title>
<link rel="stylesheet" href="{{ asset('css/Perfil.css') }}">

  <x-menu /> 

</head>
<body>

<!-- Título de la página -->
<h1>MI PERFIL</h1>

  <div class="main-container">
    <!-- Tarjeta de perfil -->
    <div class="profile-card">

      <button class="save-button"disabled>
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0I
        Ars4c6QAAAMJJREFUSEvtldENgkAQRB+dSCdaipVQCqVgJ9qJOoTlY+GyrHIkJu4PAXL7mLsZtqFyNZX7czjgDP
        TAKaHsAVwAXRflFQyAINkqQjzgOXW253ZvQP+8BfRRUrwK+Rag9WpehGQBfutsvYdI2Vh7AdRLkLvvGwGyh+3PM
        FTw+4AoeLLm9Z2d2yQ1vUVbgieIuSYNWCxwh1IK5myeyEV/QJiD3bdoi2ui8Mmymg+r/yL5vvtwJqihz8XxIzOS
        n35ffei/AFYKQRkaGHKwAAAAAElFTkSuQmCC" alt="Guardar"> Guardar
      </button>

      <div class="user-info">
      <img src="data:image/png;base64,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" 
        alt="Foto de usuario" class="user-photo"/>
      
      
        <h2 class="user-name">HÉCTOR PÉREZ LÓPEZ</h2>
      </div>

      <div class="details">
        <div class="left-column">

            <button class="editarTel">
              <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AA
              AAAXNSR0IArs4c6QAAAP5JREFUSEvFlf0VgjAMxMMmuomO4iSMopvoKG6i/HyEV0LTD0qf/adQwl3ukr
              aDdB5DZ3w5iuAkIhcRediELQFB9ymQH1LjOgG+5oDnDM7rW0T4xvwbliAM9ghi4ApIYjyfPYKPQxwj02
              QUEHDWmG9ql1VQSuDZoutNBGHmKFNbUEINd1sEEA0QgoS2aJEX/2NF9iyKgWtdbC1W9SqpQS04CrWFN21
              qFXjg3jrgKFoSzymIyU8p2licIyhVpL43EaQybyYIO2PV52aL71agOClwYqoJaq+L/xOUHNc5VWwyjvTof
              cBGGYMLJAdmv1MjTlJ3J9cCZuOPupNdou4EX5hRUxlWng/uAAAAAElFTkSuQmCC"alt="Editar"> Editar
        
            </button>

          <label>Número de tel.</label>
          <input type="text" value="000 000 0000" readonly>

          <label>Correo:</label>
          <input type="email" value="Hp190@gmail.com" readonly>

          <button class="editarPas">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AA
            AAAXNSR0IArs4c6QAAAP5JREFUSEvFlf0VgjAMxMMmuomO4iSMopvoKG6i/HyEV0LTD0qf/adQwl3ukr
            aDdB5DZ3w5iuAkIhcRediELQFB9ymQH1LjOgG+5oDnDM7rW0T4xvwbliAM9ghi4ApIYjyfPYKPQxwj02
            QUEHDWmG9ql1VQSuDZoutNBGHmKFNbUEINd1sEEA0QgoS2aJEX/2NF9iyKgWtdbC1W9SqpQS04CrWFN21
            qFXjg3jrgKFoSzymIyU8p2licIyhVpL43EaQybyYIO2PV52aL71agOClwYqoJaq+L/xOUHNc5VWwyjvTof
            cBGGYMLJAdmv1MjTlJ3J9cCZuOPupNdou4EX5hRUxlWng/uAAAAAElFTkSuQmCC"alt="Editar"> Editar
        
            </button>

          <label>Contraseña:</label>
          <input type="password" value="**********" readonly>
        </div>

            <div class="left-columnd">

              <button class="editarDir">
              <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AA
              AAAXNSR0IArs4c6QAAAP5JREFUSEvFlf0VgjAMxMMmuomO4iSMopvoKG6i/HyEV0LTD0qf/adQwl3ukr
              aDdB5DZ3w5iuAkIhcRediELQFB9ymQH1LjOgG+5oDnDM7rW0T4xvwbliAM9ghi4ApIYjyfPYKPQxwj02
              QUEHDWmG9ql1VQSuDZoutNBGHmKFNbUEINd1sEEA0QgoS2aJEX/2NF9iyKgWtdbC1W9SqpQS04CrWFN21
              qFXjg3jrgKFoSzymIyU8p2licIyhVpL43EaQybyYIO2PV52aL71agOClwYqoJaq+L/xOUHNc5VWwyjvTof
              cBGGYMLJAdmv1MjTlJ3J9cCZuOPupNdou4EX5hRUxlWng/uAAAAAElFTkSuQmCC"alt="Editar"> Editar
              </button>

              <label>Ubicación de entrega</label>
              
              <label>C.P :</label>
              <input type="text" value="70610" readonly>

              <label>Estado:</label>
              <input type="text" value="Oaxaca" readonly>

              <label>Ciudad:</label>
              <input type="text" value="Salina Cruz" readonly>
            </div>

            <div class="right-columnd">
              <label>Calle:</label>
              <input id="calle" type="text" value="Oleoducto esq. 18 de Marzo" readonly>

              <label>Número int:</label>
              <input id="numero-int" type="text" value="S/N" readonly>

              <label>Número ext:</label>
              <input id="numero-ext" type="text" value="S/N" readonly>

              <div class="form-control">
                <label>Colonia:</label>
                <select name="colonia" id="colonia" disabled>
                    <option value="">Selecciona una Colonia:</option>
                    <option value="Porfirio">Porfirio Díaz</option>
                    <option value="hidalgo oriente">Hidalgo Oriente</option>
                    <option value="centro">Centro</option>
                    <option value="barrio espinal">Barrio Espinal</option>
                </select>
                    <p></p>
              </div>

            </div>
        </div>
      </div>
    </div>
  </div>
</body>

<script src="{{ asset('js/Perfil.js') }}"></script>

<x-pie/>
