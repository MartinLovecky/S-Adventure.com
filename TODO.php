<?php
// TODO: @can('',$member)
//! FIXME: permission for -> show/update/create/delete/member
//! FIX : selector->get()
// TODO: PERMISSION
// TODO: Now roles are set manuly inside DBTable. Admin should have this ability inside web !!!   
//? Work in progress MemberData
/** $router->url('/something')->mobile('memberID',$class))->action('logged'); = http://sadventure.com/something/username/?action=logged¨
 * change link to page {username} to {memberID}
 * http://sadventure.com/member/1
 * rename member.blade.php ? or keep for list of all users
 * memberprofile,balde.php should show profile ...

 * variants
    *$router->url(''); = http://sadventure.com/
    *$router->url('/');  = http://sadventure.com/index
    *$router->url('/show') = http://sadventure.com/show
    
 *mobile('action',$class)
    *mobile('articleName',$selector)->action(1); = http://sadventure.com/show/{articleName}/1
    *mmobile('memberName',$members)->action(); = http://sadventure.com/member/{memberName}

 *action('logged')    

**/
// default  username=>visitor,role=>none,//?permission=>visit
// IF user is logged -> username => Username,role=>user,//?permission=>view 
// IF user is Editor -> username =>Username,role=>edior,//?permission=>edit
// IF user is Admin -> username =>Username,role=>admin,//?permission=>all
                       
// $blade->setAuth($username, $role, $permissions);
// can('visit',$class)
/*
$blade->setCanFunction(function($action, $subject = null) {
    Perform your permissions checks here
  return true;
});
*/