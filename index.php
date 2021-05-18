<?php
//start app
    ob_start();
    session_start();
    define('DIR', $_SERVER['DOCUMENT_ROOT']);

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

    // INIT classes
    require(DIR . '/vendor/autoload.php');
    $blade = new BladeOne(DIR.'/views', DIR.'/tmp', BladeOne::MODE_AUTO);
    $blade->pipeEnable=true; // maybe not necesary
    $blade->setBaseUrl('/public/'); //@asset('folder.fileName.css/jpg/etc..')
    $db = new Datab;
    $message = new Messages;
    $mail = new Mailer;
    $sanitazor  = new Sanitazorx;
    $form = new Forms;

    //! Be sure to use correct connect info for your DB  inside DBcon
    $db->stateMode = 'localhost';
    
// Check user remeber
    if (isset($_COOKIE['user_remember'])) {
        $con = $db->con();
        $userHash = $db->getUserHash($_COOKIE['user_remember']);
        if (hash_equals($userHash, $_COOKIE['user_remember'])) {
            $stmt = $con->from('members')->where('remeber', $_COOKIE['user_remember']);
            $dbRemData = $stmt->fetch();
            $member->loggedin = true;
        }
    }
// More classes
    $member = new Member($db, $userRemData = require(DIR . '/core/data.php'));
    $selector = new Selector($sanitazor);
    $wrapper = new Wrapper($selector); //maybe rename to pagnation
    $validation = new Validation($db, $message, $member);
    $requestController = new RequestController($validation, $member, $mail, $selector, $db);
    $articlesController = new ArticlesController($selector, $member, $message, $db);
    $router = new Router($data = require(DIR . '/core/app/routerData.php'));
    //! We need call this function to use @csrf
    $blade->getCsrfToken($selector);
// Run APP
    echo $router->runApp();
    if ($member->loggedin) {
        $blade->setAuth($member->username, $member->permission);
    }
