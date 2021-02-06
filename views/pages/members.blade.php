@extends('layouts.app')

@section('members')

@include('layouts.menu')

@if ($selector->queryAction == 'edituser')
{{ \header('Location: /updateMember/'.$member->username.'') }}
@endif

<div class="article-list">
    <div class="container-fluid features-boxed">
        <div class="row">
            <div class="col-md-12 col-xl-9 offset-xl-1">
                @include('extras.messages')
            </div>
        </div>
        <div class="row" style="padding-top: 16px;">
            <div class="col-md-6 col-xl-3 offset-xl-1">
                <img class="img-fluid" src="/public/images/avatars/{{$member->avatar}}" />
            </div>
            <div class="col-xl-6 offset-xl-0 member_page_info">
                <h3 style="color:#ffffff">Informace o vás</h3>
                <p>Uživatel: <a href="/member/{{$member->username}}">{{  $member->username }}<a></p>
                <p>Jméno:</p>
                <p>Příjmení:</p>
                <p>Datum narození:</p>
                <p>Město:</p>
            </div>
            <div class="col-xl-9 offset-xl-1">
                <h2 style="color:#ffffff;margin-top:10vh;">Uložené záložky</h2>
                <p style="color:#ff9292">* Maximální počet záložek je 12. Uložit záložku lze pouze při čtení příběhu v menu uživatele.
                <div class="row justify-content-center features" id="bookmarks">
                    @if (!isset($member->bookmark))
                    <div class="col-sm-6 col-md-5 col-lg-4 item">
                        <div class="box">
                            <a class="learn-more" style="pointer-events: none; cursor: default;"> Nemáte žádnou uloženou záložku </a>
                        </div>
                    </div>
                    @else
                    @foreach ($member->bookmark as $bookmarkName => $bookmarkLink)
                    <div class="col-sm-6 col-md-5 col-lg-4 item">
                        <div class="box">
                            <a class="learn-more" href="#">Záložka »</a>
                        </br>
                        <a class="learn-more" href="#">Smazat</a>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

@endsection
