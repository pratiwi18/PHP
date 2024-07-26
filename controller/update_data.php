<?php
require_once('../includes/participant.php');
require_once('../includes/session.php');
require_once('../includes/stageOfChange.php');
require_once('../includes/baselineScreeningForm.php');
require_once('../includes/barriers.php');
require_once('../includes/participantBAR.php');
global $session;
global $database;

if(isset($_POST['go_update_bar'])) {
		$barriers = barriers::find_all();
    $barArr = array();
    foreach ($barriers as $barriers) {
        array_push($barArr, $barriers->bar_id);
    }
    if (isset($_POST['barriersId']))
        $deleteBars = array_diff($barArr, $_POST['barriersId']);
	
    if (isset($deleteBars))
        participantBAR::delete_by_barids($participantid, $deleteBars);
	
    if (isset($_POST['barriersId']))
        for ($counter = 0; $counter < count($_POST['barriersId']); $counter++) {
            $newBar = new participantBAR();
            $newBar->participantid = $participantid;
            $newBar->bar_id = $_POST['barriersId'][$counter];
            $newBar->bar_prority = $counter + 1;
            if ($newBar->bar_prority == 1) {
                $newBar->selected = 2; #barrier with the highest priority (lowest value) will be selected
            } else {
                $newBar->selected = 0;    #other barriers will be not determined
            }
            $complete_date = time();
            $newBar->timestamp = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
            $newBar->submitted = 1;
            $newBar->save();
        }
		echo 'ok';
    //echo '<script>location.replace("/coach_assistant/public/index_participant.php");</script>';
    return;
}
if(isset($_POST['go_update_bsf'])) {
		$participantid = $_POST['bsfpid'];
		$bsfid = $_POST['bsfid'];
		$participant = participant::find_by_id($participantid);
		// baseline screening form saving starts //
    $tableName = "baseline_screening_form";
    $id = 'bsfid';
    //$bsfform = baselineScreeningForm::find_by_pid_saved($participantid);
    $bsfform = baselineScreeningForm::find_by_id($bsfid);
    $bsnewForm = $bsfform;
   	/*else {
        $bsnewForm = new baselineScreeningForm();*/
    $complete_date = time();
    $bsnewForm->complete_date = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
    //$bsnewForm->submitted = 0;

    /*if (!empty($_POST['body_weight']) && !empty($_POST['height'])) {
        $bsnewForm->body_mass_index = $_POST['body_weight'] / pow($_POST['height'] / 100, 2);
    }*/
    // Gets the columns of the questionnaire table
    $sql = "SHOW COLUMNS FROM " . $tableName;
    $result = $database->query($sql);
    while ($row = $database->fetch_array($result)) {
        // If The columns exists in the form and is not null it will add the field to the corresponder created class attribute.
        if (isset($_POST[$row['Field']]) and !is_null($_POST[$row['Field']])) {
            // questionnaire ID will be filled in the questionnaire class and complete_date was filled in the beginning
            if ($row['Field'] != 'complete_date' and $row['Field'] != $id) {
                // Gets the form field from the user interface and puts it in the class attributes
                $bsnewForm->{$row['Field']} = $_POST[$row['Field']];
            }
        }
        // Removes the spaces before and after the values
        trim($bsnewForm->{$row['Field']});
    }
    // puts the participant ID to the questionnaire class attribute named participantid
    // $bsnewForm->participantid = $participantid;
		
    if ($participant->gender == 'male' and $participant->age > 45) {
        $bsnewForm->older_than_45yr_men = 1;
        $bsnewForm->older_than_55yr_women_or_had_hysterectomy_postmenopausal = 0;
    } elseif ($participant->gender == 'female' and $participant->age > 55) {
        $bsnewForm->older_than_55yr_women_or_had_hysterectomy_postmenopausal = 1;
        $bsnewForm->older_than_45yr_men = 0;
    } else {
        $bsnewForm->older_than_55yr_women_or_had_hysterectomy_postmenopausal = 0;
        $bsnewForm->older_than_45yr_men = 0;
    }
    /*
     * Sedentary lifestyle: That is, persons not participating in a regular exercise programme or not meeting the minimal physical activity recommendations from the US Surgeon General (30 min or more of moderate physical activity on most days of the week)
     * stage 1,2,3 -> yes
     * stage 4,5 -> no
     */
    /*if ($newForm->current_stage() == 'Stage 1' or $newForm->current_stage() == 'Stage 2' or $newForm->current_stage() == 'Stage 3') {
        $bsnewForm->sedentary_lifestyle = 1;
    } else {
        $bsnewForm->sedentary_lifestyle = 0;
    }
    /* if body mass index is more than 25, the participant is at risk */
    /*if ($bsnewForm->body_mass_index > 25) {
        $bsnewForm->BMI_or_WC_at_risk_value = 1;
    } else {
        $bsnewForm->BMI_or_WC_at_risk_value = 0;
    }*/
    /*
     * Low Risk: men < 45 years of age, women < 55 years of age who are asymptomatic (e.g., say no to all questions in section two) and meet no more than one risk factor threshold (section 3).
     * Moderate Risk: men ≥ 45 years, women ≥ 55 years or those who meet the threshold for two or more risk factors (section 3).
     * High Risk: Individuals with one or more major sign and symptoms (section two) or known cardiovascular, pulmonary or metabolic disease (section one).
     */
    if ($bsnewForm->stroke_history == 1 or $bsnewForm->heart_disease_history == 1 or $bsnewForm->parq_medical_supervised_pa == 1 or $bsnewForm->parq_medication_intake == 1 or $bsnewForm->lung_disease_history == 1 or $bsnewForm->metabollic_disease_history == 1 or $bsnewForm->cardiovascular_complications_history == 1 or $bsnewForm->parq_pa_pain_history == 1 or $bsnewForm->parq_non_pa_pain_history == 1 or $bsnewForm->parq_lost_balance_lost_conciousness_history == 1 or $bsnewForm->breathing_difficulty_history == 1 or $bsnewForm->fatigue_or_short_breath == 1 or $bsnewForm->leg_pain_cramp_history == 1 or $bsnewForm->swollen_puffy_ankles_history == 1 or $bsnewForm->sudden_arms_hands_leg_feet_face_history == 1 or $bsnewForm->parq_heart_beats_history == 1 or $bsnewForm->pain_chest_jaw_back_arms_history == 1 or $bsnewForm->heart_murmur_history == 1) {
        $bsnewForm->risk_stratification_category = 'High';
    } elseif (($bsnewForm->older_than_45yr_men == 1 or $bsnewForm->older_than_55yr_women_or_had_hysterectomy_postmenopausal == 1) and $bsnewForm->sedentary_lifestyle == 1 and $bsnewForm->BMI_or_WC_at_risk_value == 1) {
        $bsnewForm->risk_stratification_category = 'Moderate';
    } else {
        $bsnewForm->risk_stratification_category = 'Low';
    }
		//var_dump($bsnewForm);
    if ($bsnewForm->save()) {
        echo "<script> alert('update successful') </script>";
        $rlink = "<script>location.replace('/coach_assistant/public/index.php?pageid=participant&paction=update&pid=". $participantid ."&faction=update&fid=bsf&bsfid=". $bsfid ."');</script>";
        echo $rlink;
        return;
    } else {
        echo 'Something went wrong, try again later (BSF)';
        return;
    }
}
    // baseline screening form saving ends //

