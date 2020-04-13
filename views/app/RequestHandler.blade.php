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

       
   }
}

?>