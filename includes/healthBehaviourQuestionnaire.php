<?php require_once('database.php'); ?>
<?php
class healthBehaviourQuestionnaire {
	protected static $table_name="health_behaviour_questionnaire";
	public $hbqid;
	public $participantid;
	public $complete_date;
	public $Hbqhl_q1_uv_sunray_penetrate_cloud;
	public $Hbqhl_q2_some_type_uv_sunray_safe_to_skin;
	public $Hbqhl_q3_sunburned_on_cloudy_days;
	public $Hbqhl_q4_skin_cancer_possibility_on_unexposed_skin;
	public $Hbqhl_q5_wear_sun_protection_oh_highest_peak;
	public $Hbqhl_q6_tanning_bed_safe;
	public $Hbqhl_q7_base_tan_protection_of_sun_damage;
	public $Hbqhl_q8_sun_exposure_during_childhood;
	public $Hbqhl_q9_smart_indoor_tanning;
	public $Hbqhl_q10_sunscreen_not_required_if_have_dark_skin;
	public $Hbqhl_q11_spf30_sunscreen_twice_protection;
	public $Hbqhl_q12_healthier_people_with_suntans;
	public $Hbqhl_q13_baby_teeth_8yr;
	public $Hbqhl_q14_magnesium_supplements_good_teeth;
	public $Hbqhl_q15_gum_inflammation_as_gingivitis;
	public $Hbqhl_q16_deciduous_teeth;
	public $Hbqhl_q17_bleeding_gums_sign;
	public $Hbqhl_q18_fluoride_teeth_protection;
	public $Hbqhl_q19_teeth_floss_10cm;
	public $Hbqhl_q20_chemical_sleep_melatonin;
	public $Hbqhl_q21_stages_of_sleep;
	public $Hbqhl_q22_sleep_cycle;
	
	public static function find_all() {
		return self::find_by_sql("SELECT * FROM ".self::$table_name);
  }
  
  public static function find_by_id($hbqid=0) {
    $result_array = static::find_by_sql("SELECT * FROM ".self::$table_name." WHERE hbqid={$hbqid} LIMIT 1");
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
	  if(isset($this->hbqid)){
		  return $this->update();
	  }else{
		$result_array = static::find_by_sql("SELECT hbqid FROM ".self::$table_name." WHERE participantid='{$this->participantid}' ORDER BY hbqid DESC limit 1");
		if(empty($result_array)){
			$this->hbqid = (int)($this->participantid."01");
		}else{
			$hbqid = array_shift($result_array)->hbqid;
			$maxvalue = (int)($this->participantid."99");
			if($hbqid<$maxvalue){
				$this->hbqid = $hbqid+1;
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
	    $this->hbqid = $database->insert_id();
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
	  $sql .= " WHERE hbqid=". $database->escape_value($this->hbqid);
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