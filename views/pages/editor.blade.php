@extends('layouts.app')
@section('editor')
<body>
    <div class="col-xl-12 offset-xl-0" id="main">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/index"><span>Domů</span></a></li>
                {{-- <li class="breadcrumb-item"><a href="/member/{{$selector->username}}"><span>Profil</span></a></li> --}}
                <li class="breadcrumb-item"><a href="/create"><span>Create</span></a></li>
                <li class="breadcrumb-item"><a href="/update"><span>Update</span></a></li>
            @if($member->role === 'admin')<li class="breadcrumb-item"><a href="/delete"><span>Delete</span></a></li>@endif
                <li class="breadcrumb-item">Příběh:&nbsp;<li>
                @foreach ($articlesController->all as $names => $article)
                <li class="breadcrumb-item"><a href="/{{$selector->action}}/{{mb_strtolower($names,'UTF-8')}}/1"><span>{{$article[0]}}</span></a></li>
                @endforeach
            </ol>
            @include('extras.messages')
            <form action="" method="post">
            <input type="text" name="chapter" placeholder="Nadpis">
            <input type="text" name="nadpisH1" placeholder="Nadpis_H1">
            <input type="text" name="smallH2" placeholder="Nadpis_small_H2">
            <div id="editor">
                <textarea name="body">Placeholder</textarea>
            </div>
            <script>
                ClassicEditor
                    .create( document.querySelector( '#editor' ) )
                    .catch( error => {
                        console.error( error );
                    } );
            </script>
            <hr/>
            <button class="btn btn-success btn-block" name="submit" type="submit" value="submit">Odeslat na server</button>
            <p> * Pro vykonání jakékoliv akce je nutné klinout na Odeslat na server nestačí pouze změnit url a dát ENTRER !!!!!</p>
            </form>
        </div>
    </div>
</body>
@endsection
