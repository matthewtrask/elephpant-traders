@component('mail::message')
<h2>Hello {{ $trade->seller->name }}!</h2>

<p>A trade has been requested for {{ $trade->elephpant->title }}.</p>

<p>To accepted or reject the offer, go to your <a href="{{ getenv('APP_URL') }}/#/profile">profile</a> and
on the trade section, approve or reject the offer.</p>

<p>If you accept, you will get an email with the details to contact the person who made the offer.</p>

<p>Kthxbye <3</p>
@endcomponent