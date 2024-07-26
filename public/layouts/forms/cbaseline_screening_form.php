<?php
global $session;
// Loading a participant based on participant session
if($session->participant_is_logged_in()) {
	$participantid = $session->participantid;
}
else {
	$participantid = $_GET['pid'];
}
//$bsf_form = baselineScreeningForm::find_by_pid_saved($participantid); kien
/*$bsf_form = baselineScreeningForm::find_by_pid_completed_desc($participantid);
if (!empty($bsf_form)) {
    $bsfid = $bsf_form->bsfid;
    // Grab the information about the medication from the database based on the bsfid
    $meds = Medication::find_by_id($bsfid);
    $surgs = Surgery::find_by_id($bsfid);
}*/
if(isset($_GET['bsfid'])&&!empty($_GET['bsfid'])){ 
	$bsfid = $_GET['bsfid'];
	// Grab the information about the quesitionnaire from the database based on the fuid
	$bsf_form = baselineScreeningForm::find_by_id($bsfid);
	if (!empty($bsf_form)) {
    $bsfid = $bsf_form->bsfid;
    // Grab the information about the medication from the database based on the bsfid
    $meds = Medication::find_by_id($bsfid);
    $surgs = Surgery::find_by_id($bsfid);
	}
}
?>

<form class="text-center" method="post" name="bsf-form" id="bsf-form" action="/coach_assistant/controller/update_data.php" novalidate>
		<input type="hidden" name="bsfpid" id="bsfpid" value="<?php echo $_GET['pid'] ?>">
		<input type="hidden" name="bsfid" id="bsfid" value="<?php echo $_GET['bsfid'] ?>">
	<div id="accordion" class="mb-5 mt-5" role="tablist">
    <div class="card">
        <div class="card-header" role="tab" id="headingOne">
            <h5 class="mb-0">
                <a data-toggle="collapse" href="#collapseOne" aria-expanded="true"
                   aria-controls="collapseOne"> Known Cardiovascular, Pulmonary and/or
                    Metabolic Disease </a>
            </h5>
        </div>

        <div id="collapseOne" class="collapse show" role="tabpanel"
             aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <div class=" ">
                    <div class="col-md-12 mb-5">
                        <h3>
                            <strong> Known Cardiovascular, Pulmonary and/or Metabolic Disease
                            </strong>
                        </h3>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">Have you</th>
                            <th>Yes</th>
                            <th>No</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">A</th>
                            <td class="text-left">Ever had a stroke?</td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio" name="stroke_history"
                                                id="stroke_history" value="1"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->stroke_history) AND $bsf_form->stroke_history == 1) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio" name="stroke_history"
                                                id="stroke_history" value="0"
                                            <?php
                                            if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->stroke_history) AND $bsf_form->stroke_history == 0) echo 'checked';
                                                if (is_null($bsf_form->stroke_history))  echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">B</th>
                            <td class="text-left">Ever had anything wrong with your heart
                                (e.g., heart attack, heart surgery, heart failure etc)
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="heart_disease_history" id="heart_disease_history"
                                                value="1"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->heart_disease_history) AND $bsf_form->heart_disease_history == 1) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="heart_disease_history" id="heart_disease_history"
                                                value="0"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->heart_disease_history) AND $bsf_form->heart_disease_history == 0) echo 'checked';
                                                if (is_null($bsf_form->heart_disease_history))  echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">C</th>
                            <td class="text-left">Ever been told by your doctor that you
                                have a heart condition and recommended only medically
                                supervised physical activity?
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="parq_medical_supervised_pa"
                                                id="parq_medical_supervised_pa" value="1"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->parq_medical_supervised_pa) AND $bsf_form->parq_medical_supervised_pa == 1) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="parq_medical_supervised_pa"
                                                id="parq_medical_supervised_pa" value="0"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->parq_medical_supervised_pa) AND $bsf_form->parq_medical_supervised_pa == 0) echo 'checked';
                                                if (is_null($bsf_form->parq_medical_supervised_pa))  echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">D</th>
                            <td class="text-left">Ever been told by your doctor that they
                                should take medication to control blood pressure or a heart
                                condition?
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="parq_medication_intake" id="parq_medication_intake"
                                                value="1"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->parq_medication_intake) AND $bsf_form->parq_medication_intake == 1) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="parq_medication_intake" id="parq_medication_intake"
                                                value="0"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->parq_medication_intake) AND $bsf_form->parq_medication_intake == 0) echo 'checked';
                                                if (is_null($bsf_form->parq_medication_intake))  echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">E</th>
                            <td class="text-left">Ever been diagnosed with any chronic,
                                progressive or uncontrolled breathing or lung problems (chronic
                                obstructive pulmonary disease, interstitial lung disease or
                                cystic fibrosis)
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="lung_disease_history" id="lung_disease_history"
                                                value="1"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->lung_disease_history) AND $bsf_form->lung_disease_history == 1) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="lung_disease_history" id="lung_disease_history"
                                                value="0"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->lung_disease_history) AND $bsf_form->lung_disease_history == 0) echo 'checked';
                                                if (is_null($bsf_form->lung_disease_history))  echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">F</th>
                            <td class="text-left">Ever been diagnosed with any chronic,
                                progressive or uncontrolled metabolic disease (e.g., diabetes
                                mellitus type 1 or type 2, thyroid disorders, kidney or liver
                                disease)
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="metabollic_disease_history"
                                                id="metabollic_disease_history" value="1"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->metabollic_disease_history) AND $bsf_form->metabollic_disease_history == 1) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="metabollic_disease_history"
                                                id="metabollic_disease_history" value="0"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->metabollic_disease_history) AND $bsf_form->metabollic_disease_history == 0) echo 'checked';
                                                if (is_null($bsf_form->metabollic_disease_history))  echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">G</th>
                            <td class="text-left">Got a heath condition that has known
                                cardiovascular complications (e.g., Down Syndrome,
                                Friedrich’s Ataxia, Marfan’s Syndrome)
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="cardiovascular_complications_history"
                                                id="cardiovascular_complications_history" value="1"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->cardiovascular_complications_history) AND $bsf_form->cardiovascular_complications_history == 1) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="cardiovascular_complications_history"
                                                id="cardiovascular_complications_history" value="0"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->cardiovascular_complications_history) AND $bsf_form->cardiovascular_complications_history == 0) echo 'checked';
                                                if (is_null($bsf_form->cardiovascular_complications_history))  echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" role="tab" id="headingTwo">
            <h5 class="mb-0">
                <a class="collapsed" data-toggle="collapse" href="#collapseTwo"
                   aria-expanded="false" aria-controls="collapseTwo"> Symptoms of
                    cardiovascular, metabolic or pulmonary disease </a>
            </h5>
        </div>
        <div id="collapseTwo" class="collapse" role="tabpanel"
             aria-labelledby="headingTwo" data-parent="#accordion">
            <div class="card-body">
                <div class=" ">
                    <div class="col-md-12 mb-5">
                        <h3>
                            <strong> Symptoms of cardiovascular, metabolic or pulmonary
                                disease </strong>
                        </h3>
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">In the past 12 months, have you noticed
                                that you
                            </th>
                            <th>Yes</th>
                            <th>No</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">A</th>
                            <td class="text-left">Feel pain in the chest, jaw, shoulder or
                                arms when doing physical activity (e.g., walking, lifting,
                                pushing, climbing stairs)?
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="parq_pa_pain_history" id="parq_pa_pain_history"
                                                value="1"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->parq_pa_pain_history) AND $bsf_form->parq_pa_pain_history == 1) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="parq_pa_pain_history" id="parq_pa_pain_history"
                                                value="0"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->parq_pa_pain_history) AND $bsf_form->parq_pa_pain_history == 0) echo 'checked';
                                                if (is_null($bsf_form->parq_pa_pain_history)) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">B</th>
                            <td class="text-left">Get pain or discomfort in the chest, jaw,
                                shoulder or arms when you are not doing physical activity?
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="parq_non_pa_pain_history" id="parq_non_pa_pain_history"
                                                value="1"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->parq_non_pa_pain_history) AND $bsf_form->parq_non_pa_pain_history == 1) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="parq_non_pa_pain_history" id="parq_non_pa_pain_history"
                                                value="0"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->parq_non_pa_pain_history) AND $bsf_form->parq_non_pa_pain_history == 0) echo 'checked';
                                                if (is_null($bsf_form->parq_non_pa_pain_history)) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">C</th>
                            <td class="text-left">Lost balance because of dizziness or lost
                                consciousness (e.g., fainting, blackouts)?
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="parq_lost_balance_lost_conciousness_history"
                                                id="parq_lost_balance_lost_conciousness_history" value="1"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->parq_lost_balance_lost_conciousness_history) AND $bsf_form->parq_lost_balance_lost_conciousness_history == 1) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="parq_lost_balance_lost_conciousness_history"
                                                id="parq_lost_balance_lost_conciousness_history" value="0"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->parq_lost_balance_lost_conciousness_history) AND $bsf_form->parq_lost_balance_lost_conciousness_history == 0) echo 'checked';
                                                if (is_null($bsf_form->parq_lost_balance_lost_conciousness_history)) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">D</th>
                            <td class="text-left">Experienced difficulty breathing while
                                lying down, such that it affects getting to sleep and/or
                                staying asleep (i.e., does it wake you up).
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="breathing_difficulty_history"
                                                id="breathing_difficulty_history" value="1"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->breathing_difficulty_history) AND $bsf_form->breathing_difficulty_history == 1) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="breathing_difficulty_history"
                                                id="breathing_difficulty_history" value="0"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->breathing_difficulty_history) AND $bsf_form->breathing_difficulty_history == 0) echo 'checked';
                                                if (is_null($bsf_form->breathing_difficulty_history)) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">E</th>
                            <td class="text-left">Experienced unusual fatigue or shortness
                                of breath with usual activities or with mild exertion
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="fatigue_or_short_breath" id="fatigue_or_short_breath"
                                                value="1"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->fatigue_or_short_breath) AND $bsf_form->fatigue_or_short_breath == 1) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="fatigue_or_short_breath" id="fatigue_or_short_breath"
                                                value="0"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->fatigue_or_short_breath) AND $bsf_form->fatigue_or_short_breath == 0) echo 'checked';
                                                if (is_null($bsf_form->fatigue_or_short_breath)) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">F</th>
                            <td class="text-left">Get pains or cramps in the legs when doing
                                usual activities or with mild exertion
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="leg_pain_cramp_history" id="leg_pain_cramp_history"
                                                value="1"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->leg_pain_cramp_history) AND $bsf_form->leg_pain_cramp_history == 1) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="leg_pain_cramp_history" id="leg_pain_cramp_history"
                                                value="0"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->leg_pain_cramp_history) AND $bsf_form->leg_pain_cramp_history == 0) echo 'checked';
                                                if (is_null($bsf_form->leg_pain_cramp_history)) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">G</th>
                            <td class="text-left">Have swollen or puffy ankles</td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="swollen_puffy_ankles_history"
                                                id="swollen_puffy_ankles_history" value="1"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->swollen_puffy_ankles_history) AND $bsf_form->swollen_puffy_ankles_history == 1) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="swollen_puffy_ankles_history"
                                                id="swollen_puffy_ankles_history" value="0"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->swollen_puffy_ankles_history) AND $bsf_form->swollen_puffy_ankles_history == 0) echo 'checked';
                                                if (is_null($bsf_form->swollen_puffy_ankles_history)) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">H</th>
                            <td class="text-left">Experienced sudden tingling, numbness or
                                loss of feeling in your arms, hands, legs, feet or face?
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="sudden_arms_hands_leg_feet_face_history"
                                                id="sudden_arms_hands_leg_feet_face_history" value="1"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->sudden_arms_hands_leg_feet_face_history) AND $bsf_form->sudden_arms_hands_leg_feet_face_history == 1) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="sudden_arms_hands_leg_feet_face_history"
                                                id="sudden_arms_hands_leg_feet_face_history" value="0"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->sudden_arms_hands_leg_feet_face_history) AND $bsf_form->sudden_arms_hands_leg_feet_face_history == 0) echo 'checked';
                                                if (is_null($bsf_form->sudden_arms_hands_leg_feet_face_history)) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">I</th>
                            <td class="text-left">Experienced unusual heartbeats such as
                                skipped beats or palpitations, or that your heart feels as
                                though it is racing for no apparent reason
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="parq_heart_beats_history" id="parq_heart_beats_history"
                                                value="1"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->parq_heart_beats_history) AND $bsf_form->parq_heart_beats_history == 1) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="parq_heart_beats_history" id="parq_heart_beats_history"
                                                value="0"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->parq_heart_beats_history) AND $bsf_form->parq_heart_beats_history == 0) echo 'checked';
                                                if (is_null($bsf_form->parq_heart_beats_history)) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">J</th>
                            <td class="text-left">Any pressure, tingling, pain, heaviness,
                                burning, tightness, squeezing, and numbness in chest, jaw,
                                neck, back and arms?
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="pain_chest_jaw_back_arms_history"
                                                id="pain_chest_jaw_back_arms_history" value="1"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->pain_chest_jaw_back_arms_history) AND $bsf_form->pain_chest_jaw_back_arms_history == 1) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="pain_chest_jaw_back_arms_history"
                                                id="pain_chest_jaw_back_arms_history" value="0"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->pain_chest_jaw_back_arms_history) AND $bsf_form->pain_chest_jaw_back_arms_history == 0) echo 'checked';
                                                if (is_null($bsf_form->pain_chest_jaw_back_arms_history)) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">K</th>
                            <td class="text-left">Known Heart Murmur?</td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="heart_murmur_history" id="heart_murmur_history"
                                                value="1"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->heart_murmur_history) AND $bsf_form->heart_murmur_history == 1) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label"> <input
                                                class="form-check-input" type="radio"
                                                name="heart_murmur_history" id="heart_murmur_history"
                                                value="0"
                                            <?php if (!empty($bsf_form)) {
                                                if (!is_null($bsf_form->heart_murmur_history) AND $bsf_form->heart_murmur_history == 0) echo 'checked';
                                                if (is_null($bsf_form->heart_murmur_history)) echo 'checked';
                                            } ?>
                                                required>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" role="tab" id="headingThree">
            <h5 class="mb-0">
                <a class="collapsed" data-toggle="collapse" href="#collapseThree"
                   aria-expanded="false" aria-controls="collapseThree"> Cardiovascular
                    risk factors </a>
            </h5>
        </div>
        <div id="collapseThree" class="collapse" role="tabpanel"
             aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">

                <div class=" ">
                    <div class="col-md-12 mb-5">
                        <h3>
                            <strong> Cardiovascular risk factors </strong>
                        </h3>
                    </div>
                    <div class="col-md-12 text-left">
                        <h4>
                            <strong> 3a: Measures </strong>
                        </h4>
                    </div>

                    <table class="table table-bordered mb-5">

                        <tbody>
                        <tr>
                            <td>Height (cm)</td>
                            <td><input type="number" step="0.01" class="form-control"
                                       name="height" placeholder="Height"
                                       value="<?php if (!empty($bsf_form)) {
                                           echo $bsf_form->height;
                                       } else {
                                           echo 1;
                                       } ?>">
                            </td>

                        </tr>
                        <tr>

                            <td>Weight (kg)</td>
                            <td><input type="number" step="0.01" class="form-control"
                                       name="body_weight" placeholder="Weight"
                                       value="<?php if (!empty($bsf_form)) {
                                           echo $bsf_form->body_weight;
                                       } else {
                                           echo 1;
                                       } ?>"></td>

                        </tr>

                        </tbody>
                    </table>


                </div>

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" role="tab" id="headingFive">
            <h5 class="mb-0">
                <a class="collapsed" data-toggle="collapse" href="#collapseFive"
                   aria-expanded="false" aria-controls="collapseFive"> Other health
                    related questions </a>
            </h5>
        </div>
        <div id="collapseFive" class="collapse" role="tabpanel"
             aria-labelledby="headingFive" data-parent="#accordion">
            <div class="card-body">

                <div class=" ">
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <h3>
                                <strong> Other health related questions </strong>
                            </h3>
                        </div>
                        <div class="col-md-12 text-left">
                            <div class="col-md-12 text-left">
                                <hr class="my-5">
                                <h4 class="text-center">Asthma</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <div class="form-check">
                                            <label class="col-form-label"> Are you affected by asthma? </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="affected_by_asthma_status_yes"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="affected_by_asthma_status"
                                                                                  id="affected_by_asthma_status_yes"
                                                                                  value="1"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->affected_by_asthma_status == 1) echo 'checked';
                                                    } ?>>
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="affected_by_asthma_status_no"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="affected_by_asthma_status"
                                                                                  id="affected_by_asthma_status_no"
                                                                                  value="0"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->affected_by_asthma_status == 0) echo 'checked';
                                                    } else {
                                                        echo 'checked';
                                                    } ?>>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <div class="form-check">
                                            <label class="col-form-label"> Is your doctor who manage your
                                                asthma know that you want be to physically active? </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="doctor_know_asthma_status_yes"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="doctor_know_asthma_status"
                                                                                  id="doctor_know_asthma_status_yes"
                                                                                  value="1"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->doctor_know_asthma_status == 1) echo 'checked';
                                                    } ?>>
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="doctor_know_asthma_status_no"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="doctor_know_asthma_status"
                                                                                  id="doctor_know_asthma_status_no"
                                                                                  value="0"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->doctor_know_asthma_status == 0) echo 'checked';
                                                    } else {
                                                        echo 'checked';
                                                    } ?>>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-5 text-left">
                                <hr class="my-5">
                                <h4 class="text-center">Epilepsy/Seizures</h4>

                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <div class="form-check">
                                            <label class="col-form-label"> Are you affected by epilepsy
                                                or seizures? </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="affected_by_seizure_status_yes"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="affected_by_seizure_status"
                                                                                  id="affected_by_seizure_status_yes"
                                                                                  value="1"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->affected_by_seizure_status == 1) echo 'checked';
                                                    } ?>>
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="affected_by_seizure_status_no"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="affected_by_seizure_status"
                                                                                  id="affected_by_seizure_status_no"
                                                                                  value="0"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->affected_by_seizure_status == 0) echo 'checked';
                                                    } else {
                                                        echo 'checked';
                                                    } ?>>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <div class="form-check">
                                            <label class="col-form-label"> Is your doctor who manage your
                                                epilepsy or seizures know that you want be to physically
                                                active? </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="doctor_know_epilepsy_status_yes"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="doctor_know_epilepsy_status"
                                                                                  id="doctor_know_epilepsy_status_yes"
                                                                                  value="1"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->doctor_know_epilepsy_status == 1) echo 'checked';
                                                    } ?>>
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="doctor_know_epilepsy_status_no"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="doctor_know_epilepsy_status"
                                                                                  id="doctor_know_epilepsy_status_no"
                                                                                  value="0"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->doctor_know_epilepsy_status == 0) echo 'checked';
                                                    } else {
                                                        echo 'checked';
                                                    } ?>>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12 text-left">
                                <hr class="my-5">
                                <h4 class="text-center">Temporary illness</h4>

                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <div class="form-check">
                                            <label class="col-form-label"> In the last 2 weeks, have you
                                                been sick or not felt well? </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="last_2week_sickness_status_yes"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="last_2week_sickness_status"
                                                                                  id="last_2week_sickness_status_yes"
                                                                                  value="1"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->last_2week_sickness_status == 1) echo 'checked';
                                                    } ?>>
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="last_2week_sickness_status_no"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="last_2week_sickness_status"
                                                                                  id="last_2week_sickness_status_no"
                                                                                  value="0"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->last_2week_sickness_status == 0) echo 'checked';
                                                    } else {
                                                        echo 'checked';
                                                    } ?>>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <div class="form-check">
                                            <label class="col-form-label"> Have you needed three or more
                                                days bed rest or meant you have had three or more days when
                                                you have been unable to carry out your usual activities
                                                (work/school/self-care/household duties)? </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="last_2week_bedrest_status_yes"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="last_2week_bedrest_status"
                                                                                  id="last_2week_bedrest_status_yes"
                                                                                  value="1"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->last_2week_bedrest_status == 1) echo 'checked';
                                                    } ?>>
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="last_2week_bedrest_status_no"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="last_2week_bedrest_status"
                                                                                  id="last_2week_bedrest_status_no"
                                                                                  value="0"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->last_2week_bedrest_status == 0) echo 'checked';
                                                    } else {
                                                        echo 'checked';
                                                    } ?>>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <div class="form-check">
                                            <label class="col-form-label"> In the last 2 weeks have you
                                                had an illness that was diagnosed as viral? (if you are
                                                unsure whether the condition is bacterial or viral ask an
                                                authority. If you are unable to do this, you must assume it
                                                was viral. It is prudent to suppose that colds, flu, sore
                                                throats and middle ear infections are all associated with
                                                viral infection). </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="last_2week_viral_illness_status_yes"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="last_2week_viral_illness_status"
                                                                                  id="last_2week_viral_illness_status_yes"
                                                                                  value="1"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->last_2week_viral_illness_status == 1) echo 'checked';
                                                    } ?>>
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="last_2week_viral_illness_status_no"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="last_2week_viral_illness_status"
                                                                                  id="last_2week_viral_illness_status_no"
                                                                                  value="0"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->last_2week_viral_illness_status == 0) echo 'checked';
                                                    } else {
                                                        echo 'checked';
                                                    } ?>>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                In the last 2 weeks have you had an illness (e.g., cold of flu)
                                that was accompanied by
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <div class="form-check">
                                            <label class="col-form-label"> Sore joints or sore muscles? </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="last_2week_viral_sorejointsmuscle_status_yes"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="last_2week_viral_sorejointsmuscle_status"
                                                                                  id="last_2week_viral_sorejointsmuscle_status_yes"
                                                                                  value="1"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->last_2week_viral_sorejointsmuscle_status == 1) echo 'checked';
                                                    } ?>>
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="last_2week_viral_sorejointsmuscle_status_no"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="last_2week_viral_sorejointsmuscle_status"
                                                                                  id="last_2week_viral_sorejointsmuscle_status_no"
                                                                                  value="0"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->last_2week_viral_sorejointsmuscle_status == 0) echo 'checked';
                                                    } else {
                                                        echo 'checked';
                                                    } ?>>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <div class="form-check">
                                            <label class="col-form-label"> Fevers, a temperature or hot
                                                and cold spells? </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="last_2week_viral_fever_hotcold_status_yes"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="last_2week_viral_fever_hotcold_status"
                                                                                  id="last_2week_viral_fever_hotcold_status_yes"
                                                                                  value="1"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->last_2week_viral_fever_hotcold_status == 1) echo 'checked';
                                                    } ?>>
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="last_2week_viral_fever_hotcold_status_no"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="last_2week_viral_fever_hotcold_status"
                                                                                  id="last_2week_viral_fever_hotcold_status_no"
                                                                                  value="0"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->last_2week_viral_fever_hotcold_status == 0) echo 'checked';
                                                    } else {
                                                        echo 'checked';
                                                    } ?>>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12 text-left">
                                <hr class="my-5">
                                <h4 class="text-center">Bone and joint pain</h4>

                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <div class="form-check">
                                            <label class="col-form-label"> Do you have a bone or joint
                                                problem that could be made worse by increasing physical
                                                activity participation? (e.g., arthritis, slipped disc, bad
                                                back)? </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="parq_musculoskeletal_health_status_yes"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="parq_musculoskeletal_health_status"
                                                                                  id="parq_musculoskeletal_health_status_yes"
                                                                                  value="1"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->parq_musculoskeletal_health_status == 1) echo 'checked';
                                                    } ?>>
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="parq_musculoskeletal_health_status_no"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="parq_musculoskeletal_health_status"
                                                                                  id="parq_musculoskeletal_health_status_no"
                                                                                  value="0"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->parq_musculoskeletal_health_status == 0) echo 'checked';
                                                    } else {
                                                        echo 'checked';
                                                    } ?>>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="pain_details">If yes please provide details</label>
                                    <textarea class="form-control" name="pain_details"
                                              rows="3"><?php if (!empty($bsf_form)) {
                                            echo $bsf_form->pain_details;
                                        } ?></textarea>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <div class="form-check">
                                            <label class="col-form-label"> Is the practitioner that helps
                                                you manage this bone and joint problem aware that you
                                                increasing your physical activity participation? </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="doctor_aware_bone_problem_yes"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="doctor_aware_bone_problem"
                                                                                  id="doctor_aware_bone_problem_yes"
                                                                                  value="1"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->doctor_aware_bone_problem == 1) echo 'checked';
                                                    } ?>>
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <div class="form-check">
                                            <label for="doctor_aware_bone_problem_no"
                                                   class="col-form-label"> <input class="form-check-input"
                                                                                  type="radio"
                                                                                  name="doctor_aware_bone_problem"
                                                                                  id="doctor_aware_bone_problem_no"
                                                                                  value="0"
                                                    <?php if (!empty($bsf_form)) {
                                                        if ($bsf_form->doctor_aware_bone_problem == 0) echo 'checked';
                                                    } else {
                                                        echo 'checked';
                                                    } ?>>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-row mt-4">
    <div class="form-group col-md-12 text-center">
        <!--input role="button" type="button" class="btn btn-info float-right next-baseline-btn" value="Next">
        <input role="button" type="button" class="baseline-btn btn btn-success mr-2 float-right" value="Save">
        <input role="button" type="submit" value="Save" id="baseline-save" name="saving-gtky" style="display: none"-->

        <!--a class="btn btn-danger" role="button" onclick="history.go(-1);" style="color:white;">Cancel</a-->
			<?php if($_GET['paction']=='update') { ?>
				<a class="btn btn-danger" href="<?php echo ROOT_DIR."?pageid=participant&paction=update&pid=".$participantid?>">Cancel</a>
   			<input class="btn btn-primary" role="button" type="submit" value="Update" name="go_update_bsf" id="go_update_bsf" >
			<?php } ?>
   </div>
</div>
</form>

<script type="text/javascript">
		/*$(".next-baseline-btn").click(function () {
        $("#cps").val("value");
        $("#baseline-save").click();
    })

    $(".baseline-btn").click(function () {
        $("#cps").val("baseline");
        $("#baseline-save").click();
    })*/
</script>

