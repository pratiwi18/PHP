<?php
// If the form has a ID, it means it needs to be updated - Loads the data from the database to put them into the form
if (isset($_GET['dbid']) && ! empty($_GET['dbid'])) {
    $dbid = $_GET['dbid'];
    // Grab the information about the quesitionnaire from the database based on the dbid
    $db_form = decisionalBalance::find_by_id($dbid);
}
?>

<form method="post" action="">
	<div class="jumbotron text-left">
		<div class="col-md-12">
			<strong>Measure:</strong>
			<p>Please rate how important each of these statements is in your
				decision of whether to be physically active. In each case, think
				about how you feel right now, not how you have felt in the past or
				would like to feel.</p>
			<strong>Scale:</strong>
			<ul>
				<li>1= not at all important</li>
				<li>2= slightly important</li>
				<li>3= moderately important</li>
				<li>4= very important</li>
				<li>5= extremely important</li>
			</ul>
		</div>
		<div class="col-md-12">
			<p>1. I would have more energy for my family and friends if I were
				regularly physically active.</p>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q1_more_energy_as_physically_active"
					id="dbq_q1_more_energy_as_physically_active" value="1"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q1_more_energy_as_physically_active == 1) echo 'checked';} ?>>1
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q1_more_energy_as_physically_active"
					id="dbq_q1_more_energy_as_physically_active" value="2"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q1_more_energy_as_physically_active == 2) echo 'checked';} ?>>2
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q1_more_energy_as_physically_active"
					id="dbq_q1_more_energy_as_physically_active" value="3"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q1_more_energy_as_physically_active == 3) echo 'checked';} ?>>3
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q1_more_energy_as_physically_active"
					id="dbq_q1_more_energy_as_physically_active" value="4"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q1_more_energy_as_physically_active == 4) echo 'checked';} ?>>
					4
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q1_more_energy_as_physically_active"
					id="dbq_q1_more_energy_as_physically_active" value="5"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q1_more_energy_as_physically_active == 5) echo 'checked';} ?>>
					5
				</label>
			</div>
		</div>

		<div class="col-md-12">
			<p>2. Regular physical activity would help me relieve tension.</p>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q2_tension_relieve_do_regular_physical_activity"
					id="dbq_q2_tension_relieve_do_regular_physical_activity" value="1"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q2_tension_relieve_do_regular_physical_activity == 1) echo 'checked';} ?>>1
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q2_tension_relieve_do_regular_physical_activity"
					id="dbq_q2_tension_relieve_do_regular_physical_activity" value="2"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q2_tension_relieve_do_regular_physical_activity == 2) echo 'checked';} ?>>2
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q2_tension_relieve_do_regular_physical_activity"
					id="dbq_q2_tension_relieve_do_regular_physical_activity" value="3"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q2_tension_relieve_do_regular_physical_activity == 3) echo 'checked';} ?>>3
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q2_tension_relieve_do_regular_physical_activity"
					id="dbq_q2_tension_relieve_do_regular_physical_activity" value="4"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q2_tension_relieve_do_regular_physical_activity == 4) echo 'checked';} ?>>
					4
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q2_tension_relieve_do_regular_physical_activity"
					id="dbq_q2_tension_relieve_do_regular_physical_activity" value="5"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q2_tension_relieve_do_regular_physical_activity == 5) echo 'checked';} ?>>
					5
				</label>
			</div>
		</div>

		<div class="col-md-12">
			<p>3. I think I would be too tired to do my daily work after being
				physically active.</p>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q3_tired_daily_work_as_physically_active"
					id="dbq_q3_tired_daily_work_as_physically_active" value="1"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q3_tired_daily_work_as_physically_active == 1) echo 'checked';} ?>>1
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q3_tired_daily_work_as_physically_active"
					id="dbq_q3_tired_daily_work_as_physically_active" value="2"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q3_tired_daily_work_as_physically_active == 2) echo 'checked';} ?>>2
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q3_tired_daily_work_as_physically_active"
					id="dbq_q3_tired_daily_work_as_physically_active" value="3"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q3_tired_daily_work_as_physically_active == 3) echo 'checked';} ?>>3
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q3_tired_daily_work_as_physically_active"
					id="dbq_q3_tired_daily_work_as_physically_active" value="4"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q3_tired_daily_work_as_physically_active == 4) echo 'checked';} ?>>
					4
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q3_tired_daily_work_as_physically_active"
					id="dbq_q3_tired_daily_work_as_physically_active" value="5"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q3_tired_daily_work_as_physically_active == 5) echo 'checked';} ?>>
					5
				</label>
			</div>
		</div>

		<div class="col-md-12">
			<p>4. I would feel more confident if I were regularly physically
				active.</p>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q4_more_confident_as_physically_active"
					id="dbq_q4_more_confident_as_physically_active" value="1"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q4_more_confident_as_physically_active == 1) echo 'checked';} ?>>1
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q4_more_confident_as_physically_active"
					id="dbq_q4_more_confident_as_physically_active" value="2"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q4_more_confident_as_physically_active == 2) echo 'checked';} ?>>2
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q4_more_confident_as_physically_active"
					id="dbq_q4_more_confident_as_physically_active" value="3"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q4_more_confident_as_physically_active == 3) echo 'checked';} ?>>3
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q4_more_confident_as_physically_active"
					id="dbq_q4_more_confident_as_physically_active" value="4"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q4_more_confident_as_physically_active == 4) echo 'checked';} ?>>
					4
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q4_more_confident_as_physically_active"
					id="dbq_q4_more_confident_as_physically_active" value="5"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q4_more_confident_as_physically_active == 5) echo 'checked';} ?>>
					5
				</label>
			</div>
		</div>

		<div class="col-md-12">
			<p>5. I would sleep more soundly if I were regularly physically
				active.</p>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q5_more_sound_sleep_as_physically_active"
					id="dbq_q5_more_sound_sleep_as_physically_active" value="1"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q5_more_sound_sleep_as_physically_active == 1) echo 'checked';} ?>>1
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q5_more_sound_sleep_as_physically_active"
					id="dbq_q5_more_sound_sleep_as_physically_active" value="2"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q5_more_sound_sleep_as_physically_active == 2) echo 'checked';} ?>>2
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q5_more_sound_sleep_as_physically_active"
					id="dbq_q5_more_sound_sleep_as_physically_active" value="3"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q5_more_sound_sleep_as_physically_active == 3) echo 'checked';} ?>>3
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q5_more_sound_sleep_as_physically_active"
					id="dbq_q5_more_sound_sleep_as_physically_active" value="4"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q5_more_sound_sleep_as_physically_active == 4) echo 'checked';} ?>>
					4
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q5_more_sound_sleep_as_physically_active"
					id="dbq_q5_more_sound_sleep_as_physically_active" value="5"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q5_more_sound_sleep_as_physically_active == 5) echo 'checked';} ?>>
					5
				</label>
			</div>
		</div>

		<div class="col-md-12">
			<p>6. I would feel good about myself if I kept my commitment to being
				regularly physically active.</p>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q6_feel_better_as_physically_active"
					id="dbq_q6_feel_better_as_physically_active" value="1"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q6_feel_better_as_physically_active == 1) echo 'checked';} ?>>1
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q6_feel_better_as_physically_active"
					id="dbq_q6_feel_better_as_physically_active" value="2"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q6_feel_better_as_physically_active == 2) echo 'checked';} ?>>2
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q6_feel_better_as_physically_active"
					id="dbq_q6_feel_better_as_physically_active" value="3"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q6_feel_better_as_physically_active == 3) echo 'checked';} ?>>3
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q6_feel_better_as_physically_active"
					id="dbq_q6_feel_better_as_physically_active" value="4"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q6_feel_better_as_physically_active == 4) echo 'checked';} ?>>
					4
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q6_feel_better_as_physically_active"
					id="dbq_q6_feel_better_as_physically_active" value="5"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q6_feel_better_as_physically_active == 5) echo 'checked';} ?>>
					5
				</label>
			</div>
		</div>

		<div class="col-md-12">
			<p>7. I would find it difficult to find a physical activity that I
				enjoy and that is not affected by bad weather.</p>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q7_difficulty_finding_physical_activity_not_affected_by_weat"
					id="dbq_q7_difficulty_finding_physical_activity_not_affected_by_weat"
					value="1"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q7_difficulty_finding_physical_activity_not_affected_by_weat == 1) echo 'checked';} ?>>1
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q7_difficulty_finding_physical_activity_not_affected_by_weat"
					id="dbq_q7_difficulty_finding_physical_activity_not_affected_by_weat"
					value="2"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q7_difficulty_finding_physical_activity_not_affected_by_weat == 2) echo 'checked';} ?>>2
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q7_difficulty_finding_physical_activity_not_affected_by_weat"
					id="dbq_q7_difficulty_finding_physical_activity_not_affected_by_weat"
					value="3"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q7_difficulty_finding_physical_activity_not_affected_by_weat == 3) echo 'checked';} ?>>3
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q7_difficulty_finding_physical_activity_not_affected_by_weat"
					id="dbq_q7_difficulty_finding_physical_activity_not_affected_by_weat"
					value="4"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q7_difficulty_finding_physical_activity_not_affected_by_weat == 4) echo 'checked';} ?>>
					4
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q7_difficulty_finding_physical_activity_not_affected_by_weat"
					id="dbq_q7_difficulty_finding_physical_activity_not_affected_by_weat"
					value="5"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q7_difficulty_finding_physical_activity_not_affected_by_weat == 5) echo 'checked';} ?>>
					5
				</label>
			</div>
		</div>

		<div class="col-md-12">
			<p>8. I would like my body better if I were regularly physically
				active.</p>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q8_better_body_as_physically_active"
					id="dbq_q8_better_body_as_physically_active" value="1"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q8_better_body_as_physically_active == 1) echo 'checked';} ?>>1
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q8_better_body_as_physically_active"
					id="dbq_q8_better_body_as_physically_active" value="2"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q8_better_body_as_physically_active == 2) echo 'checked';} ?>>2
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q8_better_body_as_physically_active"
					id="dbq_q8_better_body_as_physically_active" value="3"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q8_better_body_as_physically_active == 3) echo 'checked';} ?>>3
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q8_better_body_as_physically_active"
					id="dbq_q8_better_body_as_physically_active" value="4"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q8_better_body_as_physically_active == 4) echo 'checked';} ?>>
					4
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q8_better_body_as_physically_active"
					id="dbq_q8_better_body_as_physically_active" value="5"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q8_better_body_as_physically_active == 5) echo 'checked';} ?>>
					5
				</label>
			</div>
		</div>

		<div class="col-md-12">
			<p>9. It would be easier for me to perform routine physical tasks if
				I were regularly physically active.</p>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q9_easier_perform_routine_task_as_physically_active"
					id="dbq_q9_easier_perform_routine_task_as_physically_active"
					value="1"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q9_easier_perform_routine_task_as_physically_active == 1) echo 'checked';} ?>>1
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q9_easier_perform_routine_task_as_physically_active"
					id="dbq_q9_easier_perform_routine_task_as_physically_active"
					value="2"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q9_easier_perform_routine_task_as_physically_active == 2) echo 'checked';} ?>>2
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q9_easier_perform_routine_task_as_physically_active"
					id="dbq_q9_easier_perform_routine_task_as_physically_active"
					value="3"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q9_easier_perform_routine_task_as_physically_active == 3) echo 'checked';} ?>>3
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q9_easier_perform_routine_task_as_physically_active"
					id="dbq_q9_easier_perform_routine_task_as_physically_active"
					value="4"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q9_easier_perform_routine_task_as_physically_active == 4) echo 'checked';} ?>>
					4
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q9_easier_perform_routine_task_as_physically_active"
					id="dbq_q9_easier_perform_routine_task_as_physically_active"
					value="5"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q9_easier_perform_routine_task_as_physically_active == 5) echo 'checked';} ?>>
					5
				</label>
			</div>
		</div>

		<div class="col-md-12">
			<p>10. I would feel less stressed if I were regularly physically
				active.</p>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q10_less_stress_as_physically_active"
					id="dbq_q10_less_stress_as_physically_active" value="1"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q10_less_stress_as_physically_active == 1) echo 'checked';} ?>>1
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q10_less_stress_as_physically_active"
					id="dbq_q10_less_stress_as_physically_active" value="2"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q10_less_stress_as_physically_active == 2) echo 'checked';} ?>>2
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q10_less_stress_as_physically_active"
					id="dbq_q10_less_stress_as_physically_active" value="3"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q10_less_stress_as_physically_active == 3) echo 'checked';} ?>>3
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q10_less_stress_as_physically_active"
					id="dbq_q10_less_stress_as_physically_active" value="4"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q10_less_stress_as_physically_active == 4) echo 'checked';} ?>>
					4
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q10_less_stress_as_physically_active"
					id="dbq_q10_less_stress_as_physically_active" value="5"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q10_less_stress_as_physically_active == 5) echo 'checked';} ?>>
					5
				</label>
			</div>
		</div>

		<div class="col-md-12">
			<p>11. I feel uncomfortable when I am physically active because I get
				out of breath and my heart beats very fast.</p>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q11_feel_uncomfortable_as_physically_active"
					id="dbq_q11_feel_uncomfortable_as_physically_active" value="1"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q11_feel_uncomfortable_as_physically_active == 1) echo 'checked';} ?>>1
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q11_feel_uncomfortable_as_physically_active"
					id="dbq_q11_feel_uncomfortable_as_physically_active" value="2"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q11_feel_uncomfortable_as_physically_active == 2) echo 'checked';} ?>>2
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q11_feel_uncomfortable_as_physically_active"
					id="dbq_q11_feel_uncomfortable_as_physically_active" value="3"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q11_feel_uncomfortable_as_physically_active == 3) echo 'checked';} ?>>3
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q11_feel_uncomfortable_as_physically_active"
					id="dbq_q11_feel_uncomfortable_as_physically_active" value="4"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q11_feel_uncomfortable_as_physically_active == 4) echo 'checked';} ?>>
					4
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q11_feel_uncomfortable_as_physically_active"
					id="dbq_q11_feel_uncomfortable_as_physically_active" value="5"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q11_feel_uncomfortable_as_physically_active == 5) echo 'checked';} ?>>
					5
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<p>12. I would feel more comfortable with my body if I were regularly
				physically active.</p>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q12_feel_more_comfortable__as_physically_active"
					id="dbq_q12_feel_more_comfortable__as_physically_active" value="1"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q12_feel_more_comfortable__as_physically_active == 1) echo 'checked';} ?>>1
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q12_feel_more_comfortable__as_physically_active"
					id="dbq_q12_feel_more_comfortable__as_physically_active" value="2"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q12_feel_more_comfortable__as_physically_active == 2) echo 'checked';} ?>>2
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q12_feel_more_comfortable__as_physically_active"
					id="dbq_q12_feel_more_comfortable__as_physically_active" value="3"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q12_feel_more_comfortable__as_physically_active == 3) echo 'checked';} ?>>3
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q12_feel_more_comfortable__as_physically_active"
					id="dbq_q12_feel_more_comfortable__as_physically_active" value="4"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q12_feel_more_comfortable__as_physically_active == 4) echo 'checked';} ?>>
					4
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q12_feel_more_comfortable__as_physically_active"
					id="dbq_q12_feel_more_comfortable__as_physically_active" value="5"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q12_feel_more_comfortable__as_physically_active == 5) echo 'checked';} ?>>
					5
				</label>
			</div>
		</div>

		<div class="col-md-12">
			<p>13. Regular physical activity would take too much of my time.</p>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q13_regular_physical_activity_takes_too_much_time"
					id="dbq_q13_regular_physical_activity_takes_too_much_time"
					value="1"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q13_regular_physical_activity_takes_too_much_time == 1) echo 'checked';} ?>>1
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q13_regular_physical_activity_takes_too_much_time"
					id="dbq_q13_regular_physical_activity_takes_too_much_time"
					value="2"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q13_regular_physical_activity_takes_too_much_time == 2) echo 'checked';} ?>>2
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q13_regular_physical_activity_takes_too_much_time"
					id="dbq_q13_regular_physical_activity_takes_too_much_time"
					value="3"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q13_regular_physical_activity_takes_too_much_time == 3) echo 'checked';} ?>>3
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q13_regular_physical_activity_takes_too_much_time"
					id="dbq_q13_regular_physical_activity_takes_too_much_time"
					value="4"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q13_regular_physical_activity_takes_too_much_time == 4) echo 'checked';} ?>>
					4
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q13_regular_physical_activity_takes_too_much_time"
					id="dbq_q13_regular_physical_activity_takes_too_much_time"
					value="5"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q13_regular_physical_activity_takes_too_much_time == 5) echo 'checked';} ?>>
					5
				</label>
			</div>
		</div>


		<div class="col-md-12">
			<p>14. Regular physical activity would help me have a more positive
				outlook on life.</p>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q14_physical_activity_positive_outlook"
					id="dbq_q14_physical_activity_positive_outlook" value="1"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q14_physical_activity_positive_outlook == 1) echo 'checked';} ?>>1
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q14_physical_activity_positive_outlook"
					id="dbq_q14_physical_activity_positive_outlook" value="2"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q14_physical_activity_positive_outlook == 2) echo 'checked';} ?>>2
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q14_physical_activity_positive_outlook"
					id="dbq_q14_physical_activity_positive_outlook" value="3"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q14_physical_activity_positive_outlook == 3) echo 'checked';} ?>>3
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q14_physical_activity_positive_outlook"
					id="dbq_q14_physical_activity_positive_outlook" value="4"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q14_physical_activity_positive_outlook == 4) echo 'checked';} ?>>
					4
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q14_physical_activity_positive_outlook"
					id="dbq_q14_physical_activity_positive_outlook" value="5"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q14_physical_activity_positive_outlook == 5) echo 'checked';} ?>>
					5
				</label>
			</div>
		</div>

		<div class="col-md-12">
			<p>15. I would have less time for my family and friends if I were
				regularly physically active.</p>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q15_have_less_time_as_physically_active"
					id="dbq_q15_have_less_time_as_physically_active" value="1"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q15_have_less_time_as_physically_active == 1) echo 'checked';} ?>>1
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q15_have_less_time_as_physically_active"
					id="dbq_q15_have_less_time_as_physically_active" value="2"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q15_have_less_time_as_physically_active == 2) echo 'checked';} ?>>2
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q15_have_less_time_as_physically_active"
					id="dbq_q15_have_less_time_as_physically_active" value="3"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q15_have_less_time_as_physically_active == 3) echo 'checked';} ?>>3
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q15_have_less_time_as_physically_active"
					id="dbq_q15_have_less_time_as_physically_active" value="4"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q15_have_less_time_as_physically_active == 4) echo 'checked';} ?>>
					4
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio" name="dbq_q15_have_less_time_as_physically_active"
					id="dbq_q15_have_less_time_as_physically_active" value="5"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q15_have_less_time_as_physically_active == 5) echo 'checked';} ?>>
					5
				</label>
			</div>
		</div>

		<div class="col-md-12">
			<p>16. At the end of the day, I am too exhausted to be physically
				active.</p>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q16_regular_physical_activity_too_exhausted_at_the_end_of_da"
					id="dbq_q16_regular_physical_activity_too_exhausted_at_the_end_of_da"
					value="1"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q16_regular_physical_activity_too_exhausted_at_the_end_of_da == 1) echo 'checked';} ?>>1
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q16_regular_physical_activity_too_exhausted_at_the_end_of_da"
					id="dbq_q16_regular_physical_activity_too_exhausted_at_the_end_of_da"
					value="2"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q16_regular_physical_activity_too_exhausted_at_the_end_of_da == 2) echo 'checked';} ?>>2
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q16_regular_physical_activity_too_exhausted_at_the_end_of_da"
					id="dbq_q16_regular_physical_activity_too_exhausted_at_the_end_of_da"
					value="3"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q16_regular_physical_activity_too_exhausted_at_the_end_of_da == 3) echo 'checked';} ?>>3
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q16_regular_physical_activity_too_exhausted_at_the_end_of_da"
					id="dbq_q16_regular_physical_activity_too_exhausted_at_the_end_of_da"
					value="4"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q16_regular_physical_activity_too_exhausted_at_the_end_of_da == 4) echo 'checked';} ?>>
					4
				</label>
			</div>
			<div class="form-check form-check-inline">
				<label class="form-check-label"> <input class="form-check-input"
					type="radio"
					name="dbq_q16_regular_physical_activity_too_exhausted_at_the_end_of_da"
					id="dbq_q16_regular_physical_activity_too_exhausted_at_the_end_of_da"
					value="5"
					<?php if (isset($_GET['dbid'])&&!empty($_GET['dbid'])) { if ($db_form->dbq_q16_regular_physical_activity_too_exhausted_at_the_end_of_da == 5) echo 'checked';} ?>>
					5
				</label>
			</div>
		</div>
		<div class="form-row text-center mt-4">
			<div class="form-group col-md-12">
				<a class="btn btn-danger" role="button" onclick="history.go(-1);"
					style="color: white;">Cancel</a>
  <?php if(isset($_GET['dbid'])&&!empty($_GET['dbid'])){ ?>
   <input class="btn btn-primary" role="button" type="submit"
					value="Update" name="go_register_form">
  <?php }else{ ?>
  <?php ?>
 	<input class="btn btn-primary" role="button" type="submit"
					value="Submit" name="go_register_form">
  <?php } ?>
  </div>
		</div>

	</div>


</form>