// stage of change updating begins //
if(isset($_POST['go_update_soc'])) {
		$participantid = $_POST['socpid'];
		$socid = $_POST['socid'];
    $tableName = "stage_of_change";
    $id = 'socid';
    $socform = stageOfChange::find_by_id($socid);
    $newForm = $socform;
    $complete_date = time();
    $newForm->complete_date = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
    //$newForm->status = "current";

    // Gets the columns of the questionnaire table
    $sql = "SHOW COLUMNS FROM " . $tableName;
    $result = $database->query($sql);
    while ($row = $database->fetch_array($result)) {
        // If The columns exists in the form and is not null it will add the field to the corresponder created class attribute.
        if (isset($_POST[$row['Field']]) and !is_null($_POST[$row['Field']])) {
            // questionnaire ID will be filled in the questionnaire class and complete_date was filled in the beginning
            if ($row['Field'] != 'complete_date' and $row['Field'] != $id) {
                // Gets the form field from the user interface and puts it in the class attributes
                $newForm->{$row['Field']} = $_POST[$row['Field']];
            }
        }
        // Removes the spaces before and after the values
        trim($newForm->{$row['Field']});
    }
    // puts the participant ID to the questionnaire class attribute named participantid
    $newForm->participantid = $participantid;
    if ($newForm->save()) {
				echo "<script> alert('update successful') </script>";
        $rlink = "<script>location.replace('/coach_assistant/public/index.php?pageid=participant&paction=update&pid=". $participantid ."&faction=update&fid=soc&socid=". $socid ."');</script>";
        echo $rlink;
        return;
    } else {
        echo 'Something went wrong, try again later (SOC)';
        return;
    }
}
// stage of change updating ends //


