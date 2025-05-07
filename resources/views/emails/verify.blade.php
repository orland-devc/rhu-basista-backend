@component('mail::message')
# Verify Your Email

Hi {{ $user->name }},

Click the button below to verify your email address:

@component('mail::button', ['url' => $url])
Verify Email
@endcomponent

This link expires in 60 minutes.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
