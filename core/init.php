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
$router = new Router;
$hform = new Forms;

//! IF You want 'add' new page to allowedPages go to selector
//? inside selector ultimate view rename / delete aftrer test done
# Check Fail DB con !! 
if($db->con() === null){   
    // blade->run(page) -> for send msg
echo $message->message(['error'=>'Please write email to '.$mail->_email.' with Subject: SA-2002 and Message: Database conection fail']); die;
}

$member = new Member($db);
$selector = new Selector($member);
$validation = new Validation($db,$message,$member);
$requestController = new RequestController($validation,$member,$db,$mail,$selector);
$articlesController = new ArticlesController($selector);

// Insert all necesary variables for ALL views here
$router->data = ['router'=>$router,'blade'=>$blade,'request'=>$router->request,'selector'=>$selector,'message'=>$message,'hform'=>$hform,'member'=>$member,'articlesController'=>$articlesController,'requestController'=>$requestController];

//$blade->setAuth($member->getUserName(),)
?>