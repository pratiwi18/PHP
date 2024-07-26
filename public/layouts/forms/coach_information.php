<form class="text-center" method="post" id="coach_registration">
	<div class="jumbotron mt-4">
		<div class="form-row text-left">
			<div class="col-md-12" role="alert" id="error">
				<!-- error will be shown here ! -->
			</div>
			<div class="form-group col-md-6">
				<label for="c_first_name" class="col-form-label">First name</label> <input type="text" class="form-control" name="first_name" id="c_first_name" placeholder="First name">
			</div>
			<div class="form-group col-md-6">
				<label for="c_last_name" class="col-form-label">Last name</label> <input type="text" class="form-control" name="last_name" id="c_last_name" placeholder="Last name">
			</div>
		</div>
		<div class="form-row text-left">
			<div class="form-group col-md-4">
				<label for="c_email" class="col-form-label">Email</label> <input type="email" class="form-control" name="email" placeholder="Email" id="c_email">
			</div>
			<div class="form-group col-md-4">
				<label for="c_password" class="col-form-label">Password</label> <input type="password" class="form-control" name="password" placeholder="Password" id="c_password">
			</div>
			<div class="form-group col-md-4">
				<label for="c_cpassword" class="col-form-label">Confirm password</label>
				<input type="password" class="form-control" name="cpassword" id="c_cpassword" placeholder="confirm Password">
			</div>
		</div>
		<div class="form-row text-center mt-4">
			<div class="form-group col-md-12">
				<a class="btn btn-danger" role="button" href="login.php" style="color: white;">Cancel</a>
				<input class="btn btn-primary" role="button" type="submit" value="Register" name="go_register_coach" id="c-reg-btn">
			</div>
		</div>
	</div>
</form>
<script>
	/* registration validation */
	$("#coach_registration").validate({
		rules: {
			first_name: {
				required: true,
			},
			last_name: {
				required: true,
			},
			email: {
				required: true,
				email: true,
				remote: {
					url: "../controller/check_coach.php",
					type: "POST",
					data: {
						email: function() {
							return $("#c_email").val();
						}
					},

				}
			},
			password: {
				required: true,
				minlength: 8,
			},
			cpassword: {
				equalTo: "#c_password"
			},
		},
		messages: {
			first_name: {
				required: "<span style='color:red'>please enter your first name</span>",
			},
			last_name: {
				required: "<span style='color:red'>please enter your last name</span>",
			},
			email: {
				required: "<span style='color:red'>please enter your email address</span>",
				email: "<span style='color:red'>please enter a valid email address</span>",
				remote: "<span style='color:red'>This email address you have entered is already registered</span>",
			},
			password: {
				required: "<span style='color:red'>please enter your password</span>",
				minlength: "<span style='color:red'>Please enter at least 8 characters</span>",
			},
			cpassword: {
				equalTo: "<span style='color:red'>Please enter the same value again</span>",
			},
		},
		submitHandler: submitCoachRegistration
	});
	/* validation */

	/* coach registration submit */
	function submitCoachRegistration() {
		var data = $("#coach_registration").serialize();

		$.ajax({

			type: 'POST',
			url: '../controller/registration_process.php',
			data: data,
			beforeSend: function() {
				console.log(data);
				$("#error").fadeOut();
				$("#c-reg-btn").val('registring...');
			},
			success: function(response) {
				console.log(response);
				if (response == "ok") {
					$("#c-reg-btn").val('You are now registered, please wait...');
					setTimeout(' window.location.href = "index_participant.php"; ', 4000);
				} else {
					console.log('notokay');
					$("#error").fadeIn(1000, function() {
						$("#error").html('<div class="alert alert-danger">' + response + ' </div>');
						$("#c-reg-btn").val('Register');
					});
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

	/*coach registration submit */
</script>