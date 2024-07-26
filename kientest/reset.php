<?php
require_once "dbconnect.php";

$msg = "";

$email = "";
if (isset($_POST["email"]) & !empty($_POST["email"]))
    $email = $_POST["email"];

if (isset($_POST["submitbtn"])) {
    //echo "start<br/>";
    $result = mysqli_query($con, "SELECT * FROM participant WHERE email = '$email' LIMIT 1")
    or die("<p><span style=\"color: red;\">Unable to select table</span></p>");
    $num_rows_exist = mysqli_num_rows($result);

    //echo "num: $num_rows_exist <br/>";
    if ($num_rows_exist > 0) {
        $pid = "";
        while ($row = mysqli_fetch_array($result)) {
            $pid = $row[0];
        }

        $con->autocommit(FALSE);
        mysqli_begin_transaction($con);
        if (isset($_POST['pwd']) & !empty($_POST["pwd"])) {
            $cpassword = password_hash($_POST['pwd'], PASSWORD_BCRYPT);
            //echo "cpass: $cpassword<br/>";
            $str_query = "UPDATE participant SET password = '$cpassword' WHERE participantid='$pid'";
            $con->query($str_query);
            //echo "query: $str_query";
        }

        if (isset($_POST['ck_soc'])) {
            $con->query("DELETE FROM stage_of_change WHERE participantid='$pid'");
        }
        if (isset($_POST['ck_impairment'])) {
            $con->query("DELETE FROM participant_impairments WHERE participantid='$pid'");
        }
        if (isset($_POST['ck_baseline'])) {
            $con->query("DELETE FROM baseline_screening_form WHERE participantid='$pid'");
        }
        if (isset($_POST['ck_value'])) {
            $con->query("DELETE FROM participant_value_identification WHERE participantid='$pid'");
        }

        if (isset($_POST['ck_barriers'])) {
            $con->query("DELETE FROM participant_barrier WHERE participantid='$pid'");
        }
        if (isset($_POST['ck_strategies'])) {
            $con->query("DELETE FROM participant_strategy WHERE participantid='$pid'");
        }
        if (isset($_POST['ck_goal'])) {
            $con->query("DELETE FROM participant_goal WHERE participantid='$pid'");
        }
        if (isset($_POST['ck_sfos'])) {
            $con->query("DELETE FROM participant_sfos WHERE participantid='$pid'");
        }
        if (isset($_POST['ck_confident'])) {
            $con->query("DELETE FROM participant_confident WHERE participantid='$pid'");
        }

        /* commit transaction */
        if (!$con->commit()) {
            $msg = "<p><span style=\"color: red;\">Transaction commit failed</span></p>";
            //exit();
        } else {
            $msg = "<p><span style=\"color: red;\">User has been reset.</span></p>";
        }
        $con->close();


        // Getting to know you
        //$sql_soc = "DELETE FROM stage_of_change WHERE participantid='$pid'";
        //$sql_impairment = "DELETE FROM participant_impairments WHERE participantid='$pid'";
        //$sql_baseline = "DELETE FROM baseline_screening_form WHERE participantid='$pid'";
        //$sql_value = "DELETE FROM participant_value_identification WHERE participantid='$pid'";

        // barriers
        //$sql_barriers = "DELETE FROM participant_barrier WHERE participantid='$pid'";
        // strategies
        //$sql_strategies = "DELETE FROM participant_strategy WHERE participantid='$pid'";
        // goal_setting
        //$sql_goal = "DELETE FROM participant_goal WHERE participantid='$pid'";
        // sfos
        // $sql_sfos = "DELETE FROM participant_goal WHERE participantid='$pid'";
    }
}
?>
<html>
<head>
    <title>Reset account</title>
</head>
<body>
<form method="post">
    <h1>Reset account</h1>
    <h3>Please check what you want to reset</h3>

    <?php echo $msg; ?>

    Email: <input type="text" name="email" value="<?php echo $email ?>"/><br/>
    Change password: <input type="text" name="pwd" autocomplete="off"/><br/>
    <strong>Getting to know you</strong><br/>
    <label><input type="checkbox" name="ck_soc" value="yes"/> Stage_of_change</label><br/>
    <label><input type="checkbox" name="ck_impairment" value="yes"/> impairments</label><br/>
    <label><input type="checkbox" name="ck_baseline" value="yes"/> baseline_screening_form</label><br/>
    <label><input type="checkbox" name="ck_value" value="yes"/> value_identification</label><br/><br/>

    <strong>barriers</strong><br/>
    <label><input type="checkbox" name="ck_barriers" value="yes"/> barriers</label><br/><br/>

    <strong>strategies</strong><br/>
    <label><input type="checkbox" name="ck_strategies" value="yes"/> strategies</label><br/>

    <strong>goal</strong><br/>
    <label><input type="checkbox" name="ck_goal" value="yes"/> goal</label><br/><br/>

    <strong>sfos</strong><br/>
    <label><input type="checkbox" name="ck_sfos" value="yes"/> sfos</label><br/><br/>

    <strong>confident</strong><br/>
    <label><input type="checkbox" name="ck_confident" value="yes"/> confident</label><br/><br/>

    <input type="submit" value="Submit" name="submitbtn"/>
</form>
</body>
</html>
