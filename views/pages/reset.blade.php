@if (!$member->logged)
@include('layouts.app')
<div class="login-dark">
    {!! $hform->options(['target'=>['app.RequestHandler',['requestController'=>$requestController,'request'=>$request]],'method'=>'POST','class'=>'text-center'])->open($blade)!!}
@include('extras.messages',['selector'=>$selector,'message'=>$message,'requestController'=>$requestController])
    <div class="form-group"><input type="email" name="email" value="@isset($email){{$email}}@endisset" placeholder="Email" class="form-control" required/></div>
    <div class="form-group"><button class="btn btn-success btn-block" name="submit" type="submit" value="submit">Odeslat</button></div>
    <a href="http://sadventure.com/index" class="forgot">Úvodní stránka</a><a href="http://sadventure.com/login" class="forgot">Přihlášení</a>
    <input type="hidden" name="reset_send_email" value='reset_send_email'>   
    {!! $hform->close() !!}
    </div>
</body>

</html>
@else 
	{{ header('Location: http://sadventure.com/member/'.$member->username.'?action=logged') }}
@endif