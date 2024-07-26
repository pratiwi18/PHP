<?php
require_once("../includes/initialize.php");
// If a participant logs into the system it will be redirected to the first page for the participant
if ($session->participant_is_logged_in()) {
    redirect_to("index_participant.php");
}
// If a coach logs into the system it will be redirected to the first page for the coach
if ($session->coach_is_logged_in()) {
    redirect_to("index.php");
}

?>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Coach Assistant: Login</title>
</head>
<body>
<nav class="navbar navbar-dark justify-content-center"
     style="background-color: #001742; height: 200px">
    <h1><a class="navbar-brand" href="index_participant.php">Coach
            Assistant</a></h1>
</nav>
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-md-4 text-center">
            <div class="card">
                <h4 class="card-header">Login</h4>
                <div class="card-body">
                    <form method="post" id="login-form">
                        <div class="" role="alert" id="error">
                            <!-- error will be shown here ! -->
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="email" class="form-control" name="email"
                                       id="username" placeholder="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="password"
                                       id="password" placeholder="password">
                            </div>
                        </div>
                        <div class="form-group align-content-center">
                            <select class="form-control col-md-12" id="login-role">
                                <option>Participant</option>
                                <option>Coach</option>
                            </select>
                        </div>
                        <div class="form-group text-center ">
                            <input class="btn btn-primary col-md-12"
                                   type="submit" value="Login" name="participant_login"
                                   id="login-button">
                        </div>
                        <a class="btn btn-success col-md-12" style="color: white"
                           href="registration.php"> Register</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
<script src="js/functions.js?v=1" type="text/javascript"></script>
</body>
</html>
<script>
  /* login validation */
	$("#login-form").validate({
		rules: {
			password: {
				required: true,
			},
			email: {
				required: true,
				email: true
			},
			username: {
				required: true,
			},
		},
		messages: {
			password: {
				required: "<span style='color:red'>please enter your password</span>"
			},
			email: "<span style='color:red'>please enter your email address</span>",
			username: "<span style='color:red'>please enter your username</span>"
		},
		submitHandler: submitLogin
	});
	/* validation */

	/* login submit */

	function submitLogin() {
		var data = $("#login-form").serialize();

		$.ajax({

			type: 'POST',
			url: '../controller/login_process.php',
			data: data,
			beforeSend: function() {
				console.log(data);
				$("#error").fadeOut();
				$("#login-button").val('sending...');
			},
			success: function(response) {
				console.log(response);
				if (response == "ok-coach") {
					$("#login-button").val('Loging In ...');
					setTimeout(' window.location.href = "index.php"; ', 2000);
				} else {
					if (response == "ok-participant") {
						$("#login-button").val('Loging In ...');
						setTimeout(' window.location.href = "index_participant.php"; ', 2000);
					} else {
						console.log('notokay');
						$("#error").fadeIn(1000, function() {
							$("#error").html('<div class="alert alert-danger">' + response + ' </div>');
							$("#login-button").val('Login');
						});
					}
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				console.log(xhr.status);
				console.log(thrownError);
			}
		});
		console.log('false');
		return false;
	}
	/* login submit */
</script>
<?php // if(isset($database)) { $database->close_connection(); } ?>
