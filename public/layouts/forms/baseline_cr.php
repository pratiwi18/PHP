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
          <h5>Your current step--Getting to know you: Baseline 3/4</h5>
          <hr/> 
      </div>
  
      <div class="col-md-8 order-md-1 text-left mb-5"  role="tablist">

    <div class="card">
        <!--div class="card-header" role="tab" id="headingThree">
            <h5 class="mb-0">
                <a class="collapsed" data-toggle="collapse" href="#collapseThree"
                   aria-expanded="false" aria-controls="collapseThree"> Cardiovascular
                    risk factors </a>
            </h5>
        </div-->
        <div id="collapseThree" class="collapse show" role="tabpanel"
             aria-labelledby="headingThree" data-parent="#accordion">
            <div class="card-body">

                <div class=" ">
                    <div class="col-md-12 mb-5">
                        <h5>
                            <strong> Cardiovascular risk factors </strong>
                        </h5>
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
      <div class="form-row mt-4">
          <div class="form-group col-md-12 text-right">
              <input role="button" type="button" class="btn btn-info float-right next-baseline_cr-btn" value="Next">
              <input role="button" type="button" class="baseline_cr-btn btn btn-success mr-2 float-right" value="Save">
              <input role="button" type="submit" value="Save" id="baseline_cr-save" name="saving-gtky" style="display: none">
              <small class="mr-2"
                     style="color: #999"> *You can save at any time and complete the form
                  later.
              </small>
              <a href="index_participant.php?cps=baseline_sc" class="btn btn-secondary float-left">Previous</a>

              <!--<a class="btn btn-danger" role="button" onclick="history.go(-1);" style="color:white;">Cancel</a>
        <?php if (!empty($bsf_form)) { ?>
         <input class="btn btn-primary" role="button" type="submit" value="Update" name="go_register_form" >
        <?php } else { ?>
        <?php ?>
        <input class="btn btn-primary" role="button" type="submit" value="Submit" name="go_register_form" >
        <?php } ?>-->
          </div>
          <div class="col-md-12 text-left">
              <small style="color: #999"> 9/</small>
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
    $(".next-baseline_cr-btn").click(function () {
        $("#cps").val("baseline_oh");
        $("#baseline_cr-save").click();
    })

    $(".baseline_cr-btn").click(function () {
        $("#cps").val("baseline_cr");
        $("#baseline_cr-save").click();
    })
</script>
