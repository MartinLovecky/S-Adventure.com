<?php


if(!empty($request))
{
   switch ($request['type']) {
        case 'register':
            $requestController->submitRegister($request);
        break;
        case 'login':
            $requestController->submitLogin($request);
        break;
        case 'reset_send_email':
            $requestController->submitsendReset($request);
        break;              
        case 'reset_pwd';
            $requestController->submitReset($request);
        default: null;            
   }
}

?>