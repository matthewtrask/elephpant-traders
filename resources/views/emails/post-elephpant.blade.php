@component('mail::message')
# Elephpant Trade

Hi!

You recently signed up to trade elephpants, which is super awesome! But in order to
trade elephpants, we need some elephpants posted to get this party started!

Do you have any elephpants you are willing to trade away? If so, get them posted so we can start moving this herd!

@component('mail::button', ['url' => env('APP_LOGIN')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
