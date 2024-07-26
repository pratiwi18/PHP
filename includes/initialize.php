<?php

// Define the core paths
// Define them as absolute paths to make sure that require_once works as expected

// for macOS put mac and for windows put windows
//defined('OS') ? null : define('OS', 'mac');
// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('LIB_PATH') ? null : define('LIB_PATH', __DIR__);
// load config file first
require_once(LIB_PATH . DS . 'config.php');

if (OS == "server") {
    //defined('SITE_ROOT') ? null : define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT']);
    defined('SITE_ROOT') ? null : define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'] . DS . 'coach_assistant');
} else {
    defined('SITE_ROOT') ? null : define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'] . DS . 'coach_assistant');
}


// load basic functions next so that everything after can use them
require_once(LIB_PATH . DS . 'functions.php');

// load core objects
require_once(LIB_PATH . DS . 'session.php');
require_once(LIB_PATH . DS . 'database.php');

// load database-related classes
require_once(LIB_PATH . DS . 'coach.php');
require_once(LIB_PATH . DS . 'participant.php');
require_once(LIB_PATH . DS . 'baselineScreeningForm.php');
require_once(LIB_PATH . DS . 'decisionalBalance.php');
require_once(LIB_PATH . DS . 'difficultyWithLocomotor.php');
require_once(LIB_PATH . DS . 'healthBehaviourQuestionnaire.php');
require_once(LIB_PATH . DS . 'selfEfficacyQuestionnaire.php');
require_once(LIB_PATH . DS . 'sf12Questionnaire.php');
require_once(LIB_PATH . DS . 'socialSupport.php');
require_once(LIB_PATH . DS . 'stageOfChange.php');
require_once(LIB_PATH . DS . 'medication.php');
require_once(LIB_PATH . DS . 'surgery.php');
require_once(LIB_PATH . DS . 'participantSOC.php');
require_once(LIB_PATH . DS . 'impairments.php');
require_once(LIB_PATH . DS . 'participantIMP.php');
require_once(LIB_PATH . DS . 'barriers.php');
require_once(LIB_PATH . DS . 'participantBAR.php');
require_once(LIB_PATH . DS . 'strategy.php');
require_once(LIB_PATH . DS . 'participantSTRA.php');
require_once(LIB_PATH . DS . 'goal.php');
require_once(LIB_PATH . DS . 'valueIdentification.php');
require_once(LIB_PATH . DS . 'participantVI.php');

if (OS == "windows") {
    defined('LOCAL_HOST') ? null : define('LOCAL_HOST', 'localhost');
} elseif (OS == "server") {
    defined('LOCAL_HOST') ? null : define('LOCAL_HOST', 'paecoaching.com');
} else {
    defined('LOCAL_HOST') ? null : define('LOCAL_HOST', 'localhost:8888');
}
// If a coach logs in it will load the coach page
if ($session->coach_is_logged_in()) {
    if (OS == "server") {
        defined('ROOT_DIR') ? null : define('ROOT_DIR', 'http:' . DS . DS . LOCAL_HOST . DS . 'coach_assistant' . DS . 'public' . DS . 'index.php');
        defined('MAIN_PAGE') ? null : define('MAIN_PAGE', 'index.php');
    } else {
        defined('ROOT_DIR') ? null : define('ROOT_DIR', 'http:' . DS . DS . LOCAL_HOST . DS . 'coach_assistant' . DS . 'public' . DS . 'index.php');
        defined('MAIN_PAGE') ? null : define('MAIN_PAGE', 'index.php');
    }

// If a participant logs in it will load the participant page
} elseif ($session->participant_is_logged_in()) {
    if (OS == "server") {
        defined('ROOT_DIR') ? null : define('ROOT_DIR', 'http:' . DS . DS . LOCAL_HOST . DS . 'coach_assistant' . DS .'public' . DS . 'index_participant.php');
        defined('MAIN_PAGE') ? null : define('MAIN_PAGE', 'index_participant.php');
    } else {
        defined('ROOT_DIR') ? null : define('ROOT_DIR', 'http:' . DS . DS . LOCAL_HOST . DS . 'coach_assistant' . DS . 'public' . DS . 'index_participant.php');
        defined('MAIN_PAGE') ? null : define('MAIN_PAGE', 'index_participant.php');
    }

} else {
    if (OS == "server") {
        defined('ROOT_DIR') ? null : define('ROOT_DIR', 'http:' . DS . DS . LOCAL_HOST . DS . 'coach_assistant' . DS .'public' . DS . 'index.php');
        defined('MAIN_PAGE') ? null : define('MAIN_PAGE', 'index.php');
    } else {
        defined('ROOT_DIR') ? null : define('ROOT_DIR', 'http:' . DS . DS . LOCAL_HOST . DS . 'coach_assistant' . DS . 'public' . DS . 'index.php');
        defined('MAIN_PAGE') ? null : define('MAIN_PAGE', 'index.php');
    }
}
?>
