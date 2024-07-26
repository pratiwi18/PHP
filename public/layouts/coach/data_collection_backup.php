<?php
if(isset($_GET['pid'])&&!empty($_GET['pid'])&&isset($_GET['paction'])&&!empty($_GET['paction'])){
	// Loading the participant data
	$participantid = $_GET['pid'];
	$participant = participant::find_by_id($participantid);
	// Getting All the forms for the participant
	$bsforms = baselineScreeningForm::find_by_pid($participantid);
	$sf12forms = sf12Questionnaire::find_by_pid($participantid);
	$hbqforms = healthBehaviourQuestionnaire::find_by_pid($participantid);
	$socforms = stageOfChange::find_by_pid($participantid);
	$dbforms = decisionalBalance::find_by_pid($participantid);
	$ssforms = socialSupport::find_by_pid($participantid);
	$seqforms = selfEfficacyQuestionnaire::find_by_pid($participantid);
	$dwlforms = difficultyWithLocomotor::find_by_pid($participantid);
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
</div>
<!--Baseline Screening From begins-->
<div class="row justify-content-md-center">
    <div class="col-md-auto">
    <h3>Baseline Screening From</h3>
    </div>
</div>
<div class="row mb-5">
	<div class="col-md-12">
        <table class="table table-hover">
          <thead class="thead-inverse">
            <tr>
              <th>#</th>
              <th>Complete date</th>
              <th>Update</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach($bsforms as $bsform){	
            ?>
            <tr>
              <th scope="row"><?php echo $bsform->bsfid; ?></th>
							<td><?php echo $bsform->complete_date; ?></td>
              <td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=update&pid=".$participant->participantid."&faction=update&fid=bsf&bsfid=".$bsform->bsfid;?>" class="btn btn-outline-primary btn-sm" role="button">Update</a></td>
              <td>
               <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal<?php echo "bsfid".$bsform->bsfid; ?>" data-whatever="@<?php echo "bsfid".$bsform->bsfid; ?>">
                Delete</button>
                <!-- Modal -->
                <div class="modal fade" id="modal<?php echo "bsfid".$bsform->bsfid?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?php echo "bsfid".$bsform->bsfid ?>" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel<?php echo "bsfid".$bsform->bsfid; ?>">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       Are you sure you want to delete form number <?php echo $bsform->bsfid; ?> from Baseline Screening From?
                      </div>
                      <div class="modal-footer">
                      <form method="post"  action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="go_delete_form">Yes</button>
                        <input type="hidden" value="<?php echo $bsform->bsfid; ?>" name="fuid">
                        <input type="hidden" value="bsf" name="fid">
                        <input type="hidden" value="<?php echo $participant->participantid; ?>" name="participantid">
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <?php
                }
            ?>
          </tbody>
        </table>
	</div>
</div>
<!--Baseline Screening From ends-->
<!--SF-12_questionnaire begins-->
<div class="row justify-content-md-center">
    <div class="col-md-auto">
    <h3>SF-12 questionnaire</h3>
    </div>
</div>
<div class="row mb-5">
	<div class="col-md-12">
        <table class="table table-hover">
          <thead class="thead-inverse">
            <tr>
              <th>#</th>
              <th>Complete date</th>
              <th>Update</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach($sf12forms as $sf12form){	
            ?>
            <tr>
              <th scope="row"><?php echo $sf12form->sf_12id; ?></th>
              <td><?php echo $sf12form->complete_date; ?></td>
              <td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=view&pid=".$participant->participantid."&faction=Update&fid=sf_12&sf_12id=".$sf12form->sf_12id;?>" class="btn btn-outline-primary btn-sm" role="button">Update</a></td>
              <td>
               <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal<?php echo "sf_12id".$sf12form->sf_12id; ?>" data-whatever="@<?php echo "sf_12id".$sf12form->sf_12id; ?>">
                Delete</button>
                <!-- Modal -->
                <div class="modal fade" id="modal<?php echo "sf_12id".$sf12form->sf_12id; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?php echo "sf_12id".$sf12form->sf_12id; ?>" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel<?php echo "sf_12id".$sf12form->sf_12id; ?>">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       Are you sure you want to delete form number <?php echo $sf12form->sf_12id; ?> from SF-12 questionnaire?
                      </div>
                      <div class="modal-footer">
                      <form method="post"  action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="go_delete_form">Yes</button>
                        <input type="hidden" value="<?php echo $sf12form->sf_12id; ?>" name="fuid">
                        <input type="hidden" value="sf_12" name="fid">
                        <input type="hidden" value="<?php echo $participant->participantid; ?>" name="participantid">
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <?php
                }
            ?>
          </tbody>
        </table>
	</div>
</div>
<!--SF-12_questionnaire ends-->

<!--Health Behaviour Questionnaire begins-->
<div class="row justify-content-md-center">
    <div class="col-md-auto">
    <h3>Health Behaviour Questionnaire</h3>
    </div>
</div>
<div class="row mb-5">
	<div class="col-md-12">
        <table class="table table-hover">
          <thead class="thead-inverse">
            <tr>
              <th>#</th>
              <th>Complete date</th>
              <th>Update</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach($hbqforms as $hbqform){	
            ?>
            <tr>
              <th scope="row"><?php echo $hbqform->hbqid; ?></th>
              <td><?php echo $hbqform->complete_date; ?></td>
              <td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=view&pid=".$participant->participantid."&faction=Update&fid=hbq&hbqid=".$hbqform->hbqid;?>" class="btn btn-outline-primary btn-sm" role="button">Update</a></td>
              <td>
               <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal<?php echo "hbqid".$hbqform->hbqid; ?>" data-whatever="@<?php echo "hbqid".$hbqform->hbqid; ?>">
                Delete</button>
                <!-- Modal -->
                <div class="modal fade" id="modal<?php echo "hbqid".$hbqform->hbqid; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?php echo "hbqid".$hbqform->hbqid; ?>" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel<?php echo "hbqid".$hbqform->hbqid; ?>">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       Are you sure you want to delete form number <?php echo $hbqform->hbqid; ?> from Health Behaviour Questionnaire?
                      </div>
                      <div class="modal-footer">
                      <form method="post"  action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="go_delete_form">Yes</button>
                        <input type="hidden" value="<?php echo $hbqform->hbqid; ?>" name="fuid">
                        <input type="hidden" value="hbq" name="fid">
                        <input type="hidden" value="<?php echo $participant->participantid; ?>" name="participantid">
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <?php
                }
            ?>
          </tbody>
        </table>
	</div>
</div>
<!--Health Behaviour Questionnaire ends-->

<!--Stage of change begins-->
<div class="row justify-content-md-center">
    <div class="col-md-auto">
    <h3>Stage of change</h3>
    </div>
</div>
<div class="row mb-5">
	<div class="col-md-12">
        <table class="table table-hover">
          <thead class="thead-inverse">
            <tr>
              <th>#</th>
              <th>Complete date</th>
              <th>Update</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach($socforms as $socform){	
            ?>
            <tr>
              <th scope="row"><?php echo $socform->socid; ?></th>
              <td><?php echo $socform->complete_date; ?></td>
              <td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=view&pid=".$participant->participantid."&faction=Update&fid=soc&socid=".$socform->socid;?>" class="btn btn-outline-primary btn-sm" role="button">Update</a></td>
              <td>
               <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal<?php echo "socid".$socform->socid; ?>" data-whatever="@<?php echo "socid".$socform->socid; ?>">
                Delete</button>
                <!-- Modal -->
                <div class="modal fade" id="modal<?php echo "socid".$socform->socid; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?php echo "socid".$socform->socid; ?>" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel<?php echo "socid".$socform->socid; ?>">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       Are you sure you want to delete form number <?php echo $socform->socid; ?> from Stage of change?
                      </div>
                      <div class="modal-footer">
                      <form method="post"  action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="go_delete_form">Yes</button>
                        <input type="hidden" value="<?php echo $socform->socid; ?>" name="fuid">
                        <input type="hidden" value="soc" name="fid">
                        <input type="hidden" value="<?php echo $participant->participantid; ?>" name="participantid">
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <?php
                }
            ?>
          </tbody>
        </table>
	</div>
</div>
<!--Stage of change ends-->


<!--Decisional Balance begins-->
<div class="row justify-content-md-center">
    <div class="col-md-auto">
    <h3>Decisional Balance</h3>
    </div>
</div>
<div class="row mb-5">
	<div class="col-md-12">
        <table class="table table-hover">
          <thead class="thead-inverse">
            <tr>
              <th>#</th>
              <th>Complete date</th>
              <th>Update</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach($dbforms as $dbform){	
            ?>
            <tr>
              <th scope="row"><?php echo $dbform->dbid; ?></th>
              <td><?php echo $dbform->complete_date; ?></td>
              <td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=view&pid=".$participant->participantid."&faction=Update&fid=db&dbid=".$dbform->dbid;?>" class="btn btn-outline-primary btn-sm" role="button">Update</a></td>
              <td>
               <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal<?php echo "dbid".$dbform->dbid; ?>" data-whatever="@<?php echo "dbid".$dbform->dbid; ?>">
                Delete</button>
                <!-- Modal -->
                <div class="modal fade" id="modal<?php echo "dbid".$dbform->dbid; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?php echo "dbid".$dbform->dbid; ?>" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel<?php echo "dbid".$dbform->dbid; ?>">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       Are you sure you want to delete form number <?php echo $dbform->dbid; ?> from Decisional Balance?
                      </div>
                      <div class="modal-footer">
                      <form method="post"  action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="go_delete_form">Yes</button>
                        <input type="hidden" value="<?php echo $dbform->dbid; ?>" name="fuid">
                        <input type="hidden" value="db" name="fid">
                        <input type="hidden" value="<?php echo $participant->participantid; ?>" name="participantid">
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <?php
                }
            ?>
          </tbody>
        </table>
	</div>
</div>
<!--Decisional Balance ends-->


<!--Social Support begins-->
<div class="row justify-content-md-center">
    <div class="col-md-auto">
    <h3>Social Support</h3>
    </div>
</div>
<div class="row mb-5">
	<div class="col-md-12">
        <table class="table table-hover">
          <thead class="thead-inverse">
            <tr>
              <th>#</th>
              <th>Complete date</th>
              <th>Update</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach($ssforms as $ssform){	
            ?>
            <tr>
              <th scope="row"><?php echo $ssform->ssid; ?></th>
              <td><?php echo $ssform->complete_date; ?></td>
              <td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=view&pid=".$participant->participantid."&faction=Update&fid=ss&ssid=".$ssform->ssid;?>" class="btn btn-outline-primary btn-sm" role="button">Update</a></td>
              <td>
               <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal<?php echo "ssid".$ssform->ssid; ?>" data-whatever="@<?php echo "ssid".$ssform->ssid; ?>">
                Delete</button>
                <!-- Modal -->
                <div class="modal fade" id="modal<?php echo "ssid".$ssform->ssid; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?php echo "ssid".$ssform->ssid; ?>" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel<?php echo "ssid".$ssform->ssid; ?>">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       Are you sure you want to delete form number <?php echo $ssform->ssid; ?> from Social Support?
                      </div>
                      <div class="modal-footer">
                      <form method="post"  action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="go_delete_form">Yes</button>
                        <input type="hidden" value="<?php echo $ssform->ssid; ?>" name="fuid">
                        <input type="hidden" value="ss" name="fid">
                        <input type="hidden" value="<?php echo $participant->participantid; ?>" name="participantid">
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <?php
                }
            ?>
          </tbody>
        </table>
	</div>
</div>
<!--Social Support ends-->


<!--Self Efficacy Questionnaire begins-->
<div class="row justify-content-md-center">
    <div class="col-md-auto">
    <h3>Self Efficacy Questionnaire</h3>
    </div>
</div>
<div class="row mb-5">
	<div class="col-md-12">
        <table class="table table-hover">
          <thead class="thead-inverse">
            <tr>
              <th>#</th>
              <th>Complete date</th>
              <th>Update</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach($seqforms as $seqform){	
            ?>
            <tr>
              <th scope="row"><?php echo $seqform->seqid; ?></th>
              <td><?php echo $seqform->complete_date; ?></td>
              <td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=view&pid=".$participant->participantid."&faction=Update&fid=seq&seqid=".$seqform->seqid;?>" class="btn btn-outline-primary btn-sm" role="button">Update</a></td>
              <td>
               <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal<?php echo "seqid".$seqform->seqid; ?>" data-whatever="@<?php echo "seqid".$seqform->seqid; ?>">
                Delete</button>
                <!-- Modal -->
                <div class="modal fade" id="modal<?php echo "seqid".$seqform->seqid; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?php echo "seqid".$seqform->seqid; ?>" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel<?php echo "seqid".$seqform->seqid; ?>">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       Are you sure you want to delete form number <?php echo $seqform->seqid; ?> from Self Efficacy Questionnaire?
                      </div>
                      <div class="modal-footer">
                      <form method="post"  action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="go_delete_form">Yes</button>
                        <input type="hidden" value="<?php echo $seqform->seqid; ?>" name="fuid">
                        <input type="hidden" value="seq" name="fid">
                        <input type="hidden" value="<?php echo $participant->participantid; ?>" name="participantid">
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <?php
                }
            ?>
          </tbody>
        </table>
	</div>
</div>
<!--Self Efficacy Questionnaire ends-->


<!--Difficulty With Locomotor begins-->
<div class="row justify-content-md-center">
    <div class="col-md-auto">
    <h3>Difficulty With Locomotor</h3>
    </div>
</div>
<div class="row mb-5">
	<div class="col-md-12">
        <table class="table table-hover">
          <thead class="thead-inverse">
            <tr>
              <th>#</th>
              <th>Complete date</th>
              <th>Update</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach($dwlforms as $dwlform){	
            ?>
            <tr>
              <th scope="row"><?php echo $dwlform->dwlid; ?></th>
              <td><?php echo $dwlform->complete_date; ?></td>
              <td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=view&pid=".$participant->participantid."&faction=Update&fid=dwl&dwlid=".$dwlform->dwlid;?>" class="btn btn-outline-primary btn-sm" role="button">Update</a></td>
              <td>
               <!--button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal< ?php echo "dwlid".$dwlform->dwlid; ?>" data-whatever="@<?php echo "dwlid".$dwlform->dwlid; ?>">
                Delete</button-->
                <!-- Modal -->
                <!--div class="modal fade" id="modal< ?php echo "dwlid".$dwlform->dwlid; ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?php echo "dwlid".$dwlform->dwlid; ?>" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel< ?php echo "dwlid".$dwlform->dwlid; ?>">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       Are you sure you want to delete form number <?php echo $dwlform->dwlid; ?> from Difficulty With Locomotor?
                      </div>
                      <div class="modal-footer">
                      <form method="post"  action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="go_delete_form">Yes</button>
                        <input type="hidden" value="<?php echo $dwlform->dwlid; ?>" name="fuid">
                        <input type="hidden" value="dwl" name="fid">
                        <input type="hidden" value="<?php echo $participant->participantid; ?>" name="participantid">
                        </form>
                      </div>
                    </div>
                  </div>
                </div-->
              </td>
            </tr>
            <?php
                }
            ?>
          </tbody>
        </table>
	</div>
</div>
<!--Difficulty With Locomotor ends-->