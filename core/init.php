<?php

use \eftec\bladeone\BladeOne;
use \starproject\http\Router;
use \starproject\tools\Forms;
use \starproject\tools\Mailer;
use \starproject\tools\Messages;
use \starproject\tools\Selector;
use \starproject\tools\Validation;
use \starproject\database\Articles;
use \starproject\database\DB as DataBase;
use \starproject\database\costumers\Member;
use \starproject\controllers\RequestController;
use \starproject\controllers\ArticlesController;

require(DIR . '/vendor/autoload.php'); 

$blade = new BladeOne(DIR.'/views',DIR.'/tmp',BladeOne::MODE_AUTO);
$db = new DataBase;
$message = new Messages; 
$mail = new Mailer;
$articles = new Articles; 
$selector = new Selector;
$router = new Router;
$hform = new Forms;
# Check Fail DB con !! 
if($db->con() === null)
{   
echo 'Please write email to '.$mail->_email.' with Subject: SA-2002 and Message: Database conection fail'; die;
}

dump($_SESSION); die;

$member = new Member($db,$selector);
$validation = new Validation($db,$message);
$requestController = new RequestController($validation,$member,$db);
$articlesController = new ArticlesController($selector);

// $blade->setAuth($username, $role, $permissions);

// Insert all necesary variables for ALL views here
$router->data = ["blade"=>$blade,"request"=>$router->request,"selector"=>$selector,'message'=>$message,'hform'=>$hform,'member'=>$member,'articles'=>$articlesController,'requestController'=>$requestController];
/*
$blade->setCanFunction(function($action, $subject = null) {
    // Perform your permissions checks here
    
    return true;
});
*/
?>