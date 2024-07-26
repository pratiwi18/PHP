<?php
// load nav_selector function from function.php
nav_selector();
global $homeclass;
global $profileclass;
global $messagesclass;
global $session;
global $participantid;
$participantid = $session->participantid;
$participantName = $session->participantName;

$sql1 = "SELECT * FROM message where type=0 and isread=0 and toid=$participantid";
$messages = message::find_by_sql($sql1);
$msgcnt = count($messages);
?>

  <header>
    <div class="masthead">

      <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #001742; height: 100px">
        <h1>
          <a class="navbar-brand" href="index_participant.php">Coach Assistant</a>
        </h1>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php echo $homeclass; ?>"><a class="nav-link" href="<?php echo ROOT_DIR . "?pageid=home" ?>">Home
                            <span class="sr-only">(current)</span></a></li>
            <li class="nav-item <?php echo $profileclass; ?>"><a class="nav-link" href="<?php echo ROOT_DIR . "?pageid=profile&paction=view" ?>">Profile</a>
            </li>
            <!--li class="nav-item <?php echo $participantclass; ?>"><a class="nav-link" href="<?php //echo ROOT_DIR." ?pageid=participant&paction=view&pid=".$participantid ?>">Program</a>
            </li-->
            <li class="nav-item <?php echo $messagesclass; ?>">
              <a class="nav-link"  id="pamsg" href="<?php echo ROOT_DIR . "?pageid=messagebox&pid=".$participantid?>">Messages<?php if($msgcnt>0) echo "({$msgcnt})"; ?></a>             
            </li>
          </ul>


        </div>
      </nav>
      <nav class="navbar navbar-expand-md navbar-light" style="background-color: #d6f1ff; height: 50px">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
         
        </ul>
        <form class="form-inline mt-6 mt-md-0 ml-2 text-right" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <button class="btn btn-danger" role="button" type="submit" name="logout" value="Logout">Logout
                </button>
        </form>
      </nav>
    </div>
  </header>


<script>
	var pageid = "<?php echo $_GET['pageid']?>";
	var msgcnt = <?php echo $msgcnt ?>;
	var msg=document.getElementById("pamsg");
  
	function msgcolorchange(){
		if(msg.style.color=="blue")
			msg.style.color="grey";
		else
			msg.style.color="blue";
	}

	if(msgcnt>0 && pageid!="messagebox"){
		setInterval("msgcolorchange()", 2200);
	}

</script>