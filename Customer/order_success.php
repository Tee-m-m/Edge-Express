<?php
// Shows the order confirmation after checkout.

session_start();
include '../config/edge_express.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit;
}

$order_id = intval($_GET['order_id']);
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM orders WHERE order_id = '$order_id' AND user_id = '$user_id'";
$result = $conn->query($sql);
$order = $result->fetch_assoc();

if (!$order) {
    header("Location: cart.php");
    exit;
}

$itemSql = "SELECT oi.quantity, oi.subtotal, fi.name
            FROM order_items oi
            JOIN fooditems fi ON fi.food_id = oi.food_id
            WHERE oi.order_id = '$order_id'";
$itemResult = $conn->query($itemSql);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edge.Express | Skip the Queue</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->


    <link rel="stylesheet" href="../Assets/css/style.css">

    <link rel="stylesheet" href="../Assets/css/navbar.css">

    <link rel="stylesheet" href="../Assets/css/hero.css">
    <link rel="stylesheet" href="../Assets/css/sections.css">

    <link rel="stylesheet" href="../Assets/css/animations.css">

    <link rel="stylesheet" href="../Assets/css/responsive.css">

</head>
<body>

<div class="background-blur blur1"></div>
<div class="background-blur blur2"></div>

<nav class="navbar">

<div class="logo">

<img src="../Resources/EE logo.png" alt="Edge Express Logo">
   Edge Express

</div>

<ul>

<li><a href="index.php" class="active">Home</a></li>

<li><a href="menu.php">Menu</a></li>

<li><a href="about.php">About</a></li>

<li><a href="contact.php">Contact</a></li>

</ul>

<div class="nav-btn">

 <a href="../User_management/profile.php">My profile</a>

</div>

</nav>

<div class="container py-5">
    <h1 class="page-title">Order Placed Successfully!</h1>

    <p>Order Number: <strong>#EE-<?php echo str_pad($order['order_id'], 5, "0", STR_PAD_LEFT); ?></strong></p>
    <p>Pickup Time: <strong><?php echo date("g:i A", strtotime($order['pickup_time'])); ?></strong></p>
    <p>Status: <strong><?php echo $order['order_status']; ?></strong></p>

    <table class="table table-bordered bg-white" style="max-width:500px;">
        <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>
        <?php while ($item = $itemResult->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($item['name']); ?></td>
            <td><?php echo $item['quantity']; ?></td>
            <td>Rs. <?php echo number_format($item['subtotal'], 2); ?></td>
        </tr>
        <?php } ?>
    </table>

    <p class="fs-4"><strong>Total Paid on Pickup: Rs. <?php echo number_format($order['total_price'], 2); ?></strong></p>

    <a href="../index.php" class="btn btn-premium-login">Back to Menu</a>
</div>

</body>
</html>
