@extends('layouts.app')
@section('index')
@include('layouts.menu',['member'=>$member,'router'=>$router])
<div class="col-xl-12" id="jump">
    <div class="jumbotron" style="background-color: rgba(247,247,249,0);">
        <h1 class="text-center">S-ADVENTURE<br></h1>
        <p class="text-center" style="color: #ed0047;font-size: 18px;font-family: Audiowide, cursive;">lorem ipsum dolor sit amet</p>
        <p class="text-center"><a class="btn btn-primary active btn-lg" role="button" href="#section2" style="background-color: rgb(40,45,40);">Learn more</a></p>
    </div>
</div>
<div class="col-xl-12 offset-xl-0" id="main">
    <div id="section2">
        <div class="container">
            <header style="height: 50px;margin-top: 25px;">
            <h1 class="text-capitalize text-center text-info">Rozcestník</h1>
            </header>
            <h4 class="text-capitalize">Hlavní příběhy</h4>
            <ul class="info">
                <li><a href="{{$router->url('/show')->mobile(['artName'=>'allwin'])->action()}}">Allwin</a>&nbsp;→&nbsp;Vysvětluje počátek světa, ve kterém se příběh odehrává.</li>
                <li><a href="{{$router->url('/show')->mobile(['artName'=>'samuel'])->action()}}">Samuel</a>&nbsp;→&nbsp;Začátek hlavního příběhu.</li>
                <li><a href="{{$router->url('/show')->mobile(['artName'=>'isama'])->action()}}">Isama</a>&nbsp;→&nbsp;Navazuje na příběh Samuela.</li>
                <li><a href="{{$router->url('/show')->mobile(['artName'=>'isamaNH'])->action()}}">Nový Horizont</a>&nbsp;→&nbsp;Pokračování Isamova příběhu.</li>
                <li><a href="{{$router->url('/show')->mobile(['artName'=>'isamaNW'])->action()}}">Nový Svět</a>&nbsp;→&nbsp;Závěrečná část Isamova příběhu.</li>
            </ul>
            <h4 class="text-capitalize">Vedlejší příběhy</h4>
            <ul class="info"> {{-- propably can pull name from DB --}}
                <li><a href="{{$router->url('/show')->mobile(['artName'=>'aeg'])->action()}}">Angel &amp; Eklips</a>&nbsp;→&nbsp;Příběh má spojitost s příběhem Allwina.</li>
                <li><a href="{{$router->url('/show')->mobile(['artName'=>'mry'])->action()}}">Mr. Y</a>&nbsp;→&nbsp;Vysvětluje původ Mr. ?</li>
                <li><a href="{{$router->url('/show')->mobile(['artName'=>'white'])->action()}}">White Star</a>&nbsp;→&nbsp;Příběh popisuje minolost postavy.</li>
                <li><a href="{{$router->url('/show')->mobile(['artName'=>'lord'])->action()}}">Lord Terror</a>&nbsp;→&nbsp;Důležitá postava v Novém světě.</li>
                <li><a href="{{$router->url('/show')->mobile(['artName'=>'hyperion'])->action()}}">Hyperion</a>&nbsp;→&nbsp;Historie Nového světa.</li>
                <li><a href="{{$router->url('/show')->mobile(['artName'=>'demoni'])->action()}}">Démoni</a>&nbsp;→&nbsp;Příběh vysvětlující rasu Démonů.</li>
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
