@component('mail::message')
    ##Dear {{ $trade->buyer->name }},

    The trade for {{ $trade->elephpant->title }} you have requested has been declined.

    We hope you have luck finding another elephpant you like!

@endcomponent