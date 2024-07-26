<?php require_once('database.php'); ?>
<?php
class socialSupport {
	protected static $table_name="social_support";
	public $ssid;
	public $participantid;
	public $complete_date;
	public $ss_q1_did_physical_activities_fam;
	public $ss_q2_offer_physical_activities_fam;
	public $ss_q3_gave_helpful_reminder_fam;
	public $ss_q4_gave_encouragement_to_activity_program_fam;
	public $ss_q5_change_their_physical_activities_schedule_fam;
	public $ss_q6_discuss_their_physical_activities_fam;
	public $ss_q7_complained_about_time_spent_physical_activities_fam;
	public $ss_q8_criticised_physical_activities_fam;
	public $ss_q9_gave_rewards_on_physically_active_fam;
	public $ss_q10_planned_for_physical_activities_fam;
	public $ss_q11_help_plan_for_physical_activities_fam;
	public $ss_q12_ask_for_ideas_on_physically_active_fam;
	public $ss_q13_talked_about_how_much_todo_for_physical_activities_fam;
	public $ss_q1_did_physical_activities_fri;
	public $ss_q2_offer_physical_activities_fri;
	public $ss_q3_gave_helpful_reminder_fri;
	public $ss_q4_gave_encouragement_to_activity_program_fri;
	public $ss_q5_change_their_physical_activities_schedule_fri;
	public $ss_q6_discuss_their_physical_activities_fri;
	public $ss_q7_complained_about_time_spent_physical_activities_fri;
	public $ss_q8_criticised_physical_activities_fri;
	public $ss_q9_gave_rewards_on_physically_active_fri;
	public $ss_q10_planned_for_physical_activities_fri;
	public $ss_q11_help_plan_for_physical_activities_fri;
	public $ss_q12_ask_for_ideas_on_physically_active_fri;
	public $ss_q13_talked_about_how_much_todo_for_physical_activities_fri;
	
	public static function find_all() {
		return self::find_by_sql("SELECT * FROM ".self::$table_name);
  }
  
  public static function find_by_id($ssid=0) {
    $result_array = static::find_by_sql("SELECT * FROM ".self::$table_name." WHERE ssid={$ssid} LIMIT 1");
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
	  if(isset($this->ssid)){
		  return $this->update();
	  }else{
		$result_array = static::find_by_sql("SELECT ssid FROM ".self::$table_name." WHERE participantid='{$this->participantid}' ORDER BY ssid DESC limit 1");
		if(empty($result_array)){
			$this->ssid = (int)($this->participantid."01");
		}else{
			$ssid = array_shift($result_array)->ssid;
			$maxvalue = (int)($this->participantid."99");
			if($ssid<$maxvalue){
				$this->ssid = $ssid+1;
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
	    $this->ssid = $database->insert_id();
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
		$sql .= " WHERE ssid=". $database->escape_value($this->ssid);
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
	  $sql .= " WHERE ssid=". $database->escape_value($this->ssid);
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