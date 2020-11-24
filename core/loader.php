<?php
    //start app
    ob_start();
    session_start();
    define('DIR',$_SERVER['DOCUMENT_ROOT']); 

    // INIT classes
    require(DIR . '/core/init.php');

    // title
    $title = 'SA | '.$selector->title();

    // IF you want use files from public directory (images,css... ) you need set base url
    $blade->setBaseUrl('/public/'); //-> @asset('folder.fileName.css/jpg/etc..')
    
    //? online storage: $blade->addAssetDict('css.Form-Dark.css','LINK'); ETC ..

    // run APP
    echo $router->_runApp($blade,$selector);
?>

