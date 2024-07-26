<?php
require_once "../includes/db.inc.php";
global $session;
global $database;
// Loading a participant based on participant session
$participantid = $session->participantid;

global $par_bar;
global $stra_bar;
global $con;
global $gq_results;
global $istype2;

$stra_details = strategy::find_by_id($stra_bar->stra_id);

# Finding the right goal mapping
if ($session->isEchoForDevelop()) {
    echo "<br/>barrier - stra_id - stra_type: "; // kien
    echo $par_bar->bar_id . "-----" . $stra_bar->stra_id . "-----"; // kien
    echo $stra_details->stra_type . "<br/><br/>";
}

$sql_gsmap = "SELECT * FROM goal_mapping WHERE bar_id='{$par_bar->bar_id}' AND  stra_id='{$stra_bar->stra_id}' LIMIT 1";
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
    
    $gq_results = array();
  
    if (!empty($row)) {
        global $gt_id;
        //$gt_id = $row['goal_template_id'];
        
        
        # Start - This is for testing different goals
         $gt_id = 16;
        # End - This is for testing different goals
        // finding the messages for that goal template
        $sql_goal_msg = "SELECT * FROM goal_template_message WHERE goal_template_id ='{$gt_id}' ORDER BY rank";
        $result_set_goal_msg = $database->query($sql_goal_msg);
        $istype2 = false;
        while ($row_goal_msg = $database->fetch_array($result_set_goal_msg)) {
            array_push($gq_results, $row_goal_msg['type']);
            array_push($gq_results, $row_goal_msg['description']);
            //type 2
            if ($row_goal_msg['type']==2)
            {
              $istype2=true;
            }
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

    $sql_goal_check = mysqli_query($con, "SELECT * FROM participant_goal WHERE participantid='$participantid' AND status='current' LIMIT 1")
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
      <?php var_dump((isset($istype2) ===false) && ($istype2))?>
    </div>
</div>
<form id="gs_form" method="post" action="/coach_assistant/controller/goal_process.php">
    <?php
    // Calculates the number of goal types that exist for a particular template
    $number_of_type = 0;
    if (isset($gq_results))
        $number_of_type = count($gq_results) / 3;
    $ans_checked=true;
    
    for ($counter = 0; $counter < $number_of_type; $counter++) {
        if ($session->isEchoForDevelop()) {
            echo 'forms/gs_type_' . $gq_results[3 * $counter] . '.php' . "<br/>";
            //echo "current answer: <br/>";
            //echo $par_answer;
        }
        if ($gq_results[3 * $counter] == 2)
        {
          $ans_checked=false;
        }
        include("layouts/forms/gs_type_" . $gq_results[3 * $counter] . '.php');
        //include_layout_template('forms/gs_type_' . $gq_results[3 * $counter] . '.php');
    }
    ?>
    <input type="hidden" name="par_goal_id" id="par_goal_id" value="<?php echo $par_goal_id ?>"/>
    <input type="hidden" name="goal_template_id" id="goal_template_id" value="<?php echo $gt_id ?>"/>
    <input type="hidden" name="bar_id" id="bar_id" value="<?php echo $par_bar->bar_id ?>">
    <input type="hidden" name="stra_id" id="stra_id" value="<?php echo $stra_bar->stra_id ?>">
    <input type="hidden" name="answer_checked" id="answer_checked" value="<?php echo $ans_checked ?>"/>
  
  
    <div class="col-md-12 text-center">
        <?php 
        /*if ($session->isDevelop) {
            ?>
            <input type="submit" class="previous-form btn btn-secondary float-left" value="Previous" name="previous"
                   id="previous">
            <?php
        }*/
        ?>
        <input role="button" type="submit" class="btn btn-success" value="Save" name="save_par_goal"
               id="save_par_goal">
        <input role="button" type="button" class="btn btn-primary" value="Submit" name="submit_par_goal"
               id="submit-goal">
        <input role="button" type="submit" class="btn btn-primary" value="submitted_form" name="submit_goal_checked"
               id="submit-goal-checked" style="display: none;">
    </div>
    <div class="col-md-12 text-center">
        <small class="mr-2" style="color:#999"> *You can save at any time and complete the form later.</small>
    </div>
</form>
</div>
    <div class="col-md-4 order-md-2" > 

        <div class="media">
                <div class="media-body align-self-center ml-3">
                    <h3 class="">Coaching path</h3>
                </div>
                <img class="align-self-center mr-3" src="images/coaching-path.png"
                     alt="Generic placeholder image">
            </div>
         <hr/>

        <div >
                      <li style="color: red"><h5>Goal Setting:</h5></li>
                      <p>You need to set your goals at this step.</p>
        </div>   
    </div>

      
</div>
<script type="text/javascript">
    $(document).ready(function () {
        //var istypetwo = "<?php echo ($istype2 == true) ?>";
        var rgroups = [];
        $('input:radio').each(function (index, el) {
            var i;
            for (i = 0; i < rgroups.length; i++)
                if (rgroups[i] == $(el).attr('name'))
                    return true;
            rgroups.push($(el).attr('name'));
        });

        rgroups = rgroups.length;

        $("#submit-goal").click(function () {

            var isAnsweredAll = true;
            if ($('input:radio:checked').length < rgroups) {
                isAnsweredAll = false;
            }

            $('textarea').each(function (index, el) {
                if ($(el).val() == '') {
                    isAnsweredAll = false;
                }
            });

            console.log(isAnsweredAll);

            if (isAnsweredAll == false) {
                var cf = confirm("Please finish the form before submit");
                
            } else if("<?php echo ($istype2)?>" == true ) { 
                var isverified2=confirm("The answer needs to be verified by your coach");
                $("#save_par_goal").click();
                $("#submit-goal-checked").click(); 
            }else {
                $("#save_par_goal").click();
                $("#submit-goal-checked").click();     
                  }                   
        });
    });
</script>