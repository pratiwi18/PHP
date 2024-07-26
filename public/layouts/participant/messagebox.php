<style>
td {
    text-align: center;
    max-width: 50px;
    word-wrap: break-word;
}
</style>
<?php
		$pid = $_GET['pid'];
		$sql = "SELECT * FROM message where toid=$pid";
		$messages = message::find_by_sql($sql);
?>
	
	<div class="row">
		<div id="addButton" class="col-sm-12 ml-sm-auto col-md-12 pt-5 text-center">
			<h5>All messages</h5>
		</div>
    <div>
      	<a href="<?php echo ROOT_DIR."?pageid=message" ?>" class="btn btn-primary"role="button">Send Message to Coach</a>
    </div>
							
		<div id="#demo-order-list" class="col-sm-12 ml-sm-auto col-md-12 pt-5">
			<input type='hidden' id='ssort' name="ssort" value='desc'>
			<table id='empTable' class="table table-hover text-center tablesorter">
				<thead>
					<tr>
            <th class="text-center">From</th>
						<th class="text-center">Message</th>
						<th class="text-center">Status</th>
            <th class="text-center">Reply</th>
						<th class="text-center">Date</th>
					</tr>
				</thead>
				<tbody>
	<?php
  
		foreach($messages as $message){	
      if ($message->type == 0) {
	?>
						<tr>
              <td>
                
                <?php  echo 'Coach '.$message->fromid ?>
              </td>
							<td>
								<?php echo $message->content ?>
							</td>
              <td>							
                <?php 
                        if($message->isread==0) echo "Unread"; 
                          else if($message->isread==1) echo "Read";
								           else echo "Replied" ?>
							</td>
							 <td>
								<a href="<?php echo ROOT_DIR."?pageid=read_message&msgtype=msg&msgid=".$message->messageid."&cid=".$message->fromid ?>" class="btn btn-primary"role="button">Read</a>
               
							</td>
              <td>
								<?php echo $message->send_date ?>
							</td>
						</tr>
						<?php
	       }
   }
	?>
				</tbody>
			</table>
		</div>
	</div>
<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
<script>
$('document').ready(function(){
	$('#empTable').tablesorter({widgets: ['zebra']});
});
</script>