@component('mail::message')
	<div class="sub-header">
			<h3>Title</h3>
      </div>
<div class="content">
<p>Hello  {{ $content['name'] }},</p>

<div class="btn-approval">
<?php  $url = url("/");?>
@component('mail::button', ['url' => $url])
Button
@endcomponent
</div>
<br>
<p>
paragraph onece more 
</p>
@endcomponent
</div>
