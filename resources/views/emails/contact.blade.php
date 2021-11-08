@component('mail::message')
	<div class="sub-header">
			<h3>New Contact Message</h3>
      </div>
<div class="content">
<p>Hello Admin Someone wants to talk</p>
<p> 
Name : {{$content['name']}}
</p>

<p> 
Email : {{$content['email']}}
</p>

<p> 
Message : {{$content['message']}}
</p>

<br>
<p> 
</p>
@endcomponent
</div>
