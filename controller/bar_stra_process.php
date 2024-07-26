<?php
require_once('../includes/participant.php');
require_once('../includes/impairments.php');
require_once('../includes/participantIMP.php');
require_once('../includes/session.php');
require_once('../includes/stageOfChange.php');
require_once('../includes/participantSTRA.php');
require_once('../includes/barriers.php');
require_once('../includes/participantBAR.php');
require_once("../includes/db.inc.php");
global $session;
$participantid = $session->participantid;

if (isset($_POST['submit_par_bar'])) {
    $barriers = barriers::find_all();
    $barArr = array();
    foreach ($barriers as $barriers) {
        array_push($barArr, $barriers->bar_id);
    }
    if (isset($_POST['barriersId']))
        $deleteBars = array_diff($barArr, $_POST['barriersId']);

    if (isset($deleteBars))
        participantBAR::delete_by_barids($participantid, $deleteBars);

    if (isset($_POST['barriersId']))
        for ($counter = 0; $counter < count($_POST['barriersId']); $counter++) {
            $newBar = new participantBAR();
            $newBar->participantid = $participantid;
            $newBar->bar_id = $_POST['barriersId'][$counter];
            $newBar->bar_prority = $counter + 1;
            if ($newBar->bar_prority == 1) {
                $newBar->selected = 2; #barrier with the highest priority (lowest value) will be selected
            } else {
                $newBar->selected = 0;    #other barriers will be not determined
            }
            $complete_date = time();
            $newBar->timestamp = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
            $newBar->submitted = 0;
            $newBar->save();
        }

    // kien
    $_SESSION['current_step'] = "strategies";
    echo '<script>location.replace("/coach_assistant/public/index_participant.php");</script>';
    return;
} elseif (isset($_POST['save_par_bar'])) {
    $barriers = barriers::find_all();
    $barArr = array();
    foreach ($barriers as $barriers) {
        array_push($barArr, $barriers->bar_id);
    }
    if (isset($_POST['barriersId']))
        $deleteBars = array_diff($barArr, $_POST['barriersId']);

    if (isset($deleteBars))
        participantBAR::delete_by_barids($participantid, $deleteBars);

    if (isset($_POST['barriersId'])){
        for ($counter = 0; $counter < count($_POST['barriersId']); $counter++) {
            $newBar = new participantBAR();
            $newBar->participantid = $participantid;
            $newBar->bar_id = $_POST['barriersId'][$counter];
            $newBar->bar_prority = $counter + 1;
            if ($newBar->bar_prority == 1) {
                $newBar->selected = 2; #barrier with the highest priority (lowest value) will be selected
            } else {
                $newBar->selected = 0;    #other barriers will be not determined
            }
            $complete_date = time();
            $newBar->timestamp = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
            $newBar->submitted = 1;
            $newBar->status = "submitted";
            $newBar->save();
        }
    }
    $_SESSION['current_step'] = "strategies";

    // save new stra
    $newStra = new participantSTRA();
    $newStra->participantid = $participantid;
    $newStra->status = 'current';
    $newStra->timestamp = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
    $newStra->create();

    echo '<script>location.replace("/coach_assistant/public/index_participant.php");</script>';
} elseif (isset($_POST['actionStra']) AND $_POST['actionStra'] == 'Save') {
    $bar_id = $_POST['bar_id'];
    $smid = $_POST['smid'];
    $stra_id = $_POST['stra_id'];

    $newStra = new participantSTRA();
    $newStra->participantid = $participantid;
    $newStra->smid = $smid;
    $newStra->stra_id = $stra_id;
    $newStra->success = NULL;
    $newStra->submitted = 0;
    $newStra->reminder_count = 0;
    $complete_date = time();
    $newStra->timestamp = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
    $newStra->create();

} elseif (isset($_POST['submit-stra'])) {
    $bar_id = $_POST['bar_id'];
    $smid = $_POST['smid'];
    $stra_id = $_POST['strategy'];
    $newStra = new participantSTRA();
    $newStra->participantid = $participantid;
    $newStra->smid = $smid;
    $newStra->stra_id = $stra_id;
    $newStra->success = 'NULL';
    $newStra->submitted = 1;
    $newStra->reminder_count = 0;
    $complete_date = time();
    $newStra->timestamp = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
    $newStra->status = 'submitted';

    $sql_par_stra_check = mysqli_query($con, "SELECT * FROM participant_strategy WHERE participantid = '$participantid' " .
        "AND `status` = 'current' ORDER BY `timestamp` desc") or die("<p><span style=\"color: red;\">Unable to select table</span></p>");
    $num_rows_par_stra = mysqli_num_rows($sql_par_stra_check);

    echo var_dump($newStra->timestamp);
    if ($num_rows_par_stra > 0) {
        echo "update";
        while ($row_ps = mysqli_fetch_array($sql_par_stra_check, MYSQLI_NUM)) {
            $par_stra_id = $row_ps[0];
        }
        $sql_update = "UPDATE participant_strategy SET smid='$newStra->smid', stra_id='$newStra->stra_id', " .
            " submitted=1, `status`='submitted' WHERE par_stra_id='$par_stra_id'";
        mysqli_query($con, $sql_update) or die (mysqli_error());

        $_SESSION['current_step'] = "goal";
    } else {
        echo "insert";
        if ($newStra->create()) {
            $_SESSION['current_step'] = "goal";
        } else {
            echo 'Something went wrong, try again later (STRA)';
            return;
        }
    }

    $sql_insert = "INSERT INTO participant_goal (participantid, `timestamp`, fail_ss, fail_nss, `status`) 
                VALUE ('$participantid', NOW(), 0, 0, 'current')";
    mysqli_query($con, $sql_insert) or die (mysqli_error($con));

    echo '<script>location.replace("/coach_assistant/public/index_participant.php");</script>';
    /*if ($newStra->create()) {
        $_SESSION['current_step'] = "goal";
        echo '<script>location.replace("/coach_assistant/public/index_participant.php");</script>';
        return;
    } else {
        echo 'Something went wrong, try again later (STRA)';
        return;
    }*/

} elseif (isset ($_POST['previous_stra'])) {
    $_SESSION['current_step'] = "barriers";
    echo '<script>location.replace("/coach_assistant/public/index_participant.php");</script>';
} elseif (isset ($_POST['previous_soc'])) {
    $_SESSION['current_step'] = "gtky";
    echo '<script>location.replace("/coach_assistant/public/index_participant.php");</script>';
} else {
    echo 'Something went wrong, try again later';
    return;
}
?>