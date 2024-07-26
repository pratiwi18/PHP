<?php
global $session;
// Loading a participant based on participant session
$participantid = $session->participantid;
global $soc_form;
global $par_bar;
global $stra_bar;
global $goal_setting;
global $sfos_bar;

?>
<div class="col col-md-12 mb-4 text-center">
    <h5>Your progress</h5>
    <?php
    // If they have a submitted strategy. It means they are in the goal template step.
    // If they have a barrier submitted and dont have strategy submitted, it means they are in strategy selection step.
    // If they have a stage of change submitted and dont have barrier submitted, it means they are in barriers ordering step.
    // And if they dont have a stage of change submitted, it means they are in the getting to know you step.

    if ($session->isDevelop) {
        $current = "";
        if (isset($_SESSION['current_step']))
            $current = $_SESSION['current_step'];

        if (!empty($soc_form) & $current != "gtky") {
            if (!empty($par_bar) & $current != "barriers") {
                if (!empty($stra_bar) & $current != "strategies") {
                    if (!empty($goal_setting) & $current != "goal") {
                        ?>
                        <div class="progress">
                            <div class="progress-bar massive-font" role="progressbar" aria-valuenow="90"
                                 aria-valuemin="100"
                                 aria-valuemax="100" style="width:90%; padding:10px 10px 35px 10px;">
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="progress">
                            <div class="progress-bar massive-font" role="progressbar" aria-valuenow="83"
                                 aria-valuemin="100"
                                 aria-valuemax="100" style="width:83%; padding:10px 10px 35px 10px;">
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="progress">
                        <div class="progress-bar massive-font" role="progressbar" aria-valuenow="66" aria-valuemin="100"
                             aria-valuemax="100" style="width:66%; padding:10px 10px 35px 10px;">
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="progress">
                    <div class="progress-bar massive-font" role="progressbar" aria-valuenow="50" aria-valuemin="100"
                         aria-valuemax="100" style="width:50%; padding:10px 10px 35px 10px;">
                    </div>
                </div>
                <?php
            }
        } else {
            // Getting to know you section
            ?>
            <div class="progress" style="height:50px">
                <div class="progress-bar massive-font" id="progressBar" role="progressbar" aria-valuenow="0"
                     aria-valuemin="100" aria-valuemax="100" style="width:0%; height:50px">
                </div>
            </div>
            <?php
        }

    } else {
        if (!empty($soc_form)) {
            if (!empty($par_bar)) {
                if (!empty($stra_bar)) {
                    // not tested yet
                    if (!empty($goal_setting)) {
                        ?>
                        <div class="progress">
                            <div class="progress-bar massive-font" role="progressbar" aria-valuenow="90"
                                 aria-valuemin="100"
                                 aria-valuemax="100" style="width:90%; padding:10px 10px 35px 10px;">
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="progress">
                            <div class="progress-bar massive-font" role="progressbar" aria-valuenow="83"
                                 aria-valuemin="100"
                                 aria-valuemax="100" style="width:83%; padding:10px 10px 35px 10px;">
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="progress">
                        <div class="progress-bar massive-font" role="progressbar" aria-valuenow="66" aria-valuemin="100"
                             aria-valuemax="100" style="width:66%; padding:10px 10px 35px 10px;">
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="progress">
                    <div class="progress-bar massive-font" role="progressbar" aria-valuenow="50" aria-valuemin="100"
                         aria-valuemax="100" style="width:50%; padding:10px 10px 35px 10px;">
                    </div>
                </div>
                <?php
            }
        } else {
            // Getting to know you section
            ?>
            <div class="progress" style="height:50px">
                <div class="progress-bar massive-font" id="progressBar" role="progressbar" aria-valuenow="0"
                     aria-valuemin="100" aria-valuemax="100" style="width:0%; height:50px">
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>