@extends('layouts.app')
@section('login')
@if (!$member->loggedin)
<div class="login-dark">
{!! $form->create(['target'=>['extras.RequestHandler',['requestController'=>$requestController,'request'=>$request]],'method'=>'POST','class'=>'text-center'])->run($blade)!!}    
@include('extras.messages',['selector'=>$selector,'message'=>$message,'requestController'=>$requestController])
    <div class="form-group"><input type="text" name="username" placeholder="Uživatel" class="form-control" value="@isset($selector->OldData['username']){{$selector->OldData['username']}}@endisset" required/></div>
    <div class="form-group"><input type="password" name="password" class="form-control" placeholder="Heslo" required/></div>
    <div class="form-group"><button class="btn btn-success btn-block" name="submit" type="submit" value="submit">Přihlášení</button></div>
    <a href="/register" class="forgot">Nemáte účet ?</a><a href="/reset" class="forgot">Zapomenuté heslo ?</a>
    @csrf
    <input type="hidden" name="type" value='login'>  
</form>
</div>
</body>
</html>
@else 
	{{ header('Location: http://sadventure.com/member/'.$member->username.'') }}
@endif
@endsection