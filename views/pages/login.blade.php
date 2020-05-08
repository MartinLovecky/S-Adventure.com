@include('layouts.app')
@if (!$member->logged)
<div class="login-dark">
    {!! $hform->create(['target'=>['app.RequestHandler',['requestController'=>$requestController,'request'=>$request]],'method'=>'POST','class'=>'text-center'])!!}
@include('extras.messages',['selector'=>$selector,'message'=>$message,'requestController'=>$requestController])    
    <div class="form-group"><input type="text" name="username" value="@isset($username){{$username}}@endisset" placeholder="Uživatel" class="form-control" required/></div>
    <div class="form-group"><input type="password" name="password" class="form-control" placeholder="Heslo" required/></div>
    <div class="form-group"><button class="btn btn-success btn-block" name="submit" type="submit" value="submit">Přihlášení</button></div>
    <a href="http://sadventure.com/register" class="forgot">Nemáte účet ?</a><a href="http://sadventure.com/reset" class="forgot">Zapomenuté heslo ?</a>
    <input type="hidden" name="type" value="login">
    {!! $hform->close() !!}
</div>
</body>

</html>
@else 
	{{ \header('Location: http://sadventure.com/member/'.$member->username.'?action=logged') }}
@endif