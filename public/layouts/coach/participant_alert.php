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
         <input type="hidden" value="participant_alert" name="pageid">
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
						<th class="text-center">Send</th>
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
							<td>
								<form method="get">
         					<input type="hidden" value="message" name="pageid">
									<input type="hidden" value="alert" name="msgtype">
            			<input type="hidden" name="pid" value="<?php echo $participant->participantid?>">
          				<input class="btn btn-outline-warning btn-sm" type="submit" value="Alert">
								</form>
							</td>
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
</script>