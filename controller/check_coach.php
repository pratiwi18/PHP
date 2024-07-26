<?php
require_once('../includes/coach.php');
global $database;
	
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$email = $database->escape_value($email);
$found_coach = coach::check_email($email);
	
if($found_coach){
	echo 'false';
}else{
	echo 'true';
}
	
?>