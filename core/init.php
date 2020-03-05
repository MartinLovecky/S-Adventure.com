<?php

use \starproject\tools\Forms;
use \eftec\bladeone\BladeOne;
use \starproject\database\DB;
use \starproject\http\Router;
use \starproject\tools\Mailer;
use \starproject\tools\Messages;
//use \starproject\database\costumers\Member;
use \starproject\tools\Selector;
use \starproject\database\Articles;

//use \starproject\member\Validation;
//use \starproject\controllers\ArticleController;
//use \starproject\controllers\RequestController;

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

/*
$container['member'] = new MemberDB($container);
$container['selector'] = new Selector($container);
$container['articles'] = new Articles;
$container['ArticleController'] = new ArticleController($container);
$router = new Router($container);
$container['validation'] = new Validation($container);
$container['request'] = new RequestController($container);
$container['Hform'] =  new HTMLF($container);
*/

// Insert all necesary variables for ALL views here
$router->data = ["blade"=>$blade,"request"=>$router->request,"selector"=>$selector,'message'=>$message];
// $blade->setAuth($username, $role, $permissions);
?>