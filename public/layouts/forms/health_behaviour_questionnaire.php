<?php 
// If the form has a ID, it means it needs to be updated - Loads the data from the database to put them into the form
if(isset($_GET['hbqid'])&&!empty($_GET['hbqid'])){ 
	global $database;
	$hbqid= $_GET['hbqid'];
	// Grab the information about the quesitionnaire from the database based on the hbqid
	$hbqid_form = healthBehaviourQuestionnaire::find_by_id($hbqid);
}
?>
<form class="text-center" method="post" action="">
<div class="jumbotron text-left mt-5">
	<div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			Ultraviolet rays from the sun penetrate through clouds 
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q1_uv_sunray_penetrate_cloud" id="Hbqhl_q1_uv_sunray_penetrate_cloud" value="1" 
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q1_uv_sunray_penetrate_cloud == 1) echo 'checked';}?>>
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q1_uv_sunray_penetrate_cloud" id="Hbqhl_q1_uv_sunray_penetrate_cloud" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q1_uv_sunray_penetrate_cloud) AND $hbqid_form->Hbqhl_q1_uv_sunray_penetrate_cloud == 0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
     <hr class="my-1">
    <div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			Some types of ultraviolet rays are safe for your skin 
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q2_some_type_uv_sunray_safe_to_skin" id="Hbqhl_q2_some_type_uv_sunray_safe_to_skin" value="1"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q2_some_type_uv_sunray_safe_to_skin == 1) echo 'checked';}?> >
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q2_some_type_uv_sunray_safe_to_skin" id="Hbqhl_q2_some_type_uv_sunray_safe_to_skin" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q2_some_type_uv_sunray_safe_to_skin ) AND $hbqid_form->Hbqhl_q2_some_type_uv_sunray_safe_to_skin == 0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
    <hr class="my-1">
    <div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			You can get sunburned on cloudy days
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q3_sunburned_on_cloudy_days" id="Hbqhl_q3_sunburned_on_cloudy_days" value="1"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q3_sunburned_on_cloudy_days == 1) echo 'checked';}?> >
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q3_sunburned_on_cloudy_days" id="Hbqhl_q3_sunburned_on_cloudy_days" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q3_sunburned_on_cloudy_days ) AND $hbqid_form->Hbqhl_q3_sunburned_on_cloudy_days == 0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
    <hr class="my-1">
    <div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			You can get skin cancer on parts of your skin that are never exposed to the sun
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q4_skin_cancer_possibility_on_unexposed_skin" id="Hbqhl_q4_skin_cancer_possibility_on_unexposed_skin" value="1" 
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q4_skin_cancer_possibility_on_unexposed_skin == 1) echo 'checked';}?>>
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q4_skin_cancer_possibility_on_unexposed_skin" id="Hbqhl_q4_skin_cancer_possibility_on_unexposed_skin" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q4_skin_cancer_possibility_on_unexposed_skin) AND $hbqid_form->Hbqhl_q4_skin_cancer_possibility_on_unexposed_skin == 0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
    <hr class="my-1">
    <div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			You only need to wear sun protection when the sun is at its highest peak during the day
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q5_wear_sun_protection_oh_highest_peak" id="Hbqhl_q5_wear_sun_protection_oh_highest_peak" value="1" 
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q5_wear_sun_protection_oh_highest_peak == 1) echo 'checked';}?>>
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q5_wear_sun_protection_oh_highest_peak" id="Hbqhl_q5_wear_sun_protection_oh_highest_peak" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q5_wear_sun_protection_oh_highest_peak) AND $hbqid_form->Hbqhl_q5_wear_sun_protection_oh_highest_peak == 0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
    <hr class="my-1">
    <div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			Tanning beds are safer than the sun
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q6_tanning_bed_safe" id="Hbqhl_q6_tanning_bed_safe" value="1"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q6_tanning_bed_safe == 1) echo 'checked';}?> >
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q6_tanning_bed_safe" id="Hbqhl_q6_tanning_bed_safe" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q6_tanning_bed_safe ) AND $hbqid_form->Hbqhl_q6_tanning_bed_safe == 0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
    <hr class="my-1">
    <div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			Getting a base tan is a healthy way to protect skin from sun damage
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q7_base_tan_protection_of_sun_damage" id="Hbqhl_q7_base_tan_protection_of_sun_damage" value="1"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q7_base_tan_protection_of_sun_damage == 1) echo 'checked';}?> >
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q7_base_tan_protection_of_sun_damage" id="Hbqhl_q7_base_tan_protection_of_sun_damage" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q7_base_tan_protection_of_sun_damage ) AND $hbqid_form->Hbqhl_q7_base_tan_protection_of_sun_damage == 0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
    <hr class="my-1">
    <div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			Sun exposure during childhood is related to skin cancer in adulthood
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q8_sun_exposure_during_childhood" id="Hbqhl_q8_sun_exposure_during_childhood" value="1"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q8_sun_exposure_during_childhood == 1) echo 'checked';}?> >
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q8_sun_exposure_during_childhood" id="Hbqhl_q8_sun_exposure_during_childhood" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q8_sun_exposure_during_childhood ) AND $hbqid_form->Hbqhl_q8_sun_exposure_during_childhood == 0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
    <hr class="my-1">
    <div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			It is smarter to tan indoors using a tanning bed where ultraviolet rays can be controlled
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q9_smart_indoor_tanning" id="Hbqhl_q9_smart_indoor_tanning" value="1"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q9_smart_indoor_tanning == 1) echo 'checked';}?> >
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q9_smart_indoor_tanning" id="Hbqhl_q9_smart_indoor_tanning" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q9_smart_indoor_tanning) AND $hbqid_form->Hbqhl_q9_smart_indoor_tanning == 0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
    <hr class="my-1">
    <div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			You don’t need to use sunscreen if you have dark skin or already have a tan
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q10_sunscreen_not_required_if_have_dark_skin" id="Hbqhl_q10_sunscreen_not_required_if_have_dark_skin" value="1" 
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q10_sunscreen_not_required_if_have_dark_skin == 1) echo 'checked';}?>>
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q10_sunscreen_not_required_if_have_dark_skin" id="Hbqhl_q10_sunscreen_not_required_if_have_dark_skin" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q10_sunscreen_not_required_if_have_dark_skin ) AND $hbqid_form->Hbqhl_q10_sunscreen_not_required_if_have_dark_skin == 0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
    <hr class="my-1">
    <div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			A sunscreen with SPF 30 provides twice the protection as an SPF 15
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q11_spf30_sunscreen_twice_protection" id="Hbqhl_q11_spf30_sunscreen_twice_protection" value="1"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q11_spf30_sunscreen_twice_protection == 1) echo 'checked';}?> >
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q11_spf30_sunscreen_twice_protection" id="Hbqhl_q11_spf30_sunscreen_twice_protection" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q11_spf30_sunscreen_twice_protection) AND $hbqid_form->Hbqhl_q11_spf30_sunscreen_twice_protection == 0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
    <hr class="my-1">
    <div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			People with suntans are healthier than people who don’t have suntans
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q12_healthier_people_with_suntans" id="Hbqhl_q12_healthier_people_with_suntans" value="1"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q12_healthier_people_with_suntans == 1) echo 'checked';}?> >
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q12_healthier_people_with_suntans" id="Hbqhl_q12_healthier_people_with_suntans" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q12_healthier_people_with_suntans ) AND $hbqid_form->Hbqhl_q12_healthier_people_with_suntans == 0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
    <hr class="my-1">
    <div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			You usually have your baby teeth for 8 years 
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q13_baby_teeth_8yr" id="Hbqhl_q13_baby_teeth_8yr" value="1"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q13_baby_teeth_8yr == 1) echo 'checked';}?> >
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q13_baby_teeth_8yr" id="Hbqhl_q13_baby_teeth_8yr" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q13_baby_teeth_8yr ) AND $hbqid_form->Hbqhl_q13_baby_teeth_8yr == 0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
    <hr class="my-1">
    <div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			Magnesium supplementation is essential for developing and maintaining good teeth.
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q14_magnesium_supplements_good_teeth" id="Hbqhl_q14_magnesium_supplements_good_teeth" value="1"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q14_magnesium_supplements_good_teeth == 1) echo 'checked';}?> >
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q14_magnesium_supplements_good_teeth" id="Hbqhl_q14_magnesium_supplements_good_teeth" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q14_magnesium_supplements_good_teeth ) AND $hbqid_form->Hbqhl_q14_magnesium_supplements_good_teeth == 0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
    <hr class="my-1">
    <div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			Inflammation of the gums is referred to as gingivitis.
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q15_gum_inflammation_as_gingivitis" id="Hbqhl_q15_gum_inflammation_as_gingivitis" value="1" 
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q15_gum_inflammation_as_gingivitis == 1) echo 'checked';}?>>
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q15_gum_inflammation_as_gingivitis" id="Hbqhl_q15_gum_inflammation_as_gingivitis" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q15_gum_inflammation_as_gingivitis ) AND $hbqid_form->Hbqhl_q15_gum_inflammation_as_gingivitis ==0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
    <hr class="my-1">
    <div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			Deciduous teeth are commonly referred to as your wisdom teeth.
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q16_deciduous_teeth" id="Hbqhl_q16_deciduous_teeth" value="1" 
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q16_deciduous_teeth == 1) echo 'checked';}?>>
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q16_deciduous_teeth" id="Hbqhl_q16_deciduous_teeth" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q16_deciduous_teeth ) AND $hbqid_form->Hbqhl_q16_deciduous_teeth == 0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
    <hr class="my-1">
    <div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			Bleeding gums when you brush your teeth is a sign of gum disease.
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q17_bleeding_gums_sign" id="Hbqhl_q17_bleeding_gums_sign" value="1" 
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q17_bleeding_gums_sign == 1) echo 'checked';}?>>
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q17_bleeding_gums_sign" id="Hbqhl_q17_bleeding_gums_sign" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q17_bleeding_gums_sign ) AND $hbqid_form->Hbqhl_q17_bleeding_gums_sign == 0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
    <hr class="my-1">
    <div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			Fluoride protects teeth against tooth decay. 
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q18_fluoride_teeth_protection" id="Hbqhl_q18_fluoride_teeth_protection" value="1"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q18_fluoride_teeth_protection == 1) echo 'checked';}?> >
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q18_fluoride_teeth_protection" id="Hbqhl_q18_fluoride_teeth_protection" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q18_fluoride_teeth_protection ) AND $hbqid_form->Hbqhl_q18_fluoride_teeth_protection == 0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
    <hr class="my-1">
    <div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			You should use only 10 cm of floss to floss your teeth.
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q19_teeth_floss_10cm" id="Hbqhl_q19_teeth_floss_10cm" value="1"
			<?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q19_teeth_floss_10cm == 1) echo 'checked';}?> >
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q19_teeth_floss_10cm" id="Hbqhl_q19_teeth_floss_10cm" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q19_teeth_floss_10cm ) AND $hbqid_form->Hbqhl_q19_teeth_floss_10cm == 0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
    <hr class="my-1">
    <div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			The chemical that helps you sleep is called melatonin
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q20_chemical_sleep_melatonin" id="Hbqhl_q20_chemical_sleep_melatonin" value="1" 
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q20_chemical_sleep_melatonin == 1) echo 'checked';}?>>
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q20_chemical_sleep_melatonin" id="Hbqhl_q20_chemical_sleep_melatonin" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q20_chemical_sleep_melatonin ) AND $hbqid_form->Hbqhl_q20_chemical_sleep_melatonin == 0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
    <hr class="my-1">
    <div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			There are 6 stages of sleep. 
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q21_stages_of_sleep" id="Hbqhl_q21_stages_of_sleep" value="1"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q21_stages_of_sleep == 1) echo 'checked';}?> >
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q21_stages_of_sleep" id="Hbqhl_q21_stages_of_sleep" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q21_stages_of_sleep ) AND $hbqid_form->Hbqhl_q21_stages_of_sleep == 0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
    <hr class="my-1">
    <div class="form-row">
  		<div class="form-group col-md-10">
		<div class="form-check">
			<label class="col-form-label">
			Each sleep cycle takes 90 minutes.
			</label>
		</div>
   		</div>
 		<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q22_sleep_cycle" id="Hbqhl_q22_sleep_cycle" value="1"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if ($hbqid_form->Hbqhl_q22_sleep_cycle == 1) echo 'checked';}?> >
			True
			</label>
		</div>
    	</div>
    	<div class="form-group col-md-1">
		<div class="form-check">
			<label class="col-form-label">
			<input class="form-check-input" type="radio" name="Hbqhl_q22_sleep_cycle" id="Hbqhl_q22_sleep_cycle" value="0"
            <?php if (isset($_GET['hbqid'])&&!empty($_GET['hbqid'])) { if (!is_null($hbqid_form->Hbqhl_q22_sleep_cycle ) AND $hbqid_form->Hbqhl_q22_sleep_cycle == 0) echo 'checked';}?>>
			False
			</label>
		</div>
    	</div>
    </div>
    <div class="form-row text-center mt-4">
  <div class="form-group col-md-12">
  <a class="btn btn-danger" role="button" onclick="history.go(-1);" style="color:white;">Cancel</a>
  <?php if(isset($_GET['hbqid'])&&!empty($_GET['hbqid'])){ ?>
   <input class="btn btn-primary" role="button" type="submit" value="Update" name="go_register_form" >
  <?php }else{ ?>
  <?php ?>
 	<input class="btn btn-primary" role="button" type="submit" value="Submit" name="go_register_form" >
  <?php } ?>
  </div>
  </div>
</div>
</form>
