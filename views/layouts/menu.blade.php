<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 offset-lg-0" id="navbar">
            <nav class="navbar navbar-light navbar-expand-lg navigation-clean-button" style="height: 80px; font-size: 16px;">
            <div class="container"><a class="navbar-brand" href="{{$router->url('/')->mobile([])->action()}}"><img class="img-fluid" src='@asset('img.icon.jpg')' alt="brand" width="80px"></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="nav navbar-nav text-center mx-auto">
                            <li class="nav-item" role="presentation"><a class="nav-link text-capitalize text-center>" href="{{$router->url('/show')->mobile(['artName'=>'allwin'])->action()}}"><strong>Allwin</strong></a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link text-capitalize text-center>" href="{{$router->url('/show')->mobile(['artName'=>'samuel'])->action()}}"><strong>Samuel</strong></a></li>
                            <li class="dropdown nav-item"><a class="dropdown-toggle nav-link text-capitalize text-center" data-toggle="dropdown" aria-expanded="false" href="#"><strong>Isama</strong></a>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item text-center nav-link active" role="presentation" href="{{$router->url('/show')->mobile(['artName'=>'isama'])->action()}}"><strong>Isama</strong></a>
                                    <a class="dropdown-item text-center" role="presentation" href="{{$router->url('/show')->mobile(['artName'=>'isamaNH'])->action()}}"><strong>Nový Horizont</strong></a>
                                    <a class="dropdown-item text-center" role="presentation" href="{{$router->url('/show')->mobile(['artName'=>'isamaNW'])->action()}}"><strong>Nový svět</strong></a>
                                </div>
                            </li>
                            <li class="nav-item" role="presentation"><a class="nav-link text-capitalize text-center>" href="{{$router->url('/chars')->mobile([])->action()}}"><strong>Postavy</strong></a></li>
                            <li class="dropdown nav-item"><a class="dropdown-toggle nav-link text-capitalize text-center" data-toggle="dropdown" aria-expanded="false" href="#"><strong>Ostatní</strong></a>
                                <div class="dropdown-menu text-center" role="menu">
                                  <a class="dropdown-item text-center" role="presentation" href="{{$router->url('/show')->mobile(['artName'=>'aeg'])->action()}}"><strong>Item</strong></a>
                                  <a class="dropdown-item text-center" role="presentation" href="{{$router->url('/show')->mobile(['artName'=>'allwin'])->action()}}"><strong>Item</strong></a>
                                  <a class="dropdown-item text-center" role="presentation" href="{{$router->url('/show')->mobile(['artName'=>'allwin'])->action()}}"><strong>Item</strong></a>
                                  <a class="dropdown-item text-center" role="presentation" href="{{$router->url('/show')->mobile(['artName'=>'allwin'])->action()}}"><strong>Item</strong></a>
                                  <a class="dropdown-item text-center" role="presentation" href="{{$router->url('/show')->mobile(['artName'=>'allwin'])->action()}}"><strong>Item</strong></a>
                                  <a class="dropdown-item text-center" role="presentation" href="{{$router->url('/show')->mobile(['artName'=>'allwin'])->action()}}"><strong>Item</strong></a>
                                </div>
                            </li>
                        </ul>@if(!$member->logged)<a class="btn btn-primary bg-danger border rounded-circle" role="button" href="http://sadventure.com/register" style="color: rgb(255,255,255);">Registrace</a><a class="btn btn-primary bg-success border rounded-circle" role="button" href="http://sadventure.com/login" style="color: rgb(255,255,255);">Přihlášení</a>@endif
                        @if($member->logged)<span class="navbar-text actions" id="imgName"><img class="rounded-circle img-fluid" src="http://localhost/example/public/resources/img/avatars/{{$member->avatar}}" alt="img" width="50px"><span class="text-warning"><a class="text-capitalize" href="http://sadventure.com/member/{{$member->username}}">{{$member->username}}</a></span></span>@endif
                        @if($articlesController->_SetAllowed()){!! $hform->create(['target'=>['app.RequestHandler',['requestController'=>$requestController,'request'=>$request]],'method'=>'POST','class'=>'form-inline'])->run($blade)!!}<input type="hidden" name="type" value='bookmark'><button class="btn btn-light" name="submit" type="submit"><i class="typcn typcn-bookmark" style="color: #f47c00;"></i><span class="text-lowercase font-size: 16px;">Uložit záložku</span></button>{!! $hform->close() !!}@endif
                    </div>
            </div>
            </nav>
</div>

