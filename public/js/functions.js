// Updating user role in the login page
function updateUserRole() {
	var role_select = document.getElementById("login-role");
	if (role_select.options[role_select.selectedIndex].value == 'Coach') {
		//document.getElementById("user-label").innerHTML = 'Username';
		//document.getElementById("username").setAttribute('placeholder', 'Username');
		//document.getElementById("username").setAttribute('type', 'text');
		//document.getElementById("username").setAttribute('name', 'username');
		document.getElementById("login-button").setAttribute('name', 'coach_login');
	} else {
		//document.getElementById("user-label").innerHTML = 'Email';
		//document.getElementById("username").setAttribute('placeholder', 'Email');
		//document.getElementById("username").setAttribute('type', 'email');
		//document.getElementById("username").setAttribute('name', 'email');
		document.getElementById("login-button").setAttribute('name', 'participant_login');
	}
}


if (document.getElementById("login-role") != null) {
	var role_select = document.getElementById("login-role");
	role_select.addEventListener("change", updateUserRole);
}


// Add and delete row for medication
if (document.getElementById("add_row_medication") != null) {
	var i = parseInt(document.getElementById('add_row_medication').title);
	var j = parseInt(document.getElementById('add_row_surgery').title);
}

$("#add_row_medication").click(function() {
	$('#addr' + i).html("<td>" + (i + 1) + "</td><td><input type='text' class='form-control' name='medication_name" + i + "' placeholder='Medication'></td><td><input type='text' class='form-control' name='reason_taken" + i + "' placeholder='Reason taken'></td><td><div class='form-check form-check'><label class='form-check-label'><input class='form-check-input' type='radio' name='prescription" + i + "' id='prescription" + i + "' value='1'> Yes</label></div><div class='form-check form-check'><label class='form-check-label'><input class='form-check-input' type='radio' name='prescription" + i + "' id='prescription" + i + "' value='0'> No</label></div></td><td><input type='number' class='form-control' name='quantity_taken" + i + "' placeholder='e.g., mg'></td><td><input type='number' class='form-control' name='frequency_taken" + i + "' placeholder='Times per day'></td><td><input type='text' class='form-control' name='period_used" + i + "' placeholder='2-3 days; 1 week'></td>");
	$('#medication-table').append('<tr id="addr' + (i + 1) + '"></tr>');
	i++;
});
$("#delete_row_medication").click(function() {
	if (i >= 1) {
		$("#addr" + (i)).html('');
		$("#addr" + (i - 1)).html('');
		i--;
	}
});

// Add and delete row for surgery
$("#add_row_surgery").click(function() {
	$('#sur_addr' + j).html("<td>" + (j + 1) + "</td><td><input type='text' class='form-control' name='surgery_type" + j + "' placeholder='Surgery Type'></td><td><input type='date' class='form-control' name='surgery_date" + j + "' placeholder='DD/MM/YY'></td><td><input type='text' class='form-control' name='surgery_doctor" + j + "' placeholder='Doctor'></td>");
	$('#surgery-table').append('<tr id="sur_addr' + (j + 1) + '"></tr>');
	j++;
});
$("#delete_row_surgery").click(function() {
	if (j >= 1) {
		$("#sur_addr" + (j)).html('');
		$("#sur_addr" + (j - 1)).html('');
		j--;
	}
});


// makes tabs unclickble
$('#gtky-tabs a').prop('disabled', true);
/* // store the currently selected tab in the hash value
	$("#gtky-tabs a").on("shown.bs.tab", function (e) {
		//alert('id');
	   var id = $(e.target).attr("href").substr(1);
		window.location.hash = id;
	});
	
	// on load of the page: switch to the currently selected tab
	var hash = window.location.hash;
	$('#gtky-tabs a[href="' + hash + '"]').tab('show');*/


