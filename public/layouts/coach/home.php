<body>
  <div class="jumbotron bg-jum">
    <div class="overlay text-center">
      <br>
      <h1><b>Coach Administration</b></h1>
      <br>
      <br>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <h3>Data Distribution</h3>
      <p>
        View the data distribution of participants.
      </p>
      <ul style="list-style-type: none;">
        <li><a class="btn btn-outline-info" href="<?php echo ROOT_DIR."?pageid=statistics"?>">Go &raquo;</a></li>
      </ul>
    </div>
    <div class="col-md-4">
      <h3>Maintenance</h3>
      <p>
        Maintain your participants.
      </p> 
      <ul style="list-style-type: none;">
        <li><a class="btn btn-outline-primary" href="<?php echo ROOT_DIR."?pageid=participant_add"?>">Add &raquo;</a></li>
        <li><p></p></li>
        <li><a class="btn btn-outline-info" href="<?php echo ROOT_DIR."?pageid=participant_main"?>">View & Update &raquo;</a></li>
        <li><p></p></li>
        <li><a class="btn btn-outline-danger" href="<?php echo ROOT_DIR."?pageid=participant_delete"?>">Delete &raquo;</a></li>
      </ul>
    </div>
    <div class="col-md-4">
      <h3>Message</h3>
      <p>
        Send message to your participants.
      </p>
      <ul style="list-style-type: none;">
        <li><a class="btn btn-outline-info" href="<?php echo ROOT_DIR."?pageid=participant_message"?>">Message &raquo;</a></li>
        <li><p></p></li>
        <li><a class="btn btn-outline-warning" href="<?php echo ROOT_DIR."?pageid=participant_alert"?>">Alert &raquo;</a></li>
        <li><p></p></li>
        <li><a class="btn btn-outline-secondary" href="<?php echo ROOT_DIR."?pageid=message&msgtype=bcast"?>">Broadcast &raquo;</a></li>
      </ul>
    </div>
    </div>
</body>
<style>
  .bg-jum {
    background-image: url("images/coachhome.jpg");
    background-size: cover;
    color: white;
    opacity: 0.8;
  }
</style>