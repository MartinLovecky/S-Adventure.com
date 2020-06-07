@extends('layouts.app')
@section('resetPassword')
@if($selector->queryAction && !$member->logged)
<div class="login-dark">
    {!! $hform->create(['target'=>['app.RequestHandler',['requestController'=>$requestController,'request'=>$request]],'method'=>'POST','class'=>'text-center'])->run($blade) !!} 
@include('extras.messages',['selector'=>$selector,'message'=>$message])
    <div class="form-group"><input type="text" name="username" placeholder="Uživatel: " class="form-control" readonly /></div>
	<div class="form-group"><input type="password" name="password" placeholder="Nové heslo" class="form-control" /></div>
	<div class="form-group"><input type="password" name="passwordConfirm" placeholder="Nové heslo (znovu)" class="form-control" /></div>
    <div class="form-group"><button class="btn btn-success btn-block" name="submit" type="submit">Změnit</button></div>
    <a href="http://sadventure.com/index" class="forgot">Úvodní stránka</a>
    <input type="hidden" name="type" value="reset_send_email">
    <input type="hidden" name="hash" value="{{$selector->queryAction}}">
    <input type="hidden" name="id" value="{{$selector->resetPWD}}">
    {!! $hform->close() !!}
    </div>
</body>
</html>
@endif
@endsection