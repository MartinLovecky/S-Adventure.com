<?php
$memberID = trim($_GET['x']);
$active = trim($_GET['y']);
//if id is number and the active token is not empty carry on
if(is_numeric($memberID) && !empty($active)){
	$stmt = $db->con()->prepare("UPDATE members SET active = 'Yes' WHERE memberID = :memberID AND active = :active");
	$stmt->execute([':memberID' =>$memberID,':active'=>$active]);

	//if the row was updated redirect the user
	if($stmt->rowCount() == 1){
		header('Location: http://example.com/login?action=active'); exit;
	} 
}
?>