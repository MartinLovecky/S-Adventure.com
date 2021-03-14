@include('layouts.app')
<div class="login-dark">
{!! $form->create(['target'=>['extras.RequestHandler',['requestController'=>$requestController,'request'=>$request]],'method'=>'POST','class'=>'text-center'])->run($blade)!!}
@include('extras.messages',['selector'=>$selector,'message'=>$message])
<div class="form-group"><input type="text" name="subject" placeholder="Předmět" class="form-control" required/></div>
<div class="form-group"><input type="email" name="email" placeholder="Váš registrační e-mail" class="form-control" required/></div>
<textarea class="form-control" name="issue" rows="4"></textarea>
@csrf
<input type="hidden" name="typoe" value="kontakt"> 
</div>   
</form>