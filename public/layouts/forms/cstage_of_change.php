<?php
global $session;
// Loading a participant based on participant session
$participantid = $_GET['pid'];
$socid = $_GET['socid'];
// Loading a saved stage of change for the participant if it is avalailbe
if ($session->isDevelop) {
    $socform = stageOfChange::find_by_pid_litmit($participantid);
} else {
    $socform = stageOfChange::find_by_id($socid);
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

<form class="text-center" method="post" name="soc-form" id="soc-form" action="/coach_assistant/controller/update_data.php" novalidate>
		<input type="hidden" name="socpid" id="socpid" value="<?php echo $_GET['pid'] ?>">
		<input type="hidden" name="socid" id="socid" value="<?php echo $_GET['socid'] ?>">
  <div class="text-left">
    <!--p>This section allows you to identify whether you could possibly be physically active or already physically active.
        Please indicate which of the following answer you currently experience, using the buttons beside each
        option.</p-->
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
                </td
                >
            </tr>
            </tbody>
        </table>
    </div>
    <div class="form-row text-center mt-4">
        <div class="form-group col-md-12 text-center">
            <!--<input type="button" class="next-form btn btn-info float-right" value="Next"/>-->
            <!--<a href="index_participant.php?cps=impair" class="btn btn-info float-right">Next</a>-->

            <!--input role="button" type="button" class="btn btn-info float-right next-soc-btn" value="Next">
            <input role="button" type="submit" value="Save" id="next-btn-soc" name="saving-gtky" style="display: none">

            <input role="button" type="submit" class="save-gtky btn btn-success mr-2 float-right" value="Save"
                   name="saving-gtky">
            <small class="mr-2" style="color:#999"> *You can save at any time and complete the form later.</small-->
        <?php if($_GET['paction']=='update') { ?>
				  <a class="btn btn-danger" href="<?php echo ROOT_DIR."?pageid=participant&paction=update&pid=".$participantid?>">Cancel</a>
   			  <input class="btn btn-primary" role="button" type="submit" value="Update" name="go_update_soc" id="go_update_soc" >
			  <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    /*$(".next-soc-btn").click(function () {
        $("#cps").val("impair");
        $("#next-btn-soc").click();
    })*/
</script>