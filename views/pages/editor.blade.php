@if ($member->permisson != 'all' || $member->permisson != 'edit')
    {!! header('Location: '.$router->urlName.'index?action=permission') !!}
@else
@extends('layouts.app')
@section('editor')
<body>
    <div class="col-xl-12 offset-xl-0" id="main">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/index"><span>Domů</span></a></li>
                <li class="breadcrumb-item"><a href="/member/{{$selector->username}}"><span>Profil</span></a></li>
                <li class="breadcrumb-item">Akce:<li>
                <li class="breadcrumb-item"><a href="/create"><span>Create</span></a></li>
                <li class="breadcrumb-item"><a href="/update"><span>Update</span></a></li>
            @if($member->role === 'admin')<li class="breadcrumb-item"><a href="/delete"><span>Delete</span></a></li>@endif
                <li class="breadcrumb-item">Příběh:<li>
                <li class="breadcrumb-item"><a href="/{{$selector->action}}/allwin/1"><span>Allwin</span></a></li>
                <li class="breadcrumb-item"><a href="/{{$selector->action}}/samuel/1"><span>Samuel</span></a></li>
                <li class="breadcrumb-item"><a href="/{{$selector->action}}/isama/1"><span>Isama</span></a></li>
                <li class="breadcrumb-item"><a href="/{{$selector->action}}/isamaNH/1"><span>Nový horizont</span></a></li>
                <li class="breadcrumb-item"><a href="/{{$selector->action}}/isamaNW/1"><span>Nový svět</span></a></li>
            </ol>
            @include('extras.messages')
            {!! $hform->create(['target'=>['app.ArticleHandler',['articlesController'=>$articlesController,'request'=>$request]],'method'=>'POST','class'=>'text-center'])->run($blade)!!}
            <textarea name="editor1">{{$articlesController->_GetArticle()}}</textarea>
            <script>CKEDITOR.replace('editor1');</script>
            <hr/>
            <button class="btn btn-success btn-block" name="submit" type="submit" value="submit">Odeslat na server</button>
            <p> * Pro vykonání jakékoliv akce je nutné klinout na Odeslat na server nestačí pouze změnit url a dát ENTRER !!!!!</p>
            {!! $hform->close() !!}
        </div>
    </div>
</body>
@endsection
@endif