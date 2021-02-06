@if ($member->loggedin)
@php
    // /saveBookmark?article=x&page=x => /sBookmark/allwin/1 => {{ $requestconroller->submitBookmark() }} needs a lot of 'magic'
    $article = $sanitazor->sanitaze_GET('article');
    $page = $sanitazor->sanitaze_GET('page');
    if(!in_array($article,$selector->allowedAricles)){
        \header('Location: http://sadventure.com/404/')
    }
    $link = '/show/$article/$page';
    // save to db or $_COOCKIE
    setcookie( $bookmark ,  $value = $link ,$expires = 0 ,  $path = "/",$domain = '.sadventure.com'); 
    \header('Location: http://sadventure.com/member/'.$member->username.'?action=savedBookmark')
@endphp
@else
{{ \header('Location: http://sadventure.com/404/')}}    
@endif
