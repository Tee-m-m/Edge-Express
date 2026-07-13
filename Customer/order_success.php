<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.html");
    exit();
}

$pickup = isset($_SESSION['pickup_time']) ? $_SESSION['pickup_time'] : "Not Selected";
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<title>Order Success</title>

 <link rel="stylesheet" href="../Assets/css/style.css">

    <link rel="stylesheet" href="../Assets/css/navbar.css">

    <link rel="stylesheet" href="../Assets/css/hero.css">
    <link rel="stylesheet" href="../Assets/css/sections.css">

    <link rel="stylesheet" href="../Assets/css/animations.css">

    <link rel="stylesheet" href="../Assets/css/responsive.css">
<link rel="stylesheet" href="../Assets/css/order-success.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body>

<div class="background-blur blur1"></div>
<div class="background-blur blur2"></div>

<div class="success-card">

<div class="tick">

<i class="fas fa-circle-check"></i>

</div>

<h1>Order Confirmed!</h1>

<p>

Your order has been placed successfully.

</p>

<div class="success-info">

<div>

<span>Pickup Time</span>

<h3><?php echo $pickup; ?></h3>

</div>

<div>

<span>Payment</span>

<h3>Cash on Pickup</h3>

</div>

<div>

<span>Status</span>

<h3>Preparing 🍴</h3>

</div>

</div>

<a href="menu.php" class="home-btn">

Back to Menu

</a>

</div>

</body>

</html>