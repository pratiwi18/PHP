<?php
global $session;
// Loading a participant based on participant session
$participantid = $session->participantid;
# Impairment list for a participant
$participantIMPs = participantIMP::find_by_pid($participantid);
# current stage for a participant
$participantSOC = participantSOC::find_by_pid($participantid);

# If there is a save barriers bring it on
$participantBARS = participantBAR::find_by_pid_saved($participantid);


#### Barrier section
#Making sure participant has select impairments
if (!empty($participantIMPs)) {
    #Making sure participant has filled out stage of change
    if (!empty($participantSOC)) {
        $barMessage = "";
        #Finding impairments categories
        $parImpCats = array();
        foreach ($participantIMPs as $participantIMP) {
            $imp_cat = impairments::find_by_id($participantIMP->imp_id);
            if (!in_array($imp_cat->imp_cat_id, $parImpCats)) {
                array_push($parImpCats, $imp_cat->imp_cat_id);
            }
        }
        sort($parImpCats);

        global $database;

        #barrier_mapping class is needed instead of the query
        # Finding the right barrier mapping
        $bar_ids = array();
        foreach ($parImpCats as $parImpCat) {
            $sql_barmap = "SELECT * FROM barriers_mapping WHERE current_stage='{$participantSOC->current_stage}' AND  imp_cat_ids LIKE '%{$parImpCat}%'";
            $result_set = $database->query($sql_barmap);
            while ($row = $database->fetch_array($result_set)) {
                array_push($bar_ids, $row);
            }
        }
        //	print_r($bar_ids);
        #if there is any rule
        if (!empty($bar_ids)) {
            # if there is any save barriers for the participant
            if (!empty($participantBARS)) {
                usort($participantBARS, function ($a, $b) {
                    return strcmp($a->bar_prority, $b->bar_prority);
                });

                $barriers = array();
                echo "<br/>";
                foreach ($participantBARS as $bar) {
                    if ($session->isEchoForDevelop()) {
                        echo $bar->bar_id . " - ";
                    }
                    array_push($barriers, barriers::find_by_id($bar->bar_id));
                }
            } else {
                #Finding the right barriers for that rule
                $barIdsArr = array();
                foreach ($bar_ids as $bar_id) {
                    $temp_bar_ids = explode(",", $bar_id['bar_ids']);
                    foreach ($temp_bar_ids as $temp_bar_id) {
                        array_push($barIdsArr, "'" . $temp_bar_id . "'");
                    }
                    $temp_bar_ids = array();
                }
                $barIdsArr = array_unique($barIdsArr);
                $barIdsArr = array_map('strval', $barIdsArr);
                //echo var_dump($barIdsArr) . "<br/><br/>";

                $barriers = barriers::find_by_ids($barIdsArr);
            }
            #if there is no rule
        } else {
            $barMessage = "No rule has been found";
        }

    } else {
        $barMessage = "First fill out stage of change questionnaire";
    }
} else {
    $barMessage = "First select your impairments";
}
# Barrier list for a participant
if (isset($bmid)) {
    $sql = "SELECT * FROM participant_barrier WHERE participantid={$participantid} AND bmid={$bmid}";
    $participantBARs = participantBAR::find_by_sql($sql);
}
?>

<div class= "col-md-12 row">
      <div class="col-md-8 order-md-1  mb-5 mt-5"  role="tablist">

        <div class="text-center" role="alert" id="error">
            <!-- error will be shown here ! -->
        </div>
        <div class="row mb-3">
            <div class="col-md-12 text-center">
                <h4>Barriers</h4>
                <h5 class="mb-3 text-left"> Please reorder barriers in the list below using the mouse (Top one has the highest
                    priority) </h5>
            </div>
            <form method="post" action="/coach_assistant/controller/bar_stra_process.php">
                <div class="col-md-12">
                    <?php
                    if (!isset($barMessage) || empty($barMessage)) {
                        $rankCounter = 1;
                        ?>

                        <ul id="bar-list" style="margin:0">
                            <?php
                            foreach ($barriers as $barrier) {
                                ?>
                                <li class="bar-li form-check ui-state-default">
                                    <span class="bar_numbers"
                                          style="margin:0; margin-left:10px; margin-right:-10px"> <?php echo $rankCounter; ?> </span>
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="hidden" name="barriersId[]" id="barriersId"
                                               value="<?php echo $barrier->bar_id; ?>">
                                        <?php echo $barrier->bar_des; ?>
                                    </label>
                                </li>
                                <?php
                                $rankCounter++;
                            } ?>

                        </ul>
                        <?php

                    } else {
                        echo '<div class="alert alert-warning" role="alert">' . $barMessage . '</div>';
                    } ?>

                </div>
                <div class="col-md-12 text-center">
                    <?php
                    if ($session->isDevelop) {
                        ?>
                        <input type="submit" class="previous-form btn btn-secondary float-left" value="Previous"
                               name="previous_soc"
                               id="previous_soc">
                        <?php
                    }
                    ?>
                    <input role="button" type="submit" class="btn btn-success" value="Save" name="submit_par_bar" id="save-bar">
                    <input role="button" type="submit" class="btn btn-primary" value="Submit" name="save_par_bar"
                           id="submit-bar">
                </div>
                <div class="col-md-12 text-center">
                    <small class="mr-2" style="color:#999"> *You can save at any time and complete the form later.</small>
                </div>
            </form>
        </div>
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

                      <li style="color: red"><h5>Barries prioritizing:</h5></li>

                      <p>You need to prioritize your barriers at this step.</p>
        </div>   
    </div>
</div>