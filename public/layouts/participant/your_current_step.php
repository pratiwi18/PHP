<?php
global $session;
// Loading a participant based on participant session
$participantid = $session->participantid;
global $soc_form;
global $par_bar;
global $stra_bar;
global $goal_setting;
global $sfos_bar;
global $confident_bar;
?>
<div class="col-md-12 order-md-1" id="yourNextStep">
    <!--div class="jumbotron">
        <div class="row text-center">
            <div class="col col-md-12">
                <h3>Your current step</h3>
            </div>
        </div-->
        <div id="YNS-inner">
            <?php
            // back for developer kien
            if ($session->isDevelop) {
                $current = "";
                if (isset($_SESSION['current_step']))
                    $current = $_SESSION['current_step'];
                echo "current: " . $current . "<br/>";    // kien
                if ($soc_form_status == false & $current != "gtky") {
                    if ($par_bar_status == false & $current != "barriers") {
                        if ($stra_bar_status == false & $current != "strategies") {
                            if ($goal_status == false & $current != "goal") {
                                if($sfos_status == false & $current != "sfos") {
                                    if($confident_status == false & $current != "confident") {
                                        include_layout_template('participant/evaluation.php');
                                    } else {
                                        echo "confident";
                                        include_layout_template('participant/confident.php');
                                    }
                                } else {
                                    echo "sfos";
                                    include_layout_template('participant/sfos.php');
                                }
                            } else {
                                echo "goal";
                                include_layout_template('participant/goal_setting.php');
                            }
                        } else {
                            echo "strategies";
                            include_layout_template('forms/strategies.php');
                        }
                    } else {
                        echo "barriers";
                        include_layout_template('forms/barriers.php');
                    }
                } else {
                    echo "getting_to_know_you";
                    // Getting to know you section
                    include_layout_template('participant/getting_to_know_you.php');
                }

            } else {
                /* How to do
                 * $soc_form -> select stage_of_change where status = 'current'
                 *              then select stage_of_change where status = 'submitted'
                 *
                 * $par_bar & $stra_bar -> do the same with barriers and strategies
                 *
                 * */
                if ($soc_form_status == false) {
                    if ($par_bar_status == false) {
                        if ($stra_bar_status == false) {
                            if ($goal_status == false) {
                                if($sfos_status == false) {
                                    if($confident_status == false) {
                                        include_layout_template('participant/evaluation.php');
                                    } else {
                                        include_layout_template('participant/confident.php');
                                    }
                                } else {
                                    include_layout_template('participant/sfos.php');
                                } //include_layout_template('participant/sfos.php');
                            } else {
                                include_layout_template('participant/goal_setting.php');
                            } //include_layout_template('participant/goal_setting.php');
                        } else {
                            include_layout_template('forms/strategies.php');
                        }
                    } else {
                        include_layout_template('forms/barriers.php');
                    }
                } else {
                    // Getting to know you section
                    include_layout_template('participant/getting_to_know_you.php');
                }
            }
            ?>
        </div>
    </div>
</div>
  