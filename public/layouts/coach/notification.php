<?php
		$sql2 = "SELECT * FROM participant_goal where answer_checked=0";
		$notifications = ParticipantGoal::find_by_sql($sql2);
		var_dump($notifications);
		$notecnt = count($notifications);
		echo $notecnt;
?>