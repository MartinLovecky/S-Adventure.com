@if(!empty($request))

@php

$appForms = match($request['type']){
    'register' =>  $requestController->submitRegister($request),
    'login' =>  $requestController->submitLogin($request),
    'reset_send_email' =>  $requestController->submitsendReset($request),
    'reset_pwd' =>  $requestController->submitReset($request),
    'bookmark' =>  $requestController->submitBookmark($request),
    'kontakt' =>  $requestController->submitKontakt($request),
    'update_member' =>  $requestController->updateMember($request),
    default => null,
};

if(isset($articlesController)){

$editorActions = match($request['type']){
        'update' =>  $articlesController->update($request),
        'delete' =>  $articlesController->delete($request),
        'create' =>  $articlesController->create($request),
        default => null,
    };
}

@endphp
@endif 