@component('mail::message')
# Hello {{ $user->name }},

{!! nl2br(e($messageContent)) !!}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
