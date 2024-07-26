<?php

global $session;
// Loading a participant based on participant session
$participantid = $session->participantid;
$participant = participant::find_by_id($participantid);
$participantSOC = participantSOC::find_by_pid($participantid);
if(!empty($participantSOC)){
	$currentStage = $participantSOC->current_stage;
	$previousStage= $participantSOC->previous_stage;
}else{
	$currentStage = "NDA";
	$previousStage= "NDA";
}
?>


<div class="card alert alert-info">
  <div class="card-body">
    <div class="row">
    <div class="col-md-2">
    	<strong>
      Participant ID:
      </strong> 
        <?php if(!empty($participant->gender)){ echo $participant->participantid; }else{ echo "No data available"; } ?>
    </div>
    <div class="col-md-4">
    	<strong>
      Full name:
      </strong> 
       <?php if(!empty($participant->full_name())){ echo $participant->full_name(); }else{ echo "No data available"; } ?>
    </div>
    
    <div class="col-md-3">
    	<strong>
      Current stage: 
      </strong> 
       <?php echo $currentStage;?>
    </div>
    <div class="col-md-3">
    	<strong>
      Previous stage: 
      </strong> 
       <?php echo $previousStage;?>
    </div>
  </div>
  </div>
</div>

<div class="jumbotron mt-4">
 <div class="row mb-3">
    <div class="col-md-3">
    	<strong>
    	Full name:
      </strong> 
       <?php if(!empty($participant->full_name())){ echo $participant->full_name(); }else{ echo "No data available"; } ?>
      
    </div>
    <div class="col-md-2">
    	<strong>
      Gender: 
      </strong> 
        <?php if(!empty($participant->gender)){ echo $participant->gender; }else{ echo "No data available"; } ?>
    </div>
    <div class="col-md-4">
    	<strong>
      Current stage: 
      </strong> 
       <?php echo $currentStage;?>
    </div>
    <div class="col-md-3">
    	<strong>
       Diagnosis:
      </strong> 
       <?php echo$participant->diagnosis;?>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-md-5">
    	<strong>
      Email address:
      </strong> 
       <?php if(!empty($participant->email)){ echo $participant->email; }else{ echo "No data available"; } ?>
    </div>
    <div class="col-md-4">
    	<strong>
      Date of birth: 
      </strong> 
        <?php if(!empty($participant->date_of_birth)){ echo $participant->date_of_birth; }else{ echo "No data available"; } ?>
    </div>
    <div class="col-md-3">
    	<strong>
      Age: 
      </strong> 
        <?php if(!empty($participant->age)){ echo $participant->age; }else{ echo "No data available"; } ?>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-md-5">
    	<strong>
      Maritial Status:
      </strong> 
      <?php if(!empty($participant->marital_status)){ echo $participant->marital_status; }else{ echo "No data available"; } ?>
    </div>
    <div class="col-md-4">
    	<strong>
      Number of children: 
      </strong> 
      <?php if(!empty($participant->number_of_children)){ echo $participant->number_of_children; }else{ echo "No data available"; } ?>
    </div>
    <div class="col-md-3">
    	<strong>
      Post code: 
      </strong> 
       <?php if(!empty($participant->post_code)){ echo $participant->post_code; }else{ echo "No data available"; } ?>
    </div>
  </div>
   <div class="row mb-3">
    <div class="col-md-5">
    	<strong>
      Education:
      </strong> 
      <?php if(!empty($participant->education)){ echo $participant->education; }else{ echo "No data available"; } ?>
    </div>
    <div class="col-md-7">
    	<strong>
      Employment: 
      </strong> 
      <?php if(!empty($participant->employment)){ echo $participant->employment; }else{ echo "No data available"; } ?>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-md-5">
    	<strong>
      Driving:
      </strong> 
      <?php if(!empty($participant->driving)){ echo $participant->driving; }else{ echo "No data available"; } ?>
    </div>
    <div class="col-md-7">
    	<strong>
      Distance from University: 
      </strong> 
      <?php if(!empty($participant->distance_from_university)){ echo $participant->distance_from_university; }else{ echo "No data available"; } ?>
    </div>
  </div>
   <div class="row mb-3 justify-content-md-center">
    <div class="col-md-auto">
	<a href="<?php echo ROOT_DIR."?pageid=profile&paction=modify"?>" class="btn btn-outline-primary" role="button">Modify</a>
    </div>
    
  </div>
</div>




