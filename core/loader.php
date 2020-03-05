<?php
    //start app
    ob_start();
    session_start();
    define('DIR','C:\xampp\htdocs\StarAdventure'); 

    // INIT classes
    require(DIR . '/core/init.php');
    
    // title
    $title = 'SA | '.$selector->title();

    // run APP
    echo $router->_runApp($blade,$selector);

?>

