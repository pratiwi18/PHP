<?php
if(isset($_GET['pid'])&&!empty($_GET['pid'])&&isset($_GET['paction'])&&!empty($_GET['paction'])) {
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
              <th>View</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach($bsforms as $bsform){	
            ?>
            <tr>
              <th scope="row"><?php echo $bsform->bsfid; ?></th>
              <td><?php echo $bsform->complete_date; ?></td>
							<?php if($_GET['paction']=='view') { ?>
              	<td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=view&pid=".$participant->participantid."&faction=view&fid=bsf&bsfid=".$bsform->bsfid;?>" class="btn btn-outline-info btn-sm" role="button">View</a></td>
							<?php } ?>
							<?php if($_GET['paction']=='update') { ?>
              	<td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=update&pid=".$participant->participantid."&faction=update&fid=bsf&bsfid=".$bsform->bsfid;?>" class="btn btn-outline-info btn-sm" role="button">Update</a></td>
							<?php } ?>
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
              <th>View</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach($sf12forms as $sf12form){	
            ?>
            <tr>
              <th scope="row"><?php echo $sf12form->sf_12id; ?></th>
              <td><?php echo $sf12form->complete_date; ?></td>
							<?php if($_GET['paction']=='view') { ?>
              	<td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=view&pid=".$participant->participantid."&faction=view&fid=sf_12&sf_12id=".$sf12form->sf_12id;?>" class="btn btn-outline-info btn-sm" role="button">View</a></td>
							<?php } ?>
							<?php if($_GET['paction']=='update') { ?>
								<td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=update&pid=".$participant->participantid."&faction=update&fid=sf_12&sf_12id=".$sf12form->sf_12id;?>" class="btn btn-outline-primary btn-sm" role="button">Update</a></td>
							<?php } ?>
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
              <th>View</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach($hbqforms as $hbqform){	
            ?>
            <tr>
              <th scope="row"><?php echo $hbqform->hbqid; ?></th>
              <td><?php echo $hbqform->complete_date; ?></td>
							<?php if($_GET['paction']=='view') { ?>
              	<td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=view&pid=".$participant->participantid."&faction=view&fid=hbq&hbqid=".$hbqform->hbqid;?>" class="btn btn-outline-info btn-sm" role="button">View</a></td>
							<?php } ?>
							<?php if($_GET['paction']=='update') { ?>
              	<td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=update&pid=".$participant->participantid."&faction=update&fid=hbq&hbqid=".$hbqform->hbqid;?>" class="btn btn-outline-info btn-sm" role="button">Update</a></td>
							<?php } ?>
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
              <th>View</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach($socforms as $socform){	
            ?>
            <tr>
              <th scope="row"><?php echo $socform->socid; ?></th>
              <td><?php echo $socform->complete_date; ?></td>
							<?php if($_GET['paction']=='view') { ?>
              	<td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=view&pid=".$participant->participantid."&faction=view&fid=soc&socid=".$socform->socid;?>" class="btn btn-outline-info btn-sm" role="button">View</a></td>
							<?php } ?>
							<?php if($_GET['paction']=='update') { ?>
              	<td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=update&pid=".$participant->participantid."&faction=update&fid=soc&socid=".$socform->socid;?>" class="btn btn-outline-info btn-sm" role="button">Update</a></td>
							<?php } ?>
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
              <th>View</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach($dbforms as $dbform){	
            ?>
            <tr>
              <th scope="row"><?php echo $dbform->dbid; ?></th>
              <td><?php echo $dbform->complete_date; ?></td>
							<?php if($_GET['paction']=='view') { ?>
	              <td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=view&pid=".$participant->participantid."&faction=view&fid=db&dbid=".$dbform->dbid;?>" class="btn btn-outline-info btn-sm" role="button">View</a></td>
							<?php } ?>
							<?php if($_GET['paction']=='update') { ?>
	              <td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=update&pid=".$participant->participantid."&faction=update&fid=db&dbid=".$dbform->dbid;?>" class="btn btn-outline-info btn-sm" role="button">Update</a></td>
							<?php } ?>
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
              <th>View</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach($ssforms as $ssform){	
            ?>
            <tr>
              <th scope="row"><?php echo $ssform->ssid; ?></th>
              <td><?php echo $ssform->complete_date; ?></td>
							<?php if($_GET['paction']=='view') { ?>
              	<td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=view&pid=".$participant->participantid."&faction=view&fid=ss&ssid=".$ssform->ssid;?>" class="btn btn-outline-info btn-sm" role="button">View</a></td>
							<?php } ?>
							<?php if($_GET['paction']=='update') { ?>
              	<td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=update&pid=".$participant->participantid."&faction=update&fid=ss&ssid=".$ssform->ssid;?>" class="btn btn-outline-info btn-sm" role="button">Update</a></td>
							<?php } ?>
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
              <th>View</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach($seqforms as $seqform){	
            ?>
            <tr>
              <th scope="row"><?php echo $seqform->seqid; ?></th>
              <td><?php echo $seqform->complete_date; ?></td>
							<?php if($_GET['paction']=='view') { ?>
              	<td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=view&pid=".$participant->participantid."&faction=view&fid=seq&seqid=".$seqform->seqid;?>" class="btn btn-outline-info btn-sm" role="button">View</a></td>
							<?php } ?>
							<?php if($_GET['paction']=='update') { ?>
              	<td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=update&pid=".$participant->participantid."&faction=update&fid=seq&seqid=".$seqform->seqid;?>" class="btn btn-outline-info btn-sm" role="button">Update</a></td>
							<?php } ?>
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
              <th>View</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach($dwlforms as $dwlform){	
            ?>
            <tr>
              <th scope="row"><?php echo $dwlform->dwlid; ?></th>
              <td><?php echo $dwlform->complete_date; ?></td>
							<?php if($_GET['paction']=='view') { ?>
              	<td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=view&pid=".$participant->participantid."&faction=view&fid=dwl&dwlid=".$dwlform->dwlid;?>" class="btn btn-outline-info btn-sm" role="button">View</a></td>
							<?php } ?>
							<?php if($_GET['paction']=='update') { ?>
              	<td><a href="<?php echo ROOT_DIR."?pageid=participant&paction=update&pid=".$participant->participantid."&faction=update&fid=dwl&dwlid=".$dwlform->dwlid;?>" class="btn btn-outline-info btn-sm" role="button">Update</a></td>
							<?php } ?>
            </tr>
            <?php
                }
            ?>
          </tbody>
        </table>
	</div>
</div>
<!--Difficulty With Locomotor ends-->