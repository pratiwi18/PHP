<?php
require_once "../includes/db.inc.php";
global $session;
global $database;
// Loading a participant based on participant session
$participantid = $session->participantid;

global $soc_form;
global $par_bar;
global $stra_bar;
global $goal_setting;
global $sfos_bar;
global $con;

?>
<div class="col-md-12 row">
  
   <div class="col-md-8 order-md-1 mb-5 mt-5"  role="tablist">
 
      <div class="row text-center">
          <div class="col col-md-12">
              <h4>Goal Evaluation</h4>
          </div>
      </div>

      <form id="gs_form" method="post" action="/coach_assistant/controller/evaluation_process.php">

          <input type="hidden" name="goal_template_id" id="goal_template_id" value="<?php echo $goal_setting[2]; ?>"/>
          <input type="hidden" name="stra_id" id="stra_id" value="<?php echo $stra_bar->stra_id ?>">
          <input type="hidden" name="bar_id" id="bar_id" value="<?php echo $par_bar->bar_id ?>">

          <div class="col-md-12 text-center">
              <?php
              if ($session->isDevelop) {
                  ?>
                  <input type="submit" class="previous-form btn btn-secondary float-left" value="Previous"
                         name="previous_soc"
                         id="previous_soc">
                  <?php
              }
              ?>
              <input role="button" type="submit" class="btn btn-success" value="Go back to Goal" name="save_evaluation"
                     id="save-evaluation">
              <input role="button" type="submit" class="btn btn-primary" value="Go back to barriers" name="submit_evaluation"
                     id="submit-evaluation">
          </div>
          <div class="col-md-12 text-center">
              <small class="mr-2" style="color:#999"> *You can save at any time and complete the form later.</small>
          </div>
      </form>
    </div>
  
    <div class="col-md-4 order-md-2" > 

        <div class="media">
                <div class="media-body align-self-center ml-3">
                    <h3 class="">Coaching path</h3>
                </div>
                <img class="align-self-center mr-3" src="images/coaching-path.png"
                     alt="Generic placeholder image">
            </div>
         <hr/>

        <div >
                      <li style="color: red"><h5>Evaluation:</h5></li>
                      <p>You need to evaluate your goals with Wearable Sensors at this step.</p>
        </div>   
    </div>
     
</div>