@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://i.ibb.co/gmdQwsJ/loguito.png" class="logo" alt="Hecho en casa Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