// Next button for baseline screening form in getting to know you section
$("#gtky-tabContent .next-forms-bsf").click(function() {
	$("#collapseOne").addClass('show');
	$("#collapseTwo").addClass('show');
	var form = $("#gtky-form");

	form.validate();
	if (form.valid() != false) {
		var data = $("#gtky-form").serialize();


		$.ajax({

			type: 'POST',
			url: '../controller/bsf_alert_process.php',
			data: data,
			beforeSend: function() { //console.log(data);
			},
			success: function(response) {
				//	console.log(response);
				if (response == "<ul></ul>") {

				} else {
					$("#error").fadeIn(0, function() {
						$("#error").html('<div class="alert alert-danger text-left">' + response + ' </div>');

					});
				}

			},
			error: function(xhr, ajaxOptions, thrownError) {
				console.log(xhr.status);
				console.log(thrownError);
			}
		});


		var elem = document.getElementById("progressBar");
		var width = parseInt(elem.style.width);
		elem.style.width = width + 17 + '%';
		next_form = $('#gtky-tabs .active').next();
		var current_form = $('#gtky-tabs .active');
		//console.log(current_form);
		current_form.prop('disabled', false);
		next_form.prop('disabled', false);
		$("#error").fadeOut();
		next_form.tab('show');
	} else {
		$("#error").fadeIn(1000, function() {
			$("#error").html('<div class="alert alert-danger">' + "Please answer all the questions" + ' </div>');
		});
	}
});


// Next button in getting to know you section for other pages except baseline form screening
$("#gtky-tabContent .next-form").click(function() {
	$("#collapse_1").addClass('show');
	var form = $("#gtky-form");
	form.validate({
		rules: {
			soc_q1_current_physically_active: {
				required: true,
			},
			soc_q2_intend_tobe_more_physically_active_next6mth: {
				required: true,
			},
			soc_q3_current_engaged_with_physical_activity: {
				required: true,
			},
			soc_q4_regularly_physically_active_for_past6mth: {
				required: true,
			},
		},
		messages: {
			soc_q1_current_physically_active: {
				required: "<div style='color:red'>Please select one of the options</div>"
			},
			soc_q2_intend_tobe_more_physically_active_next6mth: {
				required: "<div style='color:red'>Please select one of the options</div>"
			},
			soc_q3_current_engaged_with_physical_activity: {
				required: "<div style='color:red'>Please select one of the options</div>"
			},
			soc_q4_regularly_physically_active_for_past6mth: {
				required: "<div style='color:red'>Please select one of the options</div>",
				remote: "<div style='color:red'>Wrong combination of answers, please select another combination</div>"
			},
		},
	});

	form.validate();
	if (form.valid() != false) {
		var elem = document.getElementById("progressBar");
		var width = parseInt(elem.style.width);
		elem.style.width = width + 17 + '%';
		next_form = $('#gtky-tabs .active').next();
		var current_form = $('#gtky-tabs .active');
		//console.log(current_form);
		current_form.prop('disabled', false);
		next_form.prop('disabled', false);
		$("#error").fadeOut();
		next_form.tab('show');
	} else {
		$("#error").fadeIn(1000, function() {
			$("#error").html('<div class="alert alert-danger">' + "Please select at least one of the options" + ' </div>');
		});
	}
	//	console.log($('#gtky-tabs .active').next());
});

// Previous button in getting to know you section
$("#gtky-tabContent .previous-form").click(function() {
	var elem = document.getElementById("progressBar");
	var width = parseInt(elem.style.width);
	elem.style.width = width - 17 + '%';
	previous_form = $('#gtky-tabs .active').prev();
	$("#error").fadeOut();
	previous_form.tab('show');
	//	console.log($('#gtky-tabs .active').next());
});


/* getting to know you section save btn begin */

/*$('.save-gtky').on("click", function () {
    var el = $(this).attr('value');
    var data = $("#gtky-form").serialize() + '&action=' + el;


    $.ajax({

        type: 'POST',
        url: '../controller/gtky_process.php',
        data: data,
        beforeSend: function () {
            console.log(data);
            $("#error").fadeOut();
            $("#error").html('');
            $(".save-gtky").val('Saving...');
        },
        success: function (response) {
            console.log(response);
            if (response == "ok") {
                $("#error").fadeIn(1000, function () {
                    $("#error").html('<div class="alert alert-success">' + "You have successfuly saved" + ' </div>');
                    $(".save-gtky").val('Save');
                });
            }
            else {
                console.log('notokay');
                $("#error").fadeIn(1000, function () {
                    $("#error").html('<div class="alert alert-danger">' + response + ' </div>');
                    $(".save-gtky").val('Save');
                });
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
    console.log('false');
    return false;
});*/


