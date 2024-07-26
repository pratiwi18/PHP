<?php
// If the form has a ID, it means it needs to be updated - Loads the data from the database to put them into the form
if(isset($_GET['seqid'])&&!empty($_GET['seqid'])){ 
	$seqid = $_GET['seqid'];
	// Grab the information about the quesitionnaire from the database based on the seqid
	$seq_form = selfEfficacyQuestionnaire::find_by_id($seqid);
}
?>
<form class="text-center" method="post" action="">
<div class="jumbotron text-left">
	<div class="col-md-12">
    <p>
Physical activity or exercise includes activities such as walking briskly, jogging, bicycling, swimming, or any other activity in which the exertion is at least as intense as these activities.
 </p>
 <p>Select the number that indicates how confident you are that you could be physically active in each of the following situations:</p>
  <strong>Scale:</strong>
 <p></p>
    <ul>
    <li>0= does not apply to me</li>
    <li>1= not at all confident</li>
    <li>2= slightly confident</li>
    <li>3= moderately confident</li>
    <li>4= very confident</li>
    <li>5= extremely confident</li>
    </ul>
    </div>
	<div class="col-md-12">
   		<p>1. when I am tired</p>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q1_when_tired" id="Seq_q1_when_tired" value="0"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q1_when_tired ==  0) echo 'checked';} ?>>0
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q1_when_tired" id="Seq_q1_when_tired" value="1"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q1_when_tired ==  1) echo 'checked';} ?>>1
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q1_when_tired" id="Seq_q1_when_tired" value="2"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q1_when_tired ==  2) echo 'checked';} ?>>2
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q1_when_tired" id="Seq_q1_when_tired" value="3"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q1_when_tired ==  3) echo 'checked';} ?>>3
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q1_when_tired" id="Seq_q1_when_tired" value="4"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q1_when_tired ==  4) echo 'checked';} ?>> 4 
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q1_when_tired" id="Seq_q1_when_tired" value="5"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q1_when_tired ==  5) echo 'checked';} ?>> 5
          </label>
        </div>
    </div>
    
    <div class="col-md-12">
   		<p>2. When I am in a bad mood</p>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q2_when_in_a_bad_mood" id="Seq_q2_when_in_a_bad_mood" value="0"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q2_when_in_a_bad_mood ==  0) echo 'checked';} ?>>0
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q2_when_in_a_bad_mood" id="Seq_q2_when_in_a_bad_mood" value="1"
             <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q2_when_in_a_bad_mood ==  1) echo 'checked';} ?>>1
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q2_when_in_a_bad_mood" id="Seq_q2_when_in_a_bad_mood" value="2"
             <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q2_when_in_a_bad_mood ==  2) echo 'checked';} ?>>2
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q2_when_in_a_bad_mood" id="Seq_q2_when_in_a_bad_mood" value="3"
             <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q2_when_in_a_bad_mood ==  3) echo 'checked';} ?>>3
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q2_when_in_a_bad_mood" id="Seq_q2_when_in_a_bad_mood" value="4"
             <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q2_when_in_a_bad_mood ==  4) echo 'checked';} ?>> 4 
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q2_when_in_a_bad_mood" id="Seq_q2_when_in_a_bad_mood" value="5"
             <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q2_when_in_a_bad_mood ==  5) echo 'checked';} ?>> 5
          </label>
        </div>
    </div>
    
    <div class="col-md-12">
   		<p>3. When I feel I don’t have time</p>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q3_when_feel_dont_have_time" id="Seq_q3_when_feel_dont_have_time" value="0"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q3_when_feel_dont_have_time ==  0) echo 'checked';} ?>>0
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q3_when_feel_dont_have_time" id="Seq_q3_when_feel_dont_have_time" value="1"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q3_when_feel_dont_have_time ==  1) echo 'checked';} ?>>1
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q3_when_feel_dont_have_time" id="Seq_q3_when_feel_dont_have_time" value="2"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q3_when_feel_dont_have_time ==  2) echo 'checked';} ?>>2
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q3_when_feel_dont_have_time" id="Seq_q3_when_feel_dont_have_time" value="3"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q3_when_feel_dont_have_time ==  3) echo 'checked';} ?>>3
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q3_when_feel_dont_have_time" id="Seq_q3_when_feel_dont_have_time" value="4"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q3_when_feel_dont_have_time ==  4) echo 'checked';} ?>> 4 
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q3_when_feel_dont_have_time" id="Seq_q3_when_feel_dont_have_time" value="5"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q3_when_feel_dont_have_time ==  5) echo 'checked';} ?>> 5
          </label>
        </div>
    </div>
    
    <div class="col-md-12">
   		<p>4. When I am on vacation</p>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q4_when_on_vacation" id="Seq_q4_when_on_vacation" value="0"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q4_when_on_vacation ==  0) echo 'checked';} ?>>0
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q4_when_on_vacation" id="Seq_q4_when_on_vacation" value="1"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q4_when_on_vacation ==  1) echo 'checked';} ?>>1
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q4_when_on_vacation" id="Seq_q4_when_on_vacation" value="2"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q4_when_on_vacation ==  2) echo 'checked';} ?>>2
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q4_when_on_vacation" id="Seq_q4_when_on_vacation" value="3"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q4_when_on_vacation ==  3) echo 'checked';} ?>>3
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q4_when_on_vacation" id="Seq_q4_when_on_vacation" value="4"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q4_when_on_vacation ==  4) echo 'checked';} ?>> 4 
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q4_when_on_vacation" id="Seq_q4_when_on_vacation" value="5"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q4_when_on_vacation ==  5) echo 'checked';} ?>> 5
          </label>
        </div>
    </div>
    
    <div class="col-md-12">
   		<p>5. When it is raining</p>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q5_when_its_raining" id="Seq_q5_when_its_raining" value="0"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q5_when_its_raining ==  0) echo 'checked';} ?>>0
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q5_when_its_raining" id="Seq_q5_when_its_raining" value="1"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q5_when_its_raining ==  1) echo 'checked';} ?>>1
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q5_when_its_raining" id="Seq_q5_when_its_raining" value="2"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q5_when_its_raining ==  2) echo 'checked';} ?>>2
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q5_when_its_raining" id="Seq_q5_when_its_raining" value="3"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q5_when_its_raining ==  3) echo 'checked';} ?>>3
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q5_when_its_raining" id="Seq_q5_when_its_raining" value="4"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q5_when_its_raining ==  4) echo 'checked';} ?>> 4 
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Seq_q5_when_its_raining" id="Seq_q5_when_its_raining" value="5"
            <?php if (isset($_GET['seqid'])&&!empty($_GET['seqid'])) { if ($seq_form->Seq_q5_when_its_raining ==  5) echo 'checked';} ?>> 5
          </label>
        </div>
    </div>
    <div class="form-row text-center mt-4">
  <div class="form-group col-md-12">
  <a class="btn btn-danger" role="button" onclick="history.go(-1);" style="color:white;">Cancel</a>
  <?php if(isset($_GET['seqid'])&&!empty($_GET['seqid'])){ ?>
   <input class="btn btn-primary" role="button" type="submit" value="Update" name="go_register_form" >
  <?php }else{ ?>
  <?php ?>
 	<input class="btn btn-primary" role="button" type="submit" value="Submit" name="go_register_form" >
  <?php } ?>
  </div>
  </div>
</div>
</form>
