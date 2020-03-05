<?php

use \starproject\tools\Forms;
use \eftec\bladeone\BladeOne;
use \starproject\database\DB;
use \starproject\http\Router;
use \starproject\tools\Mailer;
use \starproject\tools\Messages;
use \starproject\database\costumers\Member;
use \starproject\tools\Selector;
use \starproject\database\Articles;
use \starproject\tools\Validation;
//use \starproject\controllers\ArticleController;
use \starproject\controllers\RequestController;

require(DIR . '/vendor/autoload.php'); 

$views = DIR . '/resources/views';
$cache = DIR . '/tmp/cache';
$blade = new BladeOne($views,$cache,BladeOne::MODE_AUTO);
$blade->setBaseUrl(DIR .'/public/');
$db = new DB;
$mail = new Mailer;
$message = new Messages;
$articles = new Articles;
$selector = new Selector;
$router = new Router;
$HForm = new Forms;
$member = new Member($db,$selector);
$validation = new Validation($db,$message);
$requestController = new RequestController;


//$container['ArticleController'] = new ArticleController($container);
// $blade->setAuth($username, $role, $permissions);

// Insert all necesary variables for ALL views here
$router->data = ["blade"=>$blade,"request"=>$router->request,"selector"=>$selector,'message'=>$message];

?>