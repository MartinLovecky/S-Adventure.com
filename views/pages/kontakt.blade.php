@include('layouts.app')
{{-- HTML FORM FOR SEND ERR MSD --}}
<div class="login-dark">
{!! $hform->create(['target'=>['app.RequestHandler',['requestController'=>$requestController,'request'=>$request]],'method'=>'POST','class'=>'text-center'])->run($blade)!!}
@include('extras.messages',['selector'=>$selector,'message'=>$message])
<div class="form-group"><input type="text" name="subject" placeholder="Předmět" class="form-control" required/></div>
<div class="form-group"><input type="email" name="email" placeholder="Váš registrační e-mail" class="form-control" required/></div>
<textarea class="form-control" name="issue" rows="4"></textarea>
<input type="hidden" name="type" value='kontakt'>
</div>   
{!! $hform->close() !!}