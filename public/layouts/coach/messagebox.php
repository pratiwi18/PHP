<style>
td {
    text-align: center;
    max-width: 50px;
    word-wrap: break-word;
}
</style>
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
	<a class="btn btn-outline-info" href="<?php echo ROOT_DIR."?pageid=home"?>">&laquo Back</a>
  <br>
  <br>
</div>
<div class="container">
	<p><b>Please search the message from a specific participant</b></p>
<form class="form-inline mt-2 mt-md-0" method="get">
         <input type="hidden" value="messagebox" name="pageid">
            <select class="form-control mr-2" name="sfield">
              <option <?php echo $fnfield ; ?> value="fn">Name</option>
              <!--option < ?php echo $lnfield ; ?> value="ln">Last name</option-->
              <option <?php echo $pifield ; ?> value="pi">ParticipantId</option>
            </select>
          <input class="form-control mr-sm-2" type="text" placeholder="Search" name="svalue" aria-label="Search" value="<?php echo $svalue ; ?>">
          <input class="btn btn-outline-success" role="button" type="submit" value="Search">
</form>
</div>
<?php
require_once('../includes/session.php');
require_once('../includes/message.php');
require_once('../includes/coach.php');
global $session;

$toid = $session->coachid;
// If a search has been requested
if((isset($_GET['svalue'])&&!empty($_GET['svalue'])) ){
	// Only searches for the first and last name and ID
	$svalue = strtolower($_GET['svalue']);
	$sfield = $_GET['sfield'];
	if($sfield=='fn'){
		$sql = "SELECT * FROM message WHERE first_name LIKE N'%{$svalue}%'";
		$messages = message::find_by_sql($sql);
	}elseif($sfield=='ln'){
		$sql = "SELECT * FROM message WHERE last_name LIKE N'%{$svalue}%'";
		$messages = message::find_by_sql($sql);
	}else{
		$svalue = (int)$svalue;
		$sql = "SELECT * FROM message WHERE type=10 and fromid=$svalue or type=0 and toid=$svalue";
		$messages = message::find_by_sql($sql);
	}
}
// If no search has been requested it will load all the participants
else{
	$sql = "SELECT * FROM message WHERE type=10 or type=0 ORDER BY messageid DESC";
	$messages = message::find_by_sql($sql);
}
?>
	<div class="row">
		<div id="addButton" class="col-sm-12 ml-sm-auto col-md-12 pt-5 text-center">
			<p>All messages</p>
		</div>

		<div id="#demo-order-list" class="col-sm-12 ml-sm-auto col-md-12 pt-5">
			<table id='empTable' class="table table-hover text-center">
				<thead>
					<tr>
						<th class="text-center">ParticipantId</th>
						<th class="text-center">Name</th>
						<th class="text-center">Message</th>
						<th class="text-center">Date</th>
						<th class="text-center">Status</th>
						<th class="text-center">Read</th>
					</tr>
				</thead>
				<tbody>
	<?php
		foreach($messages as $message){	
	?>
						<tr>
							<td>
								<?php if($message->type==0) echo $message->toid;
										else echo $message->fromid;?>
							</td>
							<td>
								<?php echo $message->first_name?>
							</td>
							<td>
								<?php echo $message->content?>
							</td>
							<td>
								<?php echo $message->send_date?>
							</td>
							<td>
								<?php if($message->type==0) echo "Sent"; else if($message->isread==0) echo "New"; else if($message->isread==1) echo "Read";
								else echo "Replied" ?>
							</td>
							<td>
								<?php if($message->type==10) {?>
									<a class="btn btn-outline-info" href="<?php echo ROOT_DIR."?pageid=read_message&msgtype=msg&msgid=".$message->messageid."&pid=".$message->fromid ?>">Read</a>
								<?php }?>
							</td>
						</tr>
						<?php }	?>
				</tbody>
			</table>
		</div>
	</div>
<script>
$('document').ready(function(){
	$('#empTable').tablesorter({widgets: ['zebra']});
});
</script>