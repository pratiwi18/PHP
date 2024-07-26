<?php
// If the form has a ID, it means it needs to be updated - Loads the data from the database to put them into the form
if(isset($_GET['ssid'])&&!empty($_GET['ssid'])){ 
	$ssid = $_GET['ssid'];
	// Grab the information about the quesitionnaire from the database based on the ssid
	$ss_form = socialSupport::find_by_id($ssid);
}
?>
<form class="text-center" method="post" action="">
<div class="jumbotron text-left">
	<div class="col-md-12">
    	<p> The following is a list of things people might do or say to someone who is trying to do PA regularly. Please read and answer each question. If you are not physically active, then some of the questions may not apply to you. </p>
        <p> Please rate each question two times. Under “family” rate how often anyone living in your household has said or done what is described during the past three months. Under “Friends” rate how often your friends, acquaintances, or co-workers have said or done what is described during the past three months. Please write one number from the following rating scales in each space: </p>
    <p>
    <ul>
    <li>1= none</li>
    <li>2= rarely</li>
    <li>3= a few times</li>
    <li>4= often</li>
    <li>5= very often</li>
    <li>0= does not apply </li>
    </ul>
 	</p>
	</div>
    <div class="col-md-12">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th></th>
              <th class="text-center">Family</th>
              <th class="text-center">Friends</th>
            </tr>
          </thead>
          <tbody >
            <tr>
              <th scope="row" class="text-center">1</th>
              <td class="text-left">Did physical activities with me.</td>
              <td>
              <div class="form-group">
                <select class="form-control" name="ss_q1_did_physical_activities_fam">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q1_did_physical_activities_fam ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q1_did_physical_activities_fam ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q1_did_physical_activities_fam ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q1_did_physical_activities_fam ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q1_did_physical_activities_fam ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q1_did_physical_activities_fam ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
              <td>
              	<div class="form-group">
                <select class="form-control" name="ss_q1_did_physical_activities_fri">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q1_did_physical_activities_fri ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q1_did_physical_activities_fri ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q1_did_physical_activities_fri ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q1_did_physical_activities_fri ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q1_did_physical_activities_fri ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q1_did_physical_activities_fri ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
            </tr>
            <tr>
              <th scope="row" class="text-center">2</th>
              <td class="text-left">Offered to do physical activities with me.</td>
              <td>
              <div class="form-group">
                <select class="form-control" name="ss_q2_offer_physical_activities_fam">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q2_offer_physical_activities_fam ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q2_offer_physical_activities_fam ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q2_offer_physical_activities_fam ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q2_offer_physical_activities_fam ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q2_offer_physical_activities_fam ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q2_offer_physical_activities_fam ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
              <td>
              	<div class="form-group">
                <select class="form-control" name="ss_q2_offer_physical_activities_fri">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q2_offer_physical_activities_fri ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q2_offer_physical_activities_fri ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q2_offer_physical_activities_fri ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q2_offer_physical_activities_fri ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q2_offer_physical_activities_fri ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q2_offer_physical_activities_fri ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
            </tr>
            <tr>
              <th scope="row" class="text-center">3</th>
              <td class="text-left">Gave me helpful reminders to be physically active (i.e. “Are you going to do your activity tonight?”)</td>
              <td>
              <div class="form-group">
                <select class="form-control" name="ss_q3_gave_helpful_reminder_fam">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q3_gave_helpful_reminder_fam ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q3_gave_helpful_reminder_fam ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q3_gave_helpful_reminder_fam ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q3_gave_helpful_reminder_fam ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q3_gave_helpful_reminder_fam ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q3_gave_helpful_reminder_fam ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
              <td>
              	<div class="form-group">
                <select class="form-control" name="ss_q3_gave_helpful_reminder_fri">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q3_gave_helpful_reminder_fri ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q3_gave_helpful_reminder_fri ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q3_gave_helpful_reminder_fri ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q3_gave_helpful_reminder_fri ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q3_gave_helpful_reminder_fri ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q3_gave_helpful_reminder_fri ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
            </tr>
            <tr>
              <th scope="row" class="text-center">4</th>
              <td class="text-left">Gave me encouragement to stick with my activity program.</td>
              <td>
              <div class="form-group">
                <select class="form-control" name="ss_q4_gave_encouragement_to_activity_program_fam">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q4_gave_encouragement_to_activity_program_fam ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q4_gave_encouragement_to_activity_program_fam ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q4_gave_encouragement_to_activity_program_fam ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q4_gave_encouragement_to_activity_program_fam ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q4_gave_encouragement_to_activity_program_fam ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q4_gave_encouragement_to_activity_program_fam ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
              <td>
              	<div class="form-group">
                <select class="form-control" name="ss_q4_gave_encouragement_to_activity_program_fri">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q4_gave_encouragement_to_activity_program_fri ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q4_gave_encouragement_to_activity_program_fri ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q4_gave_encouragement_to_activity_program_fri ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q4_gave_encouragement_to_activity_program_fri ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q4_gave_encouragement_to_activity_program_fri ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q4_gave_encouragement_to_activity_program_fri ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
            </tr>
            <tr>
              <th scope="row" class="text-center">5</th>
              <td class="text-left">Changed their schedule so we could do physical activities together.</td>
              <td>
              <div class="form-group">
                <select class="form-control" name="ss_q5_change_their_physical_activities_schedule_fam">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q5_change_their_physical_activities_schedule_fam ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q5_change_their_physical_activities_schedule_fam ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q5_change_their_physical_activities_schedule_fam ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q5_change_their_physical_activities_schedule_fam ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q5_change_their_physical_activities_schedule_fam ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q5_change_their_physical_activities_schedule_fam ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
              <td>
              	<div class="form-group">
                <select class="form-control" name="ss_q5_change_their_physical_activities_schedule_fri">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q5_change_their_physical_activities_schedule_fri ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q5_change_their_physical_activities_schedule_fri ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q5_change_their_physical_activities_schedule_fri ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q5_change_their_physical_activities_schedule_fri ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q5_change_their_physical_activities_schedule_fri ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q5_change_their_physical_activities_schedule_fri ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
            </tr>
            <tr>
              <th scope="row" class="text-center">6</th>
              <td class="text-left">Discussed physical activity with me.</td>
              <td>
              <div class="form-group">
                <select class="form-control" name="ss_q6_discuss_their_physical_activities_fam">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q6_discuss_their_physical_activities_fam ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q6_discuss_their_physical_activities_fam ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q6_discuss_their_physical_activities_fam ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q6_discuss_their_physical_activities_fam ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q6_discuss_their_physical_activities_fam ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q6_discuss_their_physical_activities_fam ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
              <td>
              	<div class="form-group">
                <select class="form-control" name="ss_q6_discuss_their_physical_activities_fri">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q6_discuss_their_physical_activities_fri ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q6_discuss_their_physical_activities_fri ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q6_discuss_their_physical_activities_fri ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q6_discuss_their_physical_activities_fri ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q6_discuss_their_physical_activities_fri ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q6_discuss_their_physical_activities_fri ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
            </tr>
            <tr>
              <th scope="row" class="text-center">7</th>
              <td class="text-left">Complained about the time I spend doing physical activity. </td>
              <td>
              <div class="form-group">
                <select class="form-control" name="ss_q7_complained_about_time_spent_physical_activities_fam">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q7_complained_about_time_spent_physical_activities_fam ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q7_complained_about_time_spent_physical_activities_fam ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q7_complained_about_time_spent_physical_activities_fam ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q7_complained_about_time_spent_physical_activities_fam ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q7_complained_about_time_spent_physical_activities_fam ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q7_complained_about_time_spent_physical_activities_fam ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
              <td>
              	<div class="form-group">
                <select class="form-control" name="ss_q7_complained_about_time_spent_physical_activities_fri">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q7_complained_about_time_spent_physical_activities_fri ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q7_complained_about_time_spent_physical_activities_fri ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q7_complained_about_time_spent_physical_activities_fri ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q7_complained_about_time_spent_physical_activities_fri ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q7_complained_about_time_spent_physical_activities_fri ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q7_complained_about_time_spent_physical_activities_fri ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
            </tr>
            <tr>
              <th scope="row" class="text-center">8</th>
              <td class="text-left">Criticised me or made fun of me for doing physical activity.</td>
              <td>
              <div class="form-group">
                <select class="form-control" name="ss_q8_criticised_physical_activities_fam">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q8_criticised_physical_activities_fam ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q8_criticised_physical_activities_fam ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q8_criticised_physical_activities_fam ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q8_criticised_physical_activities_fam ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q8_criticised_physical_activities_fam ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q8_criticised_physical_activities_fam ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
              <td>
              	<div class="form-group">
                <select class="form-control" name="ss_q8_criticised_physical_activities_fri">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q8_criticised_physical_activities_fri ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q8_criticised_physical_activities_fri ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q8_criticised_physical_activities_fri ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q8_criticised_physical_activities_fri ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q8_criticised_physical_activities_fri ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q8_criticised_physical_activities_fri ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
            </tr>
            <tr>
              <th scope="row" class="text-center">9</th>
              <td class="text-left">Gave me rewards for being physically active (i.e. gave me something I liked).</td>
              <td>
              <div class="form-group">
                <select class="form-control" name="ss_q9_gave_rewards_on_physically_active_fam">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q9_gave_rewards_on_physically_active_fam ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q9_gave_rewards_on_physically_active_fam ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q9_gave_rewards_on_physically_active_fam ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q9_gave_rewards_on_physically_active_fam ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q9_gave_rewards_on_physically_active_fam ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q9_gave_rewards_on_physically_active_fam ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
              <td>
              	<div class="form-group">
                <select class="form-control" name="ss_q9_gave_rewards_on_physically_active_fri">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q9_gave_rewards_on_physically_active_fri ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q9_gave_rewards_on_physically_active_fri ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q9_gave_rewards_on_physically_active_fri ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q9_gave_rewards_on_physically_active_fri ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q9_gave_rewards_on_physically_active_fri ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q9_gave_rewards_on_physically_active_fri ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
            </tr>
            <tr>
              <th scope="row" class="text-center">10</th>
              <td class="text-left">Planned for physical activities on recreational outings.</td>
              <td>
              <div class="form-group">
                <select class="form-control" name="ss_q10_planned_for_physical_activities_fam">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q10_planned_for_physical_activities_fam ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q10_planned_for_physical_activities_fam ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q10_planned_for_physical_activities_fam ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q10_planned_for_physical_activities_fam ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q10_planned_for_physical_activities_fam ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q10_planned_for_physical_activities_fam ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
              <td>
              	<div class="form-group">
                <select class="form-control" name="ss_q10_planned_for_physical_activities_fri">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q10_planned_for_physical_activities_fri ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q10_planned_for_physical_activities_fri ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q10_planned_for_physical_activities_fri ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q10_planned_for_physical_activities_fri ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q10_planned_for_physical_activities_fri ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q10_planned_for_physical_activities_fri ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
            </tr>
            <tr>
              <th scope="row" class="text-center">11</th>
              <td class="text-left">Helped plan events around my physical activities.</td>
              <td>
              <div class="form-group">
                <select class="form-control" name="ss_q11_help_plan_for_physical_activities_fam">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q11_help_plan_for_physical_activities_fam ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q11_help_plan_for_physical_activities_fam ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q11_help_plan_for_physical_activities_fam ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q11_help_plan_for_physical_activities_fam ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q11_help_plan_for_physical_activities_fam ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q11_help_plan_for_physical_activities_fam ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
              <td>
              	<div class="form-group">
                <select class="form-control" name="ss_q11_help_plan_for_physical_activities_fri">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q11_help_plan_for_physical_activities_fri ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q11_help_plan_for_physical_activities_fri ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q11_help_plan_for_physical_activities_fri ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q11_help_plan_for_physical_activities_fri ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q11_help_plan_for_physical_activities_fri ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q11_help_plan_for_physical_activities_fri ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
            </tr>
            <tr>
              <th scope="row" class="text-center">12</th>
              <td class="text-left">Asked me for ideas on how they can be more physically active.</td>
              <td>
              <div class="form-group">
                <select class="form-control" name="ss_q12_ask_for_ideas_on_physically_active_fam">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q12_ask_for_ideas_on_physically_active_fam ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q12_ask_for_ideas_on_physically_active_fam ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q12_ask_for_ideas_on_physically_active_fam ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q12_ask_for_ideas_on_physically_active_fam ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q12_ask_for_ideas_on_physically_active_fam ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q12_ask_for_ideas_on_physically_active_fam ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
              <td>
              	<div class="form-group">
                <select class="form-control" name="ss_q12_ask_for_ideas_on_physically_active_fri">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q12_ask_for_ideas_on_physically_active_fri ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q12_ask_for_ideas_on_physically_active_fri ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q12_ask_for_ideas_on_physically_active_fri ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q12_ask_for_ideas_on_physically_active_fri ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q12_ask_for_ideas_on_physically_active_fri ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q12_ask_for_ideas_on_physically_active_fri ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
            </tr>
            <tr>
              <th scope="row" class="text-center">13</th>
              <td class="text-left">Talked about how much they like to do physical activity. </td>
              <td>
              <div class="form-group">
                <select class="form-control" name="ss_q13_talked_about_how_much_todo_for_physical_activities_fam">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q13_talked_about_how_much_todo_for_physical_activities_fam ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q13_talked_about_how_much_todo_for_physical_activities_fam ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q13_talked_about_how_much_todo_for_physical_activities_fam ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q13_talked_about_how_much_todo_for_physical_activities_fam ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q13_talked_about_how_much_todo_for_physical_activities_fam ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q13_talked_about_how_much_todo_for_physical_activities_fam ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
              <td>
              	<div class="form-group">
                <select class="form-control" name="ss_q13_talked_about_how_much_todo_for_physical_activities_fri">
                	<option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q13_talked_about_how_much_todo_for_physical_activities_fri ==  0) echo 'selected';} ?>>0</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q13_talked_about_how_much_todo_for_physical_activities_fri ==  1) echo 'selected';} ?>>1</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q13_talked_about_how_much_todo_for_physical_activities_fri ==  2) echo 'selected';} ?>>2</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q13_talked_about_how_much_todo_for_physical_activities_fri ==  3) echo 'selected';} ?>>3</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q13_talked_about_how_much_todo_for_physical_activities_fri ==  4) echo 'selected';} ?>>4</option>
                  <option <?php if (isset($_GET['ssid'])&&!empty($_GET['ssid'])) { if ($ss_form->ss_q13_talked_about_how_much_todo_for_physical_activities_fri ==  5) echo 'selected';} ?>>5</option>
                </select>
              </div>
              </td>
            </tr>
          </tbody>
        </table>
    </div>
    <div class="form-row text-center mt-4">
  <div class="form-group col-md-12">
  <a class="btn btn-danger" role="button" onclick="history.go(-1);" style="color:white;">Cancel</a>
  <?php if(isset($_GET['ssid'])&&!empty($_GET['ssid'])){ ?>
   <input class="btn btn-primary" role="button" type="submit" value="Update" name="go_register_form" >
  <?php }else{ ?>
  <?php ?>
 	<input class="btn btn-primary" role="button" type="submit" value="Submit" name="go_register_form" >
  <?php } ?>
  </div>
  </div>
</div>
</form>