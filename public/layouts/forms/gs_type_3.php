<?php
global $gq_results;
global $gt_id;
$key_type = array_search(3, $gq_results);
$t3_questions = $gq_results[$key_type + 2];

//print_r($gq_results);
// templete id 13 = Personal Time Study Pain
// templete id 16 = Personal Time Study Fatigue
// templete id 19 = Personal Time Study Falling
if ($gt_id == 13 OR $gt_id == 16 OR $gt_id == 19) {
    $extra_column = true;
    switch ($gt_id) {
        case 13:
            $special_q = "What was your pain rating? 1= no pain; 5= high pain.";
            break;
        case 16:
            $special_q = "What was your fatigue rating? 1= no fatigue; 5= high fatigue.";
            break;
        case 19:
            $special_q = "What was your risk of falling? 1= no risk; 5= high risk.";
            break;
        default:
            $special_q = "";
    }
} else {
    $extra_column = false;
}

$extra_col_special = "special_";

?>
<?php 

$sql_act_cat = "SELECT * FROM activities_cat";
$result_set_act_cat = $database->query($sql_act_cat);
// This array contains the activities category and list 
$act_cat_list = array();
$act_det_list = array();
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
    array_push($act_det_list, $temp_act_list);
}
//var_dump($act_cat_list);
?>
<?php
# Description about the form
echo "<p> <h5>" . $gq_results[$key_type + 1] . "</h5></p>";

$decode = json_decode($par_answer, true);
?>

