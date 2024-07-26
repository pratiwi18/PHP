<?php require_once('database.php'); ?>
<?php
class sf12Questionnaire {
	protected static $table_name="sf_12_questionnaire";
	public $sf_12id;
	public $participantid;
	public $complete_date;
	public $Sf12_q1_general_health;
	public $Sf12_q2_moderate_activity;
	public $Sf12_q3_climbing_stairs;
	public $Sf12_q4_physical_health_problem_accomplished_less_activity;
	public $Sf12_q5_physical__health_problem_limited_work_activity;
	public $Sf12_q6_emotional_problem_accomplished_less;
	public $Sf12_q7_emotional_problem_no_usual_work_activities;
	public $Sf12_q8_pain_interfere_normal_work;
	public $Sf12_q9_calm_peaceful_feeling_past_month;
	public $Sf12_q10_lot_of_energy_feeling_past_month;
	public $Sf12_q11_downheart_blue_feeling_past_month;
	public $Sf12_q12_physical_health_emotional_problem_interfere_social_acti;
	
	public static function find_all() {
		return self::find_by_sql("SELECT * FROM ".self::$table_name);
  }
  
  public static function find_by_id($sf_12id=0) {
    $result_array = static::find_by_sql("SELECT * FROM ".self::$table_name." WHERE sf_12id={$sf_12id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
  }
  public static function find_by_pid($participantid=0) {
    $result_array = static::find_by_sql("SELECT * FROM ".self::$table_name." WHERE participantid={$participantid} Order by complete_date DESC, sf_12id ASC");
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
	  if(isset($this->sf_12id)){
		  return $this->update();
	  }else{
		$result_array = static::find_by_sql("SELECT sf_12id FROM ".self::$table_name." WHERE participantid='{$this->participantid}' ORDER BY sf_12id DESC limit 1");
		if(empty($result_array)){
			$this->sf_12id = (int)($this->participantid."01");
		}else{
			$sf_12id = array_shift($result_array)->sf_12id;
			$maxvalue = (int)($this->participantid."99");
			if($sf_12id<$maxvalue){
				$this->sf_12id = $sf_12id+1;
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
	    $this->sf_12id = $database->insert_id();
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
		$sql .= " WHERE participantid=". $database->escape_value($this->participantid);
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
	  $sql .= " WHERE sf_12id=". $database->escape_value($this->sf_12id);
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