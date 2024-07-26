<?php
/**
 * Created by PhpStorm.
 * User: Kevin Dang
 * Date: 3/04/2018
 * Time: 11:44 PM
 */

// This my_autoloader2 is different with my_autoloader in kientest/index.php
function my_autoloader2($class) {
    if (file_exists('inc/' . $class . '.php')) {
        require_once 'inc/' . $class . '.php';
    }
    elseif (file_exists( 'lib/' . $class . '.php')) {
        require_once 'lib/' . $class . '.php';
    }
}

spl_autoload_register('my_autoloader2');

echo "start here";

echo ModelInc::show() . "<br/>";
echo ViewInc::show() . "<br/>";
echo ControllerInc::show() . "<br/>";

echo "<br/><br/><br/>";

echo Model::show() . "<br/>";
echo View::show() . "<br/>";
echo Controller::show() . "<br/><br/><br/>";


include('../includes/db.inc.php');

$result_exist = mysqli_query($con, "SELECT * FROM stage_of_change WHERE participantid = '62'");
$num_rows_exist = mysqli_num_rows($result_exist);
echo $num_rows_exist;