<?php
// TODO: @can('',$member)
// TODO: Now roles are set manuly inside DBTable. Admin should have this ability inside web !!! (almost done)
// TODO: /member will show list of all users without their info if not public(set up by user)  (almost done)
// TODO: EDITOR
//? Work in progress MemberData
// TODO: templates for email doesnt show correctly -> bugfixing
// TODO: messages inside /index 

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