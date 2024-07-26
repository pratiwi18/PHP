<?php
global $database;
global $gq_results;

$key_type = array_search(4, $gq_results);

$sql_act_cat = "SELECT * FROM activities_cat ORDER BY act_cat_id";
$result_set_act_cat = $database->query($sql_act_cat);
// This array contains the activities category and list 
$act_cat_list = array();
while ($row_act_cat = $database->fetch_array($result_set_act_cat)) {
    $act_cat_id = $row_act_cat['act_cat_id'];
    $act_cat_desc = $row_act_cat['act_cat_desc'];
    array_push($act_cat_list, $act_cat_desc);
    //echo $act_cat_desc."<br>";
    $sql_act_list = "SELECT * FROM activities_list WHERE act_cat_id='{$act_cat_id}' ORDER BY act_id";
    $result_set_act_list = $database->query($sql_act_list);
    $temp_act_list = array();
    while ($row_act_list = $database->fetch_array($result_set_act_list)) {
        $temp_act_list["{$row_act_list['act_id']}"] = $row_act_list['act_desc'];
        //	echo $row_act_list['act_desc']."<br>";
    }
    array_push($act_cat_list, $temp_act_list);
//	echo "<hr>";
}
//print_r(count($act_cat_list));
?>
<?php
# Description about the form
echo "<p> <h5>" . $gq_results[$key_type + 1] . "</h5></p>";

$decode = json_decode($par_answer, true);

for ($counter = 0; $counter < count($act_cat_list) / 2; $counter++) {
    ?>
    <div class="card border-dark mt-3 mb-3">
        <div class="card-header"><h5><?php echo $act_cat_list[2 * $counter]; ?></h5></div>
        <div class="card-body text-dark">
            <p class="card-text"></p>
            <div class="row">
               
                <?php
                foreach ($act_cat_list[2 * $counter + 1] as $act_id => $act_list) {
                    ?>
                    <div class="form-check col-md-4">
                        <label class="form-check-label ">
                            <input class="form-check-input" type="checkbox" name="activities[]"
                                   value="<?php echo $act_id; ?>"
                                <?php echo isset($decode["activities"]) ? (in_array($act_id, $decode["activities"]) ? "checked" : "") : ""; ?>>
                      
                            <?php echo $act_list; ?>
                        </label>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}
?>
