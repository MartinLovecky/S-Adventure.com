@include('layouts.app')
<div class="container-fluid" id="text">
<div class="row">
<div class="col-lg-10 col-lg-offset-1 col-md-12">
<div class="text">
    {{-- !permission check -> redirect with msg --}}
@if (!empty($articlesController->Article['chapter']))
    <h1 class="text-center">{{$articlesController->Article['chapter']}}</h1>
@endif
    {!!  $articlesController->Article['body']   !!}  
<nav class="d-xl-flex justify-content-xl-center align-items-xl-center" id="wp_pagnation">
    <ul class="pagination">
        {!!  $wrapper->prev_page()   !!}
        {!!  $wrapper->main_pagnation()  !!}
        {!!  $wrapper->next_page()  !!}
    </ul>
</nav>
</div>
@include('layouts.footer')