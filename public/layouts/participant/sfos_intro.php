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
global $con;

$stra_type = strategy::find_by_id_NSS($stra_bar->stra_id);
//echo var_dump($stra_type);

if ($stra_type) {
    $result = mysqli_query($con, "SELECT s.* FROM sfos `s` JOIN sfos_mapping `sm` ON s.sfos_id = sm.sfos_id WHERE stra_id = '$stra_bar->stra_id';");
    $num_rows_exist = mysqli_num_rows($result);
    if ($num_rows_exist > 0) {
        $sfos_id = "";
        $name = "";
        $desc = "";
        while ($row = mysqli_fetch_array($result)) {
            $sfos_id = $row[0];
            $name = $row[1];
            $desc = $row[2];
        }
    }
} else {
    $sql_insert = "INSERT INTO participant_strategy (participantid, submitted, reminder_count, `timestamp`, `status`) 
                VALUE ('$participantid', 0, 0, NOW(), 'current')";
    mysqli_query($con, $sql_insert) or die (mysqli_error($con));
    echo '<script>location.replace("/coach_assistant/public/index_participant.php");</script>';
}

// kien
// check if there is a record in database

$sql_sfos_check = mysqli_query($con, "SELECT * FROM participant_sfos WHERE participantid='$participantid' AND status='current' LIMIT 1")
or die("<p><span style=\"color: red;\">Unable to select table</span></p>");
$num_rows_sfos = mysqli_num_rows($sql_sfos_check);

$par_answer = "";
$par_sfos_id = "";
if ($num_rows_sfos > 0) {
    while ($row_answer = mysqli_fetch_array($sql_sfos_check, MYSQLI_NUM)) {
        $par_sfos_id = $row_answer[0];
        $par_answer = $row_answer[3];
    }
}
$decode = json_decode($par_answer, true);

?>
    <div class="row text-center">
        <div class="col col-md-12">
            <h4>SFOS</h4>
        </div>
    </div>
    <form id="gs_form" method="post" action="/coach_assistant/controller/sfos_process.php">
        <?php
        # Description about the form
        echo "<h5>" . $name . "</h5>";
        echo $desc;

        $result_question = mysqli_query($con, "SELECT * FROM sfos_question WHERE sfos_id = '$sfos_id';");
        while ($questions = mysqli_fetch_array($result_question)) {
            ?>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <div class="form-check">
                        <label class="col-form-label">
                            <?php echo $questions[2]; // question text ?>
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <div class="form-check">
                <textarea class="form-control" name="<?php echo $questions[0]; // question id ?>"
                          rows="2"><?php echo isset($decode[$questions[0]]) ? $decode[$questions[0]] : ""; ?></textarea>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <input type="hidden" name="par_sfos_id" id="par_sfos_id" value="<?php echo $par_sfos_id ?>"/>
        <input type="hidden" name="sfos_id" id="sfos_id" value="<?php echo $sfos_id ?>"/>
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
            <input role="button" type="submit" class="btn btn-success" value="Save" name="save_sfos"
                   id="save-goal">
            <input role="button" type="submit" class="btn btn-primary" value="Submit" name="submit_sfos"
                   id="submit-goal">
        </div>
        <div class="col-md-12 text-center">
            <small class="mr-2" style="color:#999"> *You can save at any time and complete the form later.</small>
        </div>
    </form>

<?php
/*if (isset ($_POST['previous'])) {
    $_SESSION['current_step'] = "goal";
    echo '<script>location.replace("/coach_assistant/public/index_participant.php");</script>';
}*/
?>