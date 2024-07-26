<?php
if(isset($_GET['pid'])&&!empty($_GET['pid'])&&isset($_GET['paction'])&&!empty($_GET['paction'])){
	// Loading the participant data
	$participantid = $_GET['pid'];
	$participant = participant::find_by_id($participantid);
	$participantSOC = participantSOC::find_by_pid($participantid);
	if(!empty($participantSOC)){
		$currentStage = $participantSOC->current_stage;
		$previousStage= $participantSOC->previous_stage;
	}else{
		$currentStage = "NDA";
		$previousStage= "NDA";
	}
}
?>

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
       Diagnosis
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
       <?php if(!empty($participant->postcode)){ echo $participant->postcode; }else{ echo "No data available"; } ?>
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
   <!--div class="row mb-3 justify-content-md-center">
		< ?php if($_GET['paction']=='update') {?>
    <div class="col-md-auto">
			<a href="< ?php echo ROOT_DIR."?pageid=participant&paction=update&pid=".$participant->participantid;?>" class="btn btn-outline-primary" role="button">Update</a>
    </div>
		 < ?php } ?>
    <div class="col-md-auto">
<!--button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#modal< ?php echo $participant->participantid; ?>" data-whatever="@< ?php echo $participant->participantid ?>">
  		Delete</button-->
        <!-- Modal -->
        <!---div class="modal fade" id="modal< ?php echo $participant->participantid;?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel< ?php echo $participant->participantid ?>" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalLabel< ?php echo $participant->participantid ?>">Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               Are you sure you want to delete parcipant number < ?php echo $participant->participantid ?>?
              </div>
              <div class="modal-footer">
              <form method="post"  action="< ?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="go_delete_par">Yes</button>
                <input type="hidden" value="< ?php echo $participant->participantid; ?>" name="participantid">
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div-->
</div>