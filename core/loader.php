<?php
    //start app
    ob_start();
    session_start();
    define('DIR',$_SERVER['DOCUMENT_ROOT']); 

    // INIT classes
    require(DIR . '/core/init.php');
    /* FIX FOOTER min-height: calc(100vh - menuPX - footerPx) -> apply to main (container-fluid) */ 
    // title
    $title = 'SA | '.$selector->title();

    // IF you want use files from public directory (images,css... ) you need set base url
    // $blade->setBaseUrl(DIR .'/public/');
    // then you can do @asset('folder.fileName.css/jpg/etc..')

    // blade @asset ussing any online storage
    $blade->addAssetDict('css.Form-Dark.css','http://staradventure.xf.cz/views/includes/assets/css/Login-Form-Dark.css');
    $blade->addAssetDict('css.styles.css','http://staradventure.xf.cz/views/includes/assets/css/styles.min.css'); //!
    $blade->addAssetDict('css.project-horizont.css','http://staradventure.xf.cz/views/includes/assets/css/project-horizont.min.css');
    $blade->addAssetDict('img.beruska.jpg','http://staradventure.xf.cz/views/includes/assets/img/avatars/editor.jpg');
    $blade->addAssetDict('img.sensei.jpg','http://staradventure.xf.cz/views/includes/assets/img/avatars/sensei.jpeg');   
    $blade->addAssetDict('img.torag.jpg','http://staradventure.xf.cz/views/includes/assets/img/avatars/torag.jpg');
    $blade->addAssetDict('img.icon.jpg','http://staradventure.xf.cz/views/includes/assets/img/apple-touch-icon.png');

    // run APP
    echo $router->_runApp($blade,$selector);

?>

