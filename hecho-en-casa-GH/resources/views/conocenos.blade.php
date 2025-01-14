<link rel="stylesheet" href="{{ asset('css/conociendo.css') }}">
<title>Conócenos</title>
<x-menu />    

<div class="flexi">
    
    <h2 class = "titule">CONÓCENOS</h2>

    <br>
    <div class="imagenes"> 
        <img src="{{ asset('img/reglas.png') }}" alt="Reglas">
        <img src="{{ asset('img/entregas.png') }}" alt="Entregas">
        
    </div>

    <img class="centrarCocinera" src="{{ asset('img/cocinera.png') }}" alt="Pastelera">

    <div class="contacto">
        <h3>Contactos</h3>
        <div class="redes">
            <a href="https://www.instagram.com/hechoencasapastry/"><img class="enlace" src="{{ asset('img/instagram.png') }}" alt="Instagram"></a>
            <a href="https://www.facebook.com/hechoencasapastry/"><img class="enlace" src="{{ asset('img/facebook.png') }}" alt="Facebook"></a>
            <a href="https://wa.me/9711242053"><img class="enlace" src="{{ asset('img/whatsapp.png') }}" alt="WhatsApp"></a>        
        </div>

    </div>
</div>

<x-pie/>
