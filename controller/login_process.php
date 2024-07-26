<?php
//require_once("initialize.php"); 
require_once('../includes/coach.php');
require_once('../includes/participant.php');
require_once('../includes/session.php');

if (isset($_POST['coach_login'])) { // Form has been submitted.

    $email = trim($_POST['email']);
    $cpassword = trim($_POST['password']);

    // Check database to see if username/password exist.
    $found_user = Coach::authenticate($email, $cpassword);

    if ($found_user) {
        $session->coach_login($found_user);
        echo 'ok-coach';
    } else {
        // username/password combo was not found in the database
        echo "Email/password combination incorrect.";
    }
}

if (isset($_POST['participant_login'])) { // Form has been submitted.

    $email = trim($_POST['email']);
    $ppassword = trim($_POST['password']);

    // Check database to see if email/password exist.
    $found_user = participant::authenticate($email, $ppassword);

    if ($found_user) {
        $session->participant_login($found_user);
        echo 'ok-participant';
    } else {
        // email/password combo was not found in the database
        echo "Email/password combination incorrect.";
    }
}
?>