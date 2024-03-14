@component('mail::message')
Hello {{ $user->name }},

We understand it happens.

@component('mail::button', ['url' => url('reset/' . $user->remember_token)])
Reset Your Password
@endcomponent

In case you have any issues regarding your password, please contact us.

Thanks,<br>
{{ config('app.name') }}
@endcomponent