@extends('layouts.app')

@section('members')

@include('layouts.menu')

    <div class="article-list">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/#">Permission: {{  $member->permission  }}</a></li>
                        <li class="breadcrumb-item"><a href="/#">Záložka</a></li>
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
                </div>
                <div class="col-md-6">
                    @if ($selector->queryAction == 'edituser')
                    <form>
                        <div class="form-group"><input type="text" name="name" class="form-control" placeholder="Jméno"/></div>
                        <div class="form-group"><input type="text" name="surname" class="form-control" placeholder="Příjmení"/></div>
                        <div class="form-group"><input type="date" name="age" class="form-control" min="1979-12-31" max="2015-01-02" /></div>
                        <div class="form-group"><input type="text" name="location" placeholder="Město" class="form-control" /></div>
                        <div class="form-group"><label style="color:#ffff;">Avatar:</label><input type="file" name="avatar" required/></div>
                        <div class="form-group"><button class="btn btn-success btn-block" name ="submit" type="submit" value="sumbit">Upravit</button></div>
                        <p style="color:#ffff;">*Pro úpravu účtu je nutné zadat Avatar</p>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@include('layouts.footer')
@endsection