<table class="table table-bordered text-center" id="gs_form_table">
    <thead>
    <tr>
        <th class="text-center" scope="col" rowspan="2">Time Slot</th>
        <th class="text-center" scope="col" rowspan="2">Task/Activities</th>
        <th class="text-center" scope="col" colspan="2" rowspan='2'>Do you think you were active?</th>
        <?php if ($extra_column) {
            echo '<th class="text-center" scope="col" rowspan="2" >';
            echo $special_q;
            echo "</th>";
        } ?>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td colspan="2"></td>
        <td>Yes</td>
        <td>No</td>

    </tr>
    <tr>
        <td>Midnight to 4:00am</td>
        <td>
            
           <div class="form-check row">
               <select class="myactcat" id="act_cat_4am" name="act_cat_4am" onChange="getActDet(0)">;
                <option><?php echo isset($decode["act_cat_4am"]) ? ($decode["act_cat_4am"]): "Category First"; ?></option>
                <?php foreach($act_cat_list as $act_cat_elem) { ?>
                  <option value="<?php echo $act_cat_elem ?>"><?php echo $act_cat_elem ?></option>
                <?php } ?>
              </select>
               <select class="myactdet" name="mid_to_4am" id="mid_to_4am">
                 <option><?php echo isset($decode["mid_to_4am"]) ? ($decode["mid_to_4am"]): "Then activity"; ?></option>
               </select>
             <p>
               
             </p>
           </div>
        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="mid_to_4am_active" id="" value="1"
                    <?php echo isset($decode["mid_to_4am_active"]) ? ($decode["mid_to_4am_active"] == "1" ? "checked" : "") : ""; ?>>
            </div>
        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="mid_to_4am_active" id="" value="0"
                    <?php echo isset($decode["mid_to_4am_active"]) ? ($decode["mid_to_4am_active"] == "0" ? "checked" : "") : ""; ?>>
            </div>
        </td>
      
        <?php if ($extra_column) { ?>
            <th>
                <select class="form-control" name="<?php echo $extra_col_special . "mid_to_4am" ?>">
                    <option <?php echo isset($decode[$extra_col_special . "mid_to_4am"]) ?
                        ($decode[$extra_col_special . "mid_to_4am"] == "1" ? "selected" : "") : ""; ?>>
                        1
                    </option>
                    <option <?php echo isset($decode[$extra_col_special . "mid_to_4am"]) ?
                        ($decode[$extra_col_special . "mid_to_4am"] == "2" ? "selected" : "") : ""; ?>>
                        2
                    </option>
                    <option <?php echo isset($decode[$extra_col_special . "mid_to_4am"]) ?
                        ($decode[$extra_col_special . "mid_to_4am"] == "3" ? "selected" : "") : ""; ?>>
                        3
                    </option>
                    <option <?php echo isset($decode[$extra_col_special . "mid_to_4am"]) ?
                        ($decode[$extra_col_special . "mid_to_4am"] == "4" ? "selected" : "") : ""; ?>>
                        4
                    </option>
                    <option <?php echo isset($decode[$extra_col_special . "mid_to_4am"]) ?
                        ($decode[$extra_col_special . "mid_to_4am"] == "5" ? "selected" : "") : ""; ?>>
                        5
                    </option>
                </select>
            </th>
        <?php } ?>
    </tr>

    <tr>
        <td>4:01-6:00am</td>
        <td>
                          
           <div class="form-check row">
               <select class="myactcat" id="act_cat_6am" name="act_cat_6am" onChange="getActDet(1)">;
                  <option><?php echo isset($decode["act_cat_6am"]) ? ($decode["act_cat_6am"]): "Category First"; ?></option>
                              <?php foreach($act_cat_list as $act_cat_elem) { ?>
                  <option value="<?php echo $act_cat_elem ?>"><?php echo $act_cat_elem ?></option>
                <?php } ?>
              </select>
               <select class="myactdet" name="4am_to_6am" id="4am_to_6am">
                 <option><?php echo isset($decode["4am_to_6am"]) ? ($decode["4am_to_6am"]): "Then activity"; ?></option>
              </select>
           </div>        
            
        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="4am_to_6am_active" id="" value="1"
                    <?php echo isset($decode["4am_to_6am_active"]) ? ($decode["4am_to_6am_active"] == "1" ? "checked" : "") : ""; ?>>
            </div>
        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="4am_to_6am_active" id="" value="0"
                    <?php echo isset($decode["4am_to_6am_active"]) ? ($decode["4am_to_6am_active"] == "0" ? "checked" : "") : ""; ?>>
            </div>
        </td>
        <?php if ($extra_column) { ?>
            <th>
                <select class="form-control" name="<?php echo $extra_col_special . "4am_to_6am" ?>">
                    <option <?php echo isset($decode[$extra_col_special . "4am_to_6am"]) ?
                        ($decode[$extra_col_special . "4am_to_6am"] == "1" ? "selected" : "") : ""; ?>>1
                    </option>
                    <option <?php echo isset($decode[$extra_col_special . "4am_to_6am"]) ?
                        ($decode[$extra_col_special . "4am_to_6am"] == "2" ? "selected" : "") : ""; ?>>2</option>
                    <option <?php echo isset($decode[$extra_col_special . "4am_to_6am"]) ?
                        ($decode[$extra_col_special . "4am_to_6am"] == "3" ? "selected" : "") : ""; ?>>3</option>
                    <option <?php echo isset($decode[$extra_col_special . "4am_to_6am"]) ?
                        ($decode[$extra_col_special . "4am_to_6am"] == "4" ? "selected" : "") : ""; ?>>4</option>
                    <option <?php echo isset($decode[$extra_col_special . "4am_to_6am"]) ?
                        ($decode[$extra_col_special . "4am_to_6am"] == "5" ? "selected" : "") : ""; ?>>5</option>
                </select>
            </th>
        <?php } ?>
    </tr>

    <tr>
        <td>6:01-8:00am</td>
        <td>
           <div class="form-check row">
               <select class="myactcat" id="act_cat_8am" name="act_cat_8am" onChange="getActDet(2)">;
                  <option><?php echo isset($decode["act_cat_8am"]) ? ($decode["act_cat_8am"]): "Category First"; ?></option>
                <?php foreach($act_cat_list as $act_cat_elem) { ?>
                  <option value="<?php echo $act_cat_elem ?>"><?php echo $act_cat_elem ?></option>
                <?php } ?>
              </select>
               <select class="myactdet" name="6am_to_8am" id="6am_to_8am">
                 <option><?php echo isset($decode["6am_to_8am"]) ? ($decode["6am_to_8am"]): "Then activity"; ?></option>
               </select>
           </div>        
                      
        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="6am_to_8am_active" id="" value="1"
                    <?php echo isset($decode["6am_to_8am_active"]) ? ($decode["6am_to_8am_active"] == "1" ? "checked" : "") : ""; ?>>
            </div>
        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="6am_to_8am_active" id="" value="0"
                    <?php echo isset($decode["6am_to_8am_active"]) ? ($decode["6am_to_8am_active"] == "0" ? "checked" : "") : ""; ?>>
            </div>
        </td>
        <?php if ($extra_column) { ?>
            <th>
                <select class="form-control" name="<?php echo $extra_col_special . "6am_to_8am" ?>">
                    <option <?php echo isset($decode[$extra_col_special . "6am_to_8am"]) ?
                        ($decode[$extra_col_special . "6am_to_8am"] == "1" ? "selected" : "") : ""; ?>>1</option>
                    <option <?php echo isset($decode[$extra_col_special . "6am_to_8am"]) ?
                        ($decode[$extra_col_special . "6am_to_8am"] == "2" ? "selected" : "") : ""; ?>>2</option>
                    <option <?php echo isset($decode[$extra_col_special . "6am_to_8am"]) ?
                        ($decode[$extra_col_special . "6am_to_8am"] == "3" ? "selected" : "") : ""; ?>>3</option>
                    <option <?php echo isset($decode[$extra_col_special . "6am_to_8am"]) ?
                        ($decode[$extra_col_special . "6am_to_8am"] == "4" ? "selected" : "") : ""; ?>>4</option>
                    <option <?php echo isset($decode[$extra_col_special . "6am_to_8am"]) ?
                        ($decode[$extra_col_special . "6am_to_8am"] == "5" ? "selected" : "") : ""; ?>>5</option>
                </select>
            </th>
        <?php } ?>
    </tr>

    <tr>
        <td>8:01am-10:00am</td>
        <td>
            <div class="form-check row">
               <select class="myactcat" id="act_cat_10am" name="act_cat_10am" onChange="getActDet(3)">;
                  <option><?php echo isset($decode["act_cat_10am"]) ? ($decode["act_cat_10am"]): "Category First"; ?></option>
               <?php foreach($act_cat_list as $act_cat_elem) { ?>
                  <option value="<?php echo $act_cat_elem ?>"><?php echo $act_cat_elem ?></option>
                <?php } ?>
              </select>
               <select class="myactdet" name="8am_to_10am" id="8am_to_10am">
                   <option><?php echo isset($decode["8am_to_10am"]) ? ($decode["8am_to_10am"]): "Then activity"; ?></option>
                </select>
           </div>           
        
        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="8am_to_10am_active" id="" value="1"
                    <?php echo isset($decode["8am_to_10am_active"]) ? ($decode["8am_to_10am_active"] == "1" ? "checked" : "") : ""; ?>>
            </div>
        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="8am_to_10am_active" id="" value="0"
                    <?php echo isset($decode["8am_to_10am_active"]) ? ($decode["8am_to_10am_active"] == "0" ? "checked" : "") : ""; ?>>
            </div>
        </td>
        <?php if ($extra_column) { ?>
            <th>
                <select class="form-control" name="<?php echo $extra_col_special . "8am_to_10am" ?>">
                    <option <?php echo isset($decode[$extra_col_special . "8am_to_10am"]) ?
                        ($decode[$extra_col_special . "8am_to_10am"] == "1" ? "selected" : "") : ""; ?>>1</option>
                    <option <?php echo isset($decode[$extra_col_special . "8am_to_10am"]) ?
                        ($decode[$extra_col_special . "8am_to_10am"] == "2" ? "selected" : "") : ""; ?>>2</option>
                    <option <?php echo isset($decode[$extra_col_special . "8am_to_10am"]) ?
                        ($decode[$extra_col_special . "8am_to_10am"] == "3" ? "selected" : "") : ""; ?>>3</option>
                    <option <?php echo isset($decode[$extra_col_special . "8am_to_10am"]) ?
                        ($decode[$extra_col_special . "8am_to_10am"] == "4" ? "selected" : "") : ""; ?>>4</option>
                    <option <?php echo isset($decode[$extra_col_special . "8am_to_10am"]) ?
                        ($decode[$extra_col_special . "8am_to_10am"] == "5" ? "selected" : "") : ""; ?>>5</option>
                </select>
            </th>
        <?php } ?>
    </tr>

    <tr>
        <td>10:01am-12:00pm</td>
        <td>
           <div class="form-check row">
               <select class="myactcat" id="act_cat_12pm" name="act_cat_12pm" onChange="getActDet(4)">;
                  <option><?php echo isset($decode["act_cat_12pm"]) ? ($decode["act_cat_12pm"]): "Category First"; ?></option>
                <?php foreach($act_cat_list as $act_cat_elem) { ?>
                  <option value="<?php echo $act_cat_elem ?>"><?php echo $act_cat_elem ?></option>
                <?php } ?>
              </select>
               <select class="myactdet" name="10am_to_12pm" id="10am_to_12pm">
                  <option><?php echo isset($decode["10am_to_12pm"]) ? ($decode["10am_to_12pm"]): "Then activity"; ?></option>
                </select>
           </div>            

        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="10am_to_12pm_active" id="" value="1"
                    <?php echo isset($decode["10am_to_12pm_active"]) ? ($decode["10am_to_12pm_active"] == "1" ? "checked" : "") : ""; ?>>
            </div>
        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="10am_to_12pm_active" id="" value="0"
                    <?php echo isset($decode["10am_to_12pm_active"]) ? ($decode["10am_to_12pm_active"] == "0" ? "checked" : "") : ""; ?>>
            </div>
        </td>
        <?php if ($extra_column) { ?>
            <th>
                <select class="form-control" name="<?php echo $extra_col_special . "10am_to_12pm" ?>">
                    <option <?php echo isset($decode[$extra_col_special . "10am_to_12pm"]) ?
                        ($decode[$extra_col_special . "10am_to_12pm"] == "1" ? "selected" : "") : ""; ?>>1</option>
                    <option <?php echo isset($decode[$extra_col_special . "10am_to_12pm"]) ?
                        ($decode[$extra_col_special . "10am_to_12pm"] == "2" ? "selected" : "") : ""; ?>>2</option>
                    <option <?php echo isset($decode[$extra_col_special . "10am_to_12pm"]) ?
                        ($decode[$extra_col_special . "10am_to_12pm"] == "3" ? "selected" : "") : ""; ?>>3</option>
                    <option <?php echo isset($decode[$extra_col_special . "10am_to_12pm"]) ?
                        ($decode[$extra_col_special . "10am_to_12pm"] == "4" ? "selected" : "") : ""; ?>>4</option>
                    <option <?php echo isset($decode[$extra_col_special . "10am_to_12pm"]) ?
                        ($decode[$extra_col_special . "10am_to_12pm"] == "5" ? "selected" : "") : ""; ?>>5</option>
                </select>
            </th>
        <?php } ?>
    </tr>

    <tr>
        <td>12:01pm-2:00pm</td>
        <td>
            <div class="form-check row">
               <select class="myactcat" id="act_cat_2pm" name="act_cat_2pm" onChange="getActDet(5)">;
                  <option><?php echo isset($decode["act_cat_2pm"]) ? ($decode["act_cat_2pm"]): "Category First"; ?></option>
                <?php foreach($act_cat_list as $act_cat_elem) { ?>
                  <option value="<?php echo $act_cat_elem ?>"><?php echo $act_cat_elem ?></option>
                <?php } ?>
              </select>
               <select class="myactdet" name="12pm_to_2pm" id="12pm_to_2pm">
                   <option><?php echo isset($decode["12pm_to_2pm"]) ? ($decode["12pm_to_2pm"]): "Then activity"; ?></option>
               </select>
           </div>
        </td>
      
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="12pm_to_2pm_active" id="" value="1"
                    <?php echo isset($decode["12pm_to_2pm_active"]) ? ($decode["12pm_to_2pm_active"] == "1" ? "checked" : "") : ""; ?>>
            </div>
        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="12pm_to_2pm_active" id="" value="0"
                    <?php echo isset($decode["12pm_to_2pm_active"]) ? ($decode["12pm_to_2pm_active"] == "0" ? "checked" : "") : ""; ?>>
            </div>
        </td>
        <?php if ($extra_column) { ?>
            <th>
                <select class="form-control" name="<?php echo $extra_col_special . "12pm_to_2pm" ?>">
                    <option <?php echo isset($decode[$extra_col_special . "12pm_to_2pm"]) ?
                        ($decode[$extra_col_special . "12pm_to_2pm"] == "1" ? "selected" : "") : ""; ?>>1</option>
                    <option <?php echo isset($decode[$extra_col_special . "12pm_to_2pm"]) ?
                        ($decode[$extra_col_special . "12pm_to_2pm"] == "2" ? "selected" : "") : ""; ?>>2</option>
                    <option <?php echo isset($decode[$extra_col_special . "12pm_to_2pm"]) ?
                        ($decode[$extra_col_special . "12pm_to_2pm"] == "3" ? "selected" : "") : ""; ?>>3</option>
                    <option <?php echo isset($decode[$extra_col_special . "12pm_to_2pm"]) ?
                        ($decode[$extra_col_special . "12pm_to_2pm"] == "4" ? "selected" : "") : ""; ?>>4</option>
                    <option <?php echo isset($decode[$extra_col_special . "12pm_to_2pm"]) ?
                        ($decode[$extra_col_special . "12pm_to_2pm"] == "5" ? "selected" : "") : ""; ?>>5</option>
                </select>
            </th>
        <?php } ?>
    </tr>

    <tr>
        <td>2:01pm-4:00pm</td>
        <td>
           
           <div class="form-check row">
               <select class="myactcat" id="act_cat_4pm" name="act_cat_4pm" onChange="getActDet(6)">;
                   <option><?php echo isset($decode["act_cat_4pm"]) ? ($decode["act_cat_4pm"]): "Category First"; ?></option>
                <?php foreach($act_cat_list as $act_cat_elem) { ?>
                  <option value="<?php echo $act_cat_elem ?>"><?php echo $act_cat_elem ?></option>
                <?php } ?>
              </select>
               <select class="myactdet" name="2pm_to_4pm" id="2pm_to_4pm">
                   <option><?php echo isset($decode["2pm_to_4pm"]) ? ($decode["2pm_to_4pm"]): "Then activity"; ?></option>
               </select>
           </div>
           
        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="2pm_to_4pm_active" id="" value="1"
                    <?php echo isset($decode["2pm_to_4pm_active"]) ? ($decode["2pm_to_4pm_active"] == "1" ? "checked" : "") : ""; ?>>
            </div>
        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="2pm_to_4pm_active" id="" value="0"
                    <?php echo isset($decode["2pm_to_4pm_active"]) ? ($decode["2pm_to_4pm_active"] == "0" ? "checked" : "") : ""; ?>>
            </div>
        </td>
        <?php if ($extra_column) { ?>
            <th>
                <select class="form-control" name="<?php echo $extra_col_special . "2pm_to_4pm" ?>">
                    <option <?php echo isset($decode[$extra_col_special . "2pm_to_4pm"]) ?
                        ($decode[$extra_col_special . "2pm_to_4pm"] == "1" ? "selected" : "") : ""; ?>>1</option>
                    <option <?php echo isset($decode[$extra_col_special . "2pm_to_4pm"]) ?
                        ($decode[$extra_col_special . "2pm_to_4pm"] == "2" ? "selected" : "") : ""; ?>>2</option>
                    <option <?php echo isset($decode[$extra_col_special . "2pm_to_4pm"]) ?
                        ($decode[$extra_col_special . "2pm_to_4pm"] == "3" ? "selected" : "") : ""; ?>>3</option>
                    <option <?php echo isset($decode[$extra_col_special . "2pm_to_4pm"]) ?
                        ($decode[$extra_col_special . "2pm_to_4pm"] == "4" ? "selected" : "") : ""; ?>>4</option>
                    <option <?php echo isset($decode[$extra_col_special . "2pm_to_4pm"]) ?
                        ($decode[$extra_col_special . "2pm_to_4pm"] == "5" ? "selected" : "") : ""; ?>>5</option>
                </select>
            </th>
        <?php } ?>
    </tr>

    <tr>
        <td>4:01pm-6:00pm</td>
        <td>
           <div class="form-check row">
               <select class="myactcat" id="act_cat_6pm" name="act_cat_6pm" onChange="getActDet(7)">;
                   <option><?php echo isset($decode["act_cat_6pm"]) ? ($decode["act_cat_6pm"]): "Category First"; ?></option>
               <?php foreach($act_cat_list as $act_cat_elem) { ?>
                  <option <?php echo isset($decode["act_cat_6pm"]) ? $decode["act_cat_6pm"] : ""; ?> value="<?php echo $act_cat_elem ?>"><?php echo $act_cat_elem ?></option>
                <?php } ?>
              </select>
               <select class="myactdet" name="4pm_to_6pm" id="4pm_to_6pm">
                 <option <?php echo isset($decode["4pm_to_6pm"]) ? $decode["4pm_to_6pm"] : ""; ?> value>Then activity</option>
               </select>
           </div>            

        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="4pm_to_6pm_active" id="" value="1"
                    <?php echo isset($decode["4pm_to_6pm_active"]) ? ($decode["4pm_to_6pm_active"] == "1" ? "checked" : "") : ""; ?>>
            </div>
        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="4pm_to_6pm_active" id="" value="0"
                    <?php echo isset($decode["4pm_to_6pm_active"]) ? ($decode["4pm_to_6pm_active"] == "0" ? "checked" : "") : ""; ?>>
            </div>
        </td>
        <?php if ($extra_column) { ?>
            <th>
                <select class="form-control" name="<?php echo $extra_col_special . "4pm_to_6pm" ?>">
                    <option <?php echo isset($decode[$extra_col_special . "4pm_to_6pm"]) ?
                        ($decode[$extra_col_special . "4pm_to_6pm"] == "1" ? "selected" : "") : ""; ?>>1</option>
                    <option <?php echo isset($decode[$extra_col_special . "4pm_to_6pm"]) ?
                        ($decode[$extra_col_special . "4pm_to_6pm"] == "2" ? "selected" : "") : ""; ?>>2</option>
                    <option <?php echo isset($decode[$extra_col_special . "4pm_to_6pm"]) ?
                        ($decode[$extra_col_special . "4pm_to_6pm"] == "3" ? "selected" : "") : ""; ?>>3</option>
                    <option <?php echo isset($decode[$extra_col_special . "4pm_to_6pm"]) ?
                        ($decode[$extra_col_special . "4pm_to_6pm"] == "4" ? "selected" : "") : ""; ?>>4</option>
                    <option <?php echo isset($decode[$extra_col_special . "4pm_to_6pm"]) ?
                        ($decode[$extra_col_special . "4pm_to_6pm"] == "5" ? "selected" : "") : ""; ?>>5</option>
                </select>
            </th>
        <?php } ?>
    </tr>

    <tr>
        <td>6:01pm-8:00pm</td>
        <td>
            <div class="form-check">
               <select class="myactcat" id="act_cat_8pm" name="act_cat_8pm" onChange="getActDet(8)">;
                   <option><?php echo isset($decode["act_cat_8pm"]) ? ($decode["act_cat_8pm"]): "Category First"; ?></option>
                <?php foreach($act_cat_list as $act_cat_elem) { ?>
                  <option value="<?php echo $act_cat_elem ?>"><?php echo $act_cat_elem ?></option>
                <?php } ?>
              </select>
               <select class="myactdet" name="6pm_to_8pm" id="6pm_to_8pm">
                   <option><?php echo isset($decode["6pm_to_8pm"]) ? ($decode["6pm_to_8pm"]): "Then activity"; ?></option>
               </select>              

            </div>
        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="6pm_to_8pm_active" id="" value="1"
                    <?php echo isset($decode["6pm_to_8pm_active"]) ? ($decode["6pm_to_8pm_active"] == "1" ? "checked" : "") : ""; ?>>
            </div>
        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="6pm_to_8pm_active" id="" value="0"
                    <?php echo isset($decode["6pm_to_8pm_active"]) ? ($decode["6pm_to_8pm_active"] == "0" ? "checked" : "") : ""; ?>>
            </div>
        </td>
        <?php if ($extra_column) { ?>
            <th>
                <select class="form-control" name="<?php echo $extra_col_special . "6pm_to_8pm" ?>">
                    <option <?php echo isset($decode[$extra_col_special . "6pm_to_8pm"]) ?
                        ($decode[$extra_col_special . "6pm_to_8pm"] == "1" ? "selected" : "") : ""; ?>>1</option>
                    <option <?php echo isset($decode[$extra_col_special . "6pm_to_8pm"]) ?
                        ($decode[$extra_col_special . "6pm_to_8pm"] == "2" ? "selected" : "") : ""; ?>>2</option>
                    <option <?php echo isset($decode[$extra_col_special . "6pm_to_8pm"]) ?
                        ($decode[$extra_col_special . "6pm_to_8pm"] == "3" ? "selected" : "") : ""; ?>>3</option>
                    <option <?php echo isset($decode[$extra_col_special . "6pm_to_8pm"]) ?
                        ($decode[$extra_col_special . "6pm_to_8pm"] == "4" ? "selected" : "") : ""; ?>>4</option>
                    <option <?php echo isset($decode[$extra_col_special . "6pm_to_8pm"]) ?
                        ($decode[$extra_col_special . "6pm_to_8pm"] == "5" ? "selected" : "") : ""; ?>>5</option>
                </select>
            </th>
        <?php } ?>
    </tr>

    <tr>
        <td>8:01pm-10:00pm</td>
        <td>
            <div class="form-check">
               <select class="myactcat" id="act_cat_10pm" name="act_cat_10pm" onChange="getActDet(9)">;
                   <option><?php echo isset($decode["act_cat_10pm"]) ? ($decode["act_cat_10pm"]): "Category First"; ?></option>
                <?php foreach($act_cat_list as $act_cat_elem) { ?>
                  <option value="<?php echo $act_cat_elem ?>"><?php echo $act_cat_elem ?></option>
                <?php } ?>
              </select>
               <select class="myactdet" name="8pm_to_10pm" id="8pm_to_10pm">
                   <option><?php echo isset($decode["8pm_to_10pm"]) ? ($decode["8pm_to_10pm"]): "Then activity"; ?></option>
               </select>    
            </div>
        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="8pm_to_10pm_active" id="" value="1"
                    <?php echo isset($decode["8pm_to_10pm_active"]) ? ($decode["8pm_to_10pm_active"] == "1" ? "checked" : "") : ""; ?>>
            </div>
        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="8pm_to_10pm_active" id="" value="0"
                    <?php echo isset($decode["8pm_to_10pm_active"]) ? ($decode["8pm_to_10pm_active"] == "0" ? "checked" : "") : ""; ?>>
            </div>
        </td>
        <?php if ($extra_column) { ?>
            <th>
                <select class="form-control" name="<?php echo $extra_col_special . "8pm_to_10pm" ?>">
                    <option <?php echo isset($decode[$extra_col_special . "8pm_to_10pm"]) ?
                        ($decode[$extra_col_special . "8pm_to_10pm"] == "1" ? "selected" : "") : ""; ?>>1</option>
                    <option <?php echo isset($decode[$extra_col_special . "8pm_to_10pm"]) ?
                        ($decode[$extra_col_special . "8pm_to_10pm"] == "2" ? "selected" : "") : ""; ?>>2</option>
                    <option <?php echo isset($decode[$extra_col_special . "8pm_to_10pm"]) ?
                        ($decode[$extra_col_special . "8pm_to_10pm"] == "3" ? "selected" : "") : ""; ?>>3</option>
                    <option <?php echo isset($decode[$extra_col_special . "8pm_to_10pm"]) ?
                        ($decode[$extra_col_special . "8pm_to_10pm"] == "4" ? "selected" : "") : ""; ?>>4</option>
                    <option <?php echo isset($decode[$extra_col_special . "8pm_to_10pm"]) ?
                        ($decode[$extra_col_special . "8pm_to_10pm"] == "5" ? "selected" : "") : ""; ?>>5</option>
                </select>
            </th>
        <?php } ?>
    </tr>

    <tr>
        <td>10:01pm-12:00pm</td>
        <td>
            <div class="form-check">
                <select class="myactcat" id="act_cat_12pm" name="act_cat_12pm" onChange="getActDet(10)">;
                   <option><?php echo isset($decode["act_cat_12pm"]) ? ($decode["act_cat_12pm"]): "Category First"; ?></option>
                <?php foreach($act_cat_list as $act_cat_elem) { ?>
                  <option value="<?php echo $act_cat_elem ?>"><?php echo $act_cat_elem ?></option>
                <?php } ?>
              </select>
               <select class="myactdet" name="10pm_to_12pm" id="10pm_to_12pm">
                   <option><?php echo isset($decode["10pm_to_12pm"]) ? ($decode["10pm_to_12pm"]): "Then activity"; ?></option>
               </select>                
               
            </div>
        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="10pm_to_12pm_active" id="" value="1"
                    <?php echo isset($decode["10pm_to_12pm_active"]) ? ($decode["10pm_to_12pm_active"] == "1" ? "checked" : "") : ""; ?>>
            </div>
        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="10pm_to_12pm_active" id="" value="0"
                    <?php echo isset($decode["10pm_to_12pm_active"]) ? ($decode["10pm_to_12pm_active"] == "0" ? "checked" : "") : ""; ?>>
            </div>
        </td>
        <?php if ($extra_column) { ?>
            <th>
                <select class="form-control" name="<?php echo $extra_col_special . "10pm_to_12pm" ?>">
                    <option <?php echo isset($decode[$extra_col_special . "10pm_to_12pm"]) ?
                        ($decode[$extra_col_special . "10pm_to_12pm"] == "1" ? "selected" : "") : ""; ?>>1</option>
                    <option <?php echo isset($decode[$extra_col_special . "10pm_to_12pm"]) ?
                        ($decode[$extra_col_special . "10pm_to_12pm"] == "2" ? "selected" : "") : ""; ?>>2</option>
                    <option <?php echo isset($decode[$extra_col_special . "10pm_to_12pm"]) ?
                        ($decode[$extra_col_special . "10pm_to_12pm"] == "3" ? "selected" : "") : ""; ?>>3</option>
                    <option <?php echo isset($decode[$extra_col_special . "10pm_to_12pm"]) ?
                        ($decode[$extra_col_special . "10pm_to_12pm"] == "4" ? "selected" : "") : ""; ?>>4</option>
                    <option <?php echo isset($decode[$extra_col_special . "10pm_to_12pm"]) ?
                        ($decode[$extra_col_special . "10pm_to_12pm"] == "5" ? "selected" : "") : ""; ?>>5</option>
                </select>
            </th>
        <?php } ?>
    </tr>
    </tbody>
