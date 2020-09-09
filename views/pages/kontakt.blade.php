@include('extras.messages')

{{-- HTML FORM FOR SEND ERR MSD --}}
{!! $hform->create(['target'=>['app.RequestHandler',['requestController'=>$requestController,'request'=>$request]],'method'=>'POST','class'=>'text-center'])->run($blade)!!}
<input type="hidden" name="type" value='kontakt'>   
{!! $hform->close() !!}