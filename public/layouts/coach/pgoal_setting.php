<?php
require_once ("../includes/db.inc.php");
require_once ("../includes/participantGOAL.php");
require_once ("../includes/strategy.php");

global $database;

$participantid = $_GET['pid'];
$sql = "select * from participant_goal where participantid=$participantid and status='submitted' order by 'submitted_time' limit 1";
$participantgoal = ParticipantGOAL::find_by_sql($sql);

$stra_details = strategy::find_by_id($participantgoal[0]->stra_id);

$sql_gsmap = "SELECT * FROM goal_mapping WHERE bar_id='{$participantgoal[0]->bar_id}' AND  stra_id='{$participantgoal[0]->stra_id}' LIMIT 1";
$result_set = $database->query($sql_gsmap);
$row = $database->fetch_array($result_set);

#if there is any rule
if (!empty($row)) {
    $tmp_id = $row['template_id'];
    // Getting the details of the template
    $sql_gt_id = "SELECT * FROM goal_template_detail WHERE template_id='{$tmp_id}' LIMIT 1";
    $result_set = $database->query($sql_gt_id);
    $row = $database->fetch_array($result_set);

    // This is the variable for storing the goal messages and questions. It is being used in the different types of the templates (gs_type_1 to 6)
    global $gq_results;
    $gq_results = array();
    if (!empty($row)) {
        global $gt_id;
        $gt_id = $row['goal_template_id'];
        
        # Start - This is for testing different goals
        //$gt_id = 14;
        # End - This is for testing different goals
        // finding the messages for that goal template
        $sql_goal_msg = "SELECT * FROM goal_template_message WHERE goal_template_id ='{$gt_id}' ORDER BY rank";
        $result_set_goal_msg = $database->query($sql_goal_msg);
  
        while ($row_goal_msg = $database->fetch_array($result_set_goal_msg)) {
            array_push($gq_results, $row_goal_msg['type']);
            array_push($gq_results, $row_goal_msg['description']);
            // Finding the questions for for the particular message and type of the goal template
            $sql_goal_q = "SELECT * FROM goal_template_question WHERE goal_template_id ='{$gt_id}' AND type = {$row_goal_msg['type']}";
            $result_set_goal_q = $database->query($sql_goal_q);
            $temp1 = array();
            while ($row_goal_q = $database->fetch_array($result_set_goal_q)) {
                $temp1["{$row_goal_q['qid']}"] = $row_goal_q['description'];
                //var_dump($temp1);
            }
            array_push($gq_results, $temp1);
        }
        //var_dump($gq_results);
    }

    // kien
    // check if there is a record in database

    $sql_goal_check = mysqli_query($con, "SELECT * FROM participant_goal WHERE participantid='$participantid' AND status='submitted' order by 'submitted_time' LIMIT 1")
    or die("<p><span style=\"color: red;\">Unable to select table</span></p>");
    $num_rows_goal = mysqli_num_rows($sql_goal_check);

    $par_answer = "";
    $par_goal_id = "";
    $fail_ss = "";
    $fail_nss = "";
    if ($num_rows_goal > 0) {
        while ($row_answer = mysqli_fetch_array($sql_goal_check, MYSQLI_NUM)) {
            $par_goal_id = $row_answer[0];
            //var_dump($par_goal_id);
            $par_answer = $row_answer[3];
            $fail_ss = $row_answer[8];
            $fail_nss = $row_answer[9];
        }
    }
} else {
    echo 'no rules';
}

?>
<div class="col-md-12 row">
  
          <div class="col-md-8 order-md-1 mb-5 mt-5"  role="tablist">
 
<div class="row text-center">
    <div class="col col-md-12">
        <h4>Goal setting</h4>
    </div>
</div>
<form id="gs_form">
    <?php
    // Calculates the number of goal types that exist for a particular template
    $number_of_type = 0;
    if (isset($gq_results))
        $number_of_type = count($gq_results) / 3;
    $ans_checked=true;
    
    for ($counter = 0; $counter < $number_of_type; $counter++) {
        include("layouts/forms/gs_type_" . $gq_results[3 * $counter] . '.php');
        //include_layout_template('forms/gs_type_' . $gq_results[3 * $counter] . '.php');
    }
    ?>   
</form>