@component('mail::message')
    ##Hello {{ $trade->seller->name }}!

    {{ $trade->buyer->name }} has been told about the impending trade! This is exciting!

    The next step is to contact {{ $trade->buyer->name }} through their email and set up the trade.

    In the coming months, we will be adding more features that will help make this easier!

    {{ $trade->buyer->name }}'s email is {{ $trade->buyer->email }}.

    If you do not hear anything within a week, please email the site at help@elephpanttrade.com and we will help you get it sorted out!

    Happy trading!
@endcomponent