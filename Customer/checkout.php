<?php
session_start();
include '../config/edge_express.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    header("Location: cart.php");
    exit();
}

if (!isset($_SESSION['pickup_time'])) {
    header("Location: pickup.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$pickup_time = $_SESSION['pickup_time'];

try{

    $conn->begin_transaction();

    $total = 0;

    foreach($_SESSION['cart'] as $food_id=>$qty){

        $food_id=(int)$food_id;

        $result=$conn->query("SELECT price FROM fooditems WHERE food_id=$food_id");

        if($result->num_rows==0){
            throw new Exception("Food not found");
        }

        $food=$result->fetch_assoc();

        $total += $food['price']*$qty;
    }

    // Insert Order
    $stmt=$conn->prepare("INSERT INTO orders(user_id,pickup_time,total_price,order_status)
    VALUES(?,?,?,?)");

    $status="Pending";

    $stmt->bind_param("isds",$user_id,$pickup_time,$total,$status);

    $stmt->execute();

    $order_id=$conn->insert_id;

    $stmt->close();

    // Insert Items
    $stmt=$conn->prepare("INSERT INTO order_items(order_id,food_id,quantity,unit_price,subtotal)
    VALUES(?,?,?,?,?)");

    foreach($_SESSION['cart'] as $food_id=>$qty){

        $food_id=(int)$food_id;

        $result=$conn->query("SELECT price FROM fooditems WHERE food_id=$food_id");

        $food=$result->fetch_assoc();

        $price=$food['price'];

        $subtotal=$price*$qty;

        $stmt->bind_param("iiidd",$order_id,$food_id,$qty,$price,$subtotal);

        $stmt->execute();
    }

    $stmt->close();

    $conn->commit();

    unset($_SESSION['cart']);
    unset($_SESSION['pickup_time']);

    header("Location: order_success.php?order_id=".$order_id);
    exit();

}catch(Exception $e){

    $conn->rollback();

    die($e->getMessage());

}
?>