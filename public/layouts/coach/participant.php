<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="js/scripts.js" type="text/javascript"></script>
<script src="js/tether.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/jquery-ui.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script src="js/validation.min.js" type="text/javascript"></script>
<script src="js/functions.js" type="text/javascript"></script>
<!--div class="container">
	<a class="btn btn-primary" href="<?php echo ROOT_DIR."?pageid=participant_main"?>">Back</a>
</div-->
<?php
	if(isset($_GET['paction'])&&!empty($_GET['paction'])){
		// if a form has been selected to be added or modified, it load the forms page
		if(isset($_GET['faction'])&&!empty($_GET['faction'])){
			include_layout_template('coach/forms.php');
			// if the page of a particular participant has being selected be to viewd it will load participant_view page
		}
		elseif(isset($_GET['paction'])&&!empty($_GET['paction'])&&isset($_GET['pid'])&&!empty($_GET['pid'])){
			include_layout_template('coach/participant_modify.php');		
		}
		/*elseif($_GET['paction']=='view'&&isset($_GET['pid'])&&!empty($_GET['pid'])){
			include_layout_template('coach/participant_view.php');
			
		}elseif($_GET['paction']=='update'&&isset($_GET['pid'])&&!empty($_GET['pid'])){
			include_layout_template('coach/participant_update.php');
		}*/
		else{
			// Loading participant_main page (it is the page to view all the participants) if nothing else has been requested
			include_layout_template('coach/participant_main.php');
		}
	}else{
		// Loading participant_main page (it is the page to view all the participants) if nothing else has been requested
		include_layout_template('coach/participant_main.php');
	}
?>