<?php
global $session;
// If participant is logged in, it means they want to updat their information - Loads the participant data from the database to put them into the form
if ($session->participant_is_logged_in() && ! empty($_GET['paction']) && $_GET['paction'] == 'modify') {
    $participantid = $session->participantid;
    $participant = participant::find_by_id($participantid);
    if ($participant->marital_status == 'Never Married') {
        $nmselected = "selected";
    } elseif ($participant->marital_status == 'Married/Defacto') {
        $mdselected = "selected";
    } elseif ($participant->marital_status == 'Separated/Divorced') {
        $sdselected = "selected";
    } else {
        $nmselected = "";
        $mdselected = "";
        $sdselected = "";
    }
    
    if ($participant->education == "< Year 10 (Junior High School)") {
        $edOp1 = "selected";
    } elseif ($participant->education == "Completed Year 12 (High School)") {
        $edOp2 = "selected";
    } elseif ($participant->education == "Trade/Apprentice/Vocational Cert") {
        $edOp3 = "selected";
    } elseif ($participant->education == "University Degree/Higher Degree") {
        $edOp4 = "selected";
    } else {
        $edOp1 = "";
        $edOp2 = "";
        $edOp3 = "";
        $edOp4 = "";
    }
    
    if ($participant->employment == "Full-time work/study") {
        $emOp1 = "selected";
    } elseif ($participant->employment == "Full-time work (supported)") {
        $emOp2 = "selected";
    } elseif ($participant->employment == "Part-time work/study") {
        $emOp3 = "selected";
    } elseif ($participant->employment == "Unemployed looking for work") {
        $emOp4 = "selected";
    } elseif ($participant->employment == "Unemployed NOT looking for work") {
        $emOp5 = "selected";
    } elseif ($participant->employment == "Returning to previous occupation") {
        $emOp6 = "selected";
    } else {
        $emOp1 = "";
        $emOp2 = "";
        $emOp3 = "";
        $emOp4 = "";
        $emOp5 = "";
        $emOp6 = "";
    }
    
    if ($participant->driving == "No Drivers License or no car to drive") {
        $drOp1 = "selected";
    } elseif ($participant->driving == "Drivers License AND car to drive") {
        $drOp2 = "selected";
    } elseif ($participant->driving == "Drivers License only") {
        $drOp3 = "selected";
    } else {
        $drOp1 = "";
        $drOp2 = "";
        $drOp3 = "";
    }
    if ($participant->diagnosis == "TBI") {
        $tbiselected = "selected";
    } elseif ($participant->diagnosis == "Stroke") {
        $stroselected = "selected";
    } elseif ($participant->diagnosis == "CP") {
        $cpselected = "selected";
    } else {
        $tbiselected = "";
        $stroselected = "";
        $cpselected = "";
    }
}// A new participant is going to be added - Nothing is selected
else {    
    $nmselected = "";
    $mdselected = "";
    $sdselected = "";
    $edOp1 = "";
    $edOp2 = "";
    $edOp3 = "";
    $edOp4 = "";
    $emOp1 = "";
    $emOp2 = "";
    $emOp3 = "";
    $emOp4 = "";
    $emOp5 = "";
    $drOp1 = "";
    $drOp2 = "";
    $drOp3 = "";
    $tbiselected = "";
    $stroselected = "";
    $cpselected = "";
}
?>

<form class="text-center" method="post"
	id="<?php
if ($session->participant_is_logged_in()) {
    echo "participant_update";
} else {
    echo "participant_registration";
}
?>">
	<div class="jumbotron mt-4">
		<div class="form-row text-left">
			<div class="col-md-12" role="alert" id="error">
				<!-- error will be shown here ! -->
			</div>
			<div class="form-group col-md-6">
				<label for="first_name" class="col-form-label">First name</label> <input
					type="text" class="form-control" name="first_name" id="first_name"
					placeholder="First name"
					value="<?php if($session->participant_is_logged_in()){ echo $participant->first_name; } ?>">
			</div>
			<div class="form-group col-md-6">
				<label for="last_name" class="col-form-label">Last name</label> <input
					type="text" class="form-control" name="last_name"
					placeholder="Last name"
					value="<?php if($session->participant_is_logged_in()){ echo $participant->last_name; } ?>">
			</div>
		</div>
		<div class="form-row text-left">
			<div class="form-group col-md-4">
				<label for="email" class="col-form-label">Email</label> <input
					type="email" class="form-control" name="email" placeholder="Email"
					id="email"
					value="<?php if($session->participant_is_logged_in()){ echo $participant->email; } ?>">
			</div>
      <?php if(!$session->participant_is_logged_in()){ ?>
    <div class="form-group col-md-4">
				<label for="password" class="col-form-label">Password</label> <input
					type="password" class="form-control" name="password"
					placeholder="Password" id="password">
			</div>
			<div class="form-group col-md-4">
				<label for="cpassword" class="col-form-label">Confirm password</label>
				<input type="password" class="form-control" name="cpassword"
					placeholder="confirm Password">
			</div>
    <?php } ?>
  </div>
		<div class="form-row text-left">
			<div class="form-group col-md-2">
				<div class="form-check">
					<label class="col-form-label"> Gender </label>
				</div>
			</div>
			<div class="form-group col-md-2">
				<div class="form-check">
					<label for="gender_male" class="col-form-label"> <input
						class="form-check-input" type="radio" name="gender"
						id="gender_male" value="male"
						<?php
    
