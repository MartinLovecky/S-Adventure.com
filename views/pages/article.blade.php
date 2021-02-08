@if (!$member->loggedin)
    {{ header('Location: http://sadventure.com/register?action=permission') }} 
@endif
@include('layouts.app')
@include('layouts.menu')
<div class="article-list">
    <div class="container-fluid features-boxed">
        <div class="row">
            <div class="col-md-12 col-xl-10 offset-xl-1">
                @if($member->permission == 'visit')
                    {!! $message->message(['error'=>'Pro zobrazení příběhu nemáte dostatečná <a href="/vop">práva<a/>']) !!}
                @endif
            </div>
        </div>
        <div class="row" style="padding-top: 16px;">
            <div class="col-md-6 col-xl-10 offset-xl-1">
                @if($member->permission != 'visit')
                    {{-- {!!  @if (!empty($articlesController->Article['chapter']))
    <h1 class="text-center">{{$articlesController->Article['chapter']}}</h1>
@endif---$articlesController->Article['body']   !!} --}}
                @endif
            </div>
        </div>
    </div>
</div>
<nav class="d-xl-flex justify-content-xl-center align-items-xl-center" id="wp_pagnation" style="background-color:#272626">
    <ul class="pagination">
        {!!  $wrapper->prev_page()   !!}
        {!!  $wrapper->main_pagnation()  !!}
        {!!  $wrapper->next_page()  !!}
    </ul>
</nav>
@include('layouts.footer')