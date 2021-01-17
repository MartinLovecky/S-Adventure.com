@extends('layouts.app')

@section('members')

@include('layouts.menu')

    <div class="article-list">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/#" onclick = "javascript: return false;">Permission: {{  $member->permission  }}</a></li>
                        <li class="breadcrumb-item"><a href="/{{$member->bookmark()}}">Záložka</a></li>
                        <li class="breadcrumb-item"><a href="/member/{{$member->username}}?action=edituser">Upravit účet</a></li>
                        <li class="breadcrumb-item"><a href="/logout">Odhlášení</a></li>
                        @if ($member->permission == 'admin' || $member->permission == 'rewriter')
                        <li class="breadcrumb-item"><a><a href="/update">Editor</a></li>
                        <li class="breadcrumb-item"><a href="/member/{{$member->username}}?action=listofusers">Uživatelé</a></li>    
                        @endif
                    </ol>
                    @include('extras.messages')
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xl-3 offset-xl-0">
                    <img class="img-fluid" src="/public/images/avatars/{{$member->avatar}}" />
                </div>
                <div class="col-xl-3 member_page_info">
                    <p>Uživatel: <a href="/member/{{$member->username}}">{{  $member->username }}<a></p>
                        @dump($selector->queryAction)
                </div>
                <div class="col-md-6">
                    @if ($selector->queryAction == 'edituser')
                      <?php header('Location: /updateMember/'.$member->username.'') ?>
                    @endif  
                </div>
            </div>
        </div>
    </div>

@include('layouts.footer')

@endsection