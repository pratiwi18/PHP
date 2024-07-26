<?php
global $session;
// Loading a participant based on participant session
$participantid = $session->participantid;
global $soc_form;
global $par_bar;
global $stra_bar;
global $goal_setting;
global $sfos_bar;

if (!is_null($stra_bar))
    $stra_details = strategy::find_by_id($stra_bar->stra_id);


$sql_goal_check = mysqli_query($con, "SELECT * FROM participant_goal WHERE participantid='$participantid' AND status='current' LIMIT 1")
or die("<p><span style=\"color: red;\">Unable to select table</span></p>");
$num_rows_goal = mysqli_num_rows($sql_goal_check);

$start_time = time();
$par_goal_id = "";
$fail_ss = "";
$fail_nss = "";
if ($num_rows_goal > 0) {
    while ($row_answer = mysqli_fetch_array($sql_goal_check, MYSQLI_NUM)) {
        $par_goal_id = $row_answer[0];
        $start_time = strtotime($row_answer[6]);
        $fail_ss = $row_answer[8];
        $fail_nss = $row_answer[9];
    }
}
?>

<div class="col-md-2 order-md-2" id="coachingPath">
    <div class="jumbotron">

        <div class="media">
            <div class="media-body align-self-center ml-3">
                <h3 class="">Coaching path</h3>
            </div>
            <img class="align-self-center mr-3" src="images/coaching-path.png"
                 alt="Generic placeholder image">
        </div>
        <hr/>
        <?php
        if ($soc_form_status == false) {
            if ($par_bar_status == false) {
                if ($stra_bar_status == false) {
                    if ($goal_status == false) {
                        // SFOS section
                        ?>
                        <p>Congratulation, achieve a goal.
                            Your next steps are as below.</p>
                        <h5>SFOS</h5>
                        <?php
                    } else {
                        // Goal section
                        echo "goal_status" . var_dump($goal_status) . "<br/>";

                        $cur_time = time();
                        $datediff = round(($cur_time - $start_time) / (60 * 60 * 24));

                        if ($datediff > 7) {
                            echo "<p>This goal is over a week. " .
                                "Would you like to continue doing this goal?</p>";
                        } else {
                            echo "<p>Congratulation, now you have a strategy to follow. " .
                                "Follow below instruction to define your goals and activities.</p>";
                        }

                        ?>

                        <div class="col col-md-12 text-center">
                            <form class="" method="post" action="/coach_assistant/controller/un_goal.php">
                                <input type="hidden" name="parid" id="parid" value="<?php echo $participantid ?>">
                                <input type="hidden" name="bar_id" id="bar_id" value="<?php echo $par_bar->bar_id ?>">
                                <input type="hidden" name="stra_id" id="stra_id"
                                       value="<?php echo $stra_bar->stra_id ?>">
                                <input type="hidden" name="stra_type" id="stra_type"
                                       value="<?php echo $stra_details->stra_type ?>">
                                <input type="hidden" name="par_goal_id" id="par_goal_id"
                                       value="<?php echo $par_goal_id ?>">
                                <input type="hidden" name="fail_ss" id="fail_ss" value="<?php echo $fail_ss ?>">
                                <input type="hidden" name="fail_nss" id="fail_nss" value="<?php echo $fail_nss ?>">
                                <?php
                                if ((($cur_time - $start_time) / 3600 / 24) > 7) {
                                    ?>
                                    <input role="button" type="submit" class="btn btn-warning mr-2 float-right"
                                           value="No, I want to start again" name="failed_goal" id="failed_goal">
                                    <?php
                                } else {
                                    //if ($session->isDevelop) {
                                    if (empty($par_goal_id)) {
                                        echo "For testing period: You have to save this goal before testing failure";
                                    } else {
                                        ?>
                                        <input role="button" type="submit" class="btn btn-warning mr-2 float-right"
                                               value="No, I want to start again" name="failed_goal" id="failed_goal">
                                        <?php
                                    }
                                    //}
                                }
                                ?>
                            </form>
                            <!--<form class="" method="post" id='test_form'>
                                <input role="button" type="submit"
                                       class="btn btn-success mr-2 float-right"
                                       value="Unsuccessful_strategy" name="unsuccessful_strategy"
                                       id="unsuccessful_strategy"> <input hidden type="number" value=1
                                                                          name="test"/>
                            </form>-->
                        </div>
                        <?php
                    }
                } else {
                    // Strategy section
                    ?>
                    <p>Congratulation, you have prioritize your barriers.
                        Your next steps are as below.</p>
                    <ol>
                        <li style="color: red">
                            <h5>Strategy selection</h5>
                        </li>
                        <p>You will select a strategy at this step. By selecting a strategy
                            you will select a path to follow.</p>
                        <li>
                            <h5>Goal setting</h5>
                        </li>
                        <p>You will define your goal based on the strategy.</p>
                    </ol>
                    <?php
                }
            } else {
                // Barriers section
                ?>
                <p>Congratulation, you have finished getting to know you
                    section. Your next steps are as below.</p>
                <ol>

                    <li style="color: red"><h5>Barriers prioritizing</h5></li>

                    <p>You need to prioritize your barriers at this step. This will help
                        us to give you the best possible strategy to you.</p>

                    <li><h5>Strategy selection</h5></li>

                    <p>You will select a strategy at this step.</p>

                    <li><h5>Goal setting</h5></li>

                    <p>You will define your goal based on the strategy.</p>
                </ol>
                <?php
            }
        } else {
            // Getting to know you section
            ?>
            <p>Congratulation, you are now part of this program. Now you
                just need to follow below steps to get your program tailored</p>
            <ol>

                <li style="color: red"><h5>Getting to know you:</h5></li>

                <p>This section will give us some information about you that we can
                    use to select your barriers</p>

                <li><h5>Barriers prioritizing</h5></li>

                <p>You need to prioritize your barriers at this step.</p>

                <li><h5>Strategy selection</h5></li>

                <p>You will select a strategy at this step.</p>

                <li><h5>Goal setting</h5></li>

                <p>You will define your goal based on the strategy.</p>
            </ol>
            <?php
        }
        ?>
    </div>
</div>