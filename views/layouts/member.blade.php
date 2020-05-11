@php
$avatarx = (isset($_FILES['avatar']['name'])) ? $_FILES['avatar']['name'] : 'empty';
$temp = (isset($_FILES['avatar']['tmp_name'])) ? $_FILES['avatar']['tmp_name'] : 'empty';
@endphp
<div class="col-xl-6 offset-xl-0 text-center">
<h3>Úprava účtu</h3>
    {{-- Nefunkční bez member table --}}
    {!! $hform->create(['method'=>'POST','class'=>'text-center','target'=>['app.RequestHandler',['avatar'=>$avatarx,'temp'=>$temp,'requestController'=>$requestController,'request'=>$request]],'autocomplete'=>'off','enctype'=>'multipart/form-data']) !!}
        <div class="form-group"><input type="text" name="name" class="form-control" placeholder="Jméno"></div>
        <div class="form-group"><input type="text" name="surname" class="form-control" placeholder="Příjmení"></div>
        <div class="form-group"><input type="date" name="age" class="form-control" min="1979-12-31" max="2020-01-01"></div>
        <div class="form-group"><input type="text" name="location" class="form-control" placeholder="Město"></div>
        <div class="form-group"><label>Avatar:</label><input type="file" name="avatar" required></div>
        <input type="hidden" name="member_edit" value='member_edit'>
        <div class="form-group"><button class="btn btn-success btn-block" name="submit" type="submit" value="submit">Uprav</button></div>
        <p>*Pro úpravu účtu je nutné zadat Avatar</p>
    {!! $hform->close() !!}  
</div>