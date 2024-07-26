<?php

require_once "../includes/db.inc.php";
require_once("../includes/initialize.php");
global $session;

$participantid = $session->participantid;

if (isset ($_POST['previous'])) {
    $_SESSION['current_step'] = "goal";
    echo '<script>location.replace("/coach_assistant/public/index_participant.php");</script>';
}
if (isset ($_POST['save_confident'])) {
    $json = json_encode($_POST);

    $confident_id = "";
    $par_confident_id = "";
    if (isset ($_POST['confident_id'])) {
        $confident_id = $_POST['confident_id'];
    }
    if (isset ($_POST['par_confident_id'])) {
        $par_confident_id = $_POST['par_confident_id'];
    }

    $sfos_id = mysqli_real_escape_string($con, $_POST['sfos_id']);
    $goal_template_id = mysqli_real_escape_string($con, $_POST['goal_template_id']);
    $stra_id = mysqli_real_escape_string($con, $_POST['stra_id']);

    $decode = json_decode($json, true);
    $ans_escape_str = mysqli_real_escape_string($con, $json);

    if (!empty($par_confident_id)) {
        $sql_update = "UPDATE participant_confident SET answer='$ans_escape_str', stra_id='$stra_id', sfos_id = '$sfos_id',
                       goal_template_id='$goal_template_id'   WHERE participant_confident_id='$par_confident_id'";
        echo $sql_update;
        mysqli_query($con, $sql_update) or die (mysqli_error($con));
        echo "<br/>UPDATED";
    } else {
        $sql_insert = "INSERT INTO participant_confident (participantid, goal_template_id, stra_id, sfos_id, answer, `timestamp`, `status`)
                VALUE ('$participantid', '$goal_template_id', '$stra_id', '$sfos_id', '$ans_escape_str', NOW(), 'current')";
        mysqli_query($con, $sql_insert) or die (mysqli_error($con));
        echo "INSERTED";
    }
}
if (isset ($_POST['submit_confident'])) {
    $json = json_encode($_POST);

    $confident_id = "";
    $par_confident_id = "";
    if (isset ($_POST['confident_id'])) {
        $confident_id = $_POST['confident_id'];
    }
    if (isset ($_POST['par_confident_id'])) {
        $par_confident_id = $_POST['par_confident_id'];
    }

    $sfos_id = mysqli_real_escape_string($con, $_POST['sfos_id']);
    $goal_template_id = mysqli_real_escape_string($con, $_POST['goal_template_id']);
    $stra_id = mysqli_real_escape_string($con, $_POST['stra_id']);

    $decode = json_decode($json, true);
    $ans_escape_str = mysqli_real_escape_string($con, $json);

    $_SESSION['current_step'] = "evaluation";
    if (!empty($par_confident_id)) {
        $sql_update = "UPDATE participant_confident SET answer='$ans_escape_str', stra_id='$stra_id', sfos_id = '$sfos_id',
                       goal_template_id='$goal_template_id', `status`='submitted', `submitted_time` = NOW()  
                       WHERE participant_confident_id='$par_confident_id'";
        echo $sql_update;
        mysqli_query($con, $sql_update) or die (mysqli_error($con));
        echo "<br/>UPDATED";
    } else {
        $sql_insert = "INSERT INTO participant_confident (participantid, goal_template_id, stra_id, sfos_id, answer, `timestamp`, submitted_time, `status`)
                VALUE ('$participantid', '$goal_template_id', '$stra_id', '$sfos_id', '$ans_escape_str', NOW(), NOW(), 'submitted')";
        mysqli_query($con, $sql_insert) or die (mysqli_error($con));
        echo "INSERTED";
    }

    $flag = false;
    $count = 0;
    foreach($decode as $key => $value)
    {
        if(substr( $key, 0, 1 ) === "v"){
            if((int)$value < 7) {
                $flag = true;
                $count++;
            }
        }
    }

    if($flag === true && $count == 5){
        $sql_insert = "INSERT INTO participant_goal (participantid, fail_ss, fail_nss, `status`) 
                VALUE ('$participantid', 0, 0, 'current')";
        mysqli_query($con, $sql_insert) or die (mysqli_error($con));
    }
}

mysqli_close($con);
header('Location: /coach_assistant/public/index_participant.php');
?>