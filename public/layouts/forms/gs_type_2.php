<?php
global $gq_results;
$key_type = array_search(2, $gq_results);
$t2_questions = $gq_results[$key_type + 2];
//print_r($t1_questions);
?>
<?php
# Description about the form
echo "<p> <h5>" . $gq_results[$key_type + 1] . "</h5></p>";
$decode = json_decode($par_answer, true);
foreach ($t2_questions as $t2_q_id => $t2_q) {
    ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <div class="form-check">
                <label class="col-form-label">
                    <?php echo $t2_q; ?>
                </label>
            </div>
        </div>
        <div class="form-group col-md-12">
            <div class="form-check">
         
              <?php if( strpos($t2_q, 'How many') !== false): ?>     
                <select class="form-control" name="<?php echo $t2_q_id; ?>">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                </select>
              <?php else: ?>
                  <textarea class="form-control" name="< ?php echo $t2_q_id; ?>"
                          rows="2"><?php echo isset($decode[$t2_q_id]) ? $decode[$t2_q_id] : ""; ?></textarea>
              <?php endif ?>
            </div>
        </div>
    </div>
    <?php } ?>
