<?php
global $database;
global $gq_results;
#Getting the right type of question for type 5
$key_type = array_search(5, $gq_results);
$t5_questions = $gq_results[$key_type + 2];
foreach ($t5_questions as $t5_q_id => $t5_q) {
    $sql_t5_answers = "SELECT * FROM goal_template_possible_answers WHERE qid = {$t5_q_id} ORDER BY gtpa_id";
    $result_set_t5_answers = $database->query($sql_t5_answers);
    ?>
    <h5> <?php echo $t5_q; ?> kien</h5>
    <?php
    $decode = json_decode($par_answer, true);

    while ($row_t5_answers = $database->fetch_array($result_set_t5_answers)) {
        ?>
        <label class="col-form-label">
            <input type="checkbox" name="answers[]" value="<?php echo $row_t5_answers['gtpa_id']; ?>"
                <?php echo isset($decode["answers"]) ? (in_array($row_t5_answers['gtpa_id'], $decode["answers"]) ? "checked" : "") : ""; ?>>
            <?php echo $row_t5_answers['answer']; ?>
         
        </label>

        <?php
    }
}
//
?>