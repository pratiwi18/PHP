
<?php
global $session;
global $database;
// Loading a participant based on participant session
$participantid = $session->participantid;
# Barrier list for a participant						
$participantBARs = participantBAR::find_by_pid_submitted($participantid);
$participantSTRA = participantSTRA::find_by_pid_submitted_newest($participantid);

global $strategies;
$strategies = array();
#### Strategy section
if (isset($participantBARs) && !empty($participantBARs)) {
    $sql = "SELECT * FROM participant_barrier WHERE participantid={$participantid} AND `status`='submitted' AND selected ='2' LIMIT 1";
    $participantBAR = participantBAR::find_by_sql($sql);
    $participantBAR = array_shift($participantBAR);
    if (!empty($participantBAR)) {
        $participantBAR_des = barriers::find_by_id($participantBAR->bar_id);

        #strategy_mapping class is needed instead of the query
        # Finding the right strategy mapping
        $sql_stramap = "SELECT * FROM strategy_mapping WHERE bar_id ='{$participantBAR->bar_id}' LIMIT 1";
        $result_set_stramap = $database->query($sql_stramap);
        $row_stramap = $database->fetch_array($result_set_stramap);
        #if there is any rule
        if (!empty($row_stramap)) {
            #Finding the right strategy for that rule
            $smid = $row_stramap['smid'];
            $straIdsArr = explode(",", $row_stramap['stra_ids']);
            $temp_strategies = array();

            #find all the strategies based on the rule
            foreach ($straIdsArr as $straId) {
                array_push($strategies, strategy::find_by_id($straId));
            }

            #if there is no rule
        } else {
            $straMessage = "No rule has been found";
        }
    } else {
        $straMessage = "No barrier is left";
    }

} else {
    $straMessage = "First prioritize and save your barriers";
}
?>
    <hr>
<div class="col-md-12 row">
  
          <div class="col-md-8 order-md-1 mb-5 mt-5"  role="tablist">
                
    <div class="text-center" role="alert" id="error">
        <!-- error will be shown here ! -->
    </div>
    <form method="post" action="/coach_assistant/controller/bar_stra_process.php">
        <div class="col-md-12 text-center">
            <h5>
                Strategy Selection
            </h5>
        </div>
        <?php
        if (!isset($straMessage) || empty($straMessage)) {
            ?>
            <div class="col-md-12 text-center">
                Please select one of the below strategies
            </div>
            <div class="col-md-12">
                <h5> Barrier: </h5>
            </div>
            <div class="col-md-12">
                <?php echo $participantBAR_des->bar_des ?>
            </div>


            <div class="col-md-12 mt-2">
                <h5> Strategies:</h5>
            </div>
            <div class="form-check">
                <?php
                foreach ($strategies as $strategy) {
                    ?>
                    <label for="strategy<?php echo $strategy->stra_id; ?>" class="col-form-label">
                        <input type="radio" name="strategy" id="strategy<?php echo $strategy->stra_id; ?>"
                               value="<?php echo $strategy->stra_id; ?>" required
                            <?php
                            if ($participantSTRA != false)
                                echo $participantSTRA->stra_id == $strategy->stra_id ? "checked" : ""
                            ?>>

                        <?php echo $strategy->stra_des; ?>
                    </label>
                    <?php
                }
                ?>
            </div>

            <label class="error" for="strategy"> </label>

            <input class="form-check-input" type="hidden" name="bar_id" id="bar_id"
                   value="<?php echo $participantBAR->bar_id; ?>">
            <input class="form-check-input" type="hidden" name="bmid" id="bmid" value="<?php echo $bmid; ?>">

            <input class="form-check-input" type="hidden" name="stra_id" id="stra_id"
                   value="<?php echo $strategy->stra_id; ?>">
            <input class="form-check-input" type="hidden" name="smid" id="smid" value="<?php echo $smid; ?>">


            <div class="col-md-12 text-center">
                <?php
                if ($session->isDevelop) {
                    ?>
                    <input type="submit" class="previous-form btn btn-secondary float-left" value="Previous"
                           name="previous_stra"
                           id="previous_stra">
                    <?php
                }
                ?>
                <input role="button" type="submit" class="btn btn-primary" value="Submit" name="submit-stra"
                       id="submit-stra">
            </div>


            <?php

        } else {
            echo '<div class="alert alert-warning" role="alert">' . $straMessage . '</div>';
        } ?>
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
                      <li style="color: red"><h5>Strategies Selection:</h5></li>
                      <p>You need to select the strategies at this step.</p>
        </div>   
    </div>

      </div>
</div>
<?php
/*if (isset ($_POST['previous'])) {
    $_SESSION['current_step'] = "barriers";
    echo '<script>location.replace("index_participant.php");</script>';
}
else if (isset ($_POST['submit-stra'])) {
    $_SESSION['current_step'] = "goal";
    echo '<script>location.replace("index_participant.php");</script>';
}*/
?>