/*$('#gtky-submission').on("click", function () {
    var form = $("#gtky-form");
    form.validate({
        rules:
            {
                soc_q1_current_physically_active: {
                    required: true,
                },
                soc_q2_intend_tobe_more_physically_active_next6mth: {
                    required: true,
                },
                soc_q3_current_engaged_with_physical_activity: {
                    required: true,
                },
                soc_q4_regularly_physically_active_for_past6mth: {
                    required: true,
                },
                impairments: {
                    required: true,
                },
            },
        messages:
            {
                soc_q1_current_physically_active: {
                    required: "<div style='color:red'>Please select one of the options</div>"
                },
                soc_q2_intend_tobe_more_physically_active_next6mth: {
                    required: "<div style='color:red'>Please select one of the options</div>"
                },
                soc_q3_current_engaged_with_physical_activity: {
                    required: "<div style='color:red'>Please select one of the options</div>"
                },
                soc_q4_regularly_physically_active_for_past6mth: {
                    required: "<div style='color:red'>Please select one of the options</div>"
                },
                impairments: {
                    required: "<div style='color:red'>Please select one of the options</div>"
                },
            },
        // submitHandler: gtky_submission
    });
    if (form.valid() != false) {
        var el = $(this).attr('value');
        var data = $("#gtky-form").serialize() + '&action=' + el;

        console.log('hi');
        $.ajax({

            type: 'POST',
            url: '../controller/gtky_process.php',
            data: data,
            beforeSend: function () {
                console.log(data);
                $("#error").fadeOut();
                $("#error").html('');
                $("#gtky-submission").val('Submitting...');
            },
            success: function (response) {
                console.log(response);
                if (response == "ok") {
                    $("#error").fadeIn(1000, function () {
                        $("#error").html('<div class="alert alert-success">' + "You have successfuly finished getting to know you form, please wait" + ' </div>');
                        $("#gtky-submission").val('Please wait');
                    });
                    //$("#error").fadeOut(4000);
                    setTimeout(' window.location.href = "index_participant.php"; ', 4000);
                }
                else {
                    console.log('notokay');
                    $("#error").fadeIn(1000, function () {
                        $("#error").html('<div class="alert alert-danger">' + response + ' </div>');
                        $("#gtky-submission").val('Submit');
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
        console.log('false');
        return false;
    }
    else {
        $("#error").fadeIn(1000, function () {
            $("#error").html('<div class="alert alert-danger">' + "Please select at least one impairment" + ' </div>');
            $("#gtky-submission").val('Submit');
        });
    }
});
*/

// Barriers section save button begin
/*$('#save-bar').on("click", function () {
    var el = $(this).attr('value');
    var data = $("#bar-form").serialize() + '&actionBar=' + el;

    console.log('hi');
    $.ajax({

        type: 'POST',
        url: '../controller/bar_stra_process.php',
        data: data,
        beforeSend: function () {
            console.log(data);
            $("#error").fadeOut();
            $("#error").html('');
            $("#save-bar").val('Saving...');
        },
        success: function (response) {
            console.log(response);
            if (response == "ok") {
                $("#error").fadeIn(1000, function () {
                    $("#error").html('<div class="alert alert-success">' + "You have successfuly saved" + ' </div>');
                    $("#save-bar").val('Save');
                });

            }
            else {
                console.log('notokay');
                $("#error").fadeIn(1000, function () {
                    $("#error").html('<div class="alert alert-danger">' + response + ' </div>');
                    $("#save-bar").val('Save');
                });
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
    console.log('false');
    return false;
});*/
// Barriers section save button end

