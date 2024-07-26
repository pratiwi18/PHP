<?php
// This is for redirecting to another page - It should be used before any HTML tags or echo, print command in php
function redirect_to($location = NULL)
{
    if ($location != NULL) {
        header("Location: {$location}");
        exit;
    }
}

function strip_zeros_from_date($marked_string = "")
{
    // first remove the marked zeros
    $no_zeros = str_replace('*0', '', $marked_string);
    // then remove any remaining marks
    $cleaned_string = str_replace('*', '', $no_zeros);
    return $cleaned_string;
}

// If a class was forgotten to be include in the application it will try to include it
function __autoload($class_name)
{
    $class_name = strtolower($class_name);
    $path = LIB_PATH . DS . "{$class_name}.php";
    if (file_exists($path)) {
        require_once($path);
    } else {
        die("The file {$class_name}.php could not be found.");
    }
}


function output_message($message = "")
{
    if (!empty($message)) {
        return "<div class=\"alert alert-danger\" role=\"alert\">{$message}</div>";
    } else {
        return "";
    }
}

// This is for including a specific layout to a section in the application
function include_layout_template($template = "")
{
    include(SITE_ROOT . DS . 'public' . DS . 'layouts' . DS . $template); // kien
}

function log_action($action, $message = "")
{
    $logfile = SITE_ROOT . DS . 'logs' . DS . 'log.txt';
    $new = file_exists($logfile) ? false : true;
    if ($handle = fopen($logfile, 'a')) { // append
        $timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
        $content = "{$timestamp} | {$action}: {$message}\n";
        fwrite($handle, $content);
        fclose($handle);
        if ($new) {
            chmod($logfile, 0755);
        }
    } else {
        echo "Could not open log file for writing.";
    }
}

function datetime_to_text($datetime = "")
{
    $unixdatetime = strtotime($datetime);
    return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}

// This is for the web application navigation.
function nav_selector()
{
    global $homeclass;
    global $profileclass;
    global $notificationclass;
    global $messageclass;
    global $pageid;
    if (isset($_GET['pageid']) && !empty($_GET['pageid'])) {
        $pageid = $_GET['pageid'];
        if ($pageid == 'home') {
            $homeclass = 'active';
            $profileclass = ' ';
            $notificationclass = ' ';
            $messageclass = ' ';
        } elseif ($pageid == 'profile') {
            $homeclass = ' ';
            $profileclass = 'active';
            $messageclass = ' ';
            $notificationclass = ' ';
        } elseif ($pageid == 'messagebox') {
            $homeclass = ' ';
            $profileclass = ' ';
            $notificationclass = ' ';
            $messageclass = 'active';
        } elseif ($pageid == 'notification') {
            $homeclass = ' ';
            $profileclass = ' ';
            $notificationclass = 'active';
            $messageclass = ' ';
        }
        else {
            $homeclass = 'active';
            $profileclass = ' ';
            $messageclass = ' ';
            $notificationclass = ' ';
        }
    } else {
        $homeclass = 'active';
        $profileclass = ' ';
        $messageclass = ' ';
        $notificationclass = ' ';
        $pageid = 'home';
    }
}
?>