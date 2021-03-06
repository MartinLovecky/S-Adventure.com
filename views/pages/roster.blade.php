@extends('layouts.app')
@section('roster')
@dump($selector->title())
<div class="projects-horizontal">
    <div class="container">
        <div class="intro"><h2 class="text-center">Seznam všech příběhů</h2></div>
        <div class="row projects">
            @foreach ($articlesController->getArticles() as $articles)          
            <div class="col-sm-6 item">
                <div class="row">
                    <div class="col-md-12 col-lg-5"><img src="{{$articles['img']}}" class="img-fluid" alt="img" /></div>
                    <div class="col">
                        <h3 class="name"><a href="{{$articles['url']}}">{{$articles[0]}}</a></h3>
                        <p class="text-left description">{{$articles['description']}}</p>
                    </div>
                </div>
            </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>