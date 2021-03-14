@extends('layouts.app')
@section('reset')
@if (!$member->logged)
<div class="login-dark">
{!! $form->create(['target'=>['extras.RequestHandler',['requestController'=>$requestController,'request'=>$request]],'method'=>'POST','class'=>'text-center'])->run($blade)!!}
@include('extras.messages',['selector'=>$selector,'message'=>$message])
    <div class="form-group"><input type="email" name="email" value="@isset($selector->OldData['email']){{$selector->OldData['email']}}@endisset" placeholder="Email" class="form-control" required/></div>
    <div class="form-group"><button class="btn btn-success btn-block" name="submit" type="submit" value="submit">Odeslat</button></div>
    <a href="/index" class="forgot">Úvodní stránka</a><a href="/login" class="forgot">Přihlášení</a>
    @csrf
    <input type="hidden" name="type" value="reset_send_email">
</form>
</div>
</body>
</html>
@else
    {{  \header('Location: http://sadventure.com/member/'.$member->username.'?action=logged') }}
@endif
@endsection    



