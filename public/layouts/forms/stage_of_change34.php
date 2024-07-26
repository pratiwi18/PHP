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
    if (!is_null($socform->soc_q3_current_engaged_with_physical_activity) AND $socform->soc_q3_current_engaged_with_physical_activity == 0) {
        $soc_q3_0 = "checked";
        $soc_q3_1 = "";
    } elseif ($socform->soc_q3_current_engaged_with_physical_activity == 1) {
        $soc_q3_0 = "";
        $soc_q3_1 = "checked";
    } else {
        $soc_q3_0 = "";
        $soc_q3_1 = "";
    }
    if (!is_null($socform->soc_q4_regularly_physically_active_for_past6mth) AND $socform->soc_q4_regularly_physically_active_for_past6mth == 0) {
        $soc_q4_0 = "checked";
        $soc_q4_1 = "";
    } elseif ($socform->soc_q4_regularly_physically_active_for_past6mth == 1) {
        $soc_q4_0 = "";
        $soc_q4_1 = "checked";
    } else {
        $soc_q4_0 = "";
        $soc_q4_1 = "";
    }
} else {
    $soc_q1_0 = "";
    $soc_q1_1 = "";
    $soc_q2_0 = "";
    $soc_q2_1 = "";
    $soc_q3_0 = "";
    $soc_q3_1 = "";
    $soc_q4_0 = "";
    $soc_q4_1 = "";
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
          <h5>Your current step--Getting to know you: Stage of Change 2/2</h5>
          <hr/> 
      </div>
  
    <div class="col-md-8 order-md-1 text-left" id="left">
      
        <div class="col-md-12 text-left">
            <p> For activity to be regular, it must add up to a total of 30 minutes or more per day and be done at least 5
                days per week. For example, you could take on 30-minute walk or take three 10-minute walks for a daily total
                of 30 minutes. </p>
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
                    <td class="text-left">3. I currently engage in regular physical activity.<label
                                for="soc_q3_current_engaged_with_physical_activity" class="error"></label></td>
                    <td>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio"
                                       name="soc_q3_current_engaged_with_physical_activity"
                                       id="soc_q3_current_engaged_with_physical_activity"
                                       value="1" <?php echo $soc_q3_1; ?> >
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio"
                                       name="soc_q3_current_engaged_with_physical_activity"
                                       id="soc_q3_current_engaged_with_physical_activity"
                                       value="0" <?php echo $soc_q3_0; ?> >
                            </label>
                        </div>
                    </td>

                </tr>
                <tr>
                    <td class="text-left">4. I have been regularly physically active for the past 6 months.<label
                                for="soc_q4_regularly_physically_active_for_past6mth" class="error"></label></td>
                    <td>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio"
                                       name="soc_q4_regularly_physically_active_for_past6mth"
                                       id="soc_q4_regularly_physically_active_for_past6mth"
                                       value="1" <?php echo $soc_q4_1; ?> >
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio"
                                       name="soc_q4_regularly_physically_active_for_past6mth"
                                       id="soc_q4_regularly_physically_active_for_past6mth"
                                       value="0" <?php echo $soc_q4_0; ?> >
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

                  <input role="button" type="button" class="btn btn-info float-right next-soc34-btn" value="Next">

                  <input role="button" type="button" class="soc34-btn btn btn-success mr-2 float-right" value="Save">
                  <input role="button" type="submit" value="Save" id="soc34-save" name="saving-gtky" style="display: none">

                  <small class="mr-2" style="color:#999"> *You can save at any time and complete the form later.</small>
                  <a href="index_participant.php?cps=soc12" class="btn btn-secondary float-left">Previous</a>
              </div>
          </div>
        <div class="col-md-12 text-left">
            <small style="color:#999"> 2/</small>
        </div>
    </div>
  <vr></vr>
   <div class="col-md-4 order-md-2" id="right"> 
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

                  <li style="color: red"><h5>Getting to know you:</h5></li>

                  <p>This section will give us some information about you that we can
                      use to select your barriers</p>
    </div>   
  </div>
  </div>
<script type="text/javascript">
    $(".next-soc34-btn").click(function () {
        $("#cps").val("impair");
        $("#soc34-save").click();
    })
    $(".soc34-btn").click(function () {
        $("#cps").val("soc34");
        $("#soc34-save").click();
    })
</script>