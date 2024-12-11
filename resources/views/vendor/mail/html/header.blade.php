@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://res.cloudinary.com/dpuqbsu8w/image/upload/v1732178543/lgo-removebg-preview_stekf4.png" class="logo" alt="Fshoes Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
