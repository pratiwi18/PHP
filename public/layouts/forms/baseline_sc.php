<?php
global $session;
// Loading a participant based on participant session
$participantid = $session->participantid;
// $bsf_form = baselineScreeningForm::find_by_pid_saved($participantid); kien
$bsf_form = baselineScreeningForm::find_by_pid_completed_desc($participantid);
if (!empty($bsf_form)) {
    $bsfid = $bsf_form->bsfid;
    // Grab the information about the medication from the database based on the bsfid
    $meds = Medication::find_by_id($bsfid);
    $surgs = Surgery::find_by_id($bsfid);
}
?>
<style>
     
      li a{
        color: darkgray;

        float: left;
        font-size: 16px;
        font-weight: bold;
        }
    </style>
    
<div class= "col-md-12 row">
        <div class="col col-md-12 text-center">
          <h5>Your current step--Getting to know you: Baseline 2/4</h5>
          <hr/> 
      </div>   
  
      <div class="col-md-8 order-md-1 text-left mb-5"  role="tablist">

    <div class="card">
        <!--div class="card-header" role="tab" id="headingTwo">
            <h5 class="mb-0">
                <a class="collapsed" data-toggle="collapse" href="#collapseTwo"
                   aria-expanded="false" aria-controls="collapseTwo"> Symptoms of
                    cardiovascular, metabolic or pulmonary disease </a>
            </h5>
        </div-->
        <div id="collapseTwo" class="collapse show" role="tabpanel"
             data-parent="#accordion">
            <div class="card-body">
                <div class=" ">
                    <div class="col-md-12 mb-5">
                        <h5>
                            <strong> Symptoms of cardiovascular, metabolic or pulmonary
                                disease </strong>
                        </h5>
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
      <div class="form-row mt-4">
          <div class="form-group col-md-12 text-right">
              <input role="button" type="button" class="btn btn-info float-right next-baseline_sc-btn" value="Next">
              <input role="button" type="button" class="baseline_sc-btn btn btn-success mr-2 float-right" value="Save">
              <input role="button" type="submit" value="Save" id="baseline_sc-save" name="saving-gtky" style="display: none">
              <small class="mr-2"
                     style="color: #999"> *You can save at any time and complete the form
                  later.
              </small>
              <a href="index_participant.php?cps=baseline" class="btn btn-secondary float-left">Previous</a>

              <!--<a class="btn btn-danger" role="button" onclick="history.go(-1);" style="color:white;">Cancel</a>
        <?php if (!empty($bsf_form)) { ?>
         <input class="btn btn-primary" role="button" type="submit" value="Update" name="go_register_form" >
        <?php } else { ?>
        <?php ?>
        <input class="btn btn-primary" role="button" type="submit" value="Submit" name="go_register_form" >
        <?php } ?>-->
          </div>
          <div class="col-md-12 text-left">
              <small style="color: #999"> 8/</small>
          </div>
      </div>

    </div>
        <div class="col-md-4 order-md-2" > 
          <div class="">
            <ul class="align-self-left">
                <li><a href="/coach_assistant/public/index_participant.php?cps=soc12">Stage of Change</a></li> 
                <li><a href="/coach_assistant/public/index_participant.php?cps=impair">Impairments</a></li> 
                <li><a href="/coach_assistant/public/index_participant.php?cps=baseline">Baseline</a></li>
                <li><a href="/coach_assistant/public/index_participant.php?cps=value">Value Identification</a></li> 
            </ul>
        </div>
    
          <div class="media">
                <div class="media-body align-self-center ml-3">
                    <h3 class="">Coaching path</h3>
                </div>
                <img class="align-self-center mr-3" src="images/coaching-path.png"
                     alt="Generic placeholder image">
            </div>
         <hr/>
        <div >

                      <li style="color: red"><h5>Baseline:</h5></li>

                      <p>This section will give us some information about you that we can
                    use to select your barriers</p>
        </div>   
    </div>
  </div>
<script type="text/javascript">
    $(".next-baseline_sc-btn").click(function () {
        $("#cps").val("baseline_cr");
        $("#baseline_sc-save").click();
    })

    $(".baseline_sc-btn").click(function () {
        $("#cps").val("baseline_sc");
        $("#baseline_sc-save").click();
    })
</script>

