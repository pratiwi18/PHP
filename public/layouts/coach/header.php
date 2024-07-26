<?php 
// load nav_selector function from function.php
	nav_selector();
	global $homeclass;
	global $notificationclass;
	global $messageclass;
?>
<?php
		require_once('../includes/session.php');
		require_once('../includes/message.php');
		require_once('../includes/coach.php');
		require_once('../includes/participant.php');
		require_once('../includes/participantGOAL.php');
		global $session;

		//$toid = $session->coachid;
		$sql1 = "SELECT * FROM message where type=10 and isread=0";
		$messages = message::find_by_sql($sql1);
		$msgcnt = count($messages);
		$sql2 = "SELECT * FROM participant_goal where answer_checked=0";
		$notifications = ParticipantGoal::find_by_sql($sql2);
		$notecnt = count($notifications);
?>

<header>
<div class="masthead">

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="<?php echo ROOT_DIR."?pageid=home"?>">Coach Assistant</a>
      <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault1" aria-controls="navbarsExampleDefault1" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault1">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php echo $homeclass; ?>">
            <a class="nav-link" href="<?php echo ROOT_DIR."?pageid=home"?>">Home</a>
          </li>
					<li class="nav-item <?php echo $notificationclass;?>">
            <a class="nav-link" id="coachnote" href="<?php echo ROOT_DIR."?pageid=notification"?>">Notification<?php if($notecnt>0) echo "({$notecnt})"; ?></a>
          </li>
          <li class="nav-item <?php echo $messageclass;?>">
            <a class="nav-link" id="coachmsg" href="<?php echo ROOT_DIR."?pageid=messagebox" ?>">Messages<?php if($msgcnt>0) echo "({$msgcnt})"; ?></a>
          </li>
        </ul>
        <form class="form-inline mt-6 mt-md-0" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        	<input class="btn btn-outline-danger" role="button" type="submit" name="logout" value="Logout"  >
        </form>
      </div>
    </nav>
</div>
<br>
<br>
</header>

<script>
	var pageid = "<?php echo $_GET['pageid']?>";
	var msgcnt = <?php echo $msgcnt ?>;
	var notecnt = <?php echo $notecnt ?>;
	var msg=document.getElementById("coachmsg");
	var note=document.getElementById("coachnote");
	function msgcolorchange(){
		if(msg.style.color=="blue")
			msg.style.color="grey";
		else
			msg.style.color="blue";
	}
	function notecolorchange(){
		if(note.style.color=="yellow")
			note.style.color="grey";
		else
			note.style.color="yellow";
	}
	if(msgcnt>0 && pageid!="messagebox"){
		setInterval("msgcolorchange()", 2200);
	}
	if(notecnt>0 && pageid!="notification"){
		setInterval("notecolorchange()", 2100);
	}
</script>

<!--form class="form-inline mt-2 mt-md-0" method="get">
         <input type="hidden" value="participant" name="pageid">
            <select class="form-control mr-2" name="sfield">
              <option <!--?php echo $fnfield ; ?> value="fn">First name</option>
              <option <!--?php echo $lnfield ; ?> value="ln">Last name</option>
              <option <!--?php echo $pifield ; ?> value="pi">Participant ID</option>
            </select>
          <input class="form-control mr-sm-2" type="text" placeholder="Search" name="svalue" aria-label="Search" value="< ?php echo $svalue ; ?>">
          <input class="btn btn-outline-success" role="button" type="submit" value="Search">
</form-->
        
