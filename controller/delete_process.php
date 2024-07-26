<?php
	require_once('../includes/participant.php');
	if(isset($_POST['go_delete_par'])){
		global $database;
		if(isset($_POST['participantid'])&&!empty($_POST['participantid'])){
			$sql = "DELETE FROM participant_barrier WHERE participantid={$_POST['participantid']}";
			$database->query($sql);
			$sql = "DELETE FROM participant_impairments WHERE participantid={$_POST['participantid']}";
			$database->query($sql);
			$sql = "DELETE FROM baseline_screening_form WHERE participantid={$_POST['participantid']}";
			$database->query($sql);
			$sql = "DELETE FROM participant WHERE participantid={$_POST['participantid']}";
			$database->query($sql);
			$rlink = "<script>location.replace('/coach_assistant/public/index.php?pageid=participant_delete');</script>";
      echo $rlink;
      return;
		}
	}
?>