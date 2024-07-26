<?php
	require_once('../includes/participant.php');
	require_once('../includes/impairments.php');
	require_once('../includes/participantIMP.php');
	require_once('../includes/session.php');
	require_once('../includes/stageOfChange.php');
	require_once('../includes/participantSOC.php');
	require_once('../includes/baselineScreeningForm.php');
	require_once('../includes/medication.php');
	require_once('../includes/surgery.php');
	require_once('../includes/participantVI.php');
	global $session;
	global $database;
	$participantid = $session->participantid;
	$participant = participant::find_by_id($participantid);
	
	
		// finding the stage of change for the participant to be used in the alerts rules - starts//
		$tableName = "stage_of_change";
		$id = 'socid';
		$newForm = new stageOfChange();
		// Gets the columns of the questionnaire table 
		$sql = "SHOW COLUMNS FROM ".$tableName;
		$result = $database->query($sql);
		while($row = $database->fetch_array($result)){
			// If The columns exists in the form and is not null it will add the field to the corresponder created class attribute. 
			if(isset($_POST[$row['Field']]) AND !is_null($_POST[$row['Field']])){
				// questionnaire ID will be filled in the questionnaire class and complete_date was filled in the beginning
				if($row['Field'] != 'complete_date' AND $row['Field'] != $id){
					// Gets the form field from the user interface and puts it in the class attributes
					$newForm->{$row['Field']} = $_POST[$row['Field']];
				}
			}
			// Removes the spaces before and after the values
			trim($newForm->{$row['Field']});	
		}
		// finding the stage of change for the participant to be used in the alerts rules - ends//
		
		
	// baseline screening form checking starts //
	$tableName = "baseline_screening_form";
	$id = 'bsfid';
	$bsnewForm = new baselineScreeningForm();
	#calculating body mass index
	$bsnewForm->body_mass_index =  $_POST['body_weight'] / pow($_POST['height']/100,2);
					
	// Gets the columns of the questionnaire table 
	$sql = "SHOW COLUMNS FROM ".$tableName;
	$result = $database->query($sql);
	while($row = $database->fetch_array($result)){
	// If The columns exists in the form and is not null it will add the field to the corresponder created class attribute. 
		if(isset($_POST[$row['Field']]) AND !is_null($_POST[$row['Field']])){
			// questionnaire ID will be filled in the questionnaire class and complete_date was filled in the beginning
				if($row['Field'] != 'complete_date' AND $row['Field'] != $id){
						// Gets the form field from the user interface and puts it in the class attributes
						$bsnewForm->{$row['Field']} = $_POST[$row['Field']];
				}
		}
		// Removes the spaces before and after the values
		trim($bsnewForm->{$row['Field']});	
	}				
	if($participant->gender == 'male' AND $participant->age >45){
		$bsnewForm->older_than_45yr_men = 1;
		$bsnewForm->older_than_55yr_women_or_had_hysterectomy_postmenopausal = 0;
	}elseif($participant->gender == 'female' AND $participant->age >55){
		$bsnewForm->older_than_55yr_women_or_had_hysterectomy_postmenopausal = 1;
		$bsnewForm->older_than_45yr_men = 0;
	}else{
		$bsnewForm->older_than_55yr_women_or_had_hysterectomy_postmenopausal = 0;
		$bsnewForm->older_than_45yr_men = 0;
	}
		/*Sedentary lifestyle: That is, persons not participating in a regular exercise programme or not meeting the minimal physical activity recommendations from the US Surgeon General (30 min or more of moderate physical activity on most days of the week)
		stage 1,2,3 -> yes
		stage 4,5 -> no
	*/
	if($newForm->current_stage() == 'Stage 1' OR $newForm->current_stage() == 'Stage 2' OR $newForm->current_stage() == 'Stage 3'){
		$bsnewForm->sedentary_lifestyle = 1;
	}else{
		$bsnewForm->sedentary_lifestyle = 0;
	}
	/* if body mass index is more than 25, the participant is at risk */ 
	if($bsnewForm->body_mass_index > 25){
		$bsnewForm -> BMI_or_WC_at_risk_value = 1;
	}else{
		$bsnewForm -> BMI_or_WC_at_risk_value = 0;
	}
					
				/*Low Risk: men < 45 years of age, women < 55 years of age who are asymptomatic (e.g., say no to all questions in section two) and meet no more than one risk factor threshold (section 3).
				Moderate Risk: men ≥ 45 years, women ≥ 55 years or those who meet the threshold for two or more risk factors (section 3).
				High Risk: Individuals with one or more major sign and symptoms (section two) or known cardiovascular, pulmonary or metabolic disease (section one).*/	
					if($bsnewForm->stroke_history == 1 OR $bsnewForm->heart_disease_history == 1 OR $bsnewForm->parq_medical_supervised_pa == 1 OR $bsnewForm->parq_medication_intake == 1 OR $bsnewForm->lung_disease_history == 1 OR $bsnewForm->metabollic_disease_history == 1 OR $bsnewForm->cardiovascular_complications_history == 1 OR $bsnewForm->parq_pa_pain_history == 1 OR $bsnewForm->parq_non_pa_pain_history == 1 OR $bsnewForm->parq_lost_balance_lost_conciousness_history == 1 OR $bsnewForm->breathing_difficulty_history == 1  OR $bsnewForm->fatigue_or_short_breath == 1 OR $bsnewForm->leg_pain_cramp_history == 1 OR $bsnewForm->swollen_puffy_ankles_history == 1  OR $bsnewForm->sudden_arms_hands_leg_feet_face_history == 1 OR $bsnewForm->parq_heart_beats_history == 1 OR $bsnewForm->pain_chest_jaw_back_arms_history == 1 OR $bsnewForm->heart_murmur_history == 1)
					{
						$bsnewForm->risk_stratification_category = 'High';
					}elseif(($bsnewForm->older_than_45yr_men == 1 OR $bsnewForm->older_than_55yr_women_or_had_hysterectomy_postmenopausal==1) AND 	$bsnewForm->sedentary_lifestyle == 1 AND $bsnewForm -> BMI_or_WC_at_risk_value ==1){
						$bsnewForm->risk_stratification_category = 'Moderate';	
					}else{
						$bsnewForm->risk_stratification_category = 'Low';	
					}
					
					// Alert creatiion section 
					//if the risk stratification category is high we need to alert them
					echo "<ul>";
					if($bsnewForm->risk_stratification_category == 'High'){
						echo "<li>  Based on your answers in first three sections in previous step you are considered high risk - You need to talk to your doctor before you start exercising. </li>";
					}
					//if they have asthma and they have not talk to their practitioner about it, we need to alert them
					if($bsnewForm->affected_by_asthma_status == 1 AND $bsnewForm->doctor_know_asthma_status == 0){
						echo "<li> Because you said yes to Asthma question, please ensure to talk to your general practitioner prior to participate in this program. </li>";	
					}
					//if they have seizure/epilepsy and they have not talk to their practitioner about it, we need to alert them
					if($bsnewForm->affected_by_seizure_status == 1 AND $bsnewForm->doctor_know_epilepsy_status == 0){
						echo "<li> Because you said yes to Epilepsy/Seizures question, please ensure to talk to your general practitioner prior to participate in this program. </li>";	
					}
					
					if($bsnewForm->last_2week_sickness_status == 1 OR $bsnewForm->last_2week_bedrest_status == 1 OR $bsnewForm->last_2week_viral_illness_status == 1 OR $bsnewForm->last_2week_viral_sorejointsmuscle_status == 1 OR $bsnewForm->last_2week_viral_fever_hotcold_status == 1){
						echo "<li> Because you said yes to at least one of Temporary illness questions, Please ensure that you feel medically well to commence exercise or physical activity. If you are unsure please consult with your general practitioner. </li>";	
					}
					//if they have Bone and joint pain and they have not talk to their practitioner about it, we need to alert them
					if($bsnewForm->parq_musculoskeletal_health_status == 1 AND $bsnewForm->doctor_aware_bone_problem == 0){
						echo "<li> Because you said yes to Bone and joint pain question,  Please ensure that you discuss increasing your physical activity with your relevant practitioner. </li>";	
					}
				
					echo "</ul>";
?>