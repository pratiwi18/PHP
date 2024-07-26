<?php
include('db.inc.php');
require_once('stageOfChange.php');
require_once('participantBAR.php');
require_once('participantSTRA.php');

class path_generator
{
    public $soc_form_status;
    public $par_bar_status;
    public $stra_bar_status;
    public $goal_status;
    public $sfos_status;
    public $confident_status;

    public $soc_form;
    public $par_bar;
    public $stra_bar;
    public $goal_setting;
    public $sfos_bar;
    public $confident_bar;

    function __construct($participantid = 0)
    {
        $this->soc_form_status = $this->soc_status($participantid);
        if ($this->soc_form_status == false) {
            $this->par_bar_status = $this->par_bar_status($participantid);
            if ($this->par_bar_status == false) {
                $this->stra_bar_status = $this->stra_bar_status($participantid);
                if ($this->stra_bar_status == false) {
                    $this->goal_status = $this->goal_setting($participantid);
                    if ($this->goal_status == false) {
                        $this->sfos_status = $this->sfos_bar_status($participantid);
                        if ($this->sfos_status == false) {
                            $this->confident_status = $this->confident_status($participantid);
                        }
                    }
                }
            }
        }
    }

    public function soc_status($par_id = 0)
    {
        global $con;

        $result_exist = mysqli_query($con, "SELECT * FROM stage_of_change WHERE participantid = '$par_id'");
        $num_rows_exist = mysqli_num_rows($result_exist);
        if ($num_rows_exist < 1) return true;

        $result_current = mysqli_query($con, "SELECT * FROM stage_of_change WHERE participantid = '$par_id' AND `status` = 'current' ORDER BY socid desc LIMIT 1");
        $num_rows_current = mysqli_num_rows($result_current);
        if ($num_rows_current > 0) {
            $object_array = array();
            while ($row = mysqli_fetch_array($result_current)) {
                $object_array[] = stageOfChange::instantiate($row);
            }
            $this->soc_form = array_shift($object_array);
            return true;
        }

        $result_submitted = mysqli_query($con, "SELECT * FROM stage_of_change WHERE participantid = '$par_id' AND `status` = 'submitted' ORDER BY socid desc LIMIT 1");
        $num_rows_submitted = mysqli_num_rows($result_submitted);
        if ($num_rows_submitted > 0) {
            $object_array = array();
            while ($row = mysqli_fetch_array($result_submitted)) {
                $object_array[] = stageOfChange::instantiate($row);
            }
            $this->soc_form = array_shift($object_array);
            return false;
        }

        return true;
    }

    public function par_bar_status($par_id = 0)
    {
        global $con;

        $result_exist = mysqli_query($con, "SELECT * FROM participant_barrier WHERE participantid = '$par_id'");
        $num_rows_exist = mysqli_num_rows($result_exist);
        if ($num_rows_exist < 1) return true;

        $result_current = mysqli_query($con, "SELECT * FROM participant_barrier WHERE participantid = '$par_id' AND `status` = 'current' ORDER BY `timestamp` desc");
        $num_rows_current = mysqli_num_rows($result_current);
        if ($num_rows_current > 0) {
            $object_array = array();
            while ($row = mysqli_fetch_array($result_current)) {
                $object_array[] = participantBAR::instantiate($row);
            }
            $this->par_bar = array_shift($object_array);
            return true;
        }

        $result_submitted = mysqli_query($con, "SELECT * FROM participant_barrier WHERE participantid = '$par_id' AND `status` = 'submitted' AND selected = '2' ORDER BY `timestamp` desc");
        $num_rows_submitted = mysqli_num_rows($result_submitted);
        if ($num_rows_submitted > 0) {
            $object_array = array();
            while ($row = mysqli_fetch_array($result_submitted)) {
                $object_array[] = participantBAR::instantiate($row);
            }
            $this->par_bar = array_shift($object_array);
            return false;
        }

        return true;
    }

