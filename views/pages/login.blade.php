@extends('layouts.app')
@section('login')
@if (!$member->logged)
<div class="login-dark">
<form action="{{$requestController->submitLogin($request)}}" method="POST">
@include('extras.messages',['selector'=>$selector,'message'=>$message,'requestController'=>$requestController])
    <div class="form-group"><input type="text" name="username" placeholder="Uživatel" class="form-control" value="@isset($selector->OldData['username']){{$selector->OldData['username']}}@endisset" required/></div>
    <div class="form-group"><input type="password" name="password" class="form-control" placeholder="Heslo" required/></div>
    <div class="form-group"><button class="btn btn-success btn-block" name="submit" type="submit" value="submit">Přihlášení</button></div>
    <a href="http://sadventure.com/register" class="forgot">Nemáte účet ?</a><a href="http://sadventure.com/reset" class="forgot">Zapomenuté heslo ?</a>
    <input type="hidden" name="_crf" value='{{$blade->getCsrfToken()}}'>  
</form>
</div>
</body>

</html>
@else 
	{{ header('Location: http://sadventure.com/member/'.$member->username.'?action=logged') }}
@endif
@endsection