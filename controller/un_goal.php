<?php
require_once("../includes/db.inc.php");
require_once("../includes/initialize.php");
global $session;

// Loading a participant based on participant session
$participantid = $session->participantid;

if (isset ($_POST['failed_goal'])) {
    $bar_id = mysqli_real_escape_string($con, $_POST['bar_id']);
    $stra_id = mysqli_real_escape_string($con, $_POST['stra_id']);
    $stra_type = mysqli_real_escape_string($con, $_POST['stra_type']);
    $par_goal_id = mysqli_real_escape_string($con, $_POST['par_goal_id']);
    $fail_ss = mysqli_real_escape_string($con, $_POST['fail_ss']);
    $fail_nss = mysqli_real_escape_string($con, $_POST['fail_nss']);

    $stra_type == "SS" ? $fail_ss++ : $fail_nss++;
    $fail_total = $fail_ss + $fail_nss;

    $sql_update = "UPDATE participant_goal SET submitted_time=NOW(), `status`='failed' WHERE participant_goal_id='$par_goal_id'";
    mysqli_query($con, $sql_update) or die (mysqli_error());

    $sql_insert = "INSERT INTO participant_goal (participantid, `timestamp`, fail_ss, fail_nss, `status`) 
                VALUE ('$participantid', NOW(), $fail_ss, $fail_nss, 'current')";
    mysqli_query($con, $sql_insert) or die (mysqli_error($con));

    //echo $fail_ss . " nss: " . $fail_nss;

    if($fail_ss > 2 || $fail_nss > 2) {
        //echo "------ true if";
        $sql_insert = "UPDATE participant_barrier SET submitted=0, `status`='current' WHERE participantid='$participantid'";
        mysqli_query($con, $sql_insert) or die (mysqli_error($con));
    } else {
        $sql_insert = "INSERT INTO participant_strategy (participantid, submitted, reminder_count, `timestamp`, `status`) 
                VALUE ('$participantid', 0, 0, NOW(), 'current')";
        mysqli_query($con, $sql_insert) or die (mysqli_error($con));
    }

    /*
     * Need check
     * if fail_ss = 2 -> go back to par_bar
     *
     * */

    header('Location: /coach_assistant/public/index_participant.php');
}