// Barriers section submit button begin
/*$('#submit-bar').on("click", function () {
    var el = $(this).attr('value');
    var data = $("#bar-form").serialize() + '&actionBar=' + el;

    $.ajax({

        type: 'POST',
        url: '../controller/bar_stra_process.php',
        data: data,
        beforeSend: function () {
            console.log(data);
            $("#error").fadeOut();
            $("#error").html('');
            $("#submit-bar").val('Submitting...');
        },
        success: function (response) {
            console.log(response);
            if (response == "ok") {
                $("#error").fadeIn(1000, function () {
                    $("#error").html('<div class="alert alert-success">' + "You have successfuly submitted, please wait" + ' </div>');
                    $("#submit-bar").val('Please wait');
                });
                //$("#error").fadeOut(4000);
                setTimeout(' window.location.href = "index_participant.php"; ', 4000);
            }
            else {
                console.log('notokay');
                $("#error").fadeIn(1000, function () {
                    $("#error").html('<div class="alert alert-danger">' + response + ' </div>');
                    $("#submit-bar").val('Submit');
                });
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
    console.log('false');
    return false;
});*/
// Barriers section submit button end


// Strategy section submit button begin
/*$("#stra-form").validate({
    rules:
        {
            strategy: {
                required: true,
            },

        },
    messages:
        {
            strategy: {
                required: "<div style='color:red'>Please select one of the options</div>"
            },

        },
    submitHandler: stra_submit
});*/
/* validation */

/* login submit */
/*function stra_submit() {
    var el = $('#submit-stra').attr('value');
    var data = $("#stra-form").serialize() + '&actionStra=' + el;
    ;

    console.log('hi');
    $.ajax({

        type: 'POST',
        url: '../controller/bar_stra_process.php',
        data: data,
        beforeSend: function () {
            console.log(data);
            $("#error").fadeOut();
            $("#error").html('');
            $("#submit-stra").val('Submitting...');
        },
        success: function (response) {
            console.log(response);
            if (response == "ok") {
                $("#error").fadeIn(1000, function () {
                    $("#error").html('<div class="alert alert-success">' + "You have successfuly submitted, please wait" + ' </div>');
                    $("#submit-stra").val('Please wait');
                });
                setTimeout(' window.location.href = "index_participant.php"; ', 2000);
            } else if (response == "okchange") {
                $("#error").fadeIn(1000, function () {
                    $("#error").html('<div class="alert alert-danger">No strategy left, please wait to load another barrier </div>');
                    $("#submit-stra").val('Please wait');
                });
                setTimeout(' window.location.href = "index_participant.php"; ', 2000);
            } else {
                console.log('notokay');
                $("#error").fadeIn(1000, function () {
                    $("#error").html('<div class="alert alert-danger">' + response + ' </div>');
                    $("#submit-stra").val('Submit');
                });
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
}*/

// Strategy section submit button end


// Makes the value identification sortable
$(function() {
	$("#vi-list-1").sortable({
		connectWith: ".connectedSortable",
		placeholder: "ui-state-highlight",
		receive: function(event, ui) {
			// so if > 10
			if ($(this).children().length > 5) {
				//ui.sender: will cancel the change.
				//Useful in the 'receive' callback.
				$(ui.sender).sortable('cancel');
			}
		}
	}).disableSelection();
});


$(function() {
	$("#vi-list-2").sortable({
		connectWith: ".connectedSortable",
		placeholder: "ui-state-highlight",
	}).disableSelection();
});


// Makes the barriers sortable
$(function() {
	$("#bar-list").sortable({
		placeholder: "ui-state-highlight",
		stop: function(event, ui) {
			// alert('test');
			$('#bar-list li span').each(function(i) {
				var humanNum = i + 1;
				$(this).html(humanNum);
			});
		}

	});
	$("#bar-list").disableSelection();
});

// datepicker

/*if ( document.getElementById("date_of_birth") != null) {
	$( function() {
    $( "#date_of_birth" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
    
      $( "#date_of_birth" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
   
  } );
}*/