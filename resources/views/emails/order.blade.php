@component('mail::message')
	<div class="sub-header">
			<h3>@lang('email.email_confrim_title')</h3>
      </div>
<div class="content">
<p>@lang('email.hello')  {{ $content['name'] }},</p>
<p>@lang('email.email_confrim_desc') </p>
<div class="btn-approval">
<?php  $url = url("confirm/" . $content['confirmation_code']);?>
@component('mail::button', ['url' => $url])
@lang('email.email_confrim_button')

@endcomponent
</div>
<br>
<p>
<?php  echo $url;?>
</p>
@endcomponent
</div>
