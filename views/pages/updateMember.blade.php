@extends('layouts.app')

@section('updateMember')

<div class="login-dark">
{!! $form->create(['target'=>['extras.RequestHandler',['requestController'=>$requestController,'request'=>$request]],'method'=>'POST','class'=>''])->run($blade)!!}
@include('extras.messages',['selector'=>$selector,'message'=>$message])
    <div class="form-group"><input type="text" name="name" class="form-control" placeholder="Jméno"/></div>
    <div class="form-group"><input type="text" name="surname" class="form-control" placeholder="Příjmení"/></div>
    <div class="form-group"><input type="date" name="age" class="form-control" min="1979-12-31" max="2015-01-02" /></div>
    <div class="form-group"><input type="text" name="location" placeholder="Město" class="form-control" /></div>
    <div class="form-group"><label style="color:#ffff;"><span style="color:#ff92a7;">*</span>Avatar:</label><input type="file" name="avatar" required/></div>
    <div class="form-group"><div class="form-check"><input class="form-check-input" type="checkbox" id="formCheck-1" name="visible"/><label class="form-check-label" for="formCheck-1"><span style="color:#ff92a7;">**</span>Private</label></div></div>
    <div class="form-group"><button class="btn btn-success btn-block" name ="submit" type="submit" value="sumbit">Upravit</button></div>
    <input type="hidden" name="type" value="update_member">
    @csrf
    <p class="forgot" style="color:#ff9494;">* Pro úpravu účtu je nutné zadat Avatar, který je viditelný pro všechny.</p>
    <p class="forgot" style="color:#ff9494;">** Zvolením <b>Privite</b> se Vaše infromace zobrazí pouze Vám.</p>
    <p class="forgot" style="color:#ff9494;">*** Informace o Vás není nutné vyplňovat, při zadání osobních údajů uživatel souhlasí se zpracováním osobních údajů.</p>
    <hr/>
    <a href="/member/{{$member->username}}" class="forgot">Zpět na profil</a>
</form>
</div>
@endsection