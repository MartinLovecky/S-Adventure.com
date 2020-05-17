@if ($member->username == 'visitor')
    {!! header('Location: '.$router->urlName.'index?action=permission') !!}
@else
@extends('layouts.app')
@section('profile')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 offset-xl-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a><span>Práva: {{$member->permission}}</span></a></li>
            <li class="breadcrumb-item"><a><span><a href="#">Záložka</a></span></a></li>
            <li class="breadcrumb-item"><a><span><a href="?action=edituser">Upravit účet</a></span></a></li>
            <li class="breadcrumb-item"><a><span><a href="/index">Home</a></span></a></li>
            <li class="breadcrumb-item"><a><span><a href="/show">Příběhy</a></span></a></li>
            <li class="breadcrumb-item"><a><span><a href="/logout">Odhlášení</a></span></a></li>
        </ol>
        @include('extras.messages',['requestController'=>$requestController,'selector'=>$selector,'message'=>$message])
        </div>
    </div>
    <div class="row">
    <div class="col-md-12 col-xl-4 offset-xl-0">
        <h3>{{$member->username}}</h3>
        <img class="img-fluid" src="assets/img/sensei.jpeg">
    </div>
    <div class="col-md-12 col-xl-4 offset-xl-0 text-left">
    <h3>Informace o vás</h3>
    <p>Jméno: {{$member->memberName}}</p>
    <p>Příjmení: {{$member->surname}}</p>
    <p>Datum narození: {{$member->age}}</p>
    <p>Město: {{$member->location}}</p>
    <p>Viditelný: public/private</p>
    </div>
    <div class="col-md-12 col-xl-4 offset-xl-0">
        @if($selector->queryAction == 'edituser')
            @include('layouts.member',['requestController'=>$requestController,'request'=>$request])
        @endif
    </div>
    </div>
</div>
@include('layouts.footer',['router'=>$router])
@endsection
@endif

