@component('mail::message')
# Introduccion al cambio de contraseña

Mensaje para reestablecer su constraseña

@component('mail::button', ['url' => 'http://localhost:4200/response-password-reset?token='.$token])
Reestablecer
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent