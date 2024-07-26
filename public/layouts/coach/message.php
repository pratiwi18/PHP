<div class="container">
	<a class="btn btn-outline-primary" href="
<?php if(isset($_GET['paction'])&&!empty($_GET['paction']))
	echo ROOT_DIR."?pageid=participant&paction=".$_GET['paction']."&pid=".$_GET['pid'];
	else{
		 if($_GET['msgtype']=="alert") echo ROOT_DIR."?pageid=participant_alert"; 
		 else if($_GET['msgtype']=="msg") echo ROOT_DIR."?pageid=participant_message";
		 else echo ROOT_DIR."?pageid=home";
	}?>">&laquo Back</a>
	<br>
	<br>
</div>
<?php
	include_layout_template('forms/messages.php');	
?>