<?php
require_once('../includes/session.php');
require_once('../includes/message.php');
require_once('../includes/coach.php');
require_once('../includes/participant.php');

global $session;

if($session->coach_is_logged_in()) {
  global $database;
  if (isset($_POST['send_message'])) {
    if(isset($_POST['msgid'])){
      $sql = "UPDATE message SET isread=2 WHERE messageid={$_POST['msgid']}";
	    $database->query($sql);
      echo " ";
    }
    $message = new message();
    if(isset($_POST['msgtype'])&&!empty($_POST['msgtype'])){
      if($_POST['msgtype']=='msg')
        $message->type = 0;
      else if($_POST['msgtype']=='alert')
        $message->type = 1;
      else if($_POST['msgtype']=='bcast')
        $message->type = 2;
      else
        $message->type = 100;
    }
    else
    	$message->type = 100;
    $message->fromid = $session->coachid;
    $message->toid = trim($_POST['idmsgbox']);
		$participants = Participant::find_by_id($message->toid);
		$message->first_name = $participants->first_name;
    $message->content = trim($_POST['msgbox']);
    $send_date = time();
    $message->send_date = strftime("%Y-%m-%d %H:%M:%S",$send_date);
    $message->isread = 0;
    
    if ($message->save()) {
        echo 'send message success';
    } else {
        echo "send message unsuccess";
    }
  }
}

if($session->participant_is_logged_in()) {
  global $database;
      
  if (isset($_POST['send_message'])) {
        if(isset($_POST['msgid'])){
      $sql = "UPDATE message SET isread=2 WHERE messageid={$_POST['msgid']}";
	    $database->query($sql);
      echo ' ';
        }
    $message = new message();
    $message->type = 10;
    $message->fromid = $session->participantid;
    $message->content = trim($_POST['msgbox']);
    $send_date = time();
    $message->send_date = strftime("%Y-%m-%d %H:%M:%S",$send_date);
    $message->isread = 0;
    $message->first_name = $session->participantName;
    
    if ($message->save()) {
        echo "send message success";
    } else {
        echo "send message unsuccess";
    }
  }
}
?>