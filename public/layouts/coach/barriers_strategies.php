<?php
global $session;
global $database;
// Loading a participant based on participant session
$participantid = $_GET['pid'];
# Impairment list for a participant
//$participantIMPs = participantIMP::find_by_pid($participantid);
# current stage for a participant
//$participantSOC = participantSOC::find_by_pid($participantid);

# If there is a save barriers bring it on
$participantBARS = participantBAR::find_by_pid($participantid);

$bar_ids = array();
$sql = "SELECT * FROM participant_barrier WHERE participantid={$participantid}";// AND bmid={$bmid}";
$result_set = $database->query($sql);
while ($row = $database->fetch_array($result_set)) {
  array_push($bar_ids, $row);
}

if (!empty($bar_ids)) {
  if (!empty($participantBARS)) {
    usort($participantBARS, function ($a, $b) {
      return strcmp($a->bar_prority, $b->bar_prority);
    });

    $barriers = array();
    foreach ($participantBARS as $bar) {
      array_push($barriers, barriers::find_by_id($bar->bar_id));
    }
  }
}
        
#### Barrier section
#Making sure participant has select impairments/
/*if (!empty($participantIMPs)) {
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
}*/
# Barrier list for a participant
?>
<hr>
<div class="text-center" role="alert" id="error">
    <!-- error will be shown here ! -->
</div>
<div class="row mb-3">
    <div class="col-md-12 text-center">
        <h4>Barriers</h4>
        <h5 class="mb-3 text-left"> Please reorder barriers in the list below using the mouse (Top one has the highest
            priority) </h5>
    </div>
    <form method="post" action="/coach_assistant/controller/update_data.php">
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
            <?php if($_GET['paction']=='update') { ?>
                <a class="btn btn-danger" href="<?php echo ROOT_DIR."?pageid=participant&paction=update&pid=".$participantid?>">Cancel</a>
   			        <input class="btn btn-primary" role="button" type="submit" value="Update" name="go_update_bar" id="go_update_bar" >
            <?php } ?>
            <!--input role="button" type="submit" class="btn btn-success" value="Save" name="submit_par_bar" id="save-bar">
            <input role="button" type="submit" class="btn btn-primary" value="Submit" name="save_par_bar"
                   id="submit-bar"-->
        </div>
    </form>
</div>