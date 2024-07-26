<?php

require_once "../includes/db.inc.php";
require_once("../includes/initialize.php");
global $session;

$participantid = $session->participantid;

if (isset ($_POST['previous'])) {
    $_SESSION['current_step'] = "goal";
    echo '<script>location.replace("/coach_assistant/public/index_participant.php");</script>';
}
if (isset ($_POST['save_evaluation'])) {
    $gt_id = mysqli_real_escape_string($con, $_POST['goal_template_id']);
    $bar_id = mysqli_real_escape_string($con, $_POST['bar_id']);
    $stra_id = mysqli_real_escape_string($con, $_POST['stra_id']);

    $sql_insert = "INSERT INTO participant_goal (participantid, goal_template_id, bar_id, stra_id, `timestamp`, fail_ss, fail_nss, `status`) 
                VALUE ('$participantid', '$gt_id', '$bar_id', '$stra_id', NOW(), 0, 0, 'current')";
    mysqli_query($con, $sql_insert) or die (mysqli_error($con));
}
if (isset ($_POST['submit_evaluation'])) {
    $sql_update = "UPDATE participant_barrier SET status='current' WHERE participantid='$participantid'";
    mysqli_query($con, $sql_update) or die (mysqli_error($con));
}
mysqli_close($con);
header('Location: /coach_assistant/public/index_participant.php');