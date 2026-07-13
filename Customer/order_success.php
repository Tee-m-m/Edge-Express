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
<title>Order Confirmed | Edge Express</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../Assets/style.css">
</head>
<body>

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
