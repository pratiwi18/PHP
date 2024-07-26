<?php require_once('database.php'); ?>
<?php
class decisionalBalance {
	protected static $table_name="decisional_balance";
	public $dbid;
	public $participantid;
	public $complete_date;
	public $dbq_q1_more_energy_as_physically_active;
	public $dbq_q2_tension_relieve_do_regular_physical_activity;
	public $dbq_q3_tired_daily_work_as_physically_active;
	public $dbq_q4_more_confident_as_physically_active;
	public $dbq_q5_more_sound_sleep_as_physically_active;
	public $dbq_q6_feel_better_as_physically_active;
	public $dbq_q7_difficulty_finding_physical_activity_not_affected_by_weat;
	public $dbq_q8_better_body_as_physically_active;
	public $dbq_q9_easier_perform_routine_task_as_physically_active;
	public $dbq_q10_less_stress_as_physically_active;
	public $dbq_q11_feel_uncomfortable_as_physically_active;
	public $dbq_q12_feel_more_comfortable__as_physically_active;
	public $dbq_q13_regular_physical_activity_takes_too_much_time;
	public $dbq_q14_physical_activity_positive_outlook;
	public $dbq_q15_have_less_time_as_physically_active;
	public $dbq_q16_regular_physical_activity_too_exhausted_at_the_end_of_da;
	
	public static function find_all() {
		return self::find_by_sql("SELECT * FROM ".self::$table_name);
  }
  
  public static function find_by_id($dbid=0) {
    $result_array = static::find_by_sql("SELECT * FROM ".self::$table_name." WHERE dbid={$dbid} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
  }
  public static function find_by_pid($participantid=0) {
    $result_array = static::find_by_sql("SELECT * FROM ".self::$table_name." WHERE participantid={$participantid} Order by complete_date DESC");
	return $result_array;
  }
  public static function find_by_sql($sql="") {
    global $database;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)) {
      $object_array[] = self::instantiate($row);
    }
    return $object_array;
  }

	private static function instantiate($record) {
		// Could check that $record exists and is an array
    $object = new self;
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	private function has_attribute($attribute) {
	  // get_object_vars returns an associative array with all attributes 
	  // (incl. private ones!) as the keys and their current values as the value
	  $object_vars = get_object_vars($this);
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $object_vars);
	}
	public function attributes() { 
		// return an array of attribute names and their values
		$attributes = array();
		global $database;
		$sql = "SHOW COLUMNS FROM ".self::$table_name;
		$result = $database->query($sql);
		while($row = $database->fetch_array($result)){
			if(property_exists($this, $row['Field'] )) {
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
	
	public function save() {
	  // A new record won't have an id yet.
	  if(isset($this->dbid)){
		  return $this->update();
	  }else{
		  // This section is for creating a unique questionnaire ID 
		$result_array = static::find_by_sql("SELECT dbid FROM ".self::$table_name." WHERE participantid='{$this->participantid}' ORDER BY dbid DESC limit 1");
		if(empty($result_array)){
			// If there is not any record of this form for the participant it starts the ID from 'participantID.01'
			$this->dbid = (int)($this->participantid."01");
		}else{
			
			$dbid = array_shift($result_array)->dbid;
			$maxvalue = (int)($this->participantid."99");
			if($dbid<$maxvalue){
				// If there is some or one record of this form for the participant it will increase the last ID of the form by one for the new one
				$this->dbid = $dbid+1;
			}else{
				echo "A participant cannot have more than 99 assessments";
			}
		}
		return $this->create();
	  }
	}
	
	public function create() {
		global $database;
		// Don't forget your SQL syntax and good habits:
		// - INSERT INTO table (key, key) VALUES ('value', 'value')
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->sanitized_attributes();
	  $sql = "INSERT INTO ".self::$table_name." (";
		$sql .= join(", ", array_keys($attributes));
	  $sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
	  if($database->query($sql)) {
	    $this->dbid = $database->insert_id();
	    return true;
	  } else {
	    return false;
	  }
	}

	public function update() {
	  global $database;
		// Don't forget your SQL syntax and good habits:
		// - UPDATE table SET key='value', key='value' WHERE condition
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$table_name." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE dbid=". $database->escape_value($this->dbid);
	  $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}

	public function delete() {
		global $database;
		// Don't forget your SQL syntax and good habits:
		// - DELETE FROM table WHERE condition LIMIT 1
		// - escape all values to prevent SQL injection
		// - use LIMIT 1
	  $sql = "DELETE FROM ".self::$table_name;
	  $sql .= " WHERE dbid=". $database->escape_value($this->dbid);
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