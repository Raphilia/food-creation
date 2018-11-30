<?php
extract($_POST);
//connect to server
$connect = mysqli_connect("localhost", "root", "", "foodcreation");
if (!$connect) {
    die('ERROR:' . mysqli_connect_error());
}
?>