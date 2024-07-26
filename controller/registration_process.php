<?php
require_once('../includes/participant.php');
require_once('../includes/coach.php');
// This is the controller for adding, updating and deleting a participant. 
	if(isset($_POST['go_register'])){
		global $database;
		if(isset($_GET['pid'])&&!empty($_GET['pid'])){
			// If it is updating a participant
			$participant = participant::find_by_id($_GET['pid']);
			}else{
			// if it is adding a participant
			$participant = new participant();
			$register_date = time();
			$participant->register_date = strftime("%Y-%m-%d",$register_date);
			}
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
	if(!empty($_POST['password'])){
		// If the password is not empty first it will hash it then save it in the participant class attribute
		$participant->password = password_hash($_POST['password'],PASSWORD_BCRYPT);
		$cpassword = password_hash($_POST['cpassword'],PASSWORD_BCRYPT);
	}
	if($participant->save()){
		// If the saving was successful it will redirect to the main participant page
		echo 'ok';
		}else{
			echo 'something went wrong, try agian later';
		}
}

if(isset($_POST['go_register_coach'])){
		global $database;
		$coach = new coach();
		$sql = "SHOW COLUMNS FROM coach";
		$result = $database->query($sql);
		while($row = $database->fetch_array($result)){
			// If The columns exists in the participant table and is not null it will add the field to the corresponder created class attribute. 
			if(isset($_POST[$row['Field']]) AND !is_null($_POST[$row['Field']])){
				// Register_date was filled in the beginning - participantid will be filled in the save method in the participant class - passsword will be filled later here
				if($row['Field'] != 'coachid' AND $row['Field'] != 'password'){
					// Gets the participant form fields from the user interface and puts it in the participant class attributes
					$coach->{$row['Field']} = $_POST[$row['Field']];
				}
			}else{
				// If The columns does not exist puts NULL in the created participant class attribute.
				if($row['Field'] != 'coachid' AND $row['Field'] != 'password'){
					$coach->{$row['Field']} = NULL;
				}
			}
			trim($coach->{$row['Field']});	
		}
	if(!empty($_POST['password'])){
		// If the password is not empty first it will hash it then save it in the participant class attribute
		$coach->password = password_hash($_POST['password'],PASSWORD_BCRYPT);
		$cpassword = password_hash($_POST['cpassword'],PASSWORD_BCRYPT);
	}
	if($coach->save()){
		// If the saving was successful it will redirect to the main participant page
		echo 'ok';
		}else{
			echo 'something went wrong, try agian later';
		}
	}
?>