<?php
// If the form has a ID, it means it needs to be updated - Loads the data from the database to put them into the form
if (isset($_GET['dwlid']) && ! empty($_GET['dwlid'])) {
    $dwlid = $_GET['dwlid'];
    // Grab the information about the quesitionnaire from the database based on the dwlid
    $dwl_form = difficultyWithLocomotor::find_by_id($dwlid);
}
?>
<form class="text-center" method="post" action="">
	<div class="jumbotron text-left">
		<div class="col-md-12">
			<p>You are being given this questionnaire because you have a
				disability and walk to do at least some of your usual activities
				(e.g. moving around your home, going to the shops, work or school).
				Below is a list of 20 activities that relate to walking or jogging.
				Please read the list and indicate which ones you / your child can
				do.</p>
			<strong>Some points before you start:</strong>
			<ul>
				<li>For most activities, we ask if you can do it without aids and
					then, in the next question, if you can do it with aids. By aids we
					mean things that you hold in your hands to help with walking, like
					crutches and walking frames (we don’t count AFO’s or splints
					that you wear on your legs as walking aids.)</li>
				<li>If you think you can do something without aids, then we will
					assume you can do it with aids.</li>
				<li>There are 9 categories of activity. The categories that have an
					asterisk (*) need a little explanation and that is presented on the
					bottom of the page. (all the ones from No. 3-9).</li>
			</ul>
		</div>

		<div class="col-md-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center">Category</th>
						<th class="text-center">Activity</th>
						<th class="text-center">Yes</th>
						<th class="text-center">No</th>
					</tr>
				</thead>
				<tbody class="text-center">
					<tr>
						<th class="text-center">1. Normal walking</th>
						<td class="text-left">Can you walk for a short distance (20m) <strong>
								without aids? </strong></td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio"
									name="Diff_locomotor_q11_walk_short_distance_without_aid"
									id="Diff_locomotor_q11_walk_short_distance_without_aid"
									value="1"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if ($dwl_form->Diff_locomotor_q11_walk_short_distance_without_aid ==  1) echo 'checked';} ?>>
								</label>
							</div>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio"
									name="Diff_locomotor_q11_walk_short_distance_without_aid"
									id="Diff_locomotor_q11_walk_short_distance_without_aid"
									value="0"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if (!is_null($dwl_form->Diff_locomotor_q11_walk_short_distance_without_aid) AND $dwl_form->Diff_locomotor_q11_walk_short_distance_without_aid ==  0) echo 'checked';} ?>>
								</label>
							</div>
						</td>
					</tr>
					<tr>
						<th class="text-center" rowspan="2">2. Stopping and turning</th>
						<td class="text-left">When walking at your normal pace, can you
							stop, turn and walk in opposite direction <strong> without aids?
						</strong>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio"
									name="Diff_locomotor_q21_stop_turn_walk_without_aid"
									id="Diff_locomotor_q21_stop_turn_walk_without_aid" value="1"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if ($dwl_form->Diff_locomotor_q21_stop_turn_walk_without_aid == 1) echo 'checked';} ?>>
								</label>
							</div>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio"
									name="Diff_locomotor_q21_stop_turn_walk_without_aid"
									id="Diff_locomotor_q21_stop_turn_walk_without_aid" value="0"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if (!is_null($dwl_form->Diff_locomotor_q21_stop_turn_walk_without_aid) AND $dwl_form->Diff_locomotor_q21_stop_turn_walk_without_aid ==  0) echo 'checked';} ?>>
								</label>
							</div>
						</td>
					</tr>
					<tr>
						<td class="text-left">When walking at your normal pace, can you
							stop, turn and walk in opposite direction <strong> with aids? </strong>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio" name="Diff_locomotor_q22_stop_turn_walk_with_aid"
									id="Diff_locomotor_q22_stop_turn_walk_with_aid" value="1"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if ($dwl_form->Diff_locomotor_q22_stop_turn_walk_with_aid ==  1) echo 'checked';} ?>>
								</label>
							</div>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio" name="Diff_locomotor_q22_stop_turn_walk_with_aid"
									id="Diff_locomotor_q22_stop_turn_walk_with_aid" value="0"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if (!is_null($dwl_form->Diff_locomotor_q22_stop_turn_walk_with_aid) AND $dwl_form->Diff_locomotor_q22_stop_turn_walk_with_aid ==  0) echo 'checked';} ?>>
								</label>
							</div>
						</td>
					</tr>
					<tr>
						<th class="text-center" rowspan="2">3. Slopes or Inclines*</th>
						<td class="text-left">Can you walk up a standard (4.1) incline<strong>
								without aids? </strong></td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio" name="Diff_locomotor_q31_incline_walk_without_aid"
									id="Diff_locomotor_q31_incline_walk_without_aid" value="1"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if ($dwl_form->Diff_locomotor_q31_incline_walk_without_aid == 1) echo 'checked';} ?>>
								</label>
							</div>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio" name="Diff_locomotor_q31_incline_walk_without_aid"
									id="Diff_locomotor_q31_incline_walk_without_aid" value="0"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if (!is_null($dwl_form->Diff_locomotor_q31_incline_walk_without_aid) AND $dwl_form->Diff_locomotor_q31_incline_walk_without_aid ==  0) echo 'checked';} ?>>
								</label>
							</div>
						</td>
					</tr>
					<tr>
						<td class="text-left">Can you walk up a standard (4.1) incline <strong>
								with aids? </strong></td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio" name="Diff_locomotor_q32_incline_walk_with_aid"
									id="Diff_locomotor_q32_incline_walk_with_aid" value="1"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if ($dwl_form->Diff_locomotor_q32_incline_walk_with_aid ==  1) echo 'checked';} ?>>
								</label>
							</div>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio" name="Diff_locomotor_q32_incline_walk_with_aid"
									id="Diff_locomotor_q32_incline_walk_with_aid" value="0"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if (!is_null($dwl_form->Diff_locomotor_q32_incline_walk_with_aid) AND $dwl_form->Diff_locomotor_q32_incline_walk_with_aid ==  0) echo 'checked';} ?>>
								</label>
							</div>
						</td>
					</tr>

					<tr>
						<th class="text-center" rowspan="4">4. Hurrying*</th>
						<td class="text-left">Can you hurry <strong> without aids </strong>
							for short distance (20m)?
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio"
									name="Diff_locomotor_q41_hurry_short_distance_without_aid"
									id="Diff_locomotor_q41_hurry_short_distance_without_aid"
									value="1"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if ($dwl_form->Diff_locomotor_q41_hurry_short_distance_without_aid ==  1) echo 'checked';} ?>>
								</label>
							</div>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio"
									name="Diff_locomotor_q41_hurry_short_distance_without_aid"
									id="Diff_locomotor_q41_hurry_short_distance_without_aid"
									value="0"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if (!is_null($dwl_form->Diff_locomotor_q41_hurry_short_distance_without_aid) AND $dwl_form->Diff_locomotor_q41_hurry_short_distance_without_aid ==  0) echo 'checked';} ?>>
								</label>
							</div>
						</td>
					</tr>
					<tr>
						<td class="text-left">Can you hurry <strong> with aids </strong>
							for short distance (20m)?
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio"
									name="Diff_locomotor_q42_hurry_short_distance_with_aid"
									id="Diff_locomotor_q42_hurry_short_distance_with_aid" value="1"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if ($dwl_form->Diff_locomotor_q42_hurry_short_distance_with_aid ==  1) echo 'checked';} ?>>
								</label>
							</div>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio"
									name="Diff_locomotor_q42_hurry_short_distance_with_aid"
									id="Diff_locomotor_q42_hurry_short_distance_with_aid" value="0"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if (!is_null($dwl_form->Diff_locomotor_q42_hurry_short_distance_with_aid) AND $dwl_form->Diff_locomotor_q42_hurry_short_distance_with_aid ==  0) echo 'checked';} ?>>
								</label>
							</div>
						</td>
					</tr>
					<tr>
						<td class="text-left">Can you hurry <strong> without aids </strong>
							for long distance (200m)?
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio"
									name="Diff_locomotor_q43_hurry_long_distance_without_aid"
									id="Diff_locomotor_q43_hurry_long_distance_without_aid"
									value="1"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if ($dwl_form->Diff_locomotor_q43_hurry_long_distance_without_aid ==  1) echo 'checked';} ?>>
								</label>
							</div>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio"
									name="Diff_locomotor_q43_hurry_long_distance_without_aid"
									id="Diff_locomotor_q43_hurry_long_distance_without_aid"
									value="0"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if (!is_null($dwl_form->Diff_locomotor_q43_hurry_long_distance_without_aid) AND $dwl_form->Diff_locomotor_q43_hurry_long_distance_without_aid ==  0) echo 'checked';} ?>>
								</label>
							</div>
						</td>
					</tr>
					<tr>
						<td class="text-left">Can you hurry <strong> with aids </strong>
							for long distance (200m)?
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio"
									name="Diff_locomotor_q44_hurry_longt_distance_with_aid"
									id="Diff_locomotor_q44_hurry_longt_distance_with_aid" value="1"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if ($dwl_form->Diff_locomotor_q44_hurry_longt_distance_with_aid ==  1) echo 'checked';} ?>>
								</label>
							</div>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio"
									name="Diff_locomotor_q44_hurry_longt_distance_with_aid"
									id="Diff_locomotor_q44_hurry_longt_distance_with_aid" value="0"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if (!is_null($dwl_form->Diff_locomotor_q44_hurry_longt_distance_with_aid) AND $dwl_form->Diff_locomotor_q44_hurry_longt_distance_with_aid ==  0) echo 'checked';} ?>>
								</label>
							</div>
						</td>
					</tr>
					<tr>
						<th class="text-center" rowspan="2">5. Gutters*</th>
						<td class="text-left">Can you step up a gutter<strong> without
								aids? </strong></td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio" name="Diff_locomotor_q51_gutter_step_without_aid"
									id="Diff_locomotor_q51_gutter_step_without_aid" value="1"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if ($dwl_form->Diff_locomotor_q51_gutter_step_without_aid ==  1) echo 'checked';} ?>>
								</label>
							</div>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio" name="Diff_locomotor_q51_gutter_step_without_aid"
									id="Diff_locomotor_q51_gutter_step_without_aid" value="0"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if (!is_null($dwl_form->Diff_locomotor_q51_gutter_step_without_aid) AND $dwl_form->Diff_locomotor_q51_gutter_step_without_aid ==  0) echo 'checked';} ?>>
								</label>
							</div>
						</td>
					</tr>
					<tr>
						<td class="text-left">Can you step up a gutter <strong> with aids?
						</strong></td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio" name="Diff_locomotor_q52_gutter_step_with_aid"
									id="Diff_locomotor_q52_gutter_step_with_aid" value="1"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if ($dwl_form->Diff_locomotor_q52_gutter_step_with_aid ==  1) echo 'checked';} ?>>
								</label>
							</div>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio" name="Diff_locomotor_q52_gutter_step_with_aid"
									id="Diff_locomotor_q52_gutter_step_with_aid" value="0"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if (!is_null($dwl_form->Diff_locomotor_q52_gutter_step_with_aid) AND $dwl_form->Diff_locomotor_q52_gutter_step_with_aid ==  0) echo 'checked';} ?>>
								</label>
							</div>
						</td>
					</tr>

					<tr>
						<th class="text-center" rowspan="2">6. Soft, grassy surfaces*</th>
						<td class="text-left">Can you walk on grassy oval<strong> without
								aids? </strong></td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio"
									name="Diff_locomotor_q61_soft_grassy_surface_without_aid"
									id="Diff_locomotor_q61_soft_grassy_surface_without_aid"
									value="1"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if ($dwl_form->Diff_locomotor_q61_soft_grassy_surface_without_aid ==  1) echo 'checked';} ?>>
								</label>
							</div>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio"
									name="Diff_locomotor_q61_soft_grassy_surface_without_aid"
									id="Diff_locomotor_q61_soft_grassy_surface_without_aid"
									value="0"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if (!is_null($dwl_form->Diff_locomotor_q61_soft_grassy_surface_without_aid) AND $dwl_form->Diff_locomotor_q61_soft_grassy_surface_without_aid ==  0) echo 'checked';} ?>>
								</label>
							</div>
						</td>
					</tr>
					<tr>
						<td class="text-left">Can you walk on grassy oval <strong> with
								aids? </strong></td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio"
									name="Diff_locomotor_q62_soft_grassy_surface_with_aid"
									id="Diff_locomotor_q62_soft_grassy_surface_with_aid" value="1"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if ($dwl_form->Diff_locomotor_q62_soft_grassy_surface_with_aid ==  1) echo 'checked';} ?>>
								</label>
							</div>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio"
									name="Diff_locomotor_q62_soft_grassy_surface_with_aid"
									id="Diff_locomotor_q62_soft_grassy_surface_with_aid" value="0"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if (!is_null($dwl_form->Diff_locomotor_q62_soft_grassy_surface_with_aid) AND $dwl_form->Diff_locomotor_q62_soft_grassy_surface_with_aid ==  0) echo 'checked';} ?>>
								</label>
							</div>
						</td>
					</tr>

					<tr>
						<th class="text-center" rowspan="4">7. Up and down stairs*</th>
						<td class="text-left">Can you climb stairs wihout holding onto
							railing?</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio" name="Diff_locomotor_q71_up_stairs_without_aid"
									id="Diff_locomotor_q71_up_stairs_without_aid" value="1"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if ($dwl_form->Diff_locomotor_q71_up_stairs_without_aid ==  1) echo 'checked';} ?>>
								</label>
							</div>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio" name="Diff_locomotor_q71_up_stairs_without_aid"
									id="Diff_locomotor_q71_up_stairs_without_aid" value="0"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if (!is_null($dwl_form->Diff_locomotor_q71_up_stairs_without_aid) AND $dwl_form->Diff_locomotor_q71_up_stairs_without_aid ==  0) echo 'checked';} ?>>
								</label>
							</div>
						</td>
					</tr>
					<tr>
						<td class="text-left">Climb stairs while holding onto railing?</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio" name="Diff_locomotor_q72_up_stairs_with_aid"
									id="Diff_locomotor_q72_up_stairs_with_aid" value="1"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if ($dwl_form->Diff_locomotor_q72_up_stairs_with_aid ==  1) echo 'checked';} ?>>
								</label>
							</div>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio" name="Diff_locomotor_q72_up_stairs_with_aid"
									id="Diff_locomotor_q72_up_stairs_with_aid" value="0"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if (!is_null($dwl_form->Diff_locomotor_q72_up_stairs_with_aid) AND $dwl_form->Diff_locomotor_q72_up_stairs_with_aid ==  0) echo 'checked';} ?>>
								</label>
							</div>
						</td>
					</tr>
					<tr>
						<td class="text-left">Can you descend stairs without holding onto
							railing?</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio" name="Diff_locomotor_q73_down_stairs_without_aid"
									id="Diff_locomotor_q73_down_stairs_without_aid" value="1"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if ($dwl_form->Diff_locomotor_q73_down_stairs_without_aid ==  1) echo 'checked';} ?>>
								</label>
							</div>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio" name="Diff_locomotor_q73_down_stairs_without_aid"
									id="Diff_locomotor_q73_down_stairs_without_aid" value="0"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if (!is_null($dwl_form->Diff_locomotor_q73_down_stairs_without_aid) AND $dwl_form->Diff_locomotor_q73_down_stairs_without_aid ==  0) echo 'checked';} ?>>
								</label>
							</div>
						</td>
					</tr>
					<tr>
						<td class="text-left">Can you descend stairs while holding onto
							railing?</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio" name="Diff_locomotor_q74_down_stairs_with_aid"
									id="Diff_locomotor_q74_down_stairs_with_aid" value="1"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if ($dwl_form->Diff_locomotor_q74_down_stairs_with_aid ==  1) echo 'checked';} ?>>
								</label>
							</div>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio" name="Diff_locomotor_q74_down_stairs_with_aid"
									id="Diff_locomotor_q74_down_stairs_with_aid" value="0"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if (!is_null($dwl_form->Diff_locomotor_q74_down_stairs_with_aid) AND $dwl_form->Diff_locomotor_q74_down_stairs_with_aid ==  0) echo 'checked';} ?>>
								</label>
							</div>
						</td>
					</tr>
					<tr>
						<th class="text-center" rowspan="2">8. Carrying things*</th>
						<td class="text-left">Can you walk at self selected pace <strong>
								without aids </strong> while carrying a cup of water?
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio"
									name="Diff_locomotor_q81_walk_carrying_things_without_aid"
									id="Diff_locomotor_q81_walk_carrying_things_without_aid"
									value="1"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if ($dwl_form->Diff_locomotor_q81_walk_carrying_things_without_aid ==  1) echo 'checked';} ?>>
								</label>
							</div>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio"
									name="Diff_locomotor_q81_walk_carrying_things_without_aid"
									id="Diff_locomotor_q81_walk_carrying_things_without_aid"
									value="0"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if (!is_null($dwl_form->Diff_locomotor_q81_walk_carrying_things_without_aid) AND $dwl_form->Diff_locomotor_q81_walk_carrying_things_without_aid ==  0) echo 'checked';} ?>>
								</label>
							</div>
						</td>
					</tr>
					<tr>
						<td class="text-left">Can you walk at self selected pace <strong>
								with aids </strong> while carrying a cup of water?
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio"
									name="Diff_locomotor_q82_walk_carrying_things_with_aid"
									id="Diff_locomotor_q82_walk_carrying_things_with_aid" value="1"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if ($dwl_form->Diff_locomotor_q82_walk_carrying_things_with_aid ==  1) echo 'checked';} ?>>
								</label>
							</div>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio"
									name="Diff_locomotor_q82_walk_carrying_things_with_aid"
									id="Diff_locomotor_q82_walk_carrying_things_with_aid" value="0"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if (!is_null($dwl_form->Diff_locomotor_q82_walk_carrying_things_with_aid) AND $dwl_form->Diff_locomotor_q82_walk_carrying_things_with_aid ==  0) echo 'checked';} ?>>
								</label>
							</div>
						</td>
					</tr>

					<tr>
						<th class="text-center">9. Jogging / running*</th>
						<td class="text-left">Can you jog or run <strong> without aids? </strong></td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio" name="Diff_locomotor_q91_jog_or_run_without_aid"
									id="Diff_locomotor_q91_jog_or_run_without_aid" value="1"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if ($dwl_form->Diff_locomotor_q91_jog_or_run_without_aid ==  1) echo 'checked';} ?>>
								</label>
							</div>
						</td>
						<td>
							<div class="form-check">
								<label class="form-check-label"> <input class="form-check-input"
									type="radio" name="Diff_locomotor_q91_jog_or_run_without_aid"
									id="Diff_locomotor_q91_jog_or_run_without_aid" value="0"
									<?php if (isset($_GET['dwlid'])&&!empty($_GET['dwlid'])) { if (!is_null($dwl_form->Diff_locomotor_q91_jog_or_run_without_aid) AND $dwl_form->Diff_locomotor_q91_jog_or_run_without_aid ==  0) echo 'checked';} ?>>
								</label>
							</div>
						</td>
					</tr>

				</tbody>
			</table>
		</div>

		<div class="form-row text-center mt-4">
			<div class="form-group col-md-12">
				<a class="btn btn-danger" role="button" onclick="history.go(-1);"
					style="color: white;">Cancel</a>
  <?php if(isset($_GET['dwlid'])&&!empty($_GET['dwlid'])){ ?>
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