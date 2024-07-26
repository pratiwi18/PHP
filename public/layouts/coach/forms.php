<a class="btn btn-outline-primary" href="<?php echo ROOT_DIR."?pageid=participant&paction=".$_GET['paction']."&pid=".$_GET['pid']?>">&laquo Back</a>
<?php
if(isset($_GET['faction'])&&!empty($_GET['faction'])&&isset($_GET['fid'])&&!empty($_GET['fid'])){
	// Loads the requested questionnaire based on the form ID 
	$fid = $_GET['fid'];
	if($fid == 'bsf'){
		include_layout_template('forms/cbaseline_screening_form.php');
	}elseif($fid == 'sf_12'){
		include_layout_template('forms/SF-12_questionnaire.php');
	}elseif($fid == 'hbq'){
		include_layout_template('forms/health_behaviour_questionnaire.php');
	}elseif($fid == 'soc'){
		include_layout_template('forms/cstage_of_change.php');
	}elseif($fid == 'db'){
		include_layout_template('forms/decisional_balance.php');
	}elseif($fid == 'ss'){
		include_layout_template('forms/social_support.php');
	}elseif($fid == 'seq'){
		include_layout_template('forms/self_efficacy_questionnaire.php');
	}elseif($fid == 'dwl'){
		include_layout_template('forms/difficulty_with_locomotor.php');
	}else{
		echo "Page not found";
	}
}else{
	echo "Page not found";	
}
?>
