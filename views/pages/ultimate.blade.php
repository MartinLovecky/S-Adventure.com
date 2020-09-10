@include('layouts.app')

@if ($selector->queryAction != 'permission')
    @include('layouts.menu') 
    
    {{-- SHOW/UPDATE/CREATE/DELETE --}}
    @if ($articlesController->canReadPage())
        @include('pages.article')
    @endif
    @if ($articlesController->canUpdatePage())
        @include('pages.editor')
    @endif
    @if($articlesController->canCreatePage())
        {{-- /create/allwin/1 cannot craete existting page--}}
    {!! $articlesController->createPage($blade) !!}
    @endif
    @if($selector->action == 'delete' && $member->permission == 'all')
    {{-- create/allwin/1  -> Link will create  --}}
    @else 
     {{--  Router::redirect('show/allwin/1?action=permission&x=099af53f601532dbd31e0ea99ffdeb64') --}}
    @endif
    
@endif

@include('extras.messages') {{-- fix  --}}

@if ($member->permission == 'visit' && $selector->queryAction != 'permission')

{{--  Router::redirect('ultimate/allwin/1?action=permission')  --}}

@endif
{!! $articlesController->createPage() !!}