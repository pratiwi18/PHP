<?php
	if(isset($_GET['paction'])&&!empty($_GET['paction'])){
		if(isset($_GET['faction'])&&!empty($_GET['faction'])){
			// Loading participant_view page (it is the page to view a particular participant) with the participant ID
		}elseif($_GET['paction']=='view'){
			include_layout_template('participant/participant_view.php');
			// If a participant wants to modify its information initial_information page will be loaded
		}elseif($_GET['paction']=='modify'){
			include_layout_template('forms/initial_information.php');	
		}
		
	}else{
		// Loading participant_view page (it is the page to view a particular participant) if nothing else has been requested
		include_layout_template('participant/participant_view.php');
	}
?>

