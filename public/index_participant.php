<!-- Loading javascript classes to be used -->
<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="js/scripts.js" type="text/javascript"></script>
<script src="js/tether.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/jquery-ui.min.js" type="text/javascript"></script>

<script
        src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
        crossorigin="anonymous"></script>
<script src="js/validation.min.js" type="text/javascript"></script>
<script src="js/functions.js" type="text/javascript"></script>
<?php
// Initializing all the classes
require_once("../includes/initialize.php");
if (isset($_POST['logout'])) {
    // when logout button has been clicked
    $session->logout();
}
// If there is not session for a participant redirects to login.php
if (!$session->participant_is_logged_in()) {
    redirect_to("login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <title>Coach Assistant - Participant</title>
</head>

<body>
<?php
// Header of the web application
include('layouts/participant/header.php');
//include_layout_template('participant/header.php');
?>
<div class="container pt-3">
    <?php
    // Body of the application based on the page ID
    include('layouts/participant/' . $pageid . '.php');
    //include_layout_template('participant/' . $pageid . '.php');
    ?>
</div>
<?php
// Footer of the web application
include('layouts/participant/footer.php');
//include_layout_template('participant/footer.php');
?>
</body>
</html>