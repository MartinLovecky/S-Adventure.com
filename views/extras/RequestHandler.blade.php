@if(!empty($request))

@php

match($request['type']){
    'register' => $requestController->submitRegister($request),
    'login' => $requestController->submitLogin($request),
    'reset_send_email' => $requestController->submitsendReset($request),
    'reset_pwd' => $requestController->submitReset($request),
    'bookmark' => $requestController->submitBookmark($request),
    'kontakt' => $requestController->submitKontakt($request),
    'update_member' => $requestController->updateMember($request),
    default => null,
};

if($articlesController){

    match($request['type']){
        'update' => $articlesController->update($request),
        'delete' => null,//$articlesController->delete(),
        'create' => null,//$articlesController->create(),
        default => null,
    };
}

@endphp
@endif 