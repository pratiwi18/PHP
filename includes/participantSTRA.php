<?php require_once('database.php'); ?>
<?php

class participantSTRA
{
    protected static $table_name = "participant_strategy";
    public $participantid;
    public $smid;
    public $stra_id;
    public $success;
    public $submitted;
    public $reminder_count;
    public $timestamp;
    public $status;

    public static function find_all()
    {
        return self::find_by_sql("SELECT * FROM " . self::$table_name);
    }

    public static function find_by_pid($participantid = 0)
    {
        $result_array = static::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE participantid={$participantid}");
        return !empty($result_array) ? $result_array : false;
    }

    public static function find_by_pid_submitted($participantid = 0)
    {
        $result_array = static::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE participantid={$participantid} AND submitted = 1 AND success IS NULL AND reminder_count < 3 ORDER BY `timestamp` DESC LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_by_pid_submitted_newest($participantid = 0)
    {
        $result_array = static::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE participantid={$participantid} AND submitted = 1 AND success IS NULL AND reminder_count < 3 ORDER BY `timestamp` desc LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function find_by_all($participantid, $smid, $stra_id)
    {
        $result_array = static::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE participantid={$participantid} AND smid={$smid} AND stra_id='{$stra_id}' AND submitted=1 LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
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
            $clean_attributes[$key] = $database->escape_value($value);
        }
        return $clean_attributes;
    }

    public function save()
    {
        // If its in the database there is not any need to update or change anything
        $result_array = static::find_by_sql("SELECT participantid FROM " . self::$table_name . " WHERE participantid={$this->participantid} AND stra_id='{$this->stra_id}' AND smid={$this->smid} AND timestamp = '{$this->timestamp}' LIMIT 1");
        if (!empty($result_array)) {
            return $this->update();
        } else {
            return $this->create();
        }
    }

    public function create()
    {
        global $database;
        // Don't forget your SQL syntax and good habits:
        // - INSERT INTO table (key, key) VALUES ('value', 'value')
        // - single-quotes around all values
        // - escape all values to prevent SQL injection
        $attributes = $this->sanitized_attributes();
        unset($attributes['success']);
        $sql = "INSERT INTO " . self::$table_name . " (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        //return $sql;
        if ($database->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        global $database;
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
        $sql .= " WHERE participantid=" . $database->escape_value($this->participantid);
        $sql .= " AND smid=" . $database->escape_value($this->smid);
        $sql .= " AND timestamp='" . $database->escape_value($this->timestamp) . "'";
        $sql .= " AND stra_id='" . $database->escape_value($this->stra_id) . "'";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }

    public static function delete_by_par($participantid)
    {
        global $database;

        $sql = "DELETE FROM " . self::$table_name . " WHERE participantid={$participantid}";
        $database->query($sql);
    }

    public function delete()
    {
        global $database;
        // Don't forget your SQL syntax and good habits:
        // - DELETE FROM table WHERE condition LIMIT 1
        // - escape all values to prevent SQL injection
        // - use LIMIT 1
        $sql = "DELETE FROM " . self::$table_name;
        $sql .= " WHERE participantid=" . $database->escape_value($this->participantid);
        $sql .= " AND smid=" . $database->escape_value($this->smid);
        $sql .= " AND timestamp='" . $database->escape_value($this->timestamp) . "'";
        $sql .= " AND stra_id='" . $database->escape_value($this->stra_id) . "'";
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