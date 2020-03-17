@extends('layouts.app')

<div class="projects-horizontal">
    <div class="container">
        <div class="intro"><h2 class="text-center">Seznam všech příběhů</h2></div>
        <div class="row projects">
            @foreach ($articles->names as $ArticleName)
            <div class="col-sm-6 item">
                <div class="row">
                    <div class="col-md-12 col-lg-5"><img src="desk.jpg" class="img-fluid" alt="{{$ArticleName}}" /></div>
                    <div class="col">
                        <h3 class="name">{{$ArticleName}}</h3>
                    <p class="text-left description">{{$articles->all[$ArticleName]['description']}}</p>
                        <a class="btn btn-outline-link" role="button" href="{{$articles->all[$ArticleName]['url']}}" style>Čti zde<i class="fa fa-play"></i></a></div>
                </div>
            </div>
            @endforeach
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>