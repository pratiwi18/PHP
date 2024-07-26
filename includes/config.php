<?php
date_default_timezone_set('Australia/Brisbane');
//defined('OS') ? null : define('OS', 'windows'); //local
defined('OS') ? null : define('OS', 'server'); // server
// Database Constants
if( OS == "windows"){
	// For windows - WAMP
	defined('DB_SERVER') ? null : define("DB_SERVER", "localhost");
	defined('DB_USER')   ? null : define("DB_USER", "root");
	defined('DB_PASS')   ? null : define("DB_PASS", "");
	defined('DB_NAME')   ? null : define("DB_NAME", "coach_assistant");
}elseif( OS == 'server'){
    // For windows - WAMP
    defined('DB_SERVER') ? null : define("DB_SERVER", "localhost");
    defined('DB_USER')   ? null : define("DB_USER", "paecoach_user");
    defined('DB_PASS')   ? null : define("DB_PASS", "ca2018!@");
    defined('DB_NAME')   ? null : define("DB_NAME", "paecoach_db");
}elseif( OS == 'mac'){
	// For macOS - MAMP

}

?>
