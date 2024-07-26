<?php
global $database;
global $gq_results;
global $session;

$key_type = array_search(6, $gq_results);

$info_array = array(
    "Convenience/ small grocery store" => "convenience_store",
    "Fruit/vegetable store" => "fruit_store",
    "Clothing store" => "clothing_store",
    "Post office" => "post_office",
    "Library" => "library",
    "Fast food restaurant" => "fastfood_restaurant",
    "Coffee shop" => "coffee_shop",
    "Bank" => "bank",
    "Pharmacy" => "pharmacy",
    "Bus stop" => "bus_shop",
    "Park" => "park",
    "Recreation Centre" => "recreation_centre",
    "Gym or fitness facility" => "gym_facility",
    "Pool" => "pool"
);

?>

<?php
# Description about the form
echo "<p> <h5>" . $gq_results[$key_type + 1] . "</h5></p>";

$decode = json_decode($par_answer, true);
?>
<p>
    How long would it take to get from your home to the nearest:
</p>

<table class="table table-bordered text-center">
    <thead>
    <tr>
        <th class="text-center" scope="col">1-5 mins</th>
        <th class="text-center" scope="col">6-10 mins</th>
        <th class="text-center" scope="col">11-20 mins</th>
        <th class="text-center" scope="col">21-30 mins</th>
        <th class="text-center" scope="col">31+mins</th>
        <th class="text-center" scope="col">Don't know</th>
        <th class="text-center" scope="col"></th>
        <th class="text-center" scope="col" colspan="2">Would you feel safe walking there?</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($info_array as $title => $variable_name) {

        ?>
        <tr>
            <td>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="<?php echo $variable_name ?>_distance" id=""
                           value="1-5 mins"
                        <?php echo isset($decode[$variable_name . "_distance"]) ? ($decode[$variable_name . "_distance"] == "1-5 mins" ? "checked" : "") : ""; ?>>
                </div>
            </td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="<?php echo $variable_name ?>_distance" id=""
                           value="6-10 mins"
                        <?php echo isset($decode[$variable_name . "_distance"]) ? ($decode[$variable_name . "_distance"] == "6-10 mins" ? "checked" : "") : ""; ?>>
                </div>
            </td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="<?php echo $variable_name ?>_distance" id=""
                           value="11-20 mins"
                        <?php echo isset($decode[$variable_name . "_distance"]) ? ($decode[$variable_name . "_distance"] == "11-20 mins" ? "checked" : "") : ""; ?>>
                </div>
            </td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="<?php echo $variable_name ?>_distance" id=""
                           value="21-30 mins"
                        <?php echo isset($decode[$variable_name . "_distance"]) ? ($decode[$variable_name . "_distance"] == "21-30 mins" ? "checked" : "") : ""; ?>>
                </div>
            </td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="<?php echo $variable_name ?>_distance" id=""
                           value="31+mins"
                        <?php echo isset($decode[$variable_name . "_distance"]) ? ($decode[$variable_name . "_distance"] == "31+mins" ? "checked" : "") : ""; ?>>
                </div>
            </td>
            <td>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="<?php echo $variable_name ?>_distance" id=""
                           value="Don't know"
                        <?php echo isset($decode[$variable_name . "_distance"]) ? ($decode[$variable_name . "_distance"] == "Don't know" ? "checked" : "") : ""; ?>>
                </div>
            </td>
            <td><?php echo $title ?></td>
            <td>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="<?php echo $variable_name ?>_safe" id=""
                               value="1"
                            <?php echo isset($decode[$variable_name . "_safe"]) ? ($decode[$variable_name . "_safe"] == "1" ? "checked" : "") : ""; ?>>
                        Y </label>
                </div>
            </td>
            <td>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="<?php echo $variable_name ?>_safe" id=""
                               value="0"
                            <?php echo isset($decode[$variable_name . "_safe"]) ? ($decode[$variable_name . "_safe"] == "0" ? "checked" : "") : ""; ?>>
                        N </label>
                </div>
            </td>
        </tr>
    <?php } ?>

    </tbody>
</table>