
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

      <button class="save-button">
      <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0I
      Ars4c6QAAAMJJREFUSEvtldENgkAQRB+dSCdaipVQCqVgJ9qJOoTlY+GyrHIkJu4PAXL7mLsZtqFyNZX7czjgDP
      TAKaHsAVwAXRflFQyAINkqQjzgOXW253ZvQP+8BfRRUrwK+Rag9WpehGQBfutsvYdI2Vh7AdRLkLvvGwGyh+3PM
      FTw+4AoeLLm9Z2d2yQ1vUVbgieIuSYNWCxwh1IK5myeyEV/QJiD3bdoi2ui8Mmymg+r/yL5vvtwJqihz8XxIzOS
      n35ffei/AFYKQRkaGHKwAAAAAElFTkSuQmCC" alt="Guardar"> Guardar
      </button>

      <div class="user-info">
        <img src="Icon/IconCuenta.png" alt="Foto de usuario" class="user-photo">
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

          <<button class="editar">
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

            <button class="editar">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AA
            AAAXNSR0IArs4c6QAAAP5JREFUSEvFlf0VgjAMxMMmuomO4iSMopvoKG6i/HyEV0LTD0qf/adQwl3ukr
            aDdB5DZ3w5iuAkIhcRediELQFB9ymQH1LjOgG+5oDnDM7rW0T4xvwbliAM9ghi4ApIYjyfPYKPQxwj02
            QUEHDWmG9ql1VQSuDZoutNBGHmKFNbUEINd1sEEA0QgoS2aJEX/2NF9iyKgWtdbC1W9SqpQS04CrWFN21
            qFXjg3jrgKFoSzymIyU8p2licIyhVpL43EaQybyYIO2PV52aL71agOClwYqoJaq+L/xOUHNc5VWwyjvTof
            cBGGYMLJAdmv1MjTlJ3J9cCZuOPupNdou4EX5hRUxlWng/uAAAAAElFTkSuQmCC"alt="Editar"> Editar
            </button>

            <label>Ubicación de entrega</label>
              
              <label>C.P.:</label>
              <input type="text" value="70610" readonly>

              <label>Estado:</label>
              <input type="text" value="Oaxaca" readonly>

              <label>Ciudad:</label>
              <input type="text" value="Salina Cruz" readonly> 
           </div>

            <div class="right-columnd">
              <label>Calle:</label>
              <input type="text" value="Oleoducto esq. 18 de Marzo" readonly>

              <label>Número int:</label>
              <input type="text" value="S/N" readonly>

              <label>Número ext:</label>
              <input type="text" value="S/N" readonly>

              <label>Colonia:</label>
              <input type="text" value="Hidalgo Oriente" readonly>
            </div>
        </div>
      </div>
    </div>
  </div>
</body>

<x-pie/>
