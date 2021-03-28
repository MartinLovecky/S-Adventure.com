@include('layouts.app')
@if ($member->permission === 'admin' || $member->permission === 'editor')
<div class="article-list">
    <div class="container">
        <div class="row">
            <div class="col-xl-10 offset-xl-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/index">Domů</a></li>
                    <li class="breadcrumb-item"><a href="/member/{{$member->username}}">Profil</a></li>
                    <li class="breadcrumb-item"><a href="/create">Create</a></li>
                    <li class="breadcrumb-item"><a href="/update">Update</a></li>
                    <li class="breadcrumb-item"><a href="/delete">Delete</a></li>
                    @if (!$selector->article)
                    <li class="breadcrumb-item"><span style="color:#00cc80">Příběh:&nbsp;</span><li>
                    @foreach (array_keys($articlesController->Articles) as $names => $article)
                    <li class="breadcrumb-item"><a href="{{strtolower($selector->action)}}/{{$article}}/1">{{$article}}</a></li>
                    @endforeach
                    @else
                    &nbsp;&nbsp;<span style="color:#00cc80"> / Upravujete příběh {{$selector->article}}</span>
                    @endif
                </ol>
                @if (!$selector->article)
                    {!! $message->message(['error'=>'Pro vykonání akce '.$selector->action.' je nutné zvolit příběh']) !!}
                @endif
                @include('extras.messages')
                {!! $form->create(['target'=>['extras.RequestHandler',['articlesController'=>$articlesController,'request'=>$request]],'method'=>'POST','class'=>'text-center'])->run($blade)!!}
                <label style="color:#fff">Nadpis:</label><input type="text" name="chapter" @isset($articlesController->Article['chapter']) value="{{$articlesController->Article['chapter']}}" @endisset  placeholder="Může zůstat prázdný">
                <textarea name="content" id="editor">
                    @dump($articlesController->Article)
                    @isset($articlesController->Article['body'])
                        {!! $articlesController->Article['body'] !!}
                    @endisset
                </textarea>
                <script>
                    ClassicEditor
                        .create( document.querySelector( '#editor' ) )
                        .catch( error => {
                            console.error( error );
                        } );
                </script>
                    <hr/>
                    @isset($selector->article)
                    <input type="hidden" name="type" value="{{$selector->action}}">
                    <input type="hidden" name="article"  value="{{$selector->article}}">
                    <input type="hidden" name="page" value="{{$selector->page}}">
                    <button class="btn btn-success btn-block" name="submit" type="submit" value="submit" id="save">Odeslat na server</button>
                    <p style="color:#fff;"> * Pro vykonání jakékoliv akce je nutné kliknout na Odeslat na server nestačí pouze změnit url a dát ENTRER !!!!!</p>
                    @endisset
                </form>
        </div>
    </div>
</div>
@else
    {{ \header('Location: http://sadventure.com/')}}
@endif

