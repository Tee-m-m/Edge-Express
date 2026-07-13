<?php
session_start();
include '../config/edge_express.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$pickup_time = $_SESSION['pickup_time'];

// Calculate total
$total = 0;

foreach($_SESSION['cart'] as $food_id => $qty){

    $food_id = (int)$food_id;

    $result = $conn->query("SELECT price FROM fooditems WHERE food_id=$food_id");
    $food = $result->fetch_assoc();

    $total += $food['price'] * $qty;
}


// Save order

$sql = "INSERT INTO orders(user_id,pickup_time,total_price,order_status)
VALUES('$user_id','$pickup_time','$total','Pending')";

$conn->query($sql);

$order_id = $conn->insert_id;


// Save order items

foreach($_SESSION['cart'] as $food_id=>$qty){

    $food_id=(int)$food_id;

    $food=$conn->query("SELECT price FROM fooditems WHERE food_id=$food_id")->fetch_assoc();

    $price=$food['price'];

    $subtotal=$price*$qty;

    $conn->query("INSERT INTO order_items
    (order_id,food_id,quantity,unit_price,subtotal)

    VALUES

    ('$order_id','$food_id','$qty','$price','$subtotal')");
}


// Empty cart

unset($_SESSION['cart']);

header("Location: order_success.php?order_id=".$order_id);

exit();
?>