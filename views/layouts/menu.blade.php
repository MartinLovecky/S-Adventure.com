<nav class="navbar navbar-light navbar-expand-lg navigation-clean" style="font-family: Aldrich, sans-serif; font-size: 16px;">
        <div class="container"><a class="navbar-brand" href="/index"><img class="img-fluid" src='@asset('images/android-chrome-256x256.png')' alt="brand" style="width: 60px;height: 60px;"></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav text-center mx-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link text-capitalize text-center>" href="/show/allwin/1"><strong>Allwin</strong></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link text-capitalize text-center>" href="/show/samuel/1"><strong>Samuel</strong></a></li>
                    <li class="dropdown nav-item"><a class="dropdown-toggle nav-link text-capitalize text-center" data-toggle="dropdown" aria-expanded="false" href="#"><strong>Isama</strong></a>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item text-center nav-link active" role="presentation" href="/show/isama/1"><strong>Isama</strong></a>
                            <a class="dropdown-item text-center" role="presentation" href="/show/isamanh/1"><strong>Nový Horizont</strong></a>
                            <a class="dropdown-item text-center" role="presentation" href="/show/isamanw/1"><strong>Nový svět</strong></a>
                        </div>
                    </li>
                    <li class="nav-item" role="presentation"><a class="nav-link text-capitalize text-center>" href="/chars"><strong>Postavy</strong></a></li>
                    <li class="dropdown nav-item"><a class="dropdown-toggle nav-link text-capitalize text-center" data-toggle="dropdown" aria-expanded="false" href="#"><strong>Ostatní</strong></a>
                        <div class="dropdown-menu text-center" role="menu">
                            <a class="dropdown-item text-center" role="presentation" href="/show/mry/1"><strong>Mr. Y</strong></a>
                            <a class="dropdown-item text-center" role="presentation" href="/show/aeg/1"><strong>Angel & Eklips</strong></a>
                            <a class="dropdown-item text-center" role="presentation" href="/show/hyperion/1"><strong>Hyperion</strong></a>
                            <a class="dropdown-item text-center" role="presentation" href="/show/star/1"><strong>Star</strong></a>
                            <a class="dropdown-item text-center" role="presentation" href="/show/demoni/1"><strong>Demoni</strong></a>
                            <a class="dropdown-item text-center" role="presentation" href="/show/terror/1"><strong>Terror</strong></a>
                        </li>
                    </div>
                </ul>  
            @if($member->loggedin)
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item dropdown"><a data-toggle="dropdown" aria-expanded="false" class="dropdown-toggle nav-link" href="#"><img src="/public/images/avatars/{{$member->avatar}}" alt="img" height="60px" style="padding-right: 10px;" />{{$member->username}} </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/member/{{$member->username}}">Profil</a>
                        <a class="dropdown-item" href="#">#</a>
                        <a class="dropdown-item" href="/saveBookmark?article=x&page=x">Uložit záložku</a>
                        <a class="dropdown-item" href="/logout">Odhlášení</a>
                    </div>
                </li>
            </ul>
            @endif
        </div>
</nav>

