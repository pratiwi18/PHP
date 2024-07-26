<?php	
	// This is for searching a participant
	if((isset($_GET['sfield'])&&!empty($_GET['sfield'])) ){
		$sfield = $_GET['sfield'];
		// first name selected
		if($sfield=='fn'){
			$fnfield = 'selected';
			$lnfield = '';
			$pifield = '';
			// last name selected
		}elseif($sfield=='ln'){
			$lnfield = 'selected';
			$fnfield = '';
			$pifield = '';
			//participant id selected
		}elseif($sfield=='pi'){
			$pifield = 'selected';
			$fnfield = '';
			$lnfield = '';
		}else{
			$fnfield = '';
			$lnfield = '';
			$pifield = '';
		}
	}else{
		$fnfield = '';
		$lnfield = '';
		$pifield = '';
	}
	if((isset($_GET['svalue'])&&!empty($_GET['svalue'])) ){
		$svalue = $_GET['svalue'];
	}else{
		$svalue = '';
	}
?>
<div class="container">
	<a class="btn btn-outline-primary" href="<?php echo ROOT_DIR."?pageid=home"?>">&laquo Back</a>
	<br>
	<br>
</div>
<div class="container">
	<p><b>Please search the participant from the participant list</b></p>
<form class="form-inline mt-2 mt-md-0" method="get">
         <input type="hidden" value="participant_main" name="pageid">
            <select class="form-control mr-2" name="sfield">
              <option <?php echo $fnfield ; ?> value="fn">First name</option>
              <option <?php echo $lnfield ; ?> value="ln">Last name</option>
              <option <?php echo $pifield ; ?> value="pi">Participant ID</option>
            </select>
          <input class="form-control mr-sm-2" type="text" placeholder="Search" name="svalue" aria-label="Search" value="<?php echo $svalue ; ?>">
          <input class="btn btn-outline-success" role="button" type="submit" value="Search">
</form>
</div>

<?php
// If a search has been requested
if((isset($_GET['svalue'])&&!empty($_GET['svalue'])) ){
	// Only searches for the first and last name and ID
	$svalue = strtolower($_GET['svalue']);
	$sfield = $_GET['sfield'];
	if($sfield=='fn'){
		$sql = "SELECT * FROM participant WHERE first_name LIKE N'%{$svalue}%'";
		$participants = participant::find_by_sql($sql);
	}elseif($sfield=='ln'){
		$sql = "SELECT * FROM participant WHERE last_name LIKE N'%{$svalue}%'";
		$participants = participant::find_by_sql($sql);
	}else{
		$svalue = (int)$svalue;
		$sql = "SELECT * FROM participant WHERE participantid=$svalue";
		$participants = participant::find_by_sql($sql);
	}
}
// If no search has been requested it will load all the participants
else{
	if(isset($_POST['columnName'])&&isset($_POST['ssort'])){
		$columnName = $_POST['columnName'];
		$ssort = $_POST['ssort'];
	}else{
		$columnName='register_date';
		$ssort='DESC';
	}
	$sql = "SELECT * FROM participant ORDER BY ".$columnName." ".$ssort.", participantid DESC ";
	$participants = participant::find_by_sql($sql);
}
?>

	<div class="row">
		<div id="#demo-order-list" class="col-sm-12 ml-sm-auto col-md-12 pt-5">
			<input type='hidden' id='ssort' name="ssort" value='desc'>
			<table id='parTable' class="table table-hover text-center tablesorter">
				<thead>
					<tr>
						<th class="text-center">Id</th>
						<th class="text-center">First Name</th>
						<th class="text-center">Last Name</th>
						<th class="text-center">Gender</th>
						<th class="text-center">Age</th>
						<th class="text-center">Current stage</th>
						<th class="text-center">Register date</th>
						<th class="text-center">View</th>
						<th class="text-center">Modify</th>
					</tr>
				</thead>
				<tbody>

<?php
	foreach($participants as $participant){	
	$participantSOC = participantSOC::find_by_pid($participant->participantid);
	if(!empty($participantSOC)){
		$currentStage = $participantSOC->current_stage;
		$previousStage= $participantSOC->previous_stage;
	}else{
		$currentStage = "NDA";
		$previousStage= "NDA";
	}
?>
						<tr>
							<th scope="row">
								<?php echo $participant->participantid ?>
							</th>
							<td>
								<?php echo $participant->first_name ?>
							</td>
							<td>
								<?php echo $participant->last_name ?>
							</td>
							<td>
								<?php echo $participant->gender ?>
							</td>
							<td>
								<?php echo $participant->age ?>
							</td>
							<td>
								<?php echo $currentStage; ?>
							</td>
							<td>
								<?php echo $participant->register_date?>
							</td>
							<td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=view&pid=".$participant->participantid;?>" class="btn btn-outline-info btn-sm" role="button">View</a></td>
							<td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=update&pid=".$participant->participantid;?>" class="btn btn-outline-primary btn-sm" role="button">Update</a></td>
							<!--td>
								<!--button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal< ?php echo $participant->participantid;?>" data-whatever="@< ?php echo $participant->participantid?>">
  		Delete</button-->
								<!--Modal-->
								<!--div class="modal fade" id="modal< ?php echo $participant->participantid;?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel< ?php echo $participant->participantid ?>" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="modalLabel< ?php echo $participant->participantid?>">Delete</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
											</div>
											<div class="modal-body">
												Are you sure you want to delete parcipant number
												< ?php echo $participant->participantid?>?
											</div>
											<div class="modal-footer">
												<form method="post" id="delete_par_form< ?php echo $participant->participantid;?>" action="< ?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];?>">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
													<button type="submit" class="btn btn-primary" name="go_delete_par">Yes</button>
													<input type="hidden" value="< ?php echo $participant->participantid;?>" name="participantid">
												</form>
											</div>
										</div>
									</div>
								</div>
							</td-->
						</tr>
						<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
<script>
$('document').ready(function(){
	$('#parTable').tablesorter({widgets: ['zebra']});
});
/*$("#delete_par_form<!--?php echo $participant->participantid;?>").validate({
		submitHandler: submitDeletePar
	});
	function submitDeletePar() {
		var data=$("#delete_par_form").serialize();
		$.ajax({
			type: 'POST',
			url: '../controller/delete_process.php',
			data: data,
			beforeSend: function() {
				console.log(data);
			},
			success: function(response) {
				console.log(response);
				if (response == "ok") {
					setTimeout(' window.location.href = "index.php?pageid=participant_modify"; ', 4000);
				} else {
					alert(response);
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				console.log(xhr.status);
				console.log(thrownError);
			}
		});
	}*/
</script>