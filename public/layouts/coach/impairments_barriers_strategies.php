<?php
	global $database;
	$counter = 0;
	$sql_barmap = "SELECT * FROM barriers_mapping";
	$result_set = $database->query($sql_barmap);
	while ($row1 = $database->fetch_array($result_set)) {
		echo $counter."<br>";
		$counter++;
		$imp_cat_ids = explode(",", $row1['imp_cat_ids']);
		echo "rules: <br> Stage -> ".$row1['current_stage']."<br>";
		
		foreach($imp_cat_ids as $imp_cat_id){
			$sql_impdes = "SELECT imp_cat_des FROM impairments_cat WHERE imp_cat_id='{$imp_cat_id}'";
			$result_set2 = $database->query($sql_impdes);
			while ($row2 = $database->fetch_array($result_set2)) {
				echo "Impairment cat id: ".$imp_cat_id." || Impairment des: ".$row2['imp_cat_des']."<br>";
			}
		}
		
		echo "Results: <br>";
		$bar_ids = explode(",", $row1['bar_ids']);
		
		foreach($bar_ids as $bar_id){
			
			$sql_bardes = "SELECT bar_des FROM barriers WHERE bar_id='{$bar_id}'";
			$result_set3 = $database->query($sql_bardes);
			while ($row3 = $database->fetch_array($result_set3)) {
				echo "barrier id: ".$bar_id." || barrier des: ".$row3['bar_des']."<br>";
			}
			
			$sql_stramap = "SELECT stra_ids FROM strategy_mapping WHERE bar_id='{$bar_id}'";
			$result_set4 = $database->query($sql_stramap);
			while ($row4 = $database->fetch_array($result_set4)) {
				$stra_ids = explode(",", $row4['stra_ids']);
				foreach($stra_ids as $stra_id){
					$sql_stra = "SELECT stra_des FROM strategy WHERE stra_id='{$stra_id}'";
					$result_set5 = $database->query($sql_stra);
					while ($row5 = $database->fetch_array($result_set5)) {
						echo "strategy id: ".$stra_id." || strategy des: ".$row5['stra_des']."<br>";
					}
				}
			}
			
		}
		
		 echo "<hr>";
	}
 if(isset($_GET['pid'])&&!empty($_GET['pid'])){
		$participantid = $_GET['pid'];
 }else{
	global $session;
	// Loading a participant based on participant session
	$participantid = $session->participantid;
 }
 # Impairment list for a participant
 $participantIMPs = participantIMP::find_by_pid($participantid);
 # current stage for a participant
 $participantSOC = participantSOC::find_by_pid($participantid);

 
 
 ##### Impairment section
 $parImpIds = array();
 $impairments = impairments::find_all();
 if(!empty($participantIMPs)){
	 foreach($participantIMPs as $participantIMP){
		 array_push($parImpIds,$participantIMP->imp_id);
	 }
 }


#### Barrier section
#Making sure participant has select impairments
if(!empty($participantIMPs)){
	#Making sure participant has filled out stage of change
	if(!empty($participantSOC)){
		$barMessage = "";
		#Finding impairments categories
		$parImpCats = array();
		foreach($participantIMPs as $participantIMP){
			$imp_cat = impairments::find_by_id($participantIMP->imp_id);
			if (!in_array($imp_cat->imp_cat_id, $parImpCats)) 
			{ 
				array_push($parImpCats,$imp_cat->imp_cat_id);
			}
			
		}
		sort($parImpCats);
/*		$deleteImps = array_diff($test, $parImpCats);
		print_r($parImpCats);*/
		#Creating a string of impairment categories to be used for finding the right rule
		$parImpCatStr = "";
		for($counter=0;$counter<count($parImpCats);$counter++){
			if($counter>0){
				$parImpCatStr .= ",";
			}
			$parImpCatStr .= $parImpCats[$counter];
		}
	/*	echo $parImpCatStr;
		echo "<br>";
		echo $participantSOC->current_stage;
		echo "<br>";*/
		global $database;
		
		#barrier_mapping class is needed instead of the query
		# Finding the right barrier mapping
		$sql_barmap = "SELECT * FROM barriers_mapping WHERE current_stage='{$participantSOC->current_stage}' AND  imp_cat_ids='{$parImpCatStr}' LIMIT 1";
		$result_set = $database->query($sql_barmap);
		$row = $database->fetch_array($result_set);
		#if there is any rule
		if(!empty($row)){
			#Finding the right barriers for that rule 
			$barIdsArr = explode(",", $row['bar_ids']);
			$barriers = array();
			foreach($barIdsArr as $barId){
				array_push($barriers,barriers::find_by_id($barId));
			}
			$bmid = $row['bmid'];
		#if there is no rule
		}else{
			$barMessage = "No rule has been found";
		}
		
	}else{
		$barMessage = "First fill out stage of change questionnaire"; 
	}
}else{
	$barMessage = "First select your impairments"; 
}
 # Barrier list for a participant						
