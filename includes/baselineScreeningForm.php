<?php require_once('database.php'); ?>
<?php
class baselineScreeningForm {
	protected static $table_name="baseline_screening_form";
	public $bsfid;
	public $participantid;
	public $complete_date;
	public $stroke_history;
	public $heart_disease_history;
	public $parq_medical_supervised_pa;
	public $parq_medication_intake;
	public $lung_disease_history;
	public $metabollic_disease_history;
	public $cardiovascular_complications_history;
	public $parq_pa_pain_history;
	public $parq_non_pa_pain_history;
	public $parq_lost_balance_lost_conciousness_history;
	public $breathing_difficulty_history;
	public $fatigue_or_short_breath;
	public $leg_pain_cramp_history;
	public $swollen_puffy_ankles_history;
	public $sudden_arms_hands_leg_feet_face_history;
	public $parq_heart_beats_history;
	public $pain_chest_jaw_back_arms_history;
	public $heart_murmur_history;
	public $body_weight;
	public $height;
	public $body_mass_index;
	public $risk_stratification_category;
	public $older_than_45yr_men;
	public $older_than_55yr_women_or_had_hysterectomy_postmenopausal;
	public $sedentary_lifestyle;
	public $BMI_or_WC_at_risk_value;
	
	public $affected_by_asthma_status;
	public $doctor_know_asthma_status;
	
	public $affected_by_seizure_status;
	public $doctor_know_epilepsy_status;
	
	public $last_2week_sickness_status;
	public $last_2week_bedrest_status;
	public $last_2week_viral_illness_status;
	public $last_2week_viral_sorejointsmuscle_status;
	public $last_2week_viral_fever_hotcold_status;
	
	public $parq_musculoskeletal_health_status;
	public $pain_details;
	public $doctor_aware_bone_problem;
	public $submitted;

	
	public static function find_all() {
		return self::find_by_sql("SELECT * FROM ".self::$table_name);
  }
  