    public function stra_bar_status($par_id = 0)
    {
        global $con;

        $result_exist = mysqli_query($con, "SELECT * FROM participant_strategy WHERE participantid = '$par_id'");
        $num_rows_exist = mysqli_num_rows($result_exist);
        if ($num_rows_exist < 1) return true;

        $result_current = mysqli_query($con, "SELECT * FROM participant_strategy WHERE participantid = '$par_id' AND `status` = 'current' ORDER BY `timestamp` desc");
        $num_rows_current = mysqli_num_rows($result_current);
        if ($num_rows_current > 0) {
            $object_array = array();
            while ($row = mysqli_fetch_array($result_current)) {
                $object_array[] = participantSTRA::instantiate($row);
            }
            $this->stra_bar = array_shift($object_array);
            return true;
        }

        $result_submitted = mysqli_query($con, "SELECT * FROM participant_strategy WHERE participantid = '$par_id' AND `status` = 'submitted' ORDER BY `timestamp` desc");
        $num_rows_submitted = mysqli_num_rows($result_submitted);
        if ($num_rows_submitted > 0) {
            $object_array = array();
            while ($row = mysqli_fetch_array($result_submitted)) {
                $object_array[] = participantSTRA::instantiate($row);
            }
            $this->stra_bar = array_shift($object_array);
            return false;
        }

        return true;
    }

    public function goal_setting($par_id = 0)
    {
        global $con;

        $result_exist = mysqli_query($con, "SELECT * FROM participant_goal WHERE participantid = '$par_id'");
        $num_rows_exist = mysqli_num_rows($result_exist);
        if ($num_rows_exist < 1) return true;

        $result_current = mysqli_query($con, "SELECT * FROM participant_goal WHERE participantid = '$par_id' AND `status` = 'current' ORDER BY `submitted_time` desc LIMIT 1");
        $num_rows_current = mysqli_num_rows($result_current);
        if ($num_rows_current > 0) {
            $row = mysqli_fetch_array($result_current);
            $this->goal_setting = $row;// array_shift($row);
            return true;
        }

        $result_submitted = mysqli_query($con, "SELECT * FROM participant_goal WHERE participantid = '$par_id' AND `status` = 'submitted' ORDER BY `submitted_time` desc LIMIT 1");
        $num_rows_submitted = mysqli_num_rows($result_submitted);
        if ($num_rows_submitted > 0) {
            $row_submitted = mysqli_fetch_array($result_submitted);
            $this->goal_setting = $row_submitted;
            return false;
        }

        return true;
    }

    public function sfos_bar_status($par_id = 0)
    {
        global $con;

        $result_exist = mysqli_query($con, "SELECT * FROM participant_sfos WHERE participantid = '$par_id'");
        $num_rows_exist = mysqli_num_rows($result_exist);
        if ($num_rows_exist < 1) return true;

        $result_current = mysqli_query($con, "SELECT * FROM participant_sfos WHERE participantid = '$par_id' AND `status` = 'current' ORDER BY `submitted_time` desc LIMIT 1");
        $num_rows_current = mysqli_num_rows($result_current);
        if ($num_rows_current > 0) {
            $row = mysqli_fetch_array($result_current);
            $this->sfos_bar = $row;// array_shift($row);
            return true;
        }

        $result_submitted = mysqli_query($con, "SELECT * FROM participant_sfos WHERE participantid = '$par_id' AND `status` = 'submitted' ORDER BY `submitted_time` desc LIMIT 1");
        $num_rows_submitted = mysqli_num_rows($result_submitted);
        if ($num_rows_submitted > 0) {
            $row_submitted = mysqli_fetch_array($result_submitted);
            $this->sfos_bar = $row_submitted;
            return false;
        }

        return true;
    }

    public function confident_status($par_id = 0)
    {
        global $con;

        $result_exist = mysqli_query($con, "SELECT * FROM participant_confident WHERE participantid = '$par_id'");
        $num_rows_exist = mysqli_num_rows($result_exist);
        if ($num_rows_exist < 1) return true;

        $result_current = mysqli_query($con, "SELECT * FROM participant_confident WHERE participantid = '$par_id' AND `status` = 'current' ORDER BY `submitted_time` desc LIMIT 1");
        $num_rows_current = mysqli_num_rows($result_current);
        if ($num_rows_current > 0) {
            $row = mysqli_fetch_array($result_current);
            $this->confident_bar = $row;// array_shift($row);
            return true;
        }

        $result_submitted = mysqli_query($con, "SELECT * FROM participant_confident WHERE participantid = '$par_id' AND `status` = 'submitted' ORDER BY `submitted_time` desc LIMIT 1");
        $num_rows_submitted = mysqli_num_rows($result_submitted);
        if ($num_rows_submitted > 0) {
            $row_submitted = mysqli_fetch_array($result_submitted);
            $this->confident_bar = $row_submitted;
            return false;
        }

        return true;
    }
}

?>