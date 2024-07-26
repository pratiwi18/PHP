<?php require_once('database.php'); ?>
<?php

class participant
{
    protected static $table_name = "participant";
    //protected static $db_fields = array('participantid', 'email', 'password', 'first_name', 'last_name', 'gender', 'age', 'date_of_birth', 'marital_status', 'number_of_children', 'postcode', 'education', 'employment', 'driving', 'distance_from_university');
    public $participantid;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $gender;
    public $age;
    public $date_of_birth;
    public $diagnosis;
    public $marital_status;
    public $number_of_children;
    public $postcode;
    public $education;
    public $employment;
    public $driving;
    public $register_date;
    public $isDevelop;

    public static function find_all()
    {
        return self::find_by_sql("SELECT * FROM " . self::$table_name);
    }

    public static function find_by_id($participantid = 0)
    {
        $result_array = static::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE participantid={$participantid} LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function check_email($email = '')
    {
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE email='{$email}' LIMIT 1");
        return !empty($result_array) ? true : false;
    }

    public static function check_pid($pid = '')
    {
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE participantid='{$pid}' LIMIT 1");
        return !empty($result_array) ? true : false;
    }

    //This function check if the participant exists in the database
    public static function authenticate($email = "", $password = "")
    {
        global $database;
        $email = $database->escape_value($email);
        $password = $database->escape_value($password);

        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE email = '{$email}' ";
        $sql .= "LIMIT 1";
        $result_array = self::find_by_sql($sql);
        if (!empty($result_array)) {
            $result_array = array_shift($result_array);
            if (password_verify($password, $result_array->password)) {
                return $result_array;
            } else {
                return false;
            }
        } else {
            return false;
        }
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

    // Calculates participant age
    public static function age_calculator($birthDate)
    {

        $birthDate = explode("-", $birthDate);
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md")
            ? ((date("Y") - $birthDate[0]) - 1)
            : (date("Y") - $birthDate[0]));
        return $age;

    }

    public function full_name()
    {
        if (isset($this->first_name) && isset($this->last_name)) {
            return $this->first_name . " " . $this->last_name;
        } else {
            return "";
        }
    }

    private static function instantiate($record)
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
        if (isset($this->participantid)) {
            return $this->update();
        } else {
            $result_array = static::find_by_sql("SELECT participantid FROM " . self::$table_name . " ORDER BY participantid DESC limit 1");
            if (empty($result_array)) {
                $this->participantid = 1;
            } else {
                $this->participantid = array_shift($result_array)->participantid + 1;
            }
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
        $sql = "INSERT INTO " . self::$table_name . " (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        if ($database->query($sql)) {
            $this->participantid = $database->insert_id();
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
        $database->query($sql);
        return ($database->affected_rows() == 1 OR $database->affected_rows() == 0) ? true : false;
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