if(isset($_POST['go_update_sf12'])) {
		$participantid = $_POST['bsfpid'];
		$bsfid = $_POST['bsfid'];
		$participant = participant::find_by_id($participantid);
		// baseline screening form saving starts //
    $tableName = "baseline_screening_form";
    $id = 'bsfid';
    //$bsfform = baselineScreeningForm::find_by_pid_saved($participantid);
    $bsfform = baselineScreeningForm::find_by_id($bsfid);
    $bsnewForm = $bsfform;
   	/*else {
        $bsnewForm = new baselineScreeningForm();*/
    $complete_date = time();
    $bsnewForm->complete_date = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
    //$bsnewForm->submitted = 0;

    /*if (!empty($_POST['body_weight']) && !empty($_POST['height'])) {
        $bsnewForm->body_mass_index = $_POST['body_weight'] / pow($_POST['height'] / 100, 2);
    }*/
    // Gets the columns of the questionnaire table
    $sql = "SHOW COLUMNS FROM " . $tableName;
    $result = $database->query($sql);
    while ($row = $database->fetch_array($result)) {
        // If The columns exists in the form and is not null it will add the field to the corresponder created class attribute.
        if (isset($_POST[$row['Field']]) and !is_null($_POST[$row['Field']])) {
            // questionnaire ID will be filled in the questionnaire class and complete_date was filled in the beginning
            if ($row['Field'] != 'complete_date' and $row['Field'] != $id) {
                // Gets the form field from the user interface and puts it in the class attributes
                $bsnewForm->{$row['Field']} = $_POST[$row['Field']];
            }
        }
        // Removes the spaces before and after the values
        trim($bsnewForm->{$row['Field']});
    }
    // puts the participant ID to the questionnaire class attribute named participantid
    // $bsnewForm->participantid = $participantid;
		
    if ($participant->gender == 'male' and $participant->age > 45) {
        $bsnewForm->older_than_45yr_men = 1;
        $bsnewForm->older_than_55yr_women_or_had_hysterectomy_postmenopausal = 0;
    } elseif ($participant->gender == 'female' and $participant->age > 55) {
        $bsnewForm->older_than_55yr_women_or_had_hysterectomy_postmenopausal = 1;
        $bsnewForm->older_than_45yr_men = 0;
    } else {
        $bsnewForm->older_than_55yr_women_or_had_hysterectomy_postmenopausal = 0;
        $bsnewForm->older_than_45yr_men = 0;
    }
    if ($bsnewForm->stroke_history == 1 or $bsnewForm->heart_disease_history == 1 or $bsnewForm->parq_medical_supervised_pa == 1 or $bsnewForm->parq_medication_intake == 1 or $bsnewForm->lung_disease_history == 1 or $bsnewForm->metabollic_disease_history == 1 or $bsnewForm->cardiovascular_complications_history == 1 or $bsnewForm->parq_pa_pain_history == 1 or $bsnewForm->parq_non_pa_pain_history == 1 or $bsnewForm->parq_lost_balance_lost_conciousness_history == 1 or $bsnewForm->breathing_difficulty_history == 1 or $bsnewForm->fatigue_or_short_breath == 1 or $bsnewForm->leg_pain_cramp_history == 1 or $bsnewForm->swollen_puffy_ankles_history == 1 or $bsnewForm->sudden_arms_hands_leg_feet_face_history == 1 or $bsnewForm->parq_heart_beats_history == 1 or $bsnewForm->pain_chest_jaw_back_arms_history == 1 or $bsnewForm->heart_murmur_history == 1) {
        $bsnewForm->risk_stratification_category = 'High';
    } elseif (($bsnewForm->older_than_45yr_men == 1 or $bsnewForm->older_than_55yr_women_or_had_hysterectomy_postmenopausal == 1) and $bsnewForm->sedentary_lifestyle == 1 and $bsnewForm->BMI_or_WC_at_risk_value == 1) {
        $bsnewForm->risk_stratification_category = 'Moderate';
    } else {
        $bsnewForm->risk_stratification_category = 'Low';
    }
		//var_dump($bsnewForm);
    if ($bsnewForm->save()) {
        // If the saving was successful it sends a signal
        // echo 'ok';
        // $cps = $_POST["cps"];
				echo "<script> alert('update successful') </script>";
        $rlink = "<script>location.replace('/coach_assistant/public/index.php?pageid=participant&paction=update&pid=". $participantid ."&faction=update&fid=bsf&bsfid=". $bsfid ."');</script>";
        echo $rlink;
        return;
    } else {
        echo 'Something went wrong, try again later (BSF)';
        return;
    }
}
    // SF-12_questionnaire form saving ends //

?>