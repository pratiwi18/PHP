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

<div id="accordion" class="mb-5 mt-5" role="tablist">



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
    <div class="form-group col-md-12 text-right">
        <input role="button" type="button" class="btn btn-info float-right next-baseline-btn" value="Next">
        <input role="button" type="button" class="baseline-btn btn btn-success mr-2 float-right" value="Save">
        <input role="button" type="submit" value="Save" id="baseline-save" name="saving-gtky" style="display: none">
        <small class="mr-2"
               style="color: #999"> *You can save at any time and complete the form
            later.
        </small>
        <a href="index_participant.php?cps=impair_ps" class="btn btn-secondary float-left">Previous</a>

        <!--<a class="btn btn-danger" role="button" onclick="history.go(-1);" style="color:white;">Cancel</a>
  <?php if (!empty($bsf_form)) { ?>
   <input class="btn btn-primary" role="button" type="submit" value="Update" name="go_register_form" >
  <?php } else { ?>
  <?php ?>
 	<input class="btn btn-primary" role="button" type="submit" value="Submit" name="go_register_form" >
  <?php } ?>-->
    </div>
    <div class="col-md-12 text-left">
        <small style="color: #999"> 3/4</small>
    </div>
</div>

<script type="text/javascript">
    $(".next-baseline-btn").click(function () {
        $("#cps").val("value");
        $("#baseline-save").click();
    })

    $(".baseline-btn").click(function () {
        $("#cps").val("baseline");
        $("#baseline-save").click();
    })
</script>

