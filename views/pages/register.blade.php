@extends('layouts.app')
@section('register')
@if (!$member->loggedin)
<div class="login-dark">
{!! $form->create(['target'=>['extras.RequestHandler',['requestController'=>$requestController,'request'=>$request]],'method'=>'POST','class'=>'text-center'])->run($blade)!!}
@include('extras.messages',['selector'=>$selector,'message'=>$message])
	<div class="form-group"><input type="text" name="username" value="@isset($selector->oldData['username']){{$selector->oldData['username']}}@endisset" placeholder="Uživatel" class="form-control" required/></div>
	<div class="form-group"><input type="email" name="email" value="@isset($selector->oldData['email']){{$selector->oldData['email']}}@endisset" placeholder="Email" class="form-control" required/></div>
	<div class="form-group"><input type="password" name="password" placeholder="Heslo" class="form-control" required/></div>
	<div class="form-group"><input type="password" placeholder="Heslo (znovu)" name="password_again" class="form-control" required/></div>
	<div class="form-check text-left"><input type="checkbox" name="persistent_register" value="yes" class="form-check-input" id="formCheck-1" required/><label class="form-check-label text-left" for="formCheck-1">Souhlasím :<a href="http://sadventure.com/terms" class="forgot">Smluvní podmínky</a><a href="http://sadventure.com/vop" class="forgot">Ochrana soukromí</a></label></div><br/>
	<div class="form-group"><button class="btn btn-success btn-block" name="submit" type="submit" value="submit">Register</button></div><a href="http://sadventure.com/login" class="forgot">Máte již účet?</a><hr/>
	<div class="g-recaptcha" id='recaptcha' data-sitekey="6LdKkYEUAAAAAE5Ykg8LY5gOPNXzgTyIG3FVuCqM" data-badge="inline" data-size="invisible" data-callback="onSubmit"></div>
	<input type="hidden" name="_crf" value='{{$blade->getCsrfToken()}}'>
	<input type="hidden" name="type" value='register'>   
</form>
	<script>onload();</script>
	</div>
	</body>
</html>
@else
{{ \header('Location: http://sadventure.com/member/'.$member->username.'?action=logged')}}
@endif
@endsection

