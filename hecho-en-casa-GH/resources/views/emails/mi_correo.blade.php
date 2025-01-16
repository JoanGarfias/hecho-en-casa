<x-mail::message>

<h1 class="texto">Olvidaste tu contraseña  :(</h1>
<br>
        
<p>No te preocupes :D</p>
<p>Ingresa al siguiente enlace para obtener una nueva: </p>
<a href="#" onclick="document.getElementById('recuperar-form').submit()">hechoencasa.com/recuperacion/{{$token}}</a>
    
<form id="recuperar-form" action="{{ route('recuperacion.get', ['token' => $token]) }}" method="POST" style="display: none;">
@csrf
</form>
</x-mail::message>

