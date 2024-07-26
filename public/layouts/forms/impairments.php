<?php
# Impairment list for a participant
global $session;
global $database;
$participantid = $session->participantid;
$participantIMPs = participantIMP::find_by_pid($participantid);


##### Impairment section
$imp_cat_ids = array();
# Getting all the impairments categories
$sql_imp_cat = "SELECT * FROM impairments_cat where imp_cat_id=1";
$result_imp_cat = $database->query($sql_imp_cat);


$parImpIds = array();
if (!empty($participantIMPs)) {
    foreach ($participantIMPs as $participantIMP) {
        array_push($parImpIds, $participantIMP->imp_id);
    }
}
?>
<style>
     
      li a{
        color: darkgray;
        margin: 0; 
        float: left;
        font-size: 16px;
        font-weight: bold;
        }
    </style>
    
<div class= "col-md-12 row">
        <div class="col col-md-12 text-center">
          <h5>Your current step--Getting to know you: Impairments 1/5</h5>
          <hr/> 
      </div>
  
  <div class="col-md-8 order-md-1 text-left" >
      <div class="col col-md-12">
          <p>This page allows you to indicate which of the following difficulties you currently experience.</p>
      </div>

      <div class="col-md-12">
          <div id="accordion">
              <?php
              if ($row_imp_cat = $database->fetch_array($result_imp_cat)) {
                  $impairments = impairments::find_by_cat_id($row_imp_cat['imp_cat_id']);
                  ?>
                  <div class="card">
                      <div class="card-header text-center" id="header<?php echo $row_imp_cat['imp_cat_id'] ?>">
                          <h5 class="mb-0 text-center">
                              <a data-toggle="collapse" class="" href="#collapse_<?php echo $row_imp_cat['imp_cat_id'] ?>"
                                 aria-expanded="false" aria-controls="collapse_<?php echo $row_imp_cat['imp_cat_id'] ?>">
                                  <?php echo $row_imp_cat['imp_cat_des'] ?>
                              </a>
                          </h5>
                      </div>

                      <div id="collapse_<?php echo $row_imp_cat['imp_cat_id'] ?>" >
                          <div class="card-body">
                              <?php
                              foreach ($impairments as $impairment) {
                                  ?>
                                  <div class="form-check">
                                      <label class="form-check-label">
                                          <input class="form-check-input" type="checkbox" name="impairments[]"
                                                 id="impairments"
                                                 value="<?php echo $impairment->imp_id; ?>" <?php if (in_array($impairment->imp_id, $parImpIds)) {
                                              echo "checked";
                                          } ?>>
                                          <?php echo $impairment->imp_des; ?>
                                      </label>
                                  </div>
                                  <?php
                              }
                              ?>
                          </div>
                      </div>
                  </div>
                  <?php
              }
              ?>
          </div>
      </div>
      <div class="col-md-12">
          <label class="error" for="impairments[]"> </label>
      </div>
      <div class="form-group col-md-12 text-right mt-3">
          <!--<input type="button" class="next-form btn btn-info float-right" value="Next"/> -->
          <!--<input role="button" type="button" class="save-gtky btn btn-success mr-2 float-right" value="Save"
                 name="saving-gtky">-->
          <!--<a href="index_participant.php?cps=baseline" class="btn btn-info float-right">Next</a>-->

          <input role="button" type="button" class="btn btn-info float-right next-impair-btn" value="Next">

          <input role="button" type="button" class="impar-btn btn btn-success mr-2 float-right" value="Save">
          <input role="button" type="submit" value="Save" id="impair-save" name="saving-gtky" style="display: none">
          <small class="mr-2" style="color:#999"> *You can save at any time and complete the form later.</small>
          <a href="index_participant.php?cps=soc34" class="btn btn-secondary float-left">Previous</a>
          <!--<input type="button" class="previous-form btn btn-secondary float-left" value="Previous"/>-->

          <!--<a class="btn btn-danger" role="button" onclick="history.go(-1);" style="color:white;">Cancel</a>
    <?php if (isset($_GET['bsfid']) && !empty($_GET['bsfid'])) { ?>
     <input class="btn btn-primary" role="button" type="submit" value="Update" name="go_register_form" >
    <?php } else { ?>
    <?php ?>
    <input class="btn btn-primary" role="button" type="submit" value="Submit" name="go_register_form" >
    <?php } ?>-->
      </div>
      <div class="col-md-12 text-left">
          <small style="color:#999"> 3/</small>
      </div>
  </div>
  <div class="col-md-4 order-md-2" > 
        <div class="">
            <ul class="align-self-left">
                <li><a href="/coach_assistant/public/index_participant.php?cps=soc12">Stage of Change</a></li> 
                <li><a href="/coach_assistant/public/index_participant.php?cps=impair">Impairments</a></li> 
                <li><a href="/coach_assistant/public/index_participant.php?cps=baseline">Baseline</a></li>
                <li><a href="/coach_assistant/public/index_participant.php?cps=value">Value Identification</a></li> 
            </ul>
        </div>
      <div class="media">
              <div class="media-body align-self-center ml-3">
                  <h3 class="">Coaching path</h3>
              </div>
              <img class="align-self-center mr-3" src="images/coaching-path.png"
                   alt="Generic placeholder image">
          </div>
       <hr/>
      <div >

                    <li style="color: red"><h5>Impairment:</h5></li>

                    <p>We need to identify the impairment level at this stage.</p>
       
      </div>   
    </div>
</div>

<script type="text/javascript">
    $(".next-impair-btn").click(function () {
        $("#cps").val("impair_ps");
        $("#impair-save").click();
    })

    $(".impar-btn").click(function () {
        $("#cps").val("impair");
        $("#impair-save").click();
    })
</script>
