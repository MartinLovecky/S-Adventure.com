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
$mail = new Mailer;
$message = new Messages;
$articles = new Articles; //maybe not needed
$selector = new Selector;
$router = new Router;
$hform = new Forms;
$member = new Member($db,$selector);
$validation = new Validation($db,$message);
$requestController = new RequestController;
$articlesController = new ArticlesController;

// $blade->setAuth($username, $role, $permissions);

// Insert all necesary variables for ALL views here
$router->data = ["blade"=>$blade,"request"=>$router->request,"selector"=>$selector,'message'=>$message,'hform'=>$hform,'member'=>$member,'articles'=>$articlesController];

?>