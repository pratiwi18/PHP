<?php
//$con = mysqli_connect("localhost","root","");
$con = mysqli_connect("localhost","paecoach_user","ca2018!@"); // server
//mysqli_select_db($con, "coach_assistant")or die( "<p><span style=\"color: red;\">Unable to select database</span></p>");
mysqli_select_db($con, "paecoach_db")or die( "<p><span style=\"color: red;\">Unable to select database</span></p>"); // server
?>