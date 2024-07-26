<?php
global $gq_results;
$key_type = array_search(1, $gq_results);
$t1_questions = $gq_results[$key_type + 2];

//print_r($t1_questions);
?>

<?php
# Description about the form
echo "<p> <h5>" . $gq_results[$key_type + 1] . "</h5></p>";

$decode = json_decode($par_answer, true);

foreach ($t1_questions as $t1_q_id => $t1_q) {
    ?>
    <div class="form-row">
        <div class="form-group col-md-10">
            <div class="form-check">
                <label class="col-form-label">
                    <?php echo $t1_q; ?>
                 
            </div>
        </div>
        <div class="form-group col-md-1">
            <div class="form-check">
                <label class="col-form-label">
                    <input class="form-check-input" type="radio" name="<?php echo $t1_q_id; ?>" id="" value="1"
                        <?php echo isset($decode[$t1_q_id]) ? ($decode[$t1_q_id] == "1" ? "checked" : "") : ""; ?>>
                    Yes
                </label>
            </div>
        </div>
        <div class="form-group col-md-1">
            <div class="form-check">
                <label class="col-form-label">
                    <input class="form-check-input" type="radio" name="<?php echo $t1_q_id; ?>" id="" value="0"
                        <?php echo isset($decode[$t1_q_id]) ? ($decode[$t1_q_id] == "0" ? "checked" : "") : ""; ?>>
                    No
                </label>
            </div>
        </div>
    </div>
    <?php
}
?>