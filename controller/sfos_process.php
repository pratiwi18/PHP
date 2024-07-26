<?php

require_once "../includes/db.inc.php";
require_once("../includes/initialize.php");
global $session;

$participantid = $session->participantid;

if (isset ($_POST['previous'])) {
    $_SESSION['current_step'] = "goal";
    echo '<script>location.replace("/coach_assistant/public/index_participant.php");</script>';
}
if (isset ($_POST['save_sfos'])) {
    $json = json_encode($_POST);

    $sfos_id = "";
    $par_sfos_id = "";
    if (isset ($_POST['sfos_id'])) {
        $sfos_id = $_POST['sfos_id'];
    }
    if (isset ($_POST['par_sfos_id'])) {
        $par_sfos_id = $_POST['par_sfos_id'];
    }

    $stra_id = mysqli_real_escape_string($con, $_POST['stra_id']);

    //echo "participantid: " . $participantid . "<br/>";
    //echo "json: " . $json . "<br/>";

    $decode = json_decode($json, true);
    $ans_escape_str = mysqli_real_escape_string($con, $json);

    //echo "decode: " . var_dump($decode) . "<br/>";

    if (!empty($par_sfos_id)) {
        $sql_update = "UPDATE participant_sfos SET answer='$ans_escape_str', stra_id='$stra_id' WHERE participant_sfos_id='$par_sfos_id'";
        mysqli_query($con, $sql_update) or die (mysqli_error($con));
        echo "UPDATED";
    } else {
        $sql_insert = "INSERT INTO participant_sfos (participantid, sfos_id, answer, stra_id, `timestamp`, `status`)
                VALUE ('$participantid', '$sfos_id', '$ans_escape_str', '$stra_id', NOW(), 'current')";
        mysqli_query($con, $sql_insert) or die (mysqli_error($con));
        echo "INSERTED";
    }
}
if (isset ($_POST['submit_sfos'])) {
    $json = json_encode($_POST);

    $sfos_id = "";
    $par_sfos_id = "";
    if (isset ($_POST['sfos_id'])) {
        $sfos_id = $_POST['sfos_id'];
    }
    if (isset ($_POST['par_sfos_id'])) {
        $par_sfos_id = $_POST['par_sfos_id'];
    }

    $stra_id = mysqli_real_escape_string($con, $_POST['stra_id']);

    $decode = json_decode($json, true);
    $ans_escape_str = mysqli_real_escape_string($con, $json);

    $_SESSION['current_step'] = "confident";
    if (!empty($par_sfos_id)) {
        echo "<br/>UPDATE";
        $sql_update = "UPDATE participant_sfos SET answer='$ans_escape_str', 
                   stra_id='$stra_id', sfos_id='$sfos_id',
                   `status`='submitted', `submitted_time` = NOW() WHERE participant_sfos_id='$par_sfos_id'";
        mysqli_query($con, $sql_update) or die (mysqli_error($con));
    } else {
        echo "<br/>INSERT";
        $sql_insert = "INSERT INTO participant_sfos (participantid, sfos_id, answer, stra_id, `timestamp`, submitted_time, `status`) 
                VALUE ('$participantid', '$sfos_id', '$ans_escape_str', '$stra_id', NOW(), NOW(), 'submitted')";
        mysqli_query($con, $sql_insert) or die (mysqli_error($con));
    }

    $sql_insert = "INSERT INTO participant_confident (participantid, `timestamp`, `status`)
                VALUE ('$participantid', NOW(), 'current')";
    mysqli_query($con, $sql_insert) or die (mysqli_error($con));
}

mysqli_close($con);
header('Location: /coach_assistant/public/index_participant.php');
?>