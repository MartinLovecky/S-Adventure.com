<?php

use \eftec\bladeone\BladeOne;
use \starproject\http\Router;
use \starproject\tools\Mailer;
use \starproject\tools\Messages;
use \starproject\tools\Selector;
use \starproject\tools\Validation;
use \starproject\database\DB as DataBase;
use \starproject\database\costumers\Member;
use \starproject\controllers\RequestController;
use \starproject\controllers\ArticlesController;
use \starproject\tools\Sanitazor;
use \starproject\tools\html\Wrapper;

require(DIR . '/vendor/autoload.php'); 

$blade = new BladeOne(DIR.'/views',DIR.'/tmp',BladeOne::MODE_AUTO);
$db = new DataBase;
$message = new Messages; 
$mail = new Mailer;
$router = new Router;

$sanitazor  = new Sanitazor;

if($db->con() === null){   
    echo $blade
            ->setView('pages.kontakt')
            ->share(['message'=>$message->message(['error'=>'Please write email to '.$mail->_email.' with Subject: SA-2002 and Message: Database conection fail'])])
            ->run();
}

$member = new Member($db);
$selector = new Selector($member,$sanitazor);
$wrapper = new Wrapper($selector);
$validation = new Validation($db,$message,$member);
$requestController = new RequestController($validation,$member,$db,$mail,$selector);
$articlesController = new ArticlesController($selector,$member,$message,$db);

// Insert all variables for ALL views here
$router->data = ['wrapper'=>$wrapper,'router'=>$router,'blade'=>$blade,'request'=>$router->request,'selector'=>$selector,'message'=>$message,'member'=>$member,'articlesController'=>$articlesController,'requestController'=>$requestController];

//$blade->setAuth($member->getUserName(),)

?>