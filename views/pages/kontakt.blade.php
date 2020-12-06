@include('layouts.app')
<div class="login-dark">
<form action="{{$requestController->submitKontakt($request)}}" method="POST">
@include('extras.messages',['selector'=>$selector,'message'=>$message])
<div class="form-group"><input type="text" name="subject" placeholder="Předmět" class="form-control" required/></div>
<div class="form-group"><input type="email" name="email" placeholder="Váš registrační e-mail" class="form-control" required/></div>
<textarea class="form-control" name="issue" rows="4"></textarea>
<input type="hidden" name="_crf" value='{{$blade->getCsrfToken()}}'> 
</div>   
</form>