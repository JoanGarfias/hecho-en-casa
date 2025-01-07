<x-menu />
</head>
<body>
  <div class="main-container">
    
    <!-- Título de la página -->
    <h1 class="page-title">MI PERFIL</h1>

    <!-- Tarjeta de perfil -->
    <div class="profile-card">
      <div class="user-info">
        <img src="Icon/IconCuenta.png" alt="Foto de usuario" class="user-photo">
        <h2 class="user-name">HÉCTOR PÉREZ LÓPEZ</h2>
      </div>
      <div class="details">
        <div class="left-column">

            <button class="editar">
                <img src="Icon/IconEditar.png" alt="Editar"> Editar
            </button>

          <label>Número de tel.</label>
          <input type="text" value="000 000 0000" readonly>

          <label>Correo:</label>
          <input type="email" value="Hp190@gmail.com" readonly>

          <button class="editar">
            <img src="Icon/IconEditar.png" alt="Editar"> Editar
        </button>
          <label>Contraseña:</label>
          <input type="password" value="**********" readonly>
        </div>
        
        <div class="right-column">

            <button class="editar">
                <img src="Icon/IconEditar.png" alt="Editar"> Editar
            </button>

            <label>Ubicación de entrega</label>


          <label>C.P.:</label>
          <input type="text" value="70610" readonly>

          <label>Estado:</label>
          <input type="text" value="Oaxaca" readonly>

          <label>Ciudad:</label>
          <input type="text" value="Salina Cruz" readonly>

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
      <button class="save-button">
        <img src="Icon/IconSave.png" alt="Guardar"> Guardar
      </button>
    </div>
  </div>
</body>
<x-pie/>