<?php  
// this look like selector
$AllBags = ['register'=>$requestController->_register($request),'login'=>null];
$CurrentBag = array_filter($AllBags);
// messages for ?action='something'
$msg = $message->_getAction($selector->queryAction);

if(!empty($CurrentBag)){
    foreach($CurrentBag as $key =>$value){
    // CurrentBags contains [0] = > errors , [1] => Old_data in case of error       
	//$emsg = (isset($CurrentBag[$key][0])) ?? null;
	$username = (isset($CurrentBag[$key][1]['username'])) ?? null;
	$email = (isset($CurrentBag[$key][1]['email'])) ?? null;               
	}     
}
// doesnt works with BLADE bcs variables are not inside $router->insert(,[HERE]);
if(empty($msg))
{
	echo '<h3 class="text-center">'.ucfirst($selector->viewname()).'</h3>';
}
if(!empty($msg))
{
	echo $msg;
}	
?>