<?php
require_once('../includes/participant.php');
global $database;
	
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$email = $database->escape_value($email);
$found_par = participant::check_email($email);
	
if($found_par){
	echo 'false';
}else{
	echo 'true';
}
	
?>