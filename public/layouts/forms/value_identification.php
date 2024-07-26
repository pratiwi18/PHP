<?php
global $session;
// Loading a participant based on participant session
$participantid = $session->participantid;

$vis = valueIdentification::find_all();
// if there is any saved value identification find them
//$par_vis = participantVI::find_by_pid_saved($participantid);
$par_vis = participantVI::find_by_pid_latest($participantid); // kiendt
if (!empty($par_vis)) {
    $par_vis = explode(",", $par_vis->vi_ids);
    $temp_vis = array();

    foreach ($par_vis as $par_vi) {
        array_push($temp_vis, valueIdentification::find_by_id($par_vi));
    }
    foreach ($vis as $vi) {
        if (in_array($vi->vi_id, $par_vis, TRUE)) {

        } else {
            array_push($temp_vis, $vi);
        }
    }
    $vis = $temp_vis;
}
//var_dump($vis);
?>
<style>
     
      li a{
        color: darkgray;
        margin: 0; 
        float: left;
        font-size: 16px;
        font-weight: bold;
        }
</style>
    
<div class= "col-md-12 row">
        <div class="col col-md-12 text-center">
          <h5>Your current step--Getting to know you: Value Identification 1/1</h5>
          <hr/> 
      </div>
  
      <div class="col-md-8 order-md-1 mb-5"  role="tablist">

<div class="text-center" role="alert" id="error">
    <!-- error will be shown here ! -->
</div>
<div class="row mb-3">
    <div class="col-md-12 text-left">

        <p> People may consider these values when making decisions that impact their future life and/or their current
            situation.
            Please read the following list carefully and rank in order (from most important to least important) the top
            5 values that you believe
            relate the most to your current situation. You can drag each item you want and drop in the yellow area. Also
            you can drag each item from yellow area and drop it in the other section for removing. </p>
    </div>
    <div class="col-md-1 text-center">
        <ul id="vi-numbers">
            <li class="ui-state-default ui-state-disabled"> </li>
            <li class="ui-state-default ui-state-disabled"> 1</li>
            <li class="ui-state-default ui-state-disabled"> 2</li>
            <li class="ui-state-default ui-state-disabled"> 3</li>
            <li class="ui-state-default ui-state-disabled"> 4</li>
            <li class="ui-state-default ui-state-disabled"> 5</li>
        </ul>
    </div>
    <div class="col-md-11 text-left">
        <ul id="vi-list-1" class="connectedSortable" style="margin:0">
            Please grab from list below and drop here.
            <?php
            $vi_counter = 1;
            if (!empty($par_vis)) {
                foreach ($vis as $vi) {
                    ?>
                    <li class="vi-li-1 form-check ui-state-default">
                        <label class="form-check-label">
                            <input class="form-check-input" type="hidden" name="viId[]" id="viId"
                                   value="<?php echo $vi->vi_id; ?>">
                            <?php echo $vi->vi_desc; ?>
                        </label>
                    </li>
                    <?php
                    $delete = array_shift($vis);
                    if ($vi_counter >= 5) {
                        break;
                    }
                    $vi_counter++;
                }
            } ?>

        </ul>
    </div>
    <div class="col-md-12 text-left">

        <ul id="vi-list-2" class="connectedSortable" style="margin:0">
            <?php
            foreach ($vis as $vi) {
                ?>
                <li class="vi-li-2 form-check ui-state-default">
                    <label class="form-check-label">
                        <input class="form-check-input" type="hidden" name="viId[]" id="viId"
                               value="<?php echo $vi->vi_id; ?>">
                        <?php echo $vi->vi_desc; ?>
                    </label>
                </li>
                <?php
            } ?>

        </ul>
    </div>
    <div class="col-md-12 text-center">
        <input role="button" type="submit" class="btn btn-primary float-right" value="Submit" name="gtky-submission"
               id="gtky-submission">
        <input role="button" type="button" class="value-btn btn btn-success mr-2 float-right" value="Save">
        <input role="button" type="submit" value="Save" id="value-save" name="saving-gtky" style="display: none">
        <small class="mr-2 float-right" style="color:#999"> *You can save at any time and complete the form later.
        </small>
        <a href="index_participant.php?cps=baseline_oh" class="btn btn-secondary float-left">Previous</a>
    </div>
</div>
<div class="col-md-12 text-left">
    <small style="color:#999"> 11/</small>
</div>
  </div>
          <div class="col-md-4 order-md-2" > 
          <div class="">
            <ul class="align-self-left">
                <li><a href="/coach_assistant/public/index_participant.php?cps=soc12">Stage of Change</a></li> 
                <li><a href="/coach_assistant/public/index_participant.php?cps=impair">Impairments</a></li> 
                <li><a href="/coach_assistant/public/index_participant.php?cps=baseline">Baseline</a></li>
                <li><a href="/coach_assistant/public/index_participant.php?cps=value">Value Identification</a></li> 
            </ul>
        </div>
    
            <div class="media">
                <div class="media-body align-self-center ml-3">
                    <h3 class="">Coaching path</h3>
                </div>
                <img class="align-self-center mr-3" src="images/coaching-path.png"
                     alt="Generic placeholder image">
            </div>
         <hr/>
        <div >

                      <li style="color: red"><h5>Value identification:</h5></li>

                      <p>This section allows you to indicate which of the following statements relate to values that may identify as being important to you. </p>
        </div>   
    </div>
</div>

<script type="text/javascript">
    $(".value-btn").click(function () {
        $("#cps").val("value");
        $("#value-save").click();
    })
</script>