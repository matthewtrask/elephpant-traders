@component('mail::message')
    ##Hello {{ $trade->buyer->name }}!

    {{ $trade->seller->name }} has accepted your offer to trade Elephpants! This is exciting!

    The next step is to contact {{ $trade->seller->name }} through their email and set up the trade.

    In the coming months, we will be adding more features that will help make this easier!

    {{ $trade->seller->name }}'s email is {{ $trade->seller->email }}.

    If you do not hear anything within a week, please email the site at help@elephpanttrade.com and we will help you get it sorted out!

    Happy trading!
@endcomponent