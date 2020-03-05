@php
$avatarx = (isset($_FILES['avatar']['name'])) ? $_FILES['avatar']['name'] : 'empty';
$temp = (isset($_FILES['avatar']['tmp_name'])) ? $_FILES['avatar']['tmp_name'] : 'empty';
@endphp
<div class="col-xl-6 offset-xl-0 text-center">
    <h3>Úprava účtu</h3>
    @isset($errors)
        @foreach ($errors as $error)
            {{$error}}    
        @endforeach    
    @endisset
    {{-- Nefunkční bez member table --}}
    {!! $HForm->options(['method'=>'POST','class'=>'text-center','target'=>['app.RequestController',['avatar'=>$avatarx,'temp'=>$temp,'member'=>$member,'db'=>$db,'request'=>$request,'memberID'=>$memberID]],'autocomplete'=>'off','enctype'=>'multipart/form-data'])->open() !!}
        <div class="form-group">{!!$HForm->options(['name'=>'name','type'=>'text','class'=>'form-control','placeholder'=>'Jméno'])->input()!!}</div>
        <div class="form-group">{!!$HForm->options(['name'=>'surname','type'=>'text','class'=>'form-control','placeholder'=>'Příjmení'])->input()!!}</div>
        <div class="form-group">{!!$HForm->options(['name'=>'age','type'=>'date','class'=>'form-control','min'=>'1979-12-31','max'=>'2018-01-02'])->input()!!}</div>
        <div class="form-group">{!!$HForm->options(['name'=>'location','type'=>'text','class'=>'form-control','placeholder'=>'Město'])->input()!!}</div>
        <div class="form-group"><label>Avatar:</label>{!!$HForm->options(['name'=>'avatar','type'=>'file','status'=>'required'])->input()!!}</div>
        <input type="hidden" name="member" value='member'>
        <div class="form-group">{!!$HForm->options(['name'=>'submit','type'=>'submit','class'=>'btn btn-success btn-block','value'=>'Upravit'])->input()!!}</div>
        <p>*Pro úpravu účtu je nutné zadat Avatar</p>
    {!! $HForm->close() !!}  
</div>