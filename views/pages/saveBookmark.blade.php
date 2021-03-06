@if ($member->loggedin)
@php

$article = \filter_input(INPUT_GET,'article',522,32);
$page = \filter_input(INPUT_GET,'page',522,32);

$savedbookmark = $requestController->saveBookmark($article,$page);

$_SESSION['bookmark'] = $savedbookmark;
setcookie('bookmark',$_SESSION['bookmark'],time() + (10 * 365 * 24 * 60 * 60));

echo header('Location: http://sadventure.com/member/'.$member->username.'?action=savedBookmark');

@endphp
@else
{{ \header('Location: http://sadventure.com/404/')}}    
@endif