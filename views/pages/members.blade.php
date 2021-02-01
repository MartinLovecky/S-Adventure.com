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
                <h3 style="color:#fff">Informace o vás</h3>
                <p>Uživatel: <a href="/member/{{$member->username}}">{{  $member->username }}<a></p>
                <p>Jméno:</p>
                <p>Příjmení:</p>
                <p>Datum narození:</p>
                <p>Město:</p>
            </div>
            {{-- foreach() --}}
            
            <div class="col-xl-9 offset-xl-1">
                <h2 style="color:#fff">Uložené záložky</h2>
                <div class="row justify-content-center features">
                    <div class="col-sm-6 col-md-5 col-lg-4 item">
                        <div class="box">
                            <a class="learn-more" href="#">Záložka »</a>
                        </br>
                        <a class="learn-more" href="#">Smazat</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

@endsection

{{-- <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/#" onclick = "javascript: return false;">Permission: {{  $member->permission  }}</a></li>
                        <li class="breadcrumb-item"><a href="/{{$member->bookmark()}}">Záložka</a></li>
                        <li class="breadcrumb-item"><a href="/member/{{$member->username}}?action=edituser">Upravit účet</a></li>
                        <li class="breadcrumb-item"><a href="/logout">Odhlášení</a></li>
                        @if ($member->permission == 'admin' || $member->permission == 'rewriter')
                        <li class="breadcrumb-item"><a><a href="/update">Editor</a></li>
                        <li class="breadcrumb-item"><a href="/member/{{$member->username}}?action=listofusers">Uživatelé</a></li>    
                        @endif
                    </ol> 
--}}
