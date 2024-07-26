<?php
// config.php contains all the necessary variables to connect to the database
require_once("config.php");
class MySQLDatabase {
  
  private $connection;
  
  function __construct() {
    $this->open_connection();
  }
  
  public function open_connection() {
	  // This function will open a connection to the database
	if(OS == "windows"){
		$this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	}elseif(OS == "server"){
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    	//$this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME,DB_PORT);
	}else{
    	$this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME,DB_PORT);
	}
    if(mysqli_connect_errno()) {
      die("Database connection failed: " . 
           mysqli_connect_error() . 
           " (" . mysqli_connect_errno() . ")"
      );
    }
  }
  
  public function close_connection() {
	  // This function will close the connection to the database
    if(isset($this->connection)) {
      mysqli_close($this->connection);
      unset($this->connection);
    }
  }

  public function query($sql) {
    $result = mysqli_query($this->connection, $sql);
    $this->confirm_query($result);
    return $result;
  }
  
  private function confirm_query($result) {
	// If there is problem with the query this will return the error
  	if (!$result) {
		// This will be used for development environment 
		die(mysqli_error($this->connection));
		// This will be used for commercial environment
  		//die("Database query failed.");
  	}
  }

   public function escape_value($string) {
    $escaped_string = mysqli_real_escape_string($this->connection, $string);
    return $escaped_string;
  }
  
  // "database neutral" functions
  
  public function fetch_array($result_set) {
    return mysqli_fetch_array($result_set);
  }

  public function num_rows($result_set) {
    return mysqli_num_rows($result_set);
  }

  public function insert_id() {
    // get the last id inserted over the current db connection
    return mysqli_insert_id($this->connection);
  }

  public function affected_rows() {
    return mysqli_affected_rows($this->connection);
  }
  
}
// An instance of the database to be used in the application
$database = new MySQLDatabase();
$db =& $database;

?>
