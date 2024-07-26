<?php
require_once "../includes/db.inc.php";
global $session;
global $database;
// Loading a participant based on participant session
$participantid = $session->participantid;

global $soc_form;
global $par_bar;
global $stra_bar;
global $goal_setting;
global $sfos_bar;
global $con;

// check if there is a record in database

$sql_confident_check = mysqli_query($con, "SELECT * FROM participant_confident WHERE participantid='$participantid' AND status='current' LIMIT 1")
or die("<p><span style=\"color: red;\">Unable to select table</span></p>");
$num_rows_confident = mysqli_num_rows($sql_confident_check);

$par_answer = "";
$par_confident_id = "";
if ($num_rows_confident > 0) {
    while ($row_answer = mysqli_fetch_array($sql_confident_check, MYSQLI_NUM)) {
        $par_confident_id = $row_answer[0];
        $par_answer = $row_answer[5];
    }
}
$decode = json_decode($par_answer, true);

?>
<div class="col-md-12 row">
  
          <div class="col-md-8 order-md-1 mb-5 mt-5"  role="tablist">
 
<div class="row text-center">
    <div class="col col-md-12">
        <h4>Importance and Confidence rulers</h4>
    </div>
</div>

<form id="gs_form" method="post" action="/coach_assistant/controller/confident_process.php">
    <div class="form-row">
        <div class="form-group col-md-12">
            <div class="form-check">
                <label class="col-form-label">
                    <p>An important component of goal setting is to ensure that:</p>
                    <p><strong>1. That the goals that you set is achievable, in that, you are confident that you are
                            able to complete your goal.</strong></p>
                    <p>
                        On a scale of 1 to 10, one being not at all confident and 10 being extremely confident, how
                        confident are you that you are able to achieve your goal?
                    </p>
                    <input type="range" min="1" max="10" data-orientation="vertical" id="f-range" name="f-range"
                           value="<?php echo isset($decode["f-range"]) ? $decode["f-range"] : 5; ?>"
                           class="slider">
                    <p style="text-align: center">Value: <span id="f-value"><?php echo isset($decode["f-range"]) ? $decode["f-range"] : 5; ?></span></p>
                    <script>
                        $('document').ready(function () {
                            $('#f-range').on('input', function () {
                                $('#f-value').html(this.value);
                            });
                        });
                    </script>
                    <p><strong>
                            2. That the goal that you set relates to what is important to you. You are more likely to
                            achieve a goal if you believe that it is valuable.
                        </strong></p>
                    <p>Previously you identified the following values as important to you. On a scale of 1 to 10, with 1
                        being not at all relevant or important and 10 being very relevant and important, how much does
                        your
                        goal relate to your values?
                    </p>
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM participant_value_identification WHERE participantid='$participantid'");
                    $num_rows = mysqli_num_rows($result);
                    $vids = "";
                    if ($num_rows > 0) {
                        while ($row_vid = mysqli_fetch_array($result, MYSQLI_NUM)) {
                            $vids = $row_vid[1];
                        }
                    }

                    $vids = array_map('trim', explode(',', $vids));
                    $vids = "'" . implode("','", $vids) . "'";
                    ?>
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 60%;">Value Identification</th>
                            <th>Evaluation</th>
                        </tr>
                        <?php
                        $result_vid = mysqli_query($con, "SELECT * FROM value_identification WHERE vi_id IN ($vids)");
                        while ($value_id = mysqli_fetch_array($result_vid, MYSQLI_NUM)) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $value_id[1]; ?>
                                </td>
                                <td>
                                    <input type="range" min="1" max="10" data-orientation="vertical"
                                           id="<?php echo $value_id[0]."-range"; ?>" name="<?php echo $value_id[0]; ?>"
                                           value="<?php echo isset($decode[$value_id[0]]) ? $decode[$value_id[0]] : 5; ?>"
                                           class="slider">
                                    <div class="text-center">
                                        <span id="<?php echo $value_id[0]."-value"; ?>">
                                            <?php echo isset($decode[$value_id[0]]) ? $decode[$value_id[0]] : 5; ?>
                                        </span>
                                    </div>
                                    <script>
                                        $('document').ready(function () {
                                            $('#<?php echo $value_id[0]."-range"; ?>').on('input', function () {
                                                $('#<?php echo $value_id[0]."-value"; ?>').html(this.value);
                                            });
                                        });
                                    </script>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>

                </label>
            </div>
        </div>
    </div>
    <input type="hidden" name="par_confident_id" id="par_confident_id" value="<?php echo $par_confident_id; ?>"/>
    <input type="hidden" name="sfos_id" id="sfos_id" value="<?php echo $sfos_bar[2]; ?>"/>
    <input type="hidden" name="goal_template_id" id="goal_template_id" value="<?php echo $goal_setting[2]; ?>"/>
    <input type="hidden" name="stra_id" id="stra_id" value="<?php echo $stra_bar->stra_id ?>">

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
        <input role="button" type="submit" class="btn btn-success" value="Save" name="save_confident"
               id="save-confident">
        <input role="button" type="submit" class="btn btn-primary" value="Submit" name="submit_confident"
               id="submit-confident">
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
                      <li style="color: red"><h5>Importance and Confidence:</h5></li>
                      <p>You need to describe your confidence and identify the importance of your goals.</p>
                      <p>It will process to evaluation only if you have 100% confidence.</p>          
        </div>   
    </div>

      
</div>
<style>
    .slider {
        -webkit-appearance: none;
        width: 100%;
        height: 15px;
        border-radius: 5px;
        background: #d3d3d3;
        outline: none;
        opacity: 0.7;
        -webkit-transition: .2s;
        transition: opacity .2s;
    }

    .slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background: #4CAF50;
        cursor: pointer;
    }

    .slider::-moz-range-thumb {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background: #4CAF50;
        cursor: pointer;
    }
</style>