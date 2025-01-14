<link rel="stylesheet" href="{{ asset('css/pastel.css') }}"> <!-- Ruta absoluta -->
<title>Inicio</title>
<x-menu-catalogo/>
<x-menu />

<body>
<div class="container">
    <h1>PASTELES</h1>
    <div class="image-gallery">
        <div class="image-card">
            <img src="{{ asset('img/pastel1.jpg') }}" alt="Pastel 1">
        </div>
        <div class="image-card">
            <img src="{{ asset('img/pastel2.jpg') }}" alt="Pastel 2">
        </div>
        <div class="image-card">
            <img src="{{ asset('img/pastel3.jpg') }}" alt="Pastel 3">
        </div>
        <div class="image-card">
            <img src="{{ asset('img/pastel2.jpg') }}" alt="Pastel 4">
        </div>
    </div>
    <div class="description-section">
        <div class="description">
            <p>Contamos con variedad de pasteles personalizados para diferentes eventos: bodas, XV años, cumpleaños y más.</p>
        </div>
        <form action="{{route('personalizado.catalogo.post')}}" method="POST">
            <div class="customize">
                <button class="personaliza">
                    <img src="{{ asset('img/varita.png') }}" alt="Personaliza tu pastel">
                    <span>Personaliza tu pastel</span>
                </button>
            </div>
        </form>
    </div>
</div>
<x-pie/>
</body>


