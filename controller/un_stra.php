<?php
require_once('../includes/session.php');
require_once('../includes/participantSTRA.php');
global $session;
$participantid = $session->participantid;
$stra_bar = participantSTRA::find_by_pid_submitted($participantid);
//var_dump($stra_bar);
		# Just change the success column to 0 
		$stra_bar->success = 0;
		if($stra_bar->save()){
			echo 'ok';	
		}else{
			echo 'not';
		}

?>