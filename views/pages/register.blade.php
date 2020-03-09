@if (!$selector->get('logged',$member))
	@include('layouts.app')
		<div class="login-dark"> {{-- target => [folder.file],data] --}}
		{!! $hform->options(['target'=>['app.RequestHandler',['request'=>$request]],'method'=>'POST','class'=>'text-center'])->open($blade)!!}
	<?php //require(DIR.'/resources/others/messages.php'); ?>
		<div class="form-group"><input type="text" name="username" value="@isset($username){{$username}}@endisset" placeholder="Uživatel" class="form-control" required/></div>
		<div class="form-group"><input type="email" name="email" value="@isset($email){{$email}}@endisset" placeholder="Email" class="form-control" required/></div>
		<div class="form-group"><input type="password" name="password" placeholder="Heslo" class="form-control" required/></div>
		<div class="form-group"><input type="password" placeholder="Heslo (znovu)" name="password_again" class="form-control" required/></div>
		<div class="form-check text-left"><input type="checkbox" name="persistent_register" value="yes" class="form-check-input" id="formCheck-1" required/><label class="form-check-label text-left" for="formCheck-1">Souhlasím :<a href="http://staradventure.xf.cz/terms" class="forgot">Smluvní podmínky</a><a href="http://staradventure.xf.cz/vop" class="forgot">Ochrana soukromí</a></label></div><br/>
		<div class="form-group"><button class="btn btn-success btn-block" name="submit" type="submit" value="submit">Register</button></div><a href="http://staradventure.xf.cz/login" class="forgot">Máte již účet?</a>
		<hr/>
		<div class="g-recaptcha" id='recaptcha' data-sitekey="6LdKkYEUAAAAAE5Ykg8LY5gOPNXzgTyIG3FVuCqM" data-badge="inline" data-size="invisible" data-callback="onSubmit"></div>
		<input type="hidden" name="type" value='register'>   
		{!! $hform->close() !!}
		<script>onload();</script>
	</div>
	</body>
	</html>
@else 
	{{ header('Location: http://www.example.com/member/'.$member.'?action=logged') }}
@endif
