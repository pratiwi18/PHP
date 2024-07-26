<?php
	if(isset($_GET['pid'])&&!empty($_GET['pid']))
		$pid = $_GET['pid'];
?>

<body>
	<form method="post" id="msg-form">
		<input type="hidden" name="msgtype" id="msgtype"
					 value="<?php if(isset($_GET['msgtype'])&&!empty($_GET['msgtype']))
													echo $_GET['msgtype'];
												else echo "Unknown";?>">
		<input type="hidden" name="msgid" id="msgid"
					 value="<?php if(isset($_GET['msgid'])&&!empty($_GET['msgid']))
													echo $_GET['msgid'];
												else echo 0;?>">
		<h5><b>Send <font color="blue"><?php if(isset($_GET['msgtype'])&&!empty($_GET['msgtype'])) echo $_GET['msgtype']; ?></font> to Id:
			<font color="red"><?php if(isset($_GET['pid'])&&!empty($_GET['pid']))
							echo $_GET['pid']; else echo "Broadcast"; ?></font></b></h5>
		<input type="hidden" name="idmsgbox" id="idmsgbox"
					 value="<?php if(isset($_GET['pid'])&&!empty($_GET['pid']))
													echo $_GET['pid'];
									else echo 0;?>">
		<br>
		<p><b>Input information here:</b></p>
		<textarea class="col-md-12 text-left" name="msgbox" id="msgbox" rows="8" cols="50" placeholder="Input your message here"></textarea>
		<div class="form-group text-center ">
			<input class="btn btn-primary col-md-2" type="submit" value="Send" name="send_message" id="send_button">
			<input class="btn btn-danger col-md-2" type="reset" value="Clear" name="clear_message" id="clear_button">
		</div>
	</form>
</body>

<script>
	$(document).ready(function() {
		$("#msg-form").validate({
		rules: {
			/*idmsgbox: {
				required: true,
				remote: {
					url: "../controller/check_participant.php",
					type: "POST",
					data: {
						idmsgbox: function() {
							return $("#idmsgbox").val();
						}
					},
				},
			},*/
			msgbox: {
				required: true,
			},
		},
		messages: {
			/*idmsgbox: {
				required: "<span style='color:red'>please enter participant id</span>",
				remote: "<span style='color:red'>This participant id does not exist</span>"
			},*/
			msgbox: "<span style='color:red'>please enter messages</span>"
		},
		submitHandler: submitSend
		});

		function submitSend() {
			var data = $('#msg-form').serialize();
			$.ajax({
				type: "POST",
				url: "../controller/send_message.php",
				data: data,
				beforeSend: function() {
					console.log(data);
					$("#error").fadeOut();
					$("#send_button").val('sending...');
				},
				success: function(response) {
					if (response == "send message success") {
						$("#send_button").val('Successfully send...');
						setTimeout(' window.location.href = ""; ', 4000);
					} else {
							console.log('notokay');
							alert(response);
							$("#send_button").val('Send');
							$("#error").fadeIn(1000, function() {
								$("#error").html('<div class="alert alert-danger">' + response + ' </div>');
							});
						}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					console.log(xhr.status);
					console.log(thrownError);
					$("#send_button").val('Send');
				}
			});
			console.log('false');
			return false;
		}
	});
</script>