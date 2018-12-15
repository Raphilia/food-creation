<?php
/* OBTAIN PURCHASE INFORMATIONS */
include 'connect.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$uid = $_SESSION['userID'];
$q = "SELECT * FROM receipts WHERE userID = $uid";
$result = mysqli_query($connect, $q);
if (mysqli_num_rows($result)==0) {
    echo '<img src="img/oops.gif" alt="oops" width="400">';
    echo '<p><b>Looks like you haven\'t made any purchase yet.</b><br>
    Don\'t fret! It\'s never too late to make one.</p>';
} else {
    echo '<img src="img/wanwan.gif" alt="yay" width="300">';
    echo '<p><b>Hurrah! Thanks for buying from us.</b><br>
    Looks like you\'ve lost some money, now go get some more!</p>';
}
?>