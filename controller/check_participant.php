<?php
require_once('../includes/participant.php');
global $database;
	
$participantid = isset($_POST['idmsgbox']) ? trim($_POST['idmsgbox']) : '';
$participantid = $database->escape_value($participantid);
$found_pid = participant::check_pid($participantid);
	
if($found_pid){
	echo 'true';
}else{
	echo 'false';
}
	
?>