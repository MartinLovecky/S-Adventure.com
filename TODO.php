<?php
// TODO: @can('',$member)
//! FIXME: permission for -> show/update/create/delete/member
// TODO: PERMISSION implemation
// TODO: Now roles are set manuly inside DBTable. Admin should have this ability inside web !!!   
//? Work in progress MemberData


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