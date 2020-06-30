@extends('layouts.app')
@section('index')
@include('layouts.menu',['member'=>$member,'router'=>$router])
<div class="col-xl-12" id="jump">
    <div class="jumbotron" style="background-color: rgba(247,247,249,0);">
        <h1 class="text-center">S-ADVENTURE<br></h1>
        <p class="text-center" style="color: #ed0047;font-size: 18px;font-family: Audiowide, cursive;">Dobrodružný / Sci - fi / Fantasy</p>
        <p class="text-center"><a class="btn btn-primary active btn-lg" role="button" href="#section2" style="background-color: rgb(40,45,40);">Rozcestník</a></p>
    </div>
</div>
<div class="col-xl-12 offset-xl-0" id="main">
    <div id="section2">
        <div class="container">
            <header style="height: 50px;margin-top: 25px;">
            <h1 class="text-capitalize text-center text-info">Rozcestník</h1>
            </header>
            <h4 class="text-capitalize">Všechny příběhy</h4>
            <ul class="info">
                @foreach ($articlesController->all as $article)
                <li><a href="{{$article['url']}}">{{$article[0]}}</a>&nbsp;→&nbsp;{{$article['description']}}</li>
                @endforeach
            </ul>
       </div>
    </div>
</div>
<div class="col-xl-12 offset-xl-0" id="team">
    <div class="container">
        <h1 class="text-capitalize text-center text-info">Team</h1>
        <div class="card-group">
            <div class="card"><img class="rounded img-fluid card-img-top w-100 d-block" src="@asset('img.beruska.jpg')">
                <div class="card-body text-center">
                    <h4 class="text-capitalize text-primary card-title">Květulka</h4>
                    <p>Editorka příběhu.<br></p>
                </div>
            </div>
            <div class="card"><img class="rounded img-fluid card-img-top w-100 d-block" src='@asset('img.sensei.jpg')'>
                <div class="card-body text-center">
                    <h4 class="text-capitalize text-primary card-title">Sensei</h4>
                    <p>Tvůrce webu. Autor příběhu.<br></p>
                </div>
            </div>
            <div class="card"><img class="rounded img-fluid card-img-top w-100 d-block" src='@asset('img.torag.jpg')'>
                <div class="card-body text-center">
                    <h4 class="text-primary card-title">Torag</h4>
                    <p>Hlavní konzultant.<br></p>
                </div>
            </div>
        </div>
</div>
@include('layouts.footer',['router'=>$router])
@endsection 
