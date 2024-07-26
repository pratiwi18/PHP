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
$participantid = $session->participantid;
$participant = participant::find_by_id($participantid);

if (isset($_POST['saving-gtky'])) {

    // impairments saving begins //
    //$impairments = impairments::find_all();
    $impArr = array();
    if (isset($_POST["impairments"]))
        $impArr = $_POST["impairments"];
    /*foreach ($impairments as $impairment) {
        array_push($impArr, $impairment->imp_id);
    }

    if (!empty($_POST['impairments'])) {
        $deleteImps = array_diff($impArr, $_POST['impairments']);
    } else {
        $deleteImps = $impArr;
    }*/

    //participantIMP::delete_by_impids($participantid, $deleteImps);
    participantIMP::delete_by_participantid($participantid); // kien

    foreach ($impArr as $impairment) {
        $newImp = new participantIMP();
        $newImp->participantid = $participantid;
        $newImp->imp_id = $impairment;
        $complete_date = time();
        $newImp->timestamp = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
        $newImp->save();
    }
    // impairments saving end //

    // stage of change saving begins //
    $tableName = "stage_of_change";
    $id = 'socid';
    $socform = stageOfChange::find_by_pid_saved($participantid);
    if (!empty($socform)) {
        $newForm = $socform;
    } else {
        $newForm = new stageOfChange();
        $complete_date = time();
        $newForm->complete_date = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
    }
    $newForm->submitted = 0;
    $newForm->status = "current";

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
    } else {
        echo 'Something went wrong, try again later (SOC)';
        return;
    }
    // stage of change saving ends //

    // value identification saving begins //
    $viIds = $_POST['viId'];
    $viIds = array_slice($viIds, 0, 5, true);
    $vi_s_ids = "";
    foreach ($viIds as $viId) {
        $vi_s_ids .= $viId;
        $vi_s_ids .= ",";
    }
    $vi_s_ids = substr($vi_s_ids, 0, -1);
    trim($vi_s_ids);
    $newVi = new participantVI();
    $newVi->participantid = $participantid;
    $newVi->vi_ids = $vi_s_ids;
    $newVi->submitted = 0;
    $complete_date = time();
    $newVi->timestamp = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
    if ($newVi->save()) {
    } else {
        echo 'Something went wrong, try again later (VI)';
        return;
    }
    // value identification saving ends //

    // baseline screening form saving starts //
    $tableName = "baseline_screening_form";
    $id = 'bsfid';
    //$bsfform = baselineScreeningForm::find_by_pid_saved($participantid);
    $bsfform = baselineScreeningForm::find_by_pid_completed_desc($participantid); // kien
    if (!empty($bsfform)) {
        $bsnewForm = $bsfform;
    } else {
        $bsnewForm = new baselineScreeningForm();
        $complete_date = time();
        $bsnewForm->complete_date = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
    }
    $bsnewForm->submitted = 0;

    if (!empty($_POST['body_weight']) && !empty($_POST['height'])) {
        $bsnewForm->body_mass_index = $_POST['body_weight'] / pow($_POST['height'] / 100, 2);
    }

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
    $bsnewForm->participantid = $participantid;

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
    if ($newForm->current_stage() == 'Stage 1' or $newForm->current_stage() == 'Stage 2' or $newForm->current_stage() == 'Stage 3') {
        $bsnewForm->sedentary_lifestyle = 1;
    } else {
        $bsnewForm->sedentary_lifestyle = 0;
    }
    /* if body mass index is more than 25, the participant is at risk */
    if ($bsnewForm->body_mass_index > 25) {
        $bsnewForm->BMI_or_WC_at_risk_value = 1;
    } else {
        $bsnewForm->BMI_or_WC_at_risk_value = 0;
    }
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
    if ($bsnewForm->save()) {
        // If the saving was successful it sends a signal
        // echo 'ok';
        $cps = $_POST["cps"];
        $rlink = "<script>location.replace('/coach_assistant/public/index_participant.php?cps=" . $cps . "');</script>";

        echo $rlink;
        return;
    } else {
        echo 'Something went wrong, try again later (BSF)';
        return;
    }
    // baseline screening form saving ends //
} elseif (isset($_POST['gtky-submission'])) {
    // stage of change saving begins //
    $tableName = "stage_of_change";
    $id = 'socid';
    $socform = stageOfChange::find_by_pid_saved($participantid);
    if (!empty($socform)) {
        $newForm = $socform;
    } else {
        $newForm = new stageOfChange();
        $complete_date = time();
        $newForm->complete_date = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
    }
    $newForm->submitted = 1;
    $newForm->status = "submitted";

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
    // var_dump($newForm);
    $cstage = $newForm->current_stage();
    if ($cstage == "Invalid input") {
        //echo 'Wrong combination of answers for the first form, please change your answer for the first form';
        //header("Location: coach_assistant/public/index_participant.php?cps=soc12");
      
        echo "<script> alert('Wrong combination of answers for the first form, please change your answer') </script>";
        echo "<script> location.replace('/coach_assistant/public/index_participant.php?cps=soc12') </script>";
        return ;
    }

    // stage of change saving ends //

    // impairments saving begins //
    // First we need to check if there is any rules avaliable for this combination
    $parImpCats = array();
    foreach ($_POST['impairments'] as $impairment) {
        $imp_cat = impairments::find_by_id($impairment);
        if (!in_array($imp_cat->imp_cat_id, $parImpCats)) {
            array_push($parImpCats, $imp_cat->imp_cat_id);
        }
    }
    sort($parImpCats);
       // echo "<script> alert('No rules can be found based on your answers, please select different impairments') </script>";
    
    $bar_ids = array();
    foreach ($parImpCats as $parImpCat) {
        $sql_barmap = "SELECT * FROM barriers_mapping WHERE current_stage='{$cstage}' AND  imp_cat_ids LIKE '%{$parImpCat}%'";
        $result_set = $database->query($sql_barmap);
        while ($row = $database->fetch_array($result_set)) {
            array_push($bar_ids, $row);
        }
    }

    // if there is any rule
    if (!empty($bar_ids)) {
        // kien start
        $impArr = $_POST["impairments"];
        participantIMP::delete_by_participantid($participantid); // kien

        foreach ($impArr as $impairment) {
            $newImp = new participantIMP();
            $newImp->participantid = $participantid;
            $newImp->imp_id = $impairment;
            $complete_date = time();
            $newImp->timestamp = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
            $newImp->save();
        }
        // kien end
        /*$impairments = impairments::find_all();
        $impArr = array();
        foreach ($impairments as $impairment) {
            array_push($impArr, $impairment->imp_id);
        }

        if (!empty($_POST['impairments'])) {
            $deleteImps = array_diff($impArr, $_POST['impairments']);
        } else {
            $deleteImps = $impArr;
        }
        participantIMP::delete_by_impids($participantid, $deleteImps);

        foreach ($_POST['impairments'] as $impairment) {
            $newImp = new participantIMP();
            $newImp->participantid = $participantid;
            $newImp->imp_id = $impairment;
            $complete_date = time();
            $newImp->timestamp = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
            $newImp->save();
        }*/
    } else {
        //echo 'No rules can be found based on your answers, please select different impairments';
        echo "<script> alert('No rules can be found based on your answers, please select different impairments') </script>";
        echo "<script> location.replace('/coach_assistant/public/index_participant.php?cps=impair') </script>";
  
        return;
    }

    // impairments saving end //

    // value identification saving begins //
    $vi_s_ids = "";
    $viIds = $_POST['viId'];
    $viIds = array_slice($viIds, 0, 5, true);
    foreach ($viIds as $viId) {
        $vi_s_ids .= $viId;
        $vi_s_ids .= ",";
    }
    $vi_s_ids = substr($vi_s_ids, 0, -1);
    trim($vi_s_ids);
    $newVi = new participantVI();
    $newVi->participantid = $participantid;
    $newVi->vi_ids = $vi_s_ids;
    $newVi->submitted = 1;
    $complete_date = time();
    $newVi->timestamp = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
    if ($newVi->save()) {
        // saving stage of change
        if ($newForm->save()) {
            // baseline screening form saving starts //
            $tableName = "baseline_screening_form";
            $id = 'bsfid';
            //$bsfform = baselineScreeningForm::find_by_pid_saved($participantid);
            $bsfform = baselineScreeningForm::find_by_pid_completed_desc($participantid); // kien
            if (!empty($bsfform)) {
                $bsnewForm = $bsfform;
            } else {
                $bsnewForm = new baselineScreeningForm();
                $complete_date = time();
                $bsnewForm->complete_date = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
            }
            $bsnewForm->submitted = 1;
            $bsnewForm->body_mass_index = $_POST['body_weight'] / pow($_POST['height'] / 100, 2);

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
            $bsnewForm->participantid = $participantid;

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
            if ($newForm->current_stage() == 'Stage 1' or $newForm->current_stage() == 'Stage 2' or $newForm->current_stage() == 'Stage 3') {
                $bsnewForm->sedentary_lifestyle = 1;
            } else {
                $bsnewForm->sedentary_lifestyle = 0;
            }
            if ($bsnewForm->body_mass_index > 25) {
                $bsnewForm->BMI_or_WC_at_risk_value = 1;
            } else {
                $bsnewForm->BMI_or_WC_at_risk_value = 0;
            }

            if ($bsnewForm->stroke_history == 1 or $bsnewForm->heart_disease_history == 1 or $bsnewForm->parq_medical_supervised_pa == 1 or $bsnewForm->parq_medication_intake == 1 or $bsnewForm->lung_disease_history == 1 or $bsnewForm->metabollic_disease_history == 1 or $bsnewForm->cardiovascular_complications_history == 1 or $bsnewForm->parq_pa_pain_history == 1 or $bsnewForm->parq_non_pa_pain_history == 1 or $bsnewForm->parq_lost_balance_lost_conciousness_history == 1 or $bsnewForm->breathing_difficulty_history == 1 or $bsnewForm->fatigue_or_short_breath == 1 or $bsnewForm->leg_pain_cramp_history == 1 or $bsnewForm->swollen_puffy_ankles_history == 1 or $bsnewForm->sudden_arms_hands_leg_feet_face_history == 1 or $bsnewForm->parq_heart_beats_history == 1 or $bsnewForm->pain_chest_jaw_back_arms_history == 1 or $bsnewForm->heart_murmur_history == 1) {
                $bsnewForm->risk_stratification_category = 'High';
            } elseif (($bsnewForm->older_than_45yr_men == 1 or $bsnewForm->older_than_55yr_women_or_had_hysterectomy_postmenopausal == 1) and $bsnewForm->sedentary_lifestyle == 1 and $bsnewForm->BMI_or_WC_at_risk_value == 1) {
                $bsnewForm->risk_stratification_category = 'Moderate';
            } else {
                $bsnewForm->risk_stratification_category = 'Low';
            }
            if ($bsnewForm->save()) {
                // If the saving was successful it send a signal
                // echo 'ok';
                $_SESSION['current_step'] = "barriers"; // kien

                echo '<script>location.replace("/coach_assistant/public/index_participant.php");</script>'; // kien
                return;
            } else {
                echo 'Something went wrong, try again later (BSF)';
                return;
            }
        } else {
            echo 'Something went wrong, try again later (SOC)';
            return;
        }
    } else {
        echo 'Something went wrong, try again later (VI)';
        return;
    }
    // value identification saving ends //
} else {
    echo 'Something went wrong';
}
?>