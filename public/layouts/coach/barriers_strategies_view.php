<?php
if(isset($_GET['pid'])&&!empty($_GET['pid'])){
	$participantid = $_GET['pid'];
}else{
	global $session;
	$participantid = $session->participantid;
}
$sql = "SELECT * FROM participant_strategy WHERE participantid={$participantid} AND submitted=1 LIMIT 1";
$participantSTRA = array_shift(participantSTRA::find_by_sql($sql));
?>

<?php
if(empty($participantSTRA)){
	echo "No barriers selected";
	//include_layout_template('coach/impairments_barriers_strategies.php');
}else{
	//print_r($participantSTRA);
	# Finding the right barrier mapping
	global $database;
	$sql_stramap = "SELECT * FROM strategy_mapping WHERE smid={$participantSTRA->smid} LIMIT 1";
	$result_set_stramap = $database->query($sql_stramap);
	$row_stramap = $database->fetch_array($result_set_stramap);
	if(!empty($row_stramap)){
		$bar_des = barriers::find_by_id($row_stramap['bar_id']);
		//print_r($bar_des);
	}
	$strategy = strategy::find_by_id($participantSTRA->stra_id);
	# Finding the right goal mapping
					$sql_goalmap = "SELECT * FROM goal_mapping WHERE bar_id='{$bar_des->bar_id}' AND stra_id ='{$strategy->stra_id}' LIMIT 1";
					$result_set_goalmap = $database->query($sql_goalmap);
					$row_goalmap = $database->fetch_array($result_set_goalmap);
					if(!empty($row_goalmap)){
						//$goal_id  = $row_goalmap['goal_id'];
						//$goal = goal::find_by_id($goal_id);
					}
	?>
    <div class="mb-3 row">
    <div class="col-md-12">
   <h5> Barrier: </h5>
    </div>
  	<div class="col-md-12">
  <?php echo $bar_des->bar_des ?>
  </div>
  </div>
  
  <div class="mb-3 row">
    <div class="col-md-12">
   	<h5> Strategy: </h5>
    </div>
  	<div class="col-md-12">
  	<?php echo $strategy->stra_des; ?>
  	</div>
  </div>
  
   <!--div class="mb-3 row">
    <div class="col-md-12">
   <h5> Goal: </h5>
    </div>
  	<div class="col-md-12">
  <  ?php echo  $goal->goal_des; ?>
  </div>
  </div>
  <!--form method="post" action="">
  <button type="submit" class="btn btn-danger btn-sm" name="delete_stra">
  		Delete</button>
        <input class="form-check-input" type="hidden" name="participantid" id="participantid" value="< ?php echo $participantid; ?>">
        <input class="form-check-input" type="hidden" name="stra_id" id="stra_id" value="< ?php echo $participantSTRA->stra_id; ?>">
        <input class="form-check-input" type="hidden" name="smid" id="smid" value="< ?php echo $participantSTRA->smid; ?>">
</form-->
<?php } ?>