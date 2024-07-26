<?php 
  require_once('database.php');
  require_once('participantSOC.php');
?>
<?php

class stageOfChange
{
    protected static $table_name = "stage_of_change";
    public $socid;
    public $participantid;
    public $complete_date;
    public $soc_q1_current_physically_active;
    public $soc_q2_intend_tobe_more_physically_active_next6mth;
    public $soc_q3_current_engaged_with_physical_activity;
    public $soc_q4_regularly_physically_active_for_past6mth;
    public $submitted;
    public $status;

    public static function find_all()
    {
        return self::find_by_sql("SELECT * FROM " . self::$table_name);
    }

    public static function find_by_id($socid = 0)
    {
        $result_array = static::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE socid={$socid} LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_by_pid_saved($participantid = 0)
    {
        $result_array = static::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE participantid={$participantid} AND submitted = 0 LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_by_pid_submitted($participantid = 0)
    {
        $result_array = static::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE participantid={$participantid} AND submitted = 1 LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_by_pid_litmit($participantid = 0)
    {
        $result_array = static::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE participantid={$participantid} Order by complete_date DESC LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_by_pid($participantid = 0)
    {
        $result_array = static::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE participantid={$participantid} Order by complete_date DESC");
        return $result_array;
    }

    public static function find_by_sql($sql = "")
    {
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while ($row = $database->fetch_array($result_set)) {
            $object_array[] = self::instantiate($row);
        }
        return $object_array;
    }

    // This function will find out particpant stages based on the given rules
    public function current_stage()
    {

        if ($this->soc_q1_current_physically_active == 0 && $this->soc_q2_intend_tobe_more_physically_active_next6mth == 0 && $this->soc_q3_current_engaged_with_physical_activity == 0 && $this->soc_q4_regularly_physically_active_for_past6mth == 0) {
            return "Stage 1";
        } elseif ($this->soc_q1_current_physically_active == 0 && $this->soc_q2_intend_tobe_more_physically_active_next6mth == 1 && $this->soc_q3_current_engaged_with_physical_activity == 0 && $this->soc_q4_regularly_physically_active_for_past6mth == 0) {
            return "Stage 2";
        } elseif ($this->soc_q1_current_physically_active == 1 && $this->soc_q2_intend_tobe_more_physically_active_next6mth == 1 && $this->soc_q3_current_engaged_with_physical_activity == 0 && $this->soc_q4_regularly_physically_active_for_past6mth == 0) {
            return "Stage 3";
        } elseif ($this->soc_q1_current_physically_active == 1 && $this->soc_q2_intend_tobe_more_physically_active_next6mth == 1 && $this->soc_q3_current_engaged_with_physical_activity == 1 && $this->soc_q4_regularly_physically_active_for_past6mth == 0) {
            return "Stage 4";
        } elseif ($this->soc_q1_current_physically_active == 1 && $this->soc_q2_intend_tobe_more_physically_active_next6mth == 1 && $this->soc_q3_current_engaged_with_physical_activity == 1 && $this->soc_q4_regularly_physically_active_for_past6mth == 1) {
            return "Stage 5";
        } else {
            return "Invalid input";
        }
    }

    public static function instantiate($record)
    {
        // Could check that $record exists and is an array
        $object = new self;
        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    private function has_attribute($attribute)
    {
        // get_object_vars returns an associative array with all attributes
        // (incl. private ones!) as the keys and their current values as the value
        $object_vars = get_object_vars($this);
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $object_vars);
    }

    public function attributes()
    {
        // return an array of attribute names and their values
        $attributes = array();
        global $database;
        $sql = "SHOW COLUMNS FROM " . self::$table_name;
        $result = $database->query($sql);
        while ($row = $database->fetch_array($result)) {
            if (property_exists($this, $row['Field'])) {
                $attributes[$row['Field']] = $this->{$row['Field']};
            }
        }
        return $attributes;
    }

    protected function sanitized_attributes()
    {
        global $database;
        $clean_attributes = array();
        // sanitize the values before submitting
        // Note: does not alter the actual value of each attribute
        foreach ($this->attributes() as $key => $value) {
            if (!is_null($value)) {
                $clean_attributes[$key] = $database->escape_value($value);
            }
        }
        return $clean_attributes;
    }

    public function save()
    {
        // A new record won't have an id yet.
        if (isset($this->socid)) {
            return $this->update();
        } else {
            $result_array = static::find_by_sql("SELECT socid FROM " . self::$table_name . " WHERE participantid='{$this->participantid}' ORDER BY socid DESC limit 1");
            if (empty($result_array)) {
                $this->socid = (int)($this->participantid . "01");
            } else {
                $socid = array_shift($result_array)->socid;
                $maxvalue = (int)($this->participantid . "99");
                if ($socid < $maxvalue) {
                    $this->socid = $socid + 1;
                } else {
                    echo "A participant cannot have more than 99 assessments";
                }
            }
            return $this->create();
        }
    }

    public function create()
    {
        global $database;
        // Update or add current stage to participant SOC

        $currentStage = $this->current_stage();


        $participantSOC = participantSOC::find_by_pid($this->participantid);

        // Don't forget your SQL syntax and good habits:
        // - INSERT INTO table (key, key) VALUES ('value', 'value')
        // - single-quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO " . self::$table_name . " (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        if ($database->query($sql)) {
            if (empty($participantSOC)) {
                $participantSOC = new participantSOC();
                $participantSOC->csocid = $this->socid;
                $participantSOC->psocid = 0;
                $participantSOC->strategyid = 0;
                $participantSOC->current_step = " ";
                $participantSOC->participantid = $this->participantid;
                $participantSOC->current_stage = $currentStage;
                $participantSOC->previous_stage = "NDA";
                $complete_date = time();
                $participantSOC->update_time = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
                $participantSOC->save();
            } else {
                $participantSOC->psocid = $participantSOC->csocid;
                $participantSOC->csocid = $this->socid;
                $participantSOC->participantid = $this->participantid;
                $participantSOC->previous_stage = $participantSOC->current_stage;
                $participantSOC->current_stage = $currentStage;
                $complete_date = time();
                $participantSOC->update_time = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
                $participantSOC->save();
            }
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        global $database;
        $currentStage = $this->current_stage();
        //Updating participantSOC
        $participantSOC = participantSOC::find_by_pid($this->participantid);

        // Don't forget your SQL syntax and good habits:
        // - UPDATE table SET key='value', key='value' WHERE condition
        // - single-quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE " . self::$table_name . " SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE socid=" . $database->escape_value($this->socid);
        $database->query($sql);
        if ($participantSOC->csocid == $this->socid) {
            $participantSOC->current_stage = $currentStage;
            $complete_date = time();
            $participantSOC->update_time = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
            $participantSOC->save();
        } elseif ($participantSOC->psocid == $this->socid) {
            $participantSOC->previous_stage = $currentStage;
            $complete_date = time();
            $participantSOC->update_time = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
            $participantSOC->save();
        }
        return ($database->affected_rows() == 1) ? true : false;
    }

    public function delete()
    {
        global $database;
        //Updating participantSOC
        $participantSOC = participantSOC::find_by_pid($this->participantid);
        if ($participantSOC->csocid == $this->socid) {
            if ($participantSOC->previous_stage == "NDA") {
                $participantSOC->delete();
            } else {
                $participantSOC->current_stage = $participantSOC->previous_stage;
                $participantSOC->csocid = $participantSOC->psocid;
                $psocid = $this->socid - 2;
                $psoc = stageOfChange::find_by_id($psocid);
                if (!empty($psoc)) {
                    $participantSOC->previous_stage = $psoc->current_stage();
                    $participantSOC->psocid = $psoc->socid;
                } else {
                    $participantSOC->previous_stage = "NDA";
                    $participantSOC->psocid = 0;
                }
                $complete_date = time();
                $participantSOC->update_time = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
                $participantSOC->save();
            }
        } elseif ($participantSOC->psocid == $this->socid) {
            $psocid = $this->socid - 1;
            $psoc = stageOfChange::find_by_id($psocid);
            if (!empty($psoc)) {
                $participantSOC->previous_stage = $psoc->current_stage();
                $participantSOC->psocid = $psoc->socid;
            } else {
                $participantSOC->psocid = 0;
                $participantSOC->previous_stage = "NDA";
            }
            $complete_date = time();
            $participantSOC->update_time = strftime("%Y-%m-%d %H:%M:%S", $complete_date);
            $participantSOC->save();
        }
        // Don't forget your SQL syntax and good habits:
        // - DELETE FROM table WHERE condition LIMIT 1
        // - escape all values to prevent SQL injection
        // - use LIMIT 1
        $sql = "DELETE FROM " . self::$table_name;
        $sql .= " WHERE socid=" . $database->escape_value($this->socid);
        $sql .= " LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;

        // NB: After deleting, the instance of User still
        // exists, even though the database entry does not.
        // This can be useful, as in:
        //   echo $user->first_name . " was deleted";
        // but, for example, we can't call $user->update()
        // after calling $user->delete().
    }
}

?>