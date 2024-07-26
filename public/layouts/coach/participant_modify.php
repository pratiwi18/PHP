<?php
if (isset($_GET['pid']) && ! empty($_GET['pid']) && isset($_GET['paction']) && ! empty($_GET['paction'])) {
    // Loading a participant based on participant ID
		$paction = $_GET['paction'];
    $participantid = $_GET['pid'];
    $participant = participant::find_by_id($participantid);
    $participantSOC = participantSOC::find_by_pid($participantid);
    if (! empty($participantSOC)) {
        $currentStage = $participantSOC->current_stage;
        $previousStage = $participantSOC->previous_stage;
    }
    else {
        $currentStage = "NDA";
        $previousStage = "NDA";
    }
}

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<!--style>
.dropdown:hover>.dropdown-menu {
  display: block;
}

.dropdown>.dropdown-toggle:active {
  /*Without this, clicking will make it sticky*/
    pointer-events: none;
}
</style-->
<div class="container">
	<a class="btn btn-outline-primary" href="<?php echo ROOT_DIR."?pageid=participant_main"?>">&laquo Back</a>
</div>
  <div class="card mt-5 alert alert-info">
    <div class="card-body">
      <div class="row">
        <div class="col-md-2">
          <strong> Participant ID: </strong>
          <?php if(!empty($participant->gender)){ echo $participant->participantid; }else{ echo "No data available"; } ?>
        </div>
        <div class="col-md-4">
          <strong> Full name: </strong>
          <?php if(!empty($participant->full_name())){ echo $participant->full_name(); }else{ echo "No data available"; } ?>
        </div>
        <div class="col-md-3">
          <strong> Current stage: </strong>
          <?php echo $currentStage;?>
        </div>
        <div class="col-md-3">
          <strong> Previous stage: </strong>
          <?php echo $previousStage;?>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-6">
          <td><a href="<?php echo ROOT_DIR."?pageid=message&paction=".$paction."&msgtype=msg&pid=".$participant->participantid?>" class="btn btn-info btn-sm" role="button">Messages</a>
        </div>
        <div class="col-md-6">
          <td><a href="<?php echo ROOT_DIR."?pageid=message&paction=".$paction."&msgtype=alert&pid=".$participant->participantid?>" class="btn btn-warning btn-sm" role="button">Alert</a></td>
        </div>
       </div>
    </div>
  </div>

<div class="row">
  <div class="col-sm-3 ml-sm-auto col-md-3 pt-5">
    <!--<ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-form nav-link active" id="DCT-tab" data-toggle="pill" href="#DCT" role="tab" aria-controls="DCT" aria-expanded="true">Data Collection & Tools</a>
        </li>
        <li class="nav-item">
          <a class="nav-form nav-link" id="BS-tab" data-toggle="pill" href="#BS" role="tab" aria-controls="BS" aria-expanded="true">Barriers & Strategies</a>
        </li>

        <li class="nav-item">
          <a class="nav-form nav-link" id="EP-tab" data-toggle="pill" href="#EP" role="tab" aria-controls="EP" aria-expanded="true">Exercise Prescriptions</a>
        </li>
        <li class="nav-item">
          <a class="nav-form nav-link" id="GS-tab" data-toggle="pill" href="#GS" role="tab" aria-controls="GS" aria-expanded="true">Goal Setting</a>
        </li>
    </ul-->
    <ul class="nav nav-tabs mb-3 flex-column" id="pills-tab" role="tablist">
      <!--li class="nav-item dropdown">
        <a class="nav-link" id="DCT-tab" data-toggle="tab" href="#DCT" role="tab" aria-controls="DCT" aria-selected="false">Data Collection &amp; Tools</a>
        <div class="dropdown-menu" aria-labelledby="DCT-tab">
          <a class="dropdown-item" href="< ?php echo ROOT_DIR."?pageid=participant&paction=view&pid=".$participant->participantid."&faction=addnew&fid=msg"?>">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li-->
			<li class="nav-item">
        <a class="nav-link" id="BIF-tab" data-toggle="tab" href="#BIF" role="tab" aria-controls="BIF" aria-selected="false">Basic Information</a></li>
			<li class="nav-item">
        <a class="nav-link" id="DCT-tab" data-toggle="tab" href="#DCT" role="tab" aria-controls="DCT" aria-selected="false">Data Collection &amp; Tools</a></li>
      <li class="nav-item">
        <a class="nav-link" id="BS-tab" data-toggle="tab" href="#BS" role="tab" aria-controls="BS" aria-selected="false">Barriers &amp; Strategies</a></li>
      <!--li class="nav-item">
        <a class="nav-link" id="EP-tab" data-toggle="tab" href="#EP" role="tab" aria-controls="EP" aria-selected="false">Exercise Prescriptions</a></li-->
      <li class="nav-item">
        <a class="nav-link" id="GS-tab" data-toggle="tab" href="#GS" role="tab" aria-controls="GS" aria-selected="false">Goal Setting</a></li>
    </ul>
  </div>
  <div class="tab-content col-md-9" id="pills-tabContent">
		<div class="tab-pane fade in active show" id="BIF" role="tabpanel" aria-labelledby="BIF-tab">
      <?php
include_layout_template('coach/basic_information.php');
?>
    </div>
    <div class="tab-pane fade" id="DCT" role="tabpanel" aria-labelledby="DCT-tab">
      <?php
// Loading data collection tab
include_layout_template('coach/data_collection.php');
?>
    </div>
    <div class="tab-pane fade" id="BS" role="tabpanel" aria-labelledby="BS-tab">
      <?php
// Loading barriers and strategies tab
include_layout_template('coach/barriers_strategies_view.php');
?>
    </div>
    <!--div class="tab-pane fade" id="EP" role="tabpanel" aria-labelledby="EP-tab">
      < ?php
// Loading exercise prescriptions tab
include_layout_template('coach/exercise_prescriptions.php');
?>
    </div-->
    <div class="tab-pane fade" id="GS" role="tabpanel" aria-labelledby="GS-tab">
      <?php
// Loading goal setting tab
include_layout_template('coach/pgoal_setting.php');
?>
    </div>
  </div>
</div>
  <!--cj, no idea what is wrong with bootstrap, this function works here to switch tabs-->
  <script>
    $(document).ready(function() {
      $(".nav-tabs a").click(function() {
        $(this).tab('show');
      });
    });
  </script>