<?php
include "connect.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (session_status() == PHP_SESSION_NONE) { //start session if not started
        session_start();
    }
    //get user id from session and cart from cookie
    $uid = $_SESSION['userID'];
    //check if cart is not null
    if (isset($_POST['jsonCart'])) {
        //make receipt first to get receiptID
        $q = 'INSERT INTO receipts(userID) VALUES ($uid)';
        $result = @mysqli_query($connect, $q);
        //obtain receiptID
        $q = 'SELECT * FROM receipts WHERE userID = '.$uid;
        $result = @mysqli_query($connect, $q);
        if ($result) {
            while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                echo 'Receipt created.<br>';
                //cart array
                $cart = $_POST['cart'];
                $receiptID = $row['receiptID'];
                foreach ($cart as $item) {
                    $q = 'INSERT INTO receipt-items(itemID,receiptID) VALUES ($item, $receiptID)';
                    $result = @mysqli_query($connect, $q);
                }
                echo sizeof($cart).' items has successfully been purchased.';
            }
        } else {
            echo 'Receipt creation failed.';
            echo mysqli_error($connect);
        }
    } else {
        echo 'data is not passed.';
    }
}