if(isset($bmid)){
	$sql = "SELECT * FROM participant_barrier WHERE participantid={$participantid} AND bmid={$bmid}" ;
	$participantBARs = participantBAR::find_by_sql($sql);
}



#### Strategy section
if(isset($participantBARs)&&!empty($participantBARs)){
	$sql = "SELECT * FROM participant_barrier WHERE participantid={$participantid} AND bmid={$bmid} AND selected ='2' LIMIT 1" ;
	$participantBAR = array_shift(participantBAR::find_by_sql($sql));
	if(!empty($participantBAR)){
		$participantBAR_des = barriers::find_by_id($participantBAR->bar_id);
		/*$test1= $participantBAR->bmid;
		$test2= $participantBAR->bar_id;
		$test3= $participantBAR->bar_prority;*/
		
		#strategy_mapping class is needed instead of the query
		# Finding the right strategy mapping
		$sql_stramap = "SELECT * FROM strategy_mapping WHERE bar_id ='{$participantBAR->bar_id}' LIMIT 1";
		$result_set_stramap = $database->query($sql_stramap);
		$row_stramap = $database->fetch_array($result_set_stramap);
		#if there is any rule
		if(!empty($row_stramap)){
			#Finding the right strategy for that rule 
			$smid = $row_stramap['smid'];
			$straIdsArr = explode(",", $row_stramap['stra_ids']);
			$strategies = array();
			/*while(!empty($straIdsArr)){
				$straId = array_shift($straIdsArr);
			}*/		
			
			#First check for sequential strategies
			foreach($straIdsArr as $straId){
				array_push($strategies,strategy::find_by_id_SS($straId));
			}
			#IF there was no SS find NSS 
			if(empty($strategies[0])){
				$strategies = array();
				foreach($straIdsArr as $straId){
					array_push($strategies,strategy::find_by_id_NSS($straId));
				}
			}
			if(!empty($strategies[0])){
				while(!empty($strategies)){
					$strategy = array_shift($strategies);
					$stra_exists = participantSTRA::find_by_all($participantid,$smid,$strategy->stra_id);
					if(empty($stra_exists)){
						break;
					}else{
						unset($strategy);
					}
				}
				if(isset($strategy) && !empty($strategy)){
					# Finding the right goal mapping
					$sql_goalmap = "SELECT * FROM goal_mapping WHERE bar_id='{$participantBAR->bar_id}' AND stra_id ='{$strategy->stra_id}' LIMIT 1";
					$result_set_goalmap = $database->query($sql_goalmap);
					$row_goalmap = $database->fetch_array($result_set_goalmap);
					if(!empty($row_goalmap)){
						//$goal_id  = $row_goalmap['goal_id'];
						//$goal = goal::find_by_id($goal_id);
					}else{
						$straMessage = "No goal mapping has been found";
					}
				}else{
					$straMessage = "No strategy is left";
				}
			}else{
				$straMessage = "No strategy is left";
			}
		#if there is no rule
		}else{
			$straMessage = "No rule has been found";
		}
	}else{
		$straMessage = "No barrier is left"; 
	}
	
}else{
	$straMessage = "First prioritize and save your barriers"; 
}

?>

<div class="row mb-5">
        	<div class="col-md-12">
                <div class="card">
                  <h4 class="card-header">
                    Impairment Information
                  </h4>
                  <div class="card-body">
					<form method="post" action="">
