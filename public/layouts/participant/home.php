<?php
global $participantid;

// Loading the submitted stage of change, barriers, strategeis based on the participant ID. 
// This will be used to determind the current step of a participant. 
// If they have a submitted strategy. It means they are in the goal template step. 
// If they have a barrier submitted and dont have strategy submitted, it means they are in strategy selection step. 
// If they have a stage of change submitted and dont have barrier submitted, it means they are in barriers ordering step. 
// And if they dont have a stage of change submitted, it means they are in the getting to know you step. 
global $soc_form, $par_bar, $stra_bar, $goal_setting, $sfos_bar, $confident_bar;

include("../includes/path_generator.php");
$obj = new path_generator($participantid);

$soc_form_status = $obj->soc_form_status;
$par_bar_status = $obj->par_bar_status;
$stra_bar_status = $obj->stra_bar_status;
$goal_status = $obj->goal_status;
$sfos_status = $obj->sfos_status;
$confident_status = $obj->confident_status;

$soc_form = $obj->soc_form;
$par_bar = $obj->par_bar;
$stra_bar = $obj->stra_bar;
$goal_setting = $obj->goal_setting;
$sfos_bar = $obj->sfos_bar;
$confident_bar = $obj->confident_bar;
//$soc_form2 = stageOfChange::find_by_pid_submitted($participantid);
//$par_bar = participantBAR::find_by_pid_submitted($participantid);
//$stra_bar = participantSTRA::find_by_pid_submitted($participantid);

?>

<div class="row">
    <?php
    if ($session->isEchoForDevelop()) {
        echo "soc_form: " . $soc_form->socid . "<br/>";
        echo "[false means the user already finished that step]<br/>";
        echo "stage of change (soc_form): " . ($soc_form_status ? 'true' : 'false') . "<br/>";
        echo "barriers (par_bar): " . ($par_bar_status ? 'true' : 'false') . "<br/>";
        echo "strategies (stra_bar): " . ($stra_bar_status ? 'true' : 'false') . "<br/>";
        echo "goal setting (goal_setting): " . ($goal_status ? 'true' : 'false') . "<br/>";
        echo "sfos (sfos_bar): " . ($sfos_status ? 'true' : 'false') . "<br/>";
        echo "confident (confident_bar): " . ($confident_status ? 'true' : 'false') . "<br/>";
    }
    // Progress bar
    include('progress_bar.php');
    //include_layout_template('participant/progress_bar.php');
    ?>
</div>
<div class="row">
    <?php
    //Coaching path section
    //include('coach_path.php');
    // Your current step section
    include('your_current_step.php');
    ?>
</div>
 
 
 