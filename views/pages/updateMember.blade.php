@include('layouts.app')

<div class="login-dark">
{!! $form->create(['target'=>['extras.RequestHandler',['requestController'=>$requestController,'request'=>$request]],'method'=>'POST','class'=>'text-center'])->run($blade)!!}
@include('extras.messages',['selector'=>$selector,'message'=>$message])
    <div class="form-group"><input type="text" name="name" class="form-control" placeholder="Jméno"/></div>
    <div class="form-group"><input type="text" name="surname" class="form-control" placeholder="Příjmení"/></div>
    <div class="form-group"><input type="date" name="age" class="form-control" min="1979-12-31" max="2015-01-02" /></div>
    <div class="form-group"><input type="text" name="location" placeholder="Město" class="form-control" /></div>
    <div class="form-group"><label style="color:#ffff;">Avatar:</label><input type="file" name="avatar" required/></div>
    <div class="form-group"><button class="btn btn-success btn-block" name ="submit" type="submit" value="sumbit">Upravit</button></div>
    <input type="hidden" name="type" value="update_member">
    <input type="hidden" name="_crf" value='{{$blade->getCsrfToken()}}'>
    <p style="color:#ffff;">*Pro úpravu účtu je nutné zadat Avatar</p>
</form>
</div>
