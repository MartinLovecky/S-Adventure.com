@extends('layouts.app')
@section('index')
<header class="index_header">
    <div class="container-fluid d-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center">
        <div class="row index_main">
            <div class="col-xl-12 d-flex justify-content-center align-items-center">
                <h1>STAR ADVENTURE</h1>
            </div>
            <div class="col-xl-12 d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center">
                <h2>Dobrodružný / Sci-fi / Fantasy</h2>
            </div>
            <div class="col">
                <div class="d-flex d-xl-flex justify-content-center align-items-center justify-content-xl-center align-items-xl-center" id="dd_index-container"><a href="#main"><img data-bs-hover-animate="rubberBand" class="dd_index-image" src="@asset('images/double-down.png')" title="click me"></a></div>
            </div>
        </div>
    </div>
</header>
@include('layouts.main',['articlesController'=>$articlesController])
@include('layouts.footer')
@endsection 