  public static function find_by_id($bsfid=0) {
    $result_array = static::find_by_sql("SELECT * FROM ".self::$table_name." WHERE bsfid={$bsfid} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
  }
  public static function find_by_pid($participantid=0) {
    $result_array = static::find_by_sql("SELECT * FROM ".self::$table_name." WHERE participantid={$participantid} Order by complete_date DESC, bsfid ASC;");
		return $result_array;
  }
  public static function find_by_pid_saved($participantid=0) {
    $result_array = static::find_by_sql("SELECT * FROM ".self::$table_name." WHERE participantid={$participantid} AND submitted = 0 LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
  }
	public static function find_by_pid_completed_desc($participantid=0) {
    $result_array = static::find_by_sql("SELECT * FROM ".self::$table_name." WHERE participantid={$participantid} order by complete_date desc LIMIT 1");
    return !empty($result_array) ? array_shift($result_array) : false;
  }
  
  public static function find_by_sql($sql="") {
    global $database;
    $result_set = $database->query($sql);
		//print "<pre>";
		//var_dump($sql);
		//print "</pre>";
		//print "<pre>";
		//var_dump($result_set);
		//print "</pre>";
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
		global $database;
	  // A new record won't have an id yet.
	  if(isset($this->bsfid)){
		  // Adding medication and surgery 
		  // First deletes the previous medications then add the new ones with the old ones
		/*$sql = "DELETE FROM medication";
		$sql .= " WHERE bsfid=". $database->escape_value($this->bsfid);
		$database->query($sql);
		$mcounter = 0;
			while(isset($_POST['medication_name'.$mcounter])){
				if(!empty($_POST['medication_name'.$mcounter])){
					$newMedication = new Medication();
					$newMedication->bsfid = $this->bsfid;
					$newMedication->participantid = $this->participantid;
					$newMedication->medication_name = $_POST['medication_name'.$mcounter];
					$newMedication->reason_taken = $_POST['reason_taken'.$mcounter];
					$newMedication->prescription = $_POST['prescription'.$mcounter];
					$newMedication->quantity_taken = $_POST['quantity_taken'.$mcounter];
					$newMedication->frequency_taken = $_POST['frequency_taken'.$mcounter];
					$newMedication->period_used = $_POST['period_used'.$mcounter];
					$mcounter++;
					$newMedication->create();
				}else{
					$mcounter++;
				}
			}
			// First deletes the previous surgureis then add the new ones with the old ones
			$sql = "DELETE FROM surgery";
			$sql .= " WHERE bsfid=". $database->escape_value($this->bsfid);
			$database->query($sql);
			$mcounter = 0;
			while(isset($_POST['surgery_type'.$mcounter])){
				if(!empty($_POST['surgery_type'.$mcounter])){
					$newSurgery = new Surgery();
					$newSurgery->bsfid = $this->bsfid;
					$newSurgery->participantid = $this->participantid;
					$newSurgery->surgery_type = $_POST['surgery_type'.$mcounter];
					$newSurgery->surgery_date = $_POST['surgery_date'.$mcounter];
					$newSurgery->surgery_doctor = $_POST['surgery_doctor'.$mcounter];
					$mcounter++;
					$newSurgery->create();
				}else{
					$mcounter++;
				}
			}*/
			// The record exists so it will update it
		  return $this->update();
	  }else{
		  // This section is for creating a unique questionnaire ID 
		$result_array = static::find_by_sql("SELECT bsfid FROM ".self::$table_name." WHERE participantid='{$this->participantid}' ORDER BY bsfid DESC limit 1");
		if(empty($result_array)){
			// If there is not any record of this form for the participant it starts the ID from 'participantID.01'
			$this->bsfid = (int)($this->participantid."01");
		}else{
			$bsfid = array_shift($result_array)->bsfid;
			$maxvalue = (int)($this->participantid."99");
			if($bsfid<$maxvalue){
				// If there is some or one record of this form for the participant it will increase the last ID of the form by one for the new one
				$this->bsfid = $bsfid+1;
			}else{
				echo "A participant cannot have more than 99 assessments";
			}
		}
		/*// Adding medication and surgery 
		$sql = "DELETE FROM medication";
		$sql .= " WHERE bsfid=". $database->escape_value($this->bsfid);
		$database->query($sql);
		$mcounter = 0;
			while(isset($_POST['medication_name'.$mcounter])){
				if(!empty($_POST['medication_name'.$mcounter])){
					$newMedication = new Medication();
					$newMedication->bsfid = $this->bsfid;
					$newMedication->participantid = $this->participantid;
					$newMedication->medication_name = $_POST['medication_name'.$mcounter];
					$newMedication->reason_taken = $_POST['reason_taken'.$mcounter];
					$newMedication->prescription = $_POST['prescription'.$mcounter];
					$newMedication->quantity_taken = $_POST['quantity_taken'.$mcounter];
					$newMedication->frequency_taken = $_POST['frequency_taken'.$mcounter];
					$newMedication->period_used = $_POST['period_used'.$mcounter];
					$mcounter++;
					$newMedication->create();
				}else{
					$mcounter++;
				}
			}
			$sql = "DELETE FROM surgery";
			$sql .= " WHERE bsfid=". $database->escape_value($this->bsfid);
			$database->query($sql);
			$mcounter = 0;
			while(isset($_POST['surgery_type'.$mcounter])){
				if(!empty($_POST['surgery_type'.$mcounter])){
					$newSurgery = new Surgery();
					$newSurgery->bsfid = $this->bsfid;
					$newSurgery->participantid = $this->participantid;
					$newSurgery->surgery_type = $_POST['surgery_type'.$mcounter];
					$newSurgery->surgery_date = $_POST['surgery_date'.$mcounter];
					$newSurgery->surgery_doctor = $_POST['surgery_doctor'.$mcounter];
					$mcounter++;
					$newSurgery->create();
				}else{
					$mcounter++;
				}
			}*/
			// The record does not exist so it will create it
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
	   // $this->bsfid = $database->insert_id();
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
		$sql .= " WHERE bsfid=". $database->escape_value($this->bsfid);
	 return $database->query($sql);
	 // return ($database->affected_rows() == 1) ? true : false;
	}

	public function delete() {
		global $database;
		// Don't forget your SQL syntax and good habits:
		// - DELETE FROM table WHERE condition LIMIT 1
		// - escape all values to prevent SQL injection
		// - use LIMIT 1
		/*//First delete medication and surgery
		$sql = "DELETE FROM medication";
	 	$sql .= " WHERE bsfid=". $database->escape_value($this->bsfid);
		$database->query($sql);
		$sql = "DELETE FROM surgery";
	 	$sql .= " WHERE bsfid=". $database->escape_value($this->bsfid);
		$database->query($sql);*/
	 	$sql = "DELETE FROM ".self::$table_name;
	 	$sql .= " WHERE bsfid=". $database->escape_value($this->bsfid);
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