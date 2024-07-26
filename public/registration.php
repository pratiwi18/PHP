    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="js/scripts.js" type="text/javascript"></script>
    <script src="js/tether.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui.min.js" type="text/javascript"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="js/validation.min.js" type="text/javascript"></script>
    <script src="js/functions.js" type="text/javascript"></script>
    <script>
     /* $(document).ready(function(){
        $(".nav-pills a").click(function(){
          $(this).tab('show');
        });
      });*/
    </script>
<?php
require_once ("../includes/initialize.php");
?>
  <html>

  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <link rel="stylesheet" href="css/styles.css">

    <title>Coach Assistant: Registration</title>

  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top" style="background-color: #001742; height: 100px">
      <h1>
        <a class="navbar-brand" href="index_participant.php">Coach Assistant</a>
      </h1>
      <a class="btn btn-primary float-right btn-lg" href="index_participant.php">Login</a>
    </nav>
    <div class="container pt-5">
      <div class="row justify-content-center">
        <div class="col-md-12 align-middle text-center">
          <div class="mb-4">Who are you?</div>
          <ul class=" nav nav-pills nav-fill mb-3" id="registration-tab" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="pills-participant-tab" data-toggle="pill" href="#pills-participant" role="tab" aria-controls="pills-participant" aria-selected="true">Participant</a>
            </li>
            <li class="nav-item"><a class="nav-link" id="pills-coach-tab" data-toggle="pill" href="#pills-coach" role="tab" aria-controls="pills-coach" aria-selected="false">Coach</a></li>
          </ul>
        </div>
        <div class="tab-content col-md-12" id="registration-tabContent">
          <div class="tab-pane fade show active" id="pills-participant" role="tabpanel" aria-labelledby="pills-participant-tab">
            <?php include_layout_template('forms/initial_information.php');?>
          </div>
          <div class="tab-pane fade" id="pills-coach" role="tabpanel" aria-labelledby="pills-coach-tab">
            <?php include_layout_template('forms/coach_information.php');?>
          </div>
        </div>
      </div>
    </div>
    </body>
  </html>
  <?php //if(isset($database)) { $database->close_connection(); } ?>