<?php
	foreach($impairments as $impairment){
?>
                <div class="form-check">
                    <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="impairments[]" id="impairments" value="<?php echo $impairment->imp_id; ?>" <?php if (in_array($impairment->imp_id, $parImpIds)) { echo "checked";} ?> >
                    <?php echo $impairment->imp_des; ?>
                    </label>
                </div>     
                <?php } ?>
             <input class="btn btn-primary" role="button" type="submit" value="Save" name="save_par_imp" >
             </form>
			</div>
		</div>
	</div>       
</div>
<div class="row mb-5">
        	<div class="col-md-12">
                <div class="card">
                  <h4 class="card-header">
                    Barrier Information
                  </h4>
                  <div class="card-body">
                    
                         
                         <form method="post" action="">
                        
<?php
if(!isset($barMessage) ||empty($barMessage)){
	$rankCounter = 1;
?>
   <h4 class="mb-3"> Please prioritize the barriers (1 has the highest priority) </h4>
   <input class="form-check-input" type="hidden" name="bmid" id="bmid" value="<?php echo $bmid; ?>">
<?php
	foreach($barriers as $barrier){
?>
                <div class="form-check">
                    <label class="form-check-label">
                    <input class="form-check-input" type="hidden" name="barriersId[]" id="barriersId" value="<?php echo $barrier->bar_id; ?>">
  
                    <input type="number" class="form-control-inline mb-sm-1" id="barriersPro" name="barriersPro[]" min="1" max="5" value="<?php 
					if(isset($participantBARs)&&!empty($participantBARs)){
							foreach($participantBARs as $pbar){
								if($pbar->bar_id==$barrier->bar_id && $pbar->bmid==$bmid){
									echo $pbar->bar_prority;
								}
							}
						}else{
							echo $rankCounter;
						}
					?>">
                    <?php echo $barrier->bar_des; ?>
                    </label>
                </div>     
                <?php 
				$rankCounter++;
				} ?>
             <input class="btn btn-primary" role="button" type="submit" value="Save" name="save_par_bar" >
             </form>
<?php 

}else{
	echo '<div class="alert alert-warning" role="alert">'.$barMessage.'</div>';
}?>                        
                  </div>
                </div>
            </div>

</div>
<div class="row mb-5">
        	<div class="col-md-12">
                <div class="card">
                  <h4 class="card-header">
                    Strategy Selection
                  </h4>
                  <div class="card-body">
                    
<?php
if(!isset($straMessage) || empty($straMessage)){
?>
   <form method="post" action="">
  <div class="mb-3 row">
    <div class="col-md-12">
   <h5> Barrier: </h5>
    </div>
  	<div class="col-md-12">
  <?php echo $participantBAR_des->bar_des ?>
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
  
   <div class="mb-3 row">
    <div class="col-md-12">
   <h5> Goal: </h5>
    </div>
  	<div class="col-md-12">
  <?php //echo  $goal->goal_des; ?>
  </div>
  </div>
<?php		
		/*echo $strategy->stra_id."<br>";
		echo $strategy->stra_des."<br>";
		echo $strategy->stra_type."<br>";
		echo $goal->goal_des."<br>";*/
		if(empty($strategies[0])){
			$stra_count = 0;
		}else{
			$stra_count = count($strategies);
		}
		//echo $stra_count."<br>";
		
?>
<input class="form-check-input" type="hidden" name="bar_id" id="bar_id" value="<?php echo $participantBAR->bar_id; ?>">
<input class="form-check-input" type="hidden" name="bmid" id="bmid" value="<?php echo $bmid; ?>">

<input class="form-check-input" type="hidden" name="stra_id" id="stra_id" value="<?php echo $strategy->stra_id; ?>">
<input class="form-check-input" type="hidden" name="smid" id="smid" value="<?php echo $smid; ?>">

<input class="form-check-input" type="hidden" name="stra_count" id="stra_count" value="<?php echo $stra_count; ?>">

<div class="mb-3 row text-center">
    <div class="col-md-12">
<input class="btn btn-success" role="button" type="submit" value="Accept" name="stra_accept" >
<input class="btn btn-danger" role="button" type="submit" value="Reject" name="stra_reject" >
</div>
</div>
   </form>
<?php 

}else{
	echo '<div class="alert alert-warning" role="alert">'.$straMessage.'</div>';
}?>  
                        
                  </div>
                </div>
            </div>

</div>
