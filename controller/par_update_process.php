<?php
require_once('../includes/participant.php');
require_once('../includes/session.php');
if(isset($_POST['go_update'])){
	global $session;
	global $database;
	$participantid = $session->participantid;
	$participant = participant::find_by_id($participantid);
	// Gets the columns of the participant table 
	$sql = "SHOW COLUMNS FROM participant";
	$result = $database->query($sql);
	while($row = $database->fetch_array($result)){
		// If The columns exists in the participant table and is not null it will add the field to the corresponder created class attribute. 
		if(isset($_POST[$row['Field']]) AND !is_null($_POST[$row['Field']])){
			// Register_date was filled in the beginning - participantid will be filled in the save method in the participant class - passsword will be filled later here
			if($row['Field'] != 'register_date' AND $row['Field'] != 'participantid' AND $row['Field'] != 'password'){
				// Gets the participant form fields from the user interface and puts it in the participant class attributes
				$participant->{$row['Field']} = $_POST[$row['Field']];
			}
		}else{
			// If The columns does not exist puts NULL in the created participant class attribute.
			if($row['Field'] != 'register_date' AND $row['Field'] != 'participantid' AND $row['Field'] != 'password'){
				$participant->{$row['Field']} = NULL;
			}
		}
		trim($participant->{$row['Field']});	
		}
		if(isset($participant->date_of_birth) AND !empty($participant->date_of_birth)){
			// Calculates the age of the participant
			$participant->age = participant::age_calculator($participant->date_of_birth);
		}
		
		
	if($participant->save()){
		$session->participantName =  $_SESSION['participantName']  = $participant->first_name;
		// If the saving was successful it will redirect to the main participant page
		//redirect_to(MAIN_PAGE.'?pageid=participant');
		echo 'ok';
		}else{
			echo 'something went wrong, try agian later';
		}
}
?>