if ($session->participant_is_logged_in()) {
        if ($participant->gender == 'male') {
            echo 'checked';
        }
    } else {
        echo 'checked';
    }
    ?>> Male
					</label>
				</div>
			</div>
			<div class="form-group col-md-2">
				<div class="form-check">
					<label for="gender_female" class="col-form-label"> <input
						class="form-check-input" type="radio" name="gender"
						id="gender_female" value="female"
						<?php
    
if ($session->participant_is_logged_in()) {
        if ($participant->gender == 'female') {
            echo 'checked';
        }
    }
    ?>> Female
					</label>
				</div>
			</div>
			<div class="form-group col-md-4">
				<label for="date_of_birth" class="col-form-label"> Date of birth </label>
				<input type="date" class="form-control" name="date_of_birth"
					id="date_of_birth" placeholder="YY-MM-DD"
					value="<?php if($session->participant_is_logged_in()){ echo $participant->date_of_birth; } ?>">

			</div>
			<div class="form-group col-md-2">
				<label for="diagnosis">diagnosis</label> <select
					class="form-control" name="diagnosis">
					<option <?php echo $tbiselected; ?>>TBI</option>
					<option <?php echo $stroselected; ?>>Stroke</option>
					<option <?php echo $cpselected; ?>>CP</option>
				</select>
			</div>
		</div>

		<div class="form-row text-left">
			<div class="form-group col-md-6">
				<label for="marital_status">Marital Status</label> <select
					class="form-control" name="marital_status">
					<option <?php echo $nmselected; ?>>Never Married</option>
					<option <?php echo $mdselected; ?>>Married/Defacto</option>
					<option <?php echo $sdselected; ?>>Separated/Divorced</option>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label for="number_of_children" class="col-form-label">Number of
					children</label> <input type="text" class="form-control"
					name="number_of_children" placeholder="0, 1, 2, 3 or etc"
					value="<?php if($session->participant_is_logged_in()){ echo $participant->number_of_children; } ?>">
			</div>
			<div class="form-group col-md-3">
				<label for="postcode" class="col-form-label">Postcode</label> <input
					type="text" class="form-control" name="postcode"
					placeholder="Postcode"
					value="<?php if($session->participant_is_logged_in()){ echo $participant->postcode; } ?>">
			</div>
		</div>


		<div class="form-row text-left">
			<div class="form-group col-md-6">
				<label for="education">Education</label> <select
					class="form-control" name="education">
					<option <?php echo $edOp1; ?>>&gt; Year 10 (Junior High School)</option>
					<option <?php echo $edOp2; ?>>Completed Year 12 (High School)</option>
					<option <?php echo $edOp3; ?>>Trade/Apprentice/Vocational Cert</option>
					<option <?php echo $edOp4; ?>>University Degree/Higher Degree</option>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label for="employment">Employment</label> <select
					class="form-control" name="employment">
					<option <?php echo $emOp1; ?>>Full-time work/study</option>
					<option <?php echo $emOp2; ?>>Full-time work (supported)</option>
					<option <?php echo $emOp3; ?>>Part-time work/study</option>
					<option <?php echo $emOp4; ?>>Unemployed looking for work</option>
					<option <?php echo $emOp5; ?>>Unemployed NOT looking for work</option>
					<option <?php echo $emOp6; ?>>Returning to previous occupation</option>
				</select>
			</div>
		</div>


		<div class="form-row text-left">
			<div class="form-group col-md-6">
				<label for="driving">Driving</label> <select class="form-control"
					name="driving">
					<option <?php echo $drOp1; ?>>No Drivers License or no car to drive</option>
					<option <?php echo $drOp2; ?>>Drivers License AND car to drive</option>
					<option <?php echo $drOp3; ?>>Drivers License only</option>
				</select>
			</div>
		</div>
		<div class="form-row text-center mt-4">
			<div class="form-group col-md-12">
 
  <?php if($session->participant_is_logged_in()){ ?>
   <input class="btn btn-primary" role="button" type="submit"
					value="Update" name="go_update" id="p_up_btn">
  	
  <?php }else{ ?>
  <?php ?> 
  <a class="btn btn-danger" role="button" href="login.php"
					style="color: white;">Cancel</a>
				<input class="btn btn-primary"
					role="button" type="submit" value="Register" name="go_register"
					id="p-reg-btn">
  <?php } ?>
  </div>
		</div>
	</div>
