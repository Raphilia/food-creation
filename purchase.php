<?php
include "connect.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uid = mysqli_real_escape_string($connect, $_SESSION['userID']);
    $cart = json_decode($_POST['cart']);
    //if cart is not empty
    if ($cart) {
        //generate receipt in database and obtain receipt ID
        $q = "INSERT INTO receipts(userID) VALUES ($uid)";
        $result = mysqli_query($connect, $q);
        $receipt_id = mysqli_insert_id($connect);
        echo "Receipt with ID <b>$receipt_id</b> has been generated.<br>";

        //insert item IDs in cart into database
        foreach ($cart as $counter) {
            $itemID = mysqli_real_escape_string($connect, $counter);
            $q = "INSERT INTO receipt_items (itemID, receiptID) VALUES ($itemID, $receipt_id)";
            $result = mysqli_query($connect, $q);
            if(!$result){
			    echo mysqli_error($connect);
            }
        }
        echo "Successfully purchased ".sizeof($cart)." items.<br>";

        //recalculate total price on receipt
        $q = "SELECT receipt_items.receiptID, receipt_items.itemID, items.itemPrice FROM receipt_items
        INNER JOIN items ON receipt_items.itemID=items.itemID
        WHERE receipt_items.receiptID=$receipt_id;";
        $result = mysqli_query($connect, $q);
        $total = 0; //initialize total 
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $total += $row['itemPrice'];
        }
        echo "Total purchase is <b>RM $total</b>.";

        //submit price to receipt
        $q = "UPDATE receipts SET totalCost = $total WHERE receiptID = $receipt_id";
        $result = mysqli_query($connect, $q);
        if(!$result) {
            echo "Failed to update totalCost in database.<br>";
            echo mysqli_error($connect);
        }
    } else { //if cart is empty, null or undefined
        echo "cart data is not passed.";
    }
}
