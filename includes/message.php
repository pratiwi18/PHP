<?php require_once('database.php'); ?>
<?php

class message
{
    protected static $table_name = "message";
    public $messageid;
		public $type;
    public $fromid;
		public $toid;
    public $content;
		public $send_date;
		public $isread;
		public $first_name;
		public $last_name;
		//public $threadid;
	
    public static function find_all()
    {
        return self::find_by_sql("SELECT * FROM " . self::$table_name);
    }

    public static function find_by_pid($participantid = 0)
    {
        //$result_array = static::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE participantid={$participantid} LIMIT 1");
        //return !empty($result_array) ? array_shift($result_array) : false;
    }
	
		public static function find_by_cid($coachid = 0)
    {
        //$result_array = static::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE coachid={$coachid} LIMIT 1");
        //return !empty($result_array) ? array_shift($result_array) : false;
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
	
		private static function instantiate($record)
    {
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
	
		protected function sanitized_attributes() {
	  		global $database;
	 			$clean_attributes = array();
	  		// sanitize the values before submitting
	  		// Note: does not alter the actual value of each attribute
	  		foreach($this->attributes() as $key => $value){
		  		if(!is_null($value)){	
			  		$clean_attributes[$key] = $database->escape_value($value);
		  		}
	  		}
	  		return $clean_attributes;
		}
	
		public function save()
    {
        // A new record won't have an id yet.
        if (isset($this->messageid)) {
            return $this->update();
        } else {
            $result_array = static::find_by_sql("SELECT messageid FROM " . self::$table_name . " ORDER BY messageid DESC limit 1");
            if (empty($result_array)) {
                $this->messageid = 1;
            } else {
                $this->messageid = array_shift($result_array)->messageid + 1;
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
            $this->messageid = $database->insert_id();
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
    }
}