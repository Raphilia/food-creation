<?php //this php establishes connection to database
extract($_POST);
$connect = mysqli_connect("localhost", "root", "", "foodcreation");
if (!$connect) { die('ERROR:' . mysqli_connect_error()); } ?>