<!--No está identado a propósito. No critiquen-->

<x-mail::message>   
<div class="centrando">
<h1 class="texto">¡Gracias por registrarte!</h1>
<p>Gracias por usar nuestra aplicación.</p>
<p>Entra al siguiente enlace:</p>
<a href="#" onclick="document.getElementById('registrar').submit()">blue-emu-830907.hostingersite.com</a>
        
<form id="registrar" action="{{ route('inicio.get')}}" method="POST" style="display: none;">
@csrf
</form>
</div> 
</x-mail::message>