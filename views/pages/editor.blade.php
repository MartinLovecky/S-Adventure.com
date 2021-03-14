@extends('layouts.app')
@section('editor')

<div class="article-list">
    <div class="container">
        <div class="row">
            <div class="col-xl-10 offset-xl-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/index">Domů</a></li>
                    {{-- <li class="breadcrumb-item"><a href="/member/{{$selector->username}}">Profil</a></li> --}}
                    <li class="breadcrumb-item"><a href="/create">Create</a></li>
                    <li class="breadcrumb-item"><a href="/update">Update</a></li>
                    <li class="breadcrumb-item"><a href="/delete">Delete</a></li>
                    @if (!$selector->article)
                    <li class="breadcrumb-item"><span style=color:#00cc80>Příběh:&nbsp;</span><li>
                    @foreach (array_keys($articlesController->getArticles()) as $names => $article)
                    <li class="breadcrumb-item"><a href="{{strtolower($selector->action)}}/{{$article}}/1">{{$article}}</a></li>
                    @endforeach
                    @else
                    &nbsp;&nbsp;<span style=color:#00cc80> / Upravujete příběh {{$selector->article}}</span>
                    @endif
                </ol>
                @include('extras.messages')
                {!! $form->create(['target'=>['extras.RequestHandler',['requestController'=>$requestController,'request'=>$request]],'method'=>'POST','class'=>'text-center'])->run($blade)!!}
                    <textarea class="form-control" name="editor1" id="editor1">
                    {{-- text --}}
                    </textarea>
                    <script>
                        CKEDITOR.addCss('.cke_editable { background-color: black; color: white }');
                        CKEDITOR.replace( 'editor1' );
                    </script>
                    <hr/>
                    <input type="hidden" name="type" value="{{$selector->action}}">
                    <button class="btn btn-success btn-block" name="submit" type="submit" value="submit">Odeslat na server</button>
                    <p> * Pro vykonání jakékoliv akce je nutné klinout na Odeslat na server nestačí pouze změnit url a dát ENTRER !!!!!</p>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
