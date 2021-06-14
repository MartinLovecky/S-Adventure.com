@if ($member->loggedin)
@php

$article = \filter_input(INPUT_GET,'article',522,32);
$page = \filter_input(INPUT_GET,'page',522,32);

if ($member->bookmarkCount < 12) {
    // saveBookmark returns false / true or msg if validation fails
    $requestController->saveBookmark($article,$page);
   
}

if ($member->bookmarkCount >= 12 ) {
    header('Location: http://sadventure.com/member/'.$this->_member->username.'?action=maxBookmarks');
    die; exit;
}

@endphp
@else
{{ \header('Location: http://sadventure.com/404/')}}    
@endif