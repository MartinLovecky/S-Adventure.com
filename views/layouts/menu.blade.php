<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 offset-lg-0" id="navbar">
            <nav class="navbar navbar-light navbar-expand-lg navigation-clean-button" style="height: 80px; font-size: 16px;">
            <div class="container"><a class="navbar-brand" href="http://sadventure.com/index"><img class="img-fluid" src='@asset('img.icon.jpg')' alt="brand" width="80px"></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="nav navbar-nav text-center mx-auto">
                            <li class="nav-item" role="presentation"><a class="nav-link text-capitalize text-center>" href="http://sadventure.com/#"><strong>Allwin</strong></a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link text-capitalize text-center>" href="http://sadventure.com/#"><strong>Samuel</strong></a></li>
                            <li class="dropdown nav-item"><a class="dropdown-toggle nav-link text-capitalize text-center" data-toggle="dropdown" aria-expanded="false" href="#"><strong>Isama</strong></a>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item text-center nav-link active" role="presentation" href="http://sadventure.com/#"><strong>Isama</strong></a>
                                    <a class="dropdown-item text-center" role="presentation" href="http://sadventure.com/#"><strong>Nový Horizont</strong></a>
                                    <a class="dropdown-item text-center" role="presentation" href="http://sadventure.com/#"><strong>Nový svět</strong></a>
                                </div>
                            </li>
                            <li class="nav-item" role="presentation"><a class="nav-link text-capitalize text-center>" href="http://sadventure.com/#"><strong>Postavy</strong></a></li>
                            <li class="dropdown nav-item"><a class="dropdown-toggle nav-link text-capitalize text-center" data-toggle="dropdown" aria-expanded="false" href="#"><strong>Ostatní</strong></a>
                                <div class="dropdown-menu text-center" role="menu">
                                  <a class="dropdown-item text-center" role="presentation" href="http://sadventure.com/#"><strong>Item</strong></a>
                                  <a class="dropdown-item text-center" role="presentation" href="http://sadventure.com/#"><strong>Item</strong></a>
                                  <a class="dropdown-item text-center" role="presentation" href="http://sadventure.com/#"><strong>Item</strong></a>
                                  <a class="dropdown-item text-center" role="presentation" href="http://sadventure.com/#"><strong>Item</strong></a>
                                  <a class="dropdown-item text-center" role="presentation" href="http://sadventure.com/#"><strong>Item</strong></a>
                                  <a class="dropdown-item text-center" role="presentation" href="http://sadventure.com/#"><strong>Item</strong></a>
                                </div>
                            </li>
                        </ul>@if(!$selector->get('logged',$member))<a class="btn btn-primary bg-danger border rounded-circle" role="button" href="http://sadventure.com/register" style="color: rgb(255,255,255);">Registrace</a><a class="btn btn-primary bg-success border rounded-circle" role="button" href="http://sadventure.com/login" style="color: rgb(255,255,255);">Přihlášení</a>@endif
                        @if($selector->get('logged',$member))<span class="navbar-text actions" id="imgName"><img class="rounded-circle img-fluid" src="http://localhost/example/public/resources/img/avatars/{{$selector->get("avatar",$member)}}" alt="img" width="50px"><span class="text-warning"><a class="text-capitalize" href="http://example.com/member/{{$selector->get("member",$member)}}">{{$selector->get("member",$member)}}</a></span></span>@endif
                    </div>
            </div>
            </nav>
</div>

