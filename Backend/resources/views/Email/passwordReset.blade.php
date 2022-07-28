@component('mail::message')
# Introduccion al cambio de contraseña

Mensaje para reestablecer su constraseña

@component('mail::button', ['url' => 'http://localhost:8080/Reset?resetToken='.$token])
Reestablecer
@endcomponent

Garcias,<br>
{{ config('app.name') }}
@endcomponent