</form>
<script>
	/* registration validation */
	$("#participant_registration").validate({
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
					url: "../controller/check_email.php",
					type: "POST",
					data: {
						email: function() {
							return $("#email").val();
						}
					},
				}
			},
			password: {
				required: true,
				minlength: 8,
			},
			cpassword: {
				equalTo: "#password"
			},
			date_of_birth: {
				required: true,
				date: true,
			},
			number_of_children: {
				required: true,
				digits: true,
			},
			postcode: {
				required: true,
				digits: true,
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
			date_of_birth: {
				required: "<span style='color:red'>please enter your birthday</span>",
				date: "<span style='color:red'>please enter a valid date</span>",
			},
			number_of_children: {
				required: "<span style='color:red'>please put 0 if you dont have any children</span>",
				digits: "<span style='color:red'>please enter a valid number</span>",
			},
			postcode: {
				digits: "<span style='color:red'>please enter a valid number</span>",
				required: "<span style='color:red'>please enter your postcode</span>",

			},
		},
		submitHandler: submitParRegistration
	});
	/* validation */

	/* participant registration submit */
	function submitParRegistration() {
		var data = $("#participant_registration").serialize();

		$.ajax({

			type: 'POST',
			url: '../controller/registration_process.php',
			data: data,
			beforeSend: function() {
				console.log(data);
				$("#error").fadeOut();
				$("#p-reg-btn").val('registring...');
			},
			success: function(response) {
				console.log(response);
				if (response == "ok") {
					$("#p-reg-btn").val('You are now registered, please wait...');
					setTimeout(' window.location.href = "index_participant.php"; ', 4000);
				} else {
					console.log('notokay');
					$("#error").fadeIn(1000, function() {
						$("#error").html('<div class="alert alert-danger">' + response + ' </div>');
						$("#p-reg-btn").val('Register');
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
	/*participant registration submit */	
	
	/* update validation */
	$("#participant_update").validate({
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
		},
		date_of_birth: {
			required: true,
			date: true,
		},
		number_of_children: {
			required: true,
			digits: true,
		},
		postcode: {
			required: true,
			digits: true,
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
		},
		date_of_birth: {
			required: "<span style='color:red'>please enter your birthday</span>",
			date: "<span style='color:red'>please enter a valid date</span>",
		},
		number_of_children: {
			required: "<span style='color:red'>please put 0 if you dont have any children</span>",
			digits: "<span style='color:red'>please enter a valid number</span>",
		},
		postcode: {
			digits: "<span style='color:red'>please enter a valid number</span>",
			required: "<span style='color:red'>please enter your postcode</span>",

		},
	},
	submitHandler: submitParUpdate
});
/* validation */

/* participant update submit */
function submitParUpdate() {
	var data = $("#participant_update").serialize();

	$.ajax({

		type: 'POST',
		url: '../controller/par_update_process.php',
		data: data,
		beforeSend: function() {
			console.log(data);
			$("#error").fadeOut();
			$("#p_up_btn").val('Updating...');
		},
		success: function(response) {
			console.log(response);
			if (response == "ok") {
				$("#p_up_btn").val('You have updated your profile, please wait...');
				setTimeout(' window.location.href = "index_participant.php?pageid=profile&paction=view"; ', 2000);
			} else {
				console.log('notokay');
				$("#error").fadeIn(1000, function() {
					$("#error").html('<div class="alert alert-danger">' + response + ' </div>');
					$("#p_up_btn").val('Update');
				});
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			console.log(xhr.status);
			console.log(thrownError);
		}
	});
}
/*participant update submit */
</script>