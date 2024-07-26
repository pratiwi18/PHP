<style>
p {
    word-wrap: break-word;
}
</style>
<?php
require_once('../includes/message.php');
global $database;
global $session;
$participantid=$session->participantid;

if(isset($_GET['msgid'])&&!empty($_GET['msgid'])){
	$sql = "UPDATE message SET isread=1 WHERE messageid={$_GET['msgid']}";
	$database->query($sql);
	$sql = "SELECT * FROM message WHERE messageid={$_GET['msgid']}";
	$messages = message::find_by_sql($sql);                    	
}
?>
<div class="container">
	<a class="btn btn-primary" href="<?php echo ROOT_DIR."?pageid=messagebox&pid=".$participantid?>"> Back</a>
  <br>
  <br>
</div>
<p><b>Message from coach id:<?php echo $_GET['cid']?></b></p>
<?php foreach($messages as $message) ?>
<p>
	<?php echo $message->content ?>
</p>
<?php
	include_layout_template('forms/pmessages.php');
?>