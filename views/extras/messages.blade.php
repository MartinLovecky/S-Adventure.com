<?php
// messages for ?action='something'
$actionMsg = $message->_getAction($selector->queryAction);

if(empty($actionMsg) && $selector->action != 'member')
{
	echo '<h3 class="text-center">'.ucfirst($selector->viewname()).'</h3>';
}
if(!empty($actionMsg))
{
	echo $msg;
}	
if(isset($selector->message))
{
	echo $selector->message;
}

?>