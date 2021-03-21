<?php
//start app
    ob_start();
    session_start();
    define('DIR',$_SERVER['DOCUMENT_ROOT']); 
// INIT classes
    use \eftec\bladeone\BladeOne;
    use \starproject\http\Router;
    use \starproject\tools\Mailer;
    use \starproject\tools\Messages;
    use \starproject\tools\Selector;
    use \starproject\tools\Validation;
    use \starproject\tools\Forms;
    use \starproject\database\Datab;
    use \starproject\database\costumers\Member;
    use \starproject\controllers\RequestController;
    use \starproject\controllers\ArticlesController; 
    use \starproject\tools\Sanitazorx;
    use \starproject\tools\html\Wrapper;

    require(DIR . '/vendor/autoload.php'); 
    $blade = new BladeOne(DIR.'/views',DIR.'/tmp',BladeOne::MODE_AUTO);
    $blade->pipeEnable=true;

//@asset('folder.fileName.css/jpg/etc..')
    $blade->setBaseUrl('/public/'); 

    $db = new Datab;
    $message = new Messages; 
    $mail = new Mailer;
    $sanitazor  = new Sanitazorx;
    $form = new Forms;

    //! Be sure to use correct connect info for your DB  inside DBcon 
    $db->stateMode = 'localhost';
    
    $member = new Member($db);
    $selector = new Selector($member,$sanitazor);
    $wrapper = new Wrapper($selector); //maybe rename to pagnation
    $validation = new Validation($db,$message,$member);
    $requestController = new RequestController($validation,$member,$db,$mail,$selector);
    $articlesController = new ArticlesController($selector,$member,$message,$db);

// Insert all variables for views 
//! We need call this function to use @csrf 
    $blade->getCsrfToken($selector);

//$blade->setAuth($member->getUserName(),)
// run APP
    $router = new Router($data = require(DIR . '/core/app/routerData.php'));
    echo $router->runApp();
?>