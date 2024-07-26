<?php 
// If the form has a ID, it means it needs to be updated - Loads the data from the database to put them into the form
if(isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])){ 
	$sf_12id = $_GET['sf_12id'];
	// Grab the information about the quesitionnaire from the database based on the fuid
	$sf_12id_form = sf12Questionnaire::find_by_id($sf_12id);
}

?>
<form class="text-center" method="post" action="">
<div class="jumbotron text-justify mt-5">

    <div class="col-md-12 mb-5">
    	This questionnaire asks for your views about your health. This information will help keep track of how you feel and how well you are able to do your usual activities. Please answer every question by marking one box. If you are unsure about how to answer, please give the best answer you can.
    </div>
    <div class="col-md-12 mb-3">
   <p> 1. In general would you say your health is:</p>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Sf12_q1_general_health" id="Sf12_q1_general_health" value="Excellent"
            <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q1_general_health == 'Excellent') echo 'checked';}?>
            > Excellent
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Sf12_q1_general_health" id="Sf12_q1_general_health" value="Very good"
            <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q1_general_health == 'Very good') echo 'checked';}?>
            > Very good
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Sf12_q1_general_health" id="Sf12_q1_general_health" value="Good"
            <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q1_general_health == 'Good') echo 'checked';}?>> Good
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Sf12_q1_general_health" id="Sf12_q1_general_health" value="Fair"
            <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q1_general_health == 'Fair') echo 'checked';}?>> Fair
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Sf12_q1_general_health" id="Sf12_q1_general_health" value="Poor"
            <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q1_general_health == 'Poor') echo 'checked';}?>> Poor
          </label>
        </div>
    </div>
    <div class="col-md-12 text-left">
    <p> The following items are about activities you might do during a typical day. Does your health now limit you in these activities? If so, how much. </p>
    <table class="table mb-3 text-center">
  <thead>
    <tr>
      <th></th>
      <th>Yes Limited a lot</th>
      <th>Yes limited a little</th>
      <th>No not limited at all</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="text-left">2. Moderate activities, such as moving a table pushing a vacuum cleaner, bowling or playing golf.</td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	<input class="form-check-input" type="radio" name="Sf12_q2_moderate_activity" id="Sf12_q2_moderate_activity" value="Yes limited a lot"
        <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q2_moderate_activity == 'Yes limited a lot') echo 'checked';}?>>
  		</label>
		</div>
      </td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	 <input class="form-check-input" type="radio" name="Sf12_q2_moderate_activity" id="Sf12_q2_moderate_activity" value="Yes limited a little"
         <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q2_moderate_activity == 'Yes limited a little') echo 'checked';}?>>
  		</label>
		</div>
     </td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	<input class="form-check-input" type="radio" name="Sf12_q2_moderate_activity" id="Sf12_q2_moderate_activity" value="No not limited at all"
        <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q2_moderate_activity == 'No not limited at all') echo 'checked';}?>>
  		</label>
		</div>
      </td>
    </tr>
    <tr>
      <td class="text-left">3. Climbing several flights of stairs</td>
 		<td>
        <div class="form-check">
		<label class="form-check-label">
    	 <input class="form-check-input" type="radio" name="Sf12_q3_climbing_stairs" id="Sf12_q3_climbing_stairs" value="Yes limited a lot"
         <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q3_climbing_stairs == 'Yes limited a lot') echo 'checked';}?>>
  		</label>
		</div>
       </td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	<input class="form-check-input" type="radio" name="Sf12_q3_climbing_stairs" id="Sf12_q3_climbing_stairs" value="Yes limited a little"
        <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q3_climbing_stairs == 'Yes limited a little') echo 'checked';}?>>
  		</label>
		</div>
      </td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	<input class="form-check-input" type="radio" name="Sf12_q3_climbing_stairs" id="Sf12_q3_climbing_stairs" value="No not limited at all"
        <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q3_climbing_stairs == 'No not limited at all') echo 'checked';}?>>
  		</label>
		</div>
      </td>
    </tr>
    
  </tbody>
	</table>
    </div>
    
    <div class="col-md-12 text-left">
    <p> During the past month, have you had any of the following problems with your work or other regular activities as a result of your physical health? </p>
    <table class="table mb-5 text-center">
  <thead>
    <tr>
      <th></th>
      <th class="text-center">Yes</th>
      <th class="text-center">No</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="text-left">4. Accomplished less than you would like</td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	<input class="form-check-input" type="radio" name="Sf12_q4_physical_health_problem_accomplished_less_activity" id="Sf12_q4_physical_health_problem_accomplished_less_activity" value="1"
        <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q4_physical_health_problem_accomplished_less_activity == 1) echo 'checked';}?>>
  		</label>
		</div>
      </td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	 <input class="form-check-input" type="radio" name="Sf12_q4_physical_health_problem_accomplished_less_activity" id="Sf12_q4_physical_health_problem_accomplished_less_activity" value="0"
         <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q4_physical_health_problem_accomplished_less_activity == 0) echo 'checked';}?>>
  		</label>
		</div>
     </td>

    </tr>
    <tr>
      <td class="text-left">5. Were limited in the kind of work or other activities</td>
 		<td>
        <div class="form-check">
		<label class="form-check-label">
    	 <input class="form-check-input" type="radio" name="Sf12_q5_physical__health_problem_limited_work_activity" id="Sf12_q5_physical__health_problem_limited_work_activity" value="1"
         <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q5_physical__health_problem_limited_work_activity == 1) echo 'checked';}?>>
  		</label>
		</div>
       </td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	<input class="form-check-input" type="radio" name="Sf12_q5_physical__health_problem_limited_work_activity" id="Sf12_q5_physical__health_problem_limited_work_activity" value="0"
        <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q5_physical__health_problem_limited_work_activity == 0) echo 'checked';}?>>
  		</label>
		</div>
      </td
    ></tr>
  </tbody>
	</table>
    </div>
    
    
    
    <div class="col-md-12 text-left">
    <p> During the past month, have you had any of the following problems with your work or other regular activities as a result of any emotional problems (such as feeling depressed or anxious)? </p>
    <table class="table mb-3 text-center">
  <thead>
    <tr>
      <th></th>
      <th class="text-center">Yes</th>
      <th class="text-center">No</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="text-left">6. Accomplished less than you would like</td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	<input class="form-check-input" type="radio" name="Sf12_q6_emotional_problem_accomplished_less" id="Sf12_q6_emotional_problem_accomplished_less" value="1"
        <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q6_emotional_problem_accomplished_less == 1) echo 'checked';}?>>
  		</label>
		</div>
      </td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	 <input class="form-check-input" type="radio" name="Sf12_q6_emotional_problem_accomplished_less" id="Sf12_q6_emotional_problem_accomplished_less" value="0"
         <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q6_emotional_problem_accomplished_less == 0) echo 'checked';}?>>
  		</label>
		</div>
     </td>

    </tr>
    <tr>
      <td class="text-left">7. Didn’t do work or other activities as carefully as usual </td>
 		<td>
        <div class="form-check">
		<label class="form-check-label">
    	 <input class="form-check-input" type="radio" name="Sf12_q7_emotional_problem_no_usual_work_activities" id="Sf12_q7_emotional_problem_no_usual_work_activities" value="1"
         <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q7_emotional_problem_no_usual_work_activities == 1) echo 'checked';}?>>
  		</label>
		</div>
       </td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	<input class="form-check-input" type="radio" name="Sf12_q7_emotional_problem_no_usual_work_activities" id="Sf12_q7_emotional_problem_no_usual_work_activities" value="0"
        <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q7_emotional_problem_no_usual_work_activities == 0) echo 'checked';}?>>
  		</label>
		</div>
      </td>

    </tr>
    
  </tbody>
	</table>
    </div>
    
    <div class="col-md-12 mb-3">
   <p>8. During the past month, how much did pain interfere with your normal work (including both outside the home and housework)?</p>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Sf12_q8_pain_interfere_normal_work" id="Sf12_q8_pain_interfere_normal_work" value="Not at all"
            <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q8_pain_interfere_normal_work == "Not at all") echo 'checked';}?>> Not at all
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Sf12_q8_pain_interfere_normal_work" id="Sf12_q8_pain_interfere_normal_work" value="A little bit"
            <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q8_pain_interfere_normal_work == "A little bit") echo 'checked';}?>> A little bit
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Sf12_q8_pain_interfere_normal_work" id="Sf12_q8_pain_interfere_normal_work" value="Moderately"
            <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q8_pain_interfere_normal_work == "Moderately") echo 'checked';}?>> Moderately
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Sf12_q8_pain_interfere_normal_work" id="Sf12_q8_pain_interfere_normal_work" value="Quite a bit"
            <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q8_pain_interfere_normal_work == "Quite a bit") echo 'checked';}?>> Quite a bit 
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Sf12_q8_pain_interfere_normal_work" id="Sf12_q8_pain_interfere_normal_work" value="Extremely"
            <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q8_pain_interfere_normal_work == "Extremely") echo 'checked';}?>> Extremely
          </label>
        </div>
    </div>
    
    
    <div class="col-md-12 text-left">
    <p> These questions are about how you feel and how things have been with you during the past month. For each question, please give the one answer that comes closest to the way you have been feeling. How much of the time during the past month: </p>
    <table class="table mb-3 text-center">
  <thead>
    <tr>
      <th></th>
      <th>All of the time</th>
      <th>Most of the time</th>
      <th>A good bit of the time</th>
      <th>A little of the time</th>
      <th>None of the time</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="text-left">9. Have you felt calm and peaceful?</td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	<input class="form-check-input" type="radio" name="Sf12_q9_calm_peaceful_feeling_past_month" id="Sf12_q9_calm_peaceful_feeling_past_month" value="All of the time"
        <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q9_calm_peaceful_feeling_past_month == "All of the time") echo 'checked';}?>>
  		</label>
		</div>
      </td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	 <input class="form-check-input" type="radio" name="Sf12_q9_calm_peaceful_feeling_past_month" id="Sf12_q9_calm_peaceful_feeling_past_month" value="Most of the time"
         <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q9_calm_peaceful_feeling_past_month == "Most of the time") echo 'checked';}?>>
  		</label>
		</div>
     </td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	<input class="form-check-input" type="radio" name="Sf12_q9_calm_peaceful_feeling_past_month" id="Sf12_q9_calm_peaceful_feeling_past_month" value="A good bit of the time"
        <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q9_calm_peaceful_feeling_past_month == "A good bit of the time") echo 'checked';}?>>
  		</label>
		</div>
      </td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	 <input class="form-check-input" type="radio" name="Sf12_q9_calm_peaceful_feeling_past_month" id="Sf12_q9_calm_peaceful_feeling_past_month" value="A little of the time"
         <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q9_calm_peaceful_feeling_past_month == "A little of the time") echo 'checked';}?>>
  		</label>
		</div>
     </td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	<input class="form-check-input" type="radio" name="Sf12_q9_calm_peaceful_feeling_past_month" id="Sf12_q9_calm_peaceful_feeling_past_month" value="None of the time"
        <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q9_calm_peaceful_feeling_past_month == "None of the time") echo 'checked';}?>>
  		</label>
		</div>
      </td>
    </tr>
    <tr>
      <td class="text-left">10. Did you have a lot of energy?</td>
 		<td>
      <div class="form-check">
		<label class="form-check-label">
    	<input class="form-check-input" type="radio" name="Sf12_q10_lot_of_energy_feeling_past_month" id="Sf12_q10_lot_of_energy_feeling_past_month" value="All of the time"
        <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q10_lot_of_energy_feeling_past_month == "All of the time") echo 'checked';}?>>
  		</label>
		</div>
      </td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	 <input class="form-check-input" type="radio" name="Sf12_q10_lot_of_energy_feeling_past_month" id="Sf12_q10_lot_of_energy_feeling_past_month" value="Most of the time"
         <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q10_lot_of_energy_feeling_past_month == "Most of the time") echo 'checked';}?>>
  		</label>
		</div>
     </td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	<input class="form-check-input" type="radio" name="Sf12_q10_lot_of_energy_feeling_past_month" id="Sf12_q10_lot_of_energy_feeling_past_month" value="A good bit of the time"
        <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q10_lot_of_energy_feeling_past_month == "A good bit of the time") echo 'checked';}?>>
  		</label>
		</div>
      </td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	 <input class="form-check-input" type="radio" name="Sf12_q10_lot_of_energy_feeling_past_month" id="Sf12_q10_lot_of_energy_feeling_past_month" value="A little of the time"
         <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q10_lot_of_energy_feeling_past_month == "A little of the time") echo 'checked';}?>>
  		</label>
		</div>
     </td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	<input class="form-check-input" type="radio" name="Sf12_q10_lot_of_energy_feeling_past_month" id="Sf12_q10_lot_of_energy_feeling_past_month" value="None of the time"
        <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q10_lot_of_energy_feeling_past_month == "None of the time") echo 'checked';}?>>
  		</label>
		</div>
      </td>
    </tr>
    
    <tr>
      <td class="text-left">11. Have you felt down-hearted and blue?</td>
 		<td>
      <div class="form-check">
		<label class="form-check-label">
    	<input class="form-check-input" type="radio" name="Sf12_q11_downheart_blue_feeling_past_month" id="Sf12_q11_downheart_blue_feeling_past_month" value="All of the time"
        <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q11_downheart_blue_feeling_past_month == "All of the time") echo 'checked';}?>>
  		</label>
		</div>
      </td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	 <input class="form-check-input" type="radio" name="Sf12_q11_downheart_blue_feeling_past_month" id="Sf12_q11_downheart_blue_feeling_past_month" value="Most of the time"
         <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q11_downheart_blue_feeling_past_month == "Most of the time") echo 'checked';}?>>
  		</label>
		</div>
     </td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	<input class="form-check-input" type="radio" name="Sf12_q11_downheart_blue_feeling_past_month" id="Sf12_q11_downheart_blue_feeling_past_month" value="A good bit of the time"
        <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q11_downheart_blue_feeling_past_month == "A good bit of the time") echo 'checked';}?>>
  		</label>
		</div>
      </td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	 <input class="form-check-input" type="radio" name="Sf12_q11_downheart_blue_feeling_past_month" id="Sf12_q11_downheart_blue_feeling_past_month" value="A little of the time"
         <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q11_downheart_blue_feeling_past_month == "A little of the time") echo 'checked';}?>>
  		</label>
		</div>
     </td>
      <td>
      <div class="form-check">
		<label class="form-check-label">
    	<input class="form-check-input" type="radio" name="Sf12_q11_downheart_blue_feeling_past_month" id="Sf12_q11_downheart_blue_feeling_past_month" value="None of the time"
        <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q11_downheart_blue_feeling_past_month == "None of the time") echo 'checked';}?>>
  		</label>
		</div>
      </td>
    </tr>
    
  </tbody>
	</table>
    </div>
    
     <div class="col-md-12 mb-3">
   <p>12. During the past month, how much of the time has your physical health or emotional problems interfered with your social activities (like visiting with friends, relatives etc.)?</p>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Sf12_q12_physical_health_emotional_problem_interfere_social_acti" id="Sf12_q12_physical_health_emotional_problem_interfere_social_acti" value="All of the time"
            <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q12_physical_health_emotional_problem_interfere_social_acti == "All of the time") echo 'checked';}?>> All of the time
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Sf12_q12_physical_health_emotional_problem_interfere_social_acti" id="Sf12_q12_physical_health_emotional_problem_interfere_social_acti" value="Most of the time"
           <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q12_physical_health_emotional_problem_interfere_social_acti == "Most of the time") echo 'checked';}?> > Most of the time
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Sf12_q12_physical_health_emotional_problem_interfere_social_acti" id="Sf12_q12_physical_health_emotional_problem_interfere_social_acti" value="Some of the time"
            <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q12_physical_health_emotional_problem_interfere_social_acti == "Some of the time") echo 'checked';}?>> Some of the time
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Sf12_q12_physical_health_emotional_problem_interfere_social_acti" id="Sf12_q12_physical_health_emotional_problem_interfere_social_acti" value="A little bit of the time"
            <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q12_physical_health_emotional_problem_interfere_social_acti == "A little bit of the time") echo 'checked';}?>> A little bit of the time 
          </label>
        </div>
        <div class="form-check form-check-inline">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="Sf12_q12_physical_health_emotional_problem_interfere_social_acti" id="Sf12_q12_physical_health_emotional_problem_interfere_social_acti" value="None of the time"
            <?php if (isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])) { if ($sf_12id_form->Sf12_q12_physical_health_emotional_problem_interfere_social_acti == "None of the time") echo 'checked';}?>> None of the time
          </label>
        </div>
    </div>
    <div class="form-row text-center mt-4">
  <div class="form-group col-md-12">
  <a class="btn btn-danger" role="button" onclick="history.go(-1);" style="color:white;">Cancel</a>
  <?php if(isset($_GET['sf_12id'])&&!empty($_GET['sf_12id'])){ ?>
   <input class="btn btn-primary" role="button" type="submit" value="Update" name="go_register_form" >
  <?php }else{ ?>
  <?php ?>
 	<input class="btn btn-primary" role="button" type="submit" value="Submit" name="go_register_form" >
  <?php } ?>
  </div>
  </div>
</div>
</form>