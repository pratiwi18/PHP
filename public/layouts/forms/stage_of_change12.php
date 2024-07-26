<?php
global $session;
// Loading a participant based on participant session
$participantid = $session->participantid;
// Loading a saved stage of change for the participant if it is avalailbe
if ($session->isDevelop) {
    $socform = stageOfChange::find_by_pid_litmit($participantid);
} else {
    $socform = stageOfChange::find_by_pid_saved($participantid);
}
if (!empty($socform)) {
    if (!is_null($socform->soc_q1_current_physically_active) AND $socform->soc_q1_current_physically_active == 0) {
        $soc_q1_0 = "checked";
        $soc_q1_1 = "";
    } elseif ($socform->soc_q1_current_physically_active == 1) {
        $soc_q1_0 = "";
        $soc_q1_1 = "checked";
    } else {
        $soc_q1_0 = "";
        $soc_q1_1 = "";
    }
    if (!is_null($socform->soc_q2_intend_tobe_more_physically_active_next6mth) AND $socform->soc_q2_intend_tobe_more_physically_active_next6mth == 0) {
        $soc_q2_0 = "checked";
        $soc_q2_1 = "";
    } elseif ($socform->soc_q2_intend_tobe_more_physically_active_next6mth == 1) {
        $soc_q2_0 = "";
        $soc_q2_1 = "checked";
    } else {
        $soc_q2_0 = "";
        $soc_q2_1 = "";
    }
} else {
    $soc_q1_0 = "";
    $soc_q1_1 = "";
    $soc_q2_0 = "";
    $soc_q2_1 = "";
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
    
<div class="col-md-12 row">
      <div class="col col-md-12 text-center">
          <h5>Your current step--Getting to know you: Stage of Change 1/2</h5>
          <hr/> 
      </div>
 
  <div class="col-md-8 order-md-1 text-left">
      <p>This section allows you to identify whether you could possibly be physically active or already physically active.
          Please indicate which of the following answer you currently experience, using the buttons beside each
          option.</p>
      <div class="col-md-12 mt-5 text-left">
          <p> Physical activity or exercise includes activities such as walking briskly, jogging, bicycling, swimming, or
              any activity in which the exertion is at least as intense as these activities. </p>
          <table class="table mb-5 text-center">
              <thead>
              <tr>
                  <th></th>
                  <th class="text-center">Yes</th>
                  <th class="text-center">No</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                  <td class="text-left">1. I am currently physically active.<label for="soc_q1_current_physically_active"
                                                                                   class="error"></label></td>
                  <td>
                      <div class="form-check">
                          <label class="form-check-label">
                              <input class="form-check-input" type="radio" name="soc_q1_current_physically_active"
                                     id="soc_q1_current_physically_active" value="1" <?php echo $soc_q1_1; ?> >
                          </label>
                      </div>
                  </td>
                  <td>
                      <div class="form-check">
                          <label class="form-check-label">
                              <input class="form-check-input" type="radio" name="soc_q1_current_physically_active"
                                     id="soc_q1_current_physically_active" value="0" <?php echo $soc_q1_0; ?> >
                          </label>
                      </div>
                  </td>

              </tr>
              <tr>
                  <td class="text-left">2. I intend to become more physically active in the next 6 months. <label
                              for="soc_q2_intend_tobe_more_physically_active_next6mth" class="error"></label></td>
                  <td>
                      <div class="form-check">
                          <label class="form-check-label">
                              <input class="form-check-input" type="radio"
                                     name="soc_q2_intend_tobe_more_physically_active_next6mth"
                                     id="soc_q2_intend_tobe_more_physically_active_next6mth"
                                     value="1" <?php echo $soc_q2_1; ?>>
                          </label>
                      </div>
                  </td>
                  <td>
                      <div class="form-check">
                          <label class="form-check-label">
                              <input class="form-check-input" type="radio"
                                     name="soc_q2_intend_tobe_more_physically_active_next6mth"
                                     id="soc_q2_intend_tobe_more_physically_active_next6mth"
                                     value="0" <?php echo $soc_q2_0; ?>>
                          </label>
                      </div>
                  </td>
              </tr>
              </tbody>
          </table>
      </div>

      <div class="form-row text-center mt-4">
          <div class="form-group col-md-12 text-right">
              <!--<input type="button" class="next-form btn btn-info float-right" value="Next"/>-->
              <!--<a href="index_participant.php?cps=impair" class="btn btn-info float-right">Next</a>-->

              <!--input role="button" type="button" class="btn btn-info float-right next-soc-btn" value="Next">
              <input role="button" type="submit" value="Save" id="next-btn-soc" name="saving-gtky" style="display: none">

              <input role="button" type="submit" class="save-gtky btn btn-success mr-2 float-right" value="Save"
                     name="saving-gtky"-->
              <input role="button" type="button" class="btn btn-info float-right next-soc-btn" value="Next">
              <input role="button" type="button" class="soc-btn btn btn-success mr-2 float-right" value="Save">
              <input role="button" type="submit" value="Save" id="soc-save" name="saving-gtky" style="display: none">

              <small class="mr-2" style="color:#999"> *You can save at any time and complete the form later.</small>
          </div>
      </div>
      <div class="col-md-12 text-left">
          <small style="color:#999"> 1/</small>
      </div>
  </div>
  
  <div class="col-md-4 order-md-2"> 
    <div class="">
        <ul class="align-self-left">
            <li><a href="/coach_assistant/public/index_participant.php?cps=soc12">Stage of Change</a></li> 
            <li><a href="/coach_assistant/public/index_participant.php?cps=impair">Impairments</a></li> 
            <li><a href="/coach_assistant/public/index_participant.php?cps=baseline">Baseline</a></li>
            <li><a href="/coach_assistant/public/index_participant.php?cps=value">Value Identification</a></li> 
        </ul>
    </div>
        <hr/>
    <div class="media">
            <div class="media-body align-self-center ml-3">
                <h3 class="">Coaching path</h3>
            </div>
            <img class="align-self-center mr-3" src="images/coaching-path.png"
                 alt="Generic placeholder image">
        </div>
     <hr/>

    <div >
      <p>Congratulation, you are now part of this program. Now you
                  just need to follow below steps to get your program tailored</p>


                  <li style="color: red"><h5>Getting to know you:</h5></li>

                  <p>This section will give us some information about you that we can
                      use to select your barriers</p>
    </div>   
  </div>
</div>
<script type="text/javascript">
    $(".next-soc-btn").click(function () {
        $("#cps").val("soc34");
        $("#soc-save").click();
    })
</script>