</table>

 <!--Dropdown List-->
<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
 <script language="JavaScript" type="text/javascript">
   //To define a 2-dimenstional array of activity details
   var aaact_det=[Object.values(<?php echo json_encode($act_det_list)?>)];//To convert php type value to javascript
   //console.log(aaact_det[0][5]);
   
   var aact_det=[];
   for(i=0;i<6;i++){
     aact_det.push(Object.values(aaact_det[0][i]));
     
   }
   //aact_det=[Object.values(aaact_det[0][0]),Object.values(aaact_det[0][1]),Object.values(aaact_det[0][2]),
     //     Object.values(aaact_det[0][3]),Object.values(aaact_det[0][4]),Object.values(aaact_det[0][5])];
   
   function getActDet(i){
     //To get the category of activities
     var sltact_cat=document.getElementsByClassName('myactcat')[i];
     console.log(sltact_cat);
     
     //To get details of selected activities
     var sltDet=document.getElementsByClassName('myactdet')[i];
     //console.log(sltDet);
     
     //To get the details for each category
     var act_catDet=aact_det[sltact_cat.selectedIndex - 1];
 
     //Clear the details box
     sltDet.length = 1;
 
     //To put the details of each category
     for(var i=0;i<act_catDet.length;i++){
       sltDet[i+1]=new Option(act_catDet[i],act_catDet[i]);
     }
   }
</script>
              
	