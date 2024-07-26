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
        margin: 0; 
        float: left;
        font-size: 16px;
        font-weight: bold;
        }
    </style>
    
<div class= "col-md-12 row">
      <div class="col col-md-12 text-center">
          <h5>Your current step--Getting to know you: Baseline 1/4</h5>
          <hr/> 
      </div>   
  
      <div class="col-md-8 order-md-1 text-left mb-5"  role="tablist">
          <div class="card">
              <!--div class="card-header" role="tab" id="headingOne">
                  <h5 class="mb-0">
                      <a data-toggle="collapse" href="#collapseOne" aria-expanded="true"
                         aria-controls="collapseOne"> Known Cardiovascular, Pulmonary and/or
                          Metabolic Disease </a>
                  </h5>
              </div-->

              <div id="collapseOne" class="collapse show" role="tabpanel"
                    data-parent="#accordion">
                  <div class="card-body">
                      <div class=" ">
                          <div class="col-md-12 ">
                              <h5>
                                  <strong> Known Cardiovascular, Pulmonary and/or Metabolic Disease
                                  </strong>
                              </h5>
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

      <div class="form-row mt-4">
          <div class="form-group col-md-12 text-right">
              <input role="button" type="button" class="btn btn-info float-right next-baseline-btn" value="Next">
              <input role="button" type="button" class="baseline-btn btn btn-success mr-2 float-right" value="Save">
              <input role="button" type="submit" value="Save" id="baseline-save" name="saving-gtky" style="display: none">
              <small class="mr-2"
                     style="color: #999"> *You can save at any time and complete the form
                  later.
              </small>
              <a href="index_participant.php?cps=impair_ci" class="btn btn-secondary float-left">Previous</a>

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
    $(".next-baseline-btn").click(function () {
        $("#cps").val("baseline_sc");
        $("#baseline-save").click();
    })

    $(".baseline-btn").click(function () {
        $("#cps").val("baseline");
        $("#baseline-save").click();
    })
</script>

