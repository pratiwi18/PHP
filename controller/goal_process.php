<?php

require_once "../includes/db.inc.php";
require_once("../includes/initialize.php");
global $session;

// Loading a participant based on participant session
$participantid = $session->participantid;

/*if (isset ($_POST['previous'])) {
    $_SESSION['current_step'] = "strategies";
    echo '<script>location.replace("/coach_assistant/public/index_participant.php");</script>';
}*/
if (isset ($_POST['save_par_goal'])) {
    $json = json_encode($_POST);

    $gt_id = "";
    $par_goal_id = "";
    if (isset ($_POST['goal_template_id'])) {
        $gt_id = $_POST['goal_template_id'];
    }
    if (isset ($_POST['par_goal_id'])) {
        $par_goal_id = $_POST['par_goal_id'];
    }
    $bar_id = mysqli_real_escape_string($con, $_POST['bar_id']);
    $stra_id = mysqli_real_escape_string($con, $_POST['stra_id']);

    echo "participantid: " . $participantid . "<br/>";
    echo "gt_id: " . $gt_id . "<br/>";
    echo "json: " . $json . "<br/>";

    $decode = json_decode($json, true);
    $ans_escape_str = mysqli_real_escape_string($con, $json);

    echo "decode: " . var_dump($decode) . "<br/>";

    if (!empty($par_goal_id)) {
        echo "<br/>UPDATE";
        $sql_update = "UPDATE participant_goal SET answer='$ans_escape_str', bar_id='$bar_id', stra_id='$stra_id', goal_template_id='$gt_id' WHERE participant_goal_id='$par_goal_id'";
        mysqli_query($con, $sql_update) or die (mysqli_error($con));
    } else {
        echo "<br/>INSERT";
        $sql_insert = "INSERT INTO participant_goal (participantid, goal_template_id, answer, bar_id, stra_id, `timestamp`, fail_ss, fail_nss, `status`) 
                VALUE ('$participantid', '$gt_id', '$ans_escape_str', '$bar_id', '$stra_id', NOW(), 0, 0, 'current')";
        mysqli_query($con, $sql_insert) or die (mysqli_error($con));
    }

    // not implemented
    /*
    $result = mysqli_query($con, "SELECT answer FROM participant_goal WHERE participantid='$participantid' AND `status` != 'submitted'")
    or die(mysqli_error($con));
    $num_rows = mysqli_num_rows($result);
    if($num_rows>0) {
    } else{
        $sql = "INSERT INTO participant_goal (participantid, goal_template_id, answer, isSaved) VALUES ('$participantid', '$gt_id', '$json', 1)";
    }*/
}
if (isset ($_POST['submit_goal_checked'])) {
    $json = json_encode($_POST);

    $gt_id = "";
    $par_goal_id = "";
    if (isset ($_POST['goal_template_id'])) {
        $gt_id = $_POST['goal_template_id'];
    }
    if (isset ($_POST['par_goal_id'])) {
        $par_goal_id = $_POST['par_goal_id'];
    }
    $bar_id = mysqli_real_escape_string($con, $_POST['bar_id']);
    $stra_id = mysqli_real_escape_string($con, $_POST['stra_id']);

    echo "participantid: " . $participantid . "<br/>";
    echo "gt_id: " . $gt_id . "<br/>";
    echo "json: " . $json . "<br/>";

    $decode = json_decode($json, true);
    $ans_escape_str = mysqli_real_escape_string($con, $json);

    echo "decode: " . var_dump($decode) . "<br/>";

    $_SESSION['current_step'] = "sfos";
    if (!empty($par_goal_id)) {
        echo "<br/>UPDATE";
        $sql_update = "UPDATE participant_goal SET answer='$ans_escape_str', 
                   bar_id='$bar_id', stra_id='$stra_id', goal_template_id='$gt_id',
                   `status`='submitted', `submitted_time` = NOW() WHERE participant_goal_id='$par_goal_id'";
        mysqli_query($con, $sql_update) or die (mysqli_error($con));
    } else {
        echo "<br/>INSERT";
        $sql_insert = "INSERT INTO participant_goal (participantid, goal_template_id, answer, bar_id, stra_id, `timestamp`, submitted_time, fail_ss, fail_nss, `status`) 
                VALUE ('$participantid', '$gt_id', '$ans_escape_str', '$bar_id', '$stra_id', NOW(), NOW(), 0, 0, 'submitted')";
        mysqli_query($con, $sql_insert) or die (mysqli_error($con));
    }

    $result = mysqli_query($con, "SELECT s.* FROM sfos `s` JOIN sfos_mapping `sm` ON s.sfos_id = sm.sfos_id WHERE stra_id = '$stra_id';");
    $num_rows_exist = mysqli_num_rows($result);
    $sfos_id = "";
    if ($num_rows_exist > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $sfos_id = $row[0];
        }
    }

    $sql_insert = "INSERT INTO participant_sfos (participantid, sfos_id, stra_id, `timestamp`, `status`)
                VALUE ('$participantid', '$sfos_id', '$stra_id', NOW(), 'current')";
    mysqli_query($con, $sql_insert) or die (mysqli_error($con));
}

mysqli_close($con);
header('Location: /coach_assistant/public/index_